<?php

namespace App\Services;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\RoleServiceInterface;

class UserService implements UserServiceInterface
{
    private $userRepository;
    private $roleService;

    public function __construct(UserRepositoryInterface $userRepository, RoleServiceInterface $roleService)
    {
        $this->userRepository = $userRepository;
        $this->roleService = $roleService;
    }

    public function getAll()
    {
        try {
            return $this->userRepository->findAll(['student', 'studentGuardian']);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil semua data user: " . $e->getMessage(), 0, $e);
        }
    }

    public function getAvailableStudentUsers(?string $status = null, ?string $excludeEmail = null)
    {
        try {
            return $this->userRepository->findUsersWithoutLinkedStudent($status, $excludeEmail);
        } catch (Exception $e) {
            throw new Exception(
                "Gagal mengambil semua data user yang tidak berelasi dengan siswa: " . $e->getMessage(),
                0,
                $e
            );
        }
    }



    public function getById($id)
    {
        try {
            return $this->userRepository->findById($id, ['student', 'studentGuardian']);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil user ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function getByEmail(string $email)
    {
        try {
            return $this->userRepository->findByEmail($email, ['student', 'studentGuardian']);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil user ID {$email}: " . $e->getMessage(), 0, $e);
        }
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            // Hash password di sini
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }

            if (!empty($data['role'])) {
                $data['role'] = $this->roleService->getByName($data['role'])->id;
            }

            $role = $data['role'] ?? [];
            unset($data['role']);

            $user = $this->userRepository->create($data);

            $user->roles()->sync($role);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal membuat user: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }
            if (!empty($data['role'])) {
                $data['role'] = $this->roleService->getByName($data['role'])->id;
            }

            $role = $data['role'] ?? [];
            unset($data['role']);

            $user = $this->userRepository->update($id, $data);

            // Hanya sync kalau ada role baru
            if ($role) {
                $user->roles()->sync($role);
            }

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate user ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->delete($id);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus user ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
