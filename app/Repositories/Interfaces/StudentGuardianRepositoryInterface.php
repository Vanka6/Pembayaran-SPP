<?php

namespace App\Repositories\Interfaces;

interface StudentGuardianRepositoryInterface
{
    public function findAll(array $relations = []);
    public function findById($id, array $relations = []);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
