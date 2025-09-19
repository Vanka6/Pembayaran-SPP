<?php

namespace App\Services\Interfaces;

interface DepartementServiceInterface
{
    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
    public function syncClassrooms($departementName, array $classroomNames);
    public function detachAllClassrooms($departementId);
}
