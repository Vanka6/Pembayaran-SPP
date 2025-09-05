<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function findAll()
    {
        return Permission::all();
    }

    public function findById($id)
    {
        return Permission::findOrFail($id);
    }

    public function findIdsByNames($names)
    {
        return Permission::whereIn('name', $names)->pluck('id')->toArray();
    }

    public function create(array $data)
    {
        return Permission::create($data);
    }

    public function update($id, array $data)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($data);
        return $permission;
    }

    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        return $permission->delete();
    }
}
