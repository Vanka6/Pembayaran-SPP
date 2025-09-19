<?php

namespace App\Services;


use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\ClassroomServiceInterface;
use App\Repositories\Interfaces\ClassroomRepositoryInterface;

class ClassroomService implements ClassroomServiceInterface
{
    private $classroomRepository;

    public function __construct(ClassroomRepositoryInterface $classroomRepository)
    {
        $this->classroomRepository = $classroomRepository;
    }

    public function getAll()
    {
        try {
            return $this->classroomRepository->findAll();
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil semua data classroom: " . $e->getMessage(), 0, $e);
        }
    }

    public function getById($id)
    {
        try {
            return $this->classroomRepository->findById($id);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil classroom ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function getByNames(array $names)
    {
        try {
            return $this->classroomRepository->findByNames($names);
        } catch (Exception $e) {
            throw new Exception("Gagal mengambil permission Ids {$names}: " . $e->getMessage(), 0, $e);
        }
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $classroom = $this->classroomRepository->create($data);
            DB::commit();
            return $classroom;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal membuat classroom: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $classroom = $this->classroomRepository->update($id, $data);
            DB::commit();
            return $classroom;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal mengupdate classroom ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $classroom = $this->classroomRepository->delete($id);
            DB::commit();
            return $classroom;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Gagal menghapus classroom ID {$id}: " . $e->getMessage(), 0, $e);
        }
    }
}
