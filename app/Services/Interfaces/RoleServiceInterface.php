<?php

namespace App\Services\Interfaces;

interface RoleServiceInterface
{
    public function getAll();
    public function getById($id);
    public function getByName($name);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
}
