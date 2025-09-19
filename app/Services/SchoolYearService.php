<?php

namespace App\Services;


use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\SchoolYearServiceInterface;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface;

class SchoolYearService implements SchoolYearServiceInterface
{
    private $schoolYearRepository;

    public function __construct(SchoolYearRepositoryInterface $schoolYearRepository)
    {
        $this->schoolYearRepository = $schoolYearRepository;
    }

    public function getAll()
    {
        try {
            return $this->schoolYearRepository->findAll();
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil semua data school year: " . $e->getMessage(), 0, $e);
        }
    }

    public function getById($id)
    {
        try {
            return $this->schoolYearRepository->findById($id,);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil school year ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $schoolYear = $this->schoolYearRepository->create($data);
            DB::commit();
            return $schoolYear;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal membuat school year: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $schoolYear = $this->schoolYearRepository->update($id, $data);
            DB::commit();
            return $schoolYear;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate school year ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $schoolYear = $this->schoolYearRepository->delete($id);
            DB::commit();
            return $schoolYear;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus school year ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
