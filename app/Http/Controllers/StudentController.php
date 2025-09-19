<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Student;
use App\Enums\UserGender;
use Illuminate\Http\Request;
use App\Enums\GraduationStatus;
use Illuminate\Support\Facades\Log;
use App\Enums\StudentGuardianRelationType;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\StudentServiceInterface;
use App\Services\Interfaces\DepartementServiceInterface;

class StudentController extends Controller
{
    private StudentServiceInterface $studentService;
    private UserServiceInterface $userService;
    private DepartementServiceInterface $departementService;

    public function __construct(
        StudentServiceInterface $studentService,
        UserServiceInterface $userService,
        DepartementServiceInterface $departementService
    ) {
        $this->studentService = $studentService;
        $this->userService = $userService;
        $this->departementService = $departementService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $students = $this->studentService->getAll();
            return view('pages.students.index', compact('students'));
        } catch (Exception $e) {
            Log::error('Error students index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data students.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $genders = UserGender::cases();
            $graduationStatuses = GraduationStatus::cases();
            $guardianRelations = StudentGuardianRelationType::cases();
            $users = $this->userService->getAvailableStudentUsers('active');
            $departements = $this->departementService->getAll();

            return view('pages.students.create', compact(
                'genders',
                'graduationStatuses',
                'guardianRelations',
                'users',
                'departements'
            ));
        } catch (Exception $e) {
            Log::error('Error create student: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman create student.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            $this->studentService->store($request->validated());

            return redirect()
                ->route('student-management.students.index')
                ->with('success', 'Student berhasil ditambahkan.');
        } catch (Exception $e) {
            Log::error('Error store student: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data student. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        try {
            $student = $this->studentService->getById($student->id);

            return view('pages.students.show', compact('student'));
        } catch (Exception $e) {
            Log::error('Error show student: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat detail student.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        try {
            $student = $this->studentService->getById($student->id);
            $genders = UserGender::cases();
            $graduationStatuses = GraduationStatus::cases();
            $users = $this->userService->getAvailableStudentUsers('active', $student->user->email); // dengan exclude
            $departements = $this->departementService->getAll();
            return view('pages.students.edit', compact(
                'student',
                'genders',
                'graduationStatuses',
                'users',
                'departements'
            ));
        } catch (Exception $e) {
            Log::error('Error edit student: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman edit student.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            $this->studentService->update($student->id, $request->validated());
            return redirect()
                ->route('student-management.students.index')
                ->with('success', 'Student berhasil diperbarui.');
        } catch (Exception $e) {
            Log::error('Error update student: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data student. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $this->studentService->destroy($student->id);

            return redirect()
                ->route('student-management.students.index')
                ->with('success', 'Student berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Error delete student: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data student.' . $e->getMessage());
        }
    }
}
