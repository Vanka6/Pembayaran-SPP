<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function findAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
