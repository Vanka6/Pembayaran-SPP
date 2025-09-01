<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\RoleServiceInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleService implements RoleServiceInterface
{
    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAll()
    {
        try {
            return $this->roleRepository->findAll();
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil semua data role: " . $e->getMessage(), 0, $e);
        }
    }

    public function getById($id)
    {
        try {
            return $this->roleRepository->findById($id);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil role ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->create($data);

            // $profile = $this->profileRepository->create([
            //     'user_id' => $role->id
            // ]);

            DB::commit();

            return [
                'role' => $role,
                // 'profile' => $profile
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal membuat role: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->update($id, $data);
            DB::commit();
            return $role;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate role ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->delete($id);
            DB::commit();
            return $role;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus role ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
