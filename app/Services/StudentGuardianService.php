<?php

namespace App\Services;


use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\StudentGuardianServiceInterface;
use App\Repositories\Interfaces\StudentGuardianRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;

class StudentGuardianService implements StudentGuardianServiceInterface
{
    private $studentGuardianRepository;
    private $userService;

    public function __construct(StudentGuardianRepositoryInterface $studentGuardianRepository, UserServiceInterface $userService)
    {
        $this->studentGuardianRepository = $studentGuardianRepository;
        $this->userService = $userService;
    }

    public function getAll()
    {
        try {
            return $this->studentGuardianRepository->findAll();
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil semua data student guardian: " . $e->getMessage(), 0, $e);
        }
    }

    public function getById($id)
    {
        try {
            return $this->studentGuardianRepository->findById($id,);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil student guardian ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $studentGuardian = $this->studentGuardianRepository->create($data);
            DB::commit();
            return $studentGuardian;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal membuat student guardian: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $studentGuardiandData = [
                'fullname' => $data['fullname'],
                'phone_number' => $data['phone_number'],
                'relation_type' => $data['relation_type'],
                'address' => $data['address']
            ];
            $studentGuardian = $this->studentGuardianRepository->update($id, $studentGuardiandData);
            $studentGuardianUser = ['email' => $data['email'], 'password' => $data['password']];
            $this->userService->update($studentGuardian->user->id, $studentGuardianUser);
            DB::commit();
            return $studentGuardian;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate student guardian ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $studentGuardian = $this->studentGuardianRepository->delete($id);
            DB::commit();
            return $studentGuardian;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus student guardian ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
