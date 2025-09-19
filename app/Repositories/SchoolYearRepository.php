<?php

namespace App\Repositories;

use App\Models\SchoolYear;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface;

class SchoolYearRepository implements SchoolYearRepositoryInterface
{
    public function findAll(array $relations = [])
    {
        return SchoolYear::with($relations)->get();
    }

    public function findById($id, array $relations = [])
    {
        return SchoolYear::with($relations)->findOrFail($id);
    }


    public function create(array $data)
    {
        return SchoolYear::create($data);
    }

    public function update($id, array $data)
    {
        $schoolYear = SchoolYear::findOrFail($id);
        $schoolYear->update($data);
        return $schoolYear;
    }

    public function delete($id)
    {
        $schoolYear = SchoolYear::findOrFail($id);
        // $schoolYear->roles()->detach(); // optional, pivot bisa dihapus otomatis jika cascade
        return $schoolYear->delete();
    }
}
