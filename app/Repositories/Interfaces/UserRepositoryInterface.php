<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function findAll(array $relations = []);
    public function findById($id, array $relations = []);
    public function findByEmail(string $email, array $relations = []);
    public function findUsersWithoutLinkedStudent(?string $status = null, ?string $excludeEmail = null);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
