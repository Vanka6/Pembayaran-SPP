<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentGuardianRequest;
use Exception;
use Illuminate\Http\Request;
use App\Models\StudentGuardian;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\UserServiceInterface;
use App\Http\Requests\UpdateStudentGuardianRequest;
use App\Services\Interfaces\DepartementServiceInterface;
use App\Services\Interfaces\StudentGuardianServiceInterface;

class StudentGuardianController extends Controller
{
    private StudentGuardianServiceInterface $studentGuardianService;
    private UserServiceInterface $userService;

    public function __construct(
        StudentGuardianServiceInterface $studentGuardianService,
        UserServiceInterface $userService,
    ) {
        $this->studentGuardianService = $studentGuardianService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $studentGuardians = $this->studentGuardianService->getAll();
            return view('pages.student-guardians.index', compact('studentGuardians'));
        } catch (Exception $e) {
            Log::error('Error students index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data student guardians.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentGuardianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentGuardian $studentGuardian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentGuardian $studentGuardian)
    {
        try {
            $studentGuardian = $this->studentGuardianService->getById($studentGuardian->id);
            return view('pages.student-guardians.edit', compact('studentGuardian'));
        } catch (Exception $e) {
            Log::error('Error edit student: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman edit student.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentGuardianRequest $request, StudentGuardian $studentGuardian)
    {
        try {
            $this->studentGuardianService->update($studentGuardian->id, $request->validated());

            return redirect()
                ->route('student-management.student-guardians.index')
                ->with('success', 'Data wali siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Update wali siswa gagal: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data wali siswa.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentGuardian $studentGuardian)
    {
        try {
            $this->studentGuardianService->destroy($studentGuardian->id);

            return redirect()
                ->route('student-management.student-guardians.index')
                ->with('success', 'Data wali siswa berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Error delete wali siswa: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data wali siswa.' . $e->getMessage());
        }
    }
}
