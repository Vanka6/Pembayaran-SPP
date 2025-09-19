<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\ClassroomServiceInterface;
use App\Services\Interfaces\DepartementServiceInterface;

class DepartementClassroomController extends Controller
{
    private $departementService;
    private $classroomService;

    public function __construct(
        DepartementServiceInterface $departementService,
        ClassroomServiceInterface $classroomService
    ) {
        $this->departementService = $departementService;
        $this->classroomService = $classroomService;
    }

    public function create()
    {
        try {
            $departements = $this->departementService->getAll();
            $classrooms = $this->classroomService->getAll();
            return view('pages.departement-classroom.create', compact('departements', 'classrooms'));
        } catch (Exception $e) {
            Log::error('Departement create error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuka form.');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'departement' => 'required|exists:departements,id',
            'classrooms' => 'required|array',
            'classrooms.*' => 'exists:classrooms,id',
        ], [
            'departement.required' => 'Jurusan wajib dipilih.',
            'departement.exists' => 'Jurusan tidak ditemukan.',
            'classrooms.required' => 'Kelas harus dipilih.',
            'classrooms.array' => 'Format kelas tidak valid.',
            'classrooms.*.exists' => 'Kelas yang dipilih tidak valid.',
        ]);

        try {
            $this->departementService->syncClassrooms(
                $validated['departement'],
                $validated['classrooms']
            );

            return redirect()->route('student-management.departements.index')
                ->with('success', 'Relasi jurusan dan kelas berhasil disimpan.');
        } catch (Exception $e) {
            Log::error('Store error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $departement = $this->departementService->getById($id);
            $classrooms = $this->classroomService->getAll();
            $selectedClassrooms = $departement->classrooms->pluck('id')->toArray();

            return view('pages.departement-classroom.edit', compact('departement', 'classrooms', 'selectedClassrooms'));
        } catch (Exception $e) {
            Log::error('Edit error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat data edit.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'classrooms' => 'required|array',
            'classrooms.*' => 'exists:classrooms,id',
        ], [
            'classrooms.required' => 'Kelas harus dipilih.',
            'classrooms.array' => 'Format kelas tidak valid.',
            'classrooms.*.exists' => 'Kelas yang dipilih tidak valid.',
        ]);

        try {
            $this->departementService->syncClassrooms($id, $request->classrooms);
            return redirect()->route('student-management.departements.index')
                ->with('success', 'Relasi jurusan dan kelas berhasil diperbarui.');
        } catch (Exception $e) {
            Log::error('Update error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat update data.')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->departementService->detachAllClassrooms($id);
            return redirect()->route('student-management.departements.index')
                ->with('success', 'Semua relasi kelas pada jurusan ini telah dihapus.');
        } catch (Exception $e) {
            Log::error('Delete error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus relasi.');
        }
    }
}
