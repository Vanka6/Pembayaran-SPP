<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Get all roles.
     */
    public function findAll(): Collection
    {
        return Role::all();
    }

    /**
     * Find role by ID.
     */
    public function findById(int $id): Role
    {
        return Role::findOrFail($id);
    }

    /**
     * Find role by name.
     */
    public function findByName(string $name): Role
    {
        return Role::where('name', $name)->firstOrFail();
    }

    /**
     * Create a new role.
     */
    public function create(array $data): Role
    {
        return Role::create($data);
    }

    /**
     * Update an existing role.
     */
    public function update(int $id, array $data): Role
    {
        $role = $this->findById($id);
        $role->update($data);
        return $role;
    }

    /**
     * Delete a role by ID.
     */
    public function delete(int $id): bool
    {
        $role = $this->findById($id);
        return $role->delete();
    }
}
