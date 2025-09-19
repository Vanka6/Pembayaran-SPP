<?php

namespace App\Repositories;

use App\Models\Departement;
use App\Repositories\Interfaces\DepartementRepositoryInterface;

class DepartementRepository implements DepartementRepositoryInterface
{
    public function findAll(array $relations = [])
    {
        return Departement::with($relations)->get();
    }

    public function findById($id, array $relations = [])
    {
        return Departement::with($relations)->findOrFail($id);
    }

    public function create(array $data)
    {
        return Departement::create($data);
    }

    public function update($id, array $data)
    {
        $departement = Departement::findOrFail($id);
        $departement->update($data);
        return $departement;
    }

    public function delete($id)
    {
        $departement = Departement::findOrFail($id);
        // $departement->roles()->detach(); // optional, pivot bisa dihapus otomatis jika cascade
        return $departement->delete();
    }

    /**
     * Find role by name.
     */
    public function findByName(string $name)
    {
        return Departement::where('departement_name', $name)->firstOrFail();
    }
}
