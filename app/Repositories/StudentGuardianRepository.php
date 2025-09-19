<?php

namespace App\Repositories;

use App\Models\StudentGuardian;
use App\Repositories\Interfaces\StudentGuardianRepositoryInterface;

class StudentGuardianRepository implements StudentGuardianRepositoryInterface
{
    public function findAll(array $relations = [])
    {
        return StudentGuardian::with($relations)->get();
    }

    public function findById($id, array $relations = [])
    {
        return StudentGuardian::with($relations)->findOrFail($id);
    }


    public function create(array $data)
    {
        return StudentGuardian::create($data);
    }

    public function update($id, array $data)
    {
        $studentGuardian = StudentGuardian::findOrFail($id);
        $studentGuardian->update($data);
        return $studentGuardian;
    }

    public function delete($id)
    {
        $studentGuardian = StudentGuardian::findOrFail($id);
        $studentGuardian->student->delete();
        return $studentGuardian->delete();
    }
}
