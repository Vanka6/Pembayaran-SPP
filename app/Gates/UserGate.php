<?php

namespace App\Gates;

use Illuminate\Support\Facades\Gate;

class UserGate
{
    public static function define()
    {
        Gate::define('manage-users', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage-employees', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage-students', function ($user) {
            return  $user->hasRole('admin') || $user->hasRole('employee');
        });

        // Tambah definisi lain jika perlu
    }
}
