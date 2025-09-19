<?php

namespace App\Services;

use App\Models\DepartementClassroom;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\DepartementServiceInterface;
use App\Repositories\Interfaces\DepartementRepositoryInterface;

class DepartementService implements DepartementServiceInterface
{
    private $departementRepository;

    public function __construct(DepartementRepositoryInterface $departementRepository)
    {
        $this->departementRepository = $departementRepository;
    }

    public function getAll()
    {
        try {
            return $this->departementRepository->findAll(['classrooms']);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil semua data departement: " . $e->getMessage(), 0, $e);
        }
    }

    public function getById($id)
    {
        try {
            return $this->departementRepository->findById($id,);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil departement ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $departement = $this->departementRepository->create($data);
            DB::commit();
            return $departement;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal membuat departement: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $departementData = ['departement_name' => $data['departement_name']];
            $departement = $this->departementRepository->update($id, $departementData);
            $this->syncClassrooms($id, $data['classrooms']);
            DB::commit();
            return $departement;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate departement ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $departement = $this->departementRepository->delete($id);
            // dd($departement);
            DB::commit();
            return $departement;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus departement ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function syncClassrooms($departementId, array $classroomIds)
    {
        DB::beginTransaction();
        try {
            // Harus dibuat repo dan service nanti (deleteByDepartementId)
            DepartementClassroom::where('departement_id', $departementId)->delete();

            // Harus dibuat repo dan service nanti (create)
            foreach ($classroomIds as $classroomId) {
                DepartementClassroom::create([
                    'departement_id' => $departementId,
                    'classroom_id'   => $classroomId,
                ]);
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menyinkronkan classroom untuk departement ID {$departementId}: " . $e->getMessage(), 0, $e);
        }
    }

    public function detachAllClassrooms($departementId)
    {
        DB::beginTransaction();
        try {
            // Harus dibuat repo dan service nanti (deleteByDepartementId)
            DepartementClassroom::where('departement_id', $departementId)->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus relasi kelas untuk departement ID {$departementId}: " . $e->getMessage(), 0, $e);
        }
    }
}
