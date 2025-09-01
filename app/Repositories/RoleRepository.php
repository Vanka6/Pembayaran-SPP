<?php

namespace App\Repositories;

use Exception;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function findAll()
    {
        try {
            return Role::all();
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil data role: " . $e->getMessage(), 0, $e);
        }
    }

    public function findById($id)
    {
        try {
            return Role::findOrFail($id);
        } catch (Exception $e) {
            throw new Exception("Role dengan ID {$id} tidak ditemukan: " . $e->getMessage(), 0, $e);
        }
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $role = Role::create($data);
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
            $role = Role::findOrFail($id);

            $role->update($data);

            DB::commit();
            return $role;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate role ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus role ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
