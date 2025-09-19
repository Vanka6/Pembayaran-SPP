<?php

namespace App\Repositories\Interfaces;

interface ClassroomRepositoryInterface
{
    public function findAll(array $relations = []);
    public function findById($id, array $relations = []);
    public function findByNames(array $names);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
