<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Student;

class StudentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('employee');
    }

    public function view(User $user, Student $model): bool
    {
        return $user->hasRole('admin') || $user->hasRole('employee');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('employee');
    }

    public function update(User $user, Student $model): bool
    {
        return $user->hasRole('admin') || $user->hasRole('employee');
    }

    public function delete(User $user, Student $model): bool
    {
        return $user->hasRole('admin') || $user->hasRole('employee');
    }
}
