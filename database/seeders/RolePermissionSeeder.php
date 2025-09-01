<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Roles
        $roles = [
            'admin',
            'student',
            'employee',
            'student_guardian',
        ];

        $roleInstances = [];
        foreach ($roles as $roleName) {
            $roleInstances[$roleName] = Role::create(['name' => $roleName]);
        }

        // 2. Buat Permissions
        $permissions = [
            'view_dashboard',
            'manage_users',
            'manage_roles',
            'manage_permissions',
            'view_grades',
            'pay_spp',
        ];

        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        // 3. Ambil semua permission
        $allPermissions = Permission::all();

        // 4. Atur permission per role
        // Admin -> semua permission
        $roleInstances['admin']->permissions()->sync($allPermissions->pluck('id'));

        // Student -> hanya bisa lihat dashboard dan bayar SPP
        $studentPerms = Permission::whereIn('name', ['view_dashboard', 'pay_spp'])->pluck('id');
        $roleInstances['student']->permissions()->sync($studentPerms);

        // Employee -> bisa lihat dashboard, manage users
        $employeePerms = Permission::whereIn('name', ['view_dashboard', 'manage_users'])->pluck('id');
        $roleInstances['employee']->permissions()->sync($employeePerms);

        // Student guardian -> hanya lihat dashboard
        $guardianPerms = Permission::where('name', 'view_dashboard')->pluck('id');
        $roleInstances['student_guardian']->permissions()->sync($guardianPerms);

        // 5. Buat beberapa user contoh dan assign role
        $adminUser = User::create([
            'email' => 'admin@example.com',
            'password' => bcrypt('123123123'),
        ]);
        $adminUser->roles()->attach($roleInstances['admin']->id);

        $studentUser = User::create([
            'email' => 'student@example.com',
            'password' => bcrypt('123123123'),
        ]);
        $studentUser->roles()->attach($roleInstances['student']->id);

        $employeeUser = User::create([
            'email' => 'employee@example.com',
            'password' => bcrypt('123123123'),
        ]);
        $employeeUser->roles()->attach($roleInstances['employee']->id);

        $guardianUser = User::create([
            'email' => 'guardian@example.com',
            'password' => bcrypt('123123123'),
        ]);
        $guardianUser->roles()->attach($roleInstances['student_guardian']->id);
    }
}
