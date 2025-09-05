<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\PermissionServiceInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionService implements PermissionServiceInterface
{
    private $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function getAll()
    {
        try {
            return $this->permissionRepository->findAll();
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil semua data permission: " . $e->getMessage(), 0, $e);
        }
    }

    public function getById($id)
    {
        try {
            return $this->permissionRepository->findById($id);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil permission ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function getIdsByNames($names)
    {
        try {
            return $this->permissionRepository->findIdsByNames($names);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil permission Ids {$names}: " . $e->getMessage(), 0, $e);
        }
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $permission = $this->permissionRepository->create($data);

            DB::commit();

            return $permission;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal membuat permission: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $permission = $this->permissionRepository->update($id, $data);
            DB::commit();
            return $permission;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate permission ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $permission = $this->permissionRepository->delete($id);
            DB::commit();
            return $permission;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus permission ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
