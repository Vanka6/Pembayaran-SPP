<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findAll()
    {
        return User::with('roles')->get();
    }

    public function findById($id)
    {
        return User::with('roles')->findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach(); // optional, pivot bisa dihapus otomatis jika cascade
        return $user->delete();
    }
}
