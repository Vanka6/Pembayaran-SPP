<?php

namespace App\Repositories\Interfaces;

interface DepartementRepositoryInterface
{
    public function findAll(array $relations = []);
    public function findById($id, array $relations = []);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByName(string $name);
}
