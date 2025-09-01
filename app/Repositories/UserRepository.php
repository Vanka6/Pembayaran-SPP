<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findAll()
    {
        try {
            return User::all();
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil data user: " . $e->getMessage(), 0, $e);
        }
    }

    public function findById($id)
    {
        try {
            return User::findOrFail($id);
        } catch (Exception $e) {
            throw new Exception("User dengan ID {$id} tidak ditemukan: " . $e->getMessage(), 0, $e);
        }
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $user = User::create($data);
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
            $user = User::findOrFail($id);

            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = bcrypt($data['password']);
            }

            $user->update($data);

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate user ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus user ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
