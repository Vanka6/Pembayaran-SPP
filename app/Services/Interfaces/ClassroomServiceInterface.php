<?php

namespace App\Services\Interfaces;

interface ClassroomServiceInterface
{
    public function getAll();
    public function getById($id);
    public function getByNames(array $names);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
}
