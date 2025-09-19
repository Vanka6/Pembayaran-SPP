<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Repositories\Interfaces\ClassroomRepositoryInterface;

class ClassroomRepository implements ClassroomRepositoryInterface
{
    public function findAll(array $relations = [])
    {
        return Classroom::with($relations)->get();
    }

    public function findById($id, array $relations = [])
    {
        return Classroom::with($relations)->findOrFail($id);
    }

    public function findByNames(array $names)
    {
        return Classroom::whereIn('classroom_name', $names)->toArray();
    }

    public function create(array $data)
    {
        return Classroom::create($data);
    }

    public function update($id, array $data)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->update($data);
        return $classroom;
    }

    public function delete($id)
    {
        $classroom = Classroom::findOrFail($id);
        // $classroom->roles()->detach(); // optional, pivot bisa dihapus otomatis jika cascade
        return $classroom->delete();
    }
}
