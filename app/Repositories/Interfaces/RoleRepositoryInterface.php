<?php

namespace App\Repositories\Interfaces;

use App\Models\Role;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    /**
     * Get all roles.
     *
     * @return Collection
     */
    public function findAll(): Collection;

    /**
     * Find role by ID.
     *
     * @param int $id
     * @return Role
     */
    public function findById(int $id): Role;

    /**
     * Find role by name.
     *
     * @param string $name
     * @return Role
     */
    public function findByName(string $name): Role;

    /**
     * Create a new role.
     *
     * @param array $data
     * @return Role
     */
    public function create(array $data): Role;

    /**
     * Update an existing role.
     *
     * @param int $id
     * @param array $data
     * @return Role
     */
    public function update(int $id, array $data): Role;

    /**
     * Delete a role by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
