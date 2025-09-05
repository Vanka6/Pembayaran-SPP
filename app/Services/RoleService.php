<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\RoleServiceInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Services\Interfaces\PermissionServiceInterface;

class RoleService implements RoleServiceInterface
{
    private $roleRepository;
    private $permissionService;

    public function __construct(RoleRepositoryInterface $roleRepository, PermissionServiceInterface $permissionService)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionService = $permissionService;
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

    public function getByName($name)
    {
        try {
            return $this->roleRepository->findByName($name);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil role ID {$name}: " . $e->getMessage(), 0, $e);
        }
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $permissionNames = $data['permissions'] ?? [];

            unset($data['permissions']);

            $role = $this->roleRepository->create($data);

            $permissionIds = $this->permissionService->getIdsByNames($permissionNames);

            // Simpan ke pivot table permission_role
            $role->permissions()->sync($permissionIds);

            DB::commit();

            return $role;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal membuat role: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $permissionNames = $data['permissions'] ?? [];

            unset($data['permissions']);

            $role = $this->roleRepository->update($id, $data);

            $permissionIds = $this->permissionService->getIdsByNames($permissionNames);

            $role->permissions()->sync($permissionIds); // sinkronisasi
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
