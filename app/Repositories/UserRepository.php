<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findAll(array $relations = [])
    {
        return User::with($relations)->get();
    }

    public function findById($id, array $relations = [])
    {
        return User::with($relations)->findOrFail($id);
    }

    public function findByEmail(string $email, array $relations = [])
    {
        return User::with($relations)->where('email', $email)->first();
    }

    public function findUsersWithoutLinkedStudent(?string $status = null, ?string $excludeEmail = null)
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })
            ->where(function ($query) use ($status) {
                $query->whereDoesntHave('student', function ($subQuery) use ($status) {
                    if ($status) {
                        $subQuery->where('status', $status);
                    }
                });
            })
            ->when($excludeEmail, function ($query) use ($excludeEmail) {
                $query->orWhere('email', $excludeEmail);
            })
            ->get();
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
