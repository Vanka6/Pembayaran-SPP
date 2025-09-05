<?php

namespace App\Repositories\Interfaces;

interface PermissionRepositoryInterface
{
    public function findAll();
    public function findById($id);
    public function findIdsByNames($names);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
