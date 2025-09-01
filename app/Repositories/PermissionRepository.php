<?php

namespace App\Repositories;

use Exception;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function findAll()
    {
        try {
            return Permission::all();
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil data permission: " . $e->getMessage(), 0, $e);
        }
    }

    public function findById($id)
    {
        try {
            return Permission::findOrFail($id);
        } catch (Exception $e) {
            throw new Exception("Permission dengan ID {$id} tidak ditemukan: " . $e->getMessage(), 0, $e);
        }
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::create($data);
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
            $permission = Permission::findOrFail($id);

            $permission->update($data);

            DB::commit();
            return $permission;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate permission ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus permission ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
