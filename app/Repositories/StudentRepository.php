<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    public function findAll(array $relations = [])
    {
        return Student::with($relations)->get();
    }

    public function findById($id, array $relations = [])
    {
        return Student::with($relations)->findOrFail($id);
    }


    public function create(array $data)
    {
        return Student::create($data);
    }

    public function update($id, array $data)
    {
        $student = Student::findOrFail($id);
        $student->update($data);
        return $student;
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);
        // $student->roles()->detach(); // optional, pivot bisa dihapus otomatis jika cascade
        return $student->delete();
    }
}
