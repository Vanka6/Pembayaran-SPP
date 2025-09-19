<?php

namespace App\Services;

use Exception;
use App\Models\ClassroomStudent;
use Illuminate\Support\Facades\DB;
use App\Models\DepartementClassroom;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\StudentServiceInterface;
use App\Services\Interfaces\DepartementServiceInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Services\Interfaces\StudentGuardianServiceInterface;

class StudentService implements StudentServiceInterface
{
    private $studentRepository;
    private $userService;
    private $studentGuardianService;
    private $departementService;


    public function __construct(
        StudentRepositoryInterface $studentRepository,
        UserServiceInterface $userService,
        StudentGuardianServiceInterface $studentGuardianService,
        DepartementServiceInterface $departementService
    ) {
        $this->studentRepository = $studentRepository;
        $this->userService = $userService;
        $this->studentGuardianService = $studentGuardianService;
        $this->departementService = $departementService;
    }

    public function getAll()
    {
        try {
            return $this->studentRepository->findAll();
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil semua data student: " . $e->getMessage(), 0, $e);
        }
    }

    public function getById($id)
    {
        try {
            return $this->studentRepository->findById($id, [
                'user',
                'guardian',
                'classroomStudents',
                'activeClassroomStudent'
            ]);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil student ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $studentUser = [
                'email' => $data['student_email'],
                'password' => $data['student_password'],
                'role' => 'student',
            ];

            $studentGuardianUser = [
                'email' => $data['student_guardian_email'],
                'password' => $data['student_guardian_password'],
                'role' => 'student_guardian',
            ];

            $studentUserId = $this->userService->store($studentUser)->id;

            $studentGuardianUserId = $this->userService->store($studentGuardianUser)->id;

            $studentData = [
                'user_id' => $studentUserId,
                'nis' => $data['nis'],
                'fullname' => $data['fullname'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'phone_number' => $data['phone_number'],
                'mother_name' => $data['mother_name'],
                'graduation_status' => $data['graduation_status']
            ];

            $student = $this->studentRepository->create($studentData);

            $studentGuardianData = [
                'user_id' => $studentGuardianUserId,
                'student_id' => $student->id,
                'fullname' => $data['guardian_fullname'],
                'phone_number' => $data['guardian_phone'],
                'relation_type' => $data['relation_type'],
                'address' => $data['guardian_address']
            ];

            $studentGuardian = $this->studentGuardianService->store($studentGuardianData);

            $departement = $this->departementService->getById($data['departement']);

            $departementClassroomId = $departement->classrooms()->where('classroom_id', $data['classroom'])->first()?->pivot
                ->id;

            $activeSchoolYear = \App\Models\SchoolYear::getActive();
            if (!$activeSchoolYear) {
                throw new \Exception("Tidak ada tahun ajaran aktif.");
            }

            // Harus dibuatkan repo dan servicenya nanti
            ClassroomStudent::create([
                'student_id' => $student->id,
                'departement_classroom_id' => $departementClassroomId,
                'school_year_id' => $activeSchoolYear->id,
            ]);

            DB::commit();
            return $student;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal membuat student: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $studentData = [
                'nis' => $data['nis'],
                'fullname' => $data['fullname'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'phone_number' => $data['phone_number'],
                'mother_name' => $data['mother_name'],
                'graduation_status' => $data['graduation_status'],
            ];

            $student = $this->studentRepository->update($id, $studentData);

            $studentUser = ['email' => $data['email'], 'password' => $data['password']];
            $this->userService->update($student->user->id, $studentUser);


            // Harus dibuatkan repo dan servicenya nanti
            $departementClassroom = DepartementClassroom::where('classroom_id', $data['classroom'])
                ->where('departement_id', $data['departement'])
                ->first();

            if (!$departementClassroom) {
                throw new Exception("DepartementClassroom tidak ditemukan.");
            }

            $activeClassroomStudent = $student->activeClassroomStudent;
            if ($activeClassroomStudent) {
                $activeClassroomStudent->update([
                    'departement_classroom_id' => $departementClassroom->id,
                ]);
            }

            DB::commit();
            return $student;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate student ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $student = $this->studentRepository->delete($id);
            DB::commit();
            return $student;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus student ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
