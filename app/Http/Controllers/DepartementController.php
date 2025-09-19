<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Departement;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;
use App\Services\Interfaces\ClassroomServiceInterface;
use App\Services\Interfaces\DepartementServiceInterface;

class DepartementController extends Controller
{
    private $departementService;
    private $classroomService;

    public function __construct(DepartementServiceInterface $departementService, ClassroomServiceInterface $classroomService)
    {
        $this->departementService = $departementService;
        $this->classroomService = $classroomService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Departement::class);
        try {
            $departements = $this->departementService->getAll();
            return view('pages.departements.index', compact('departements'));
        } catch (Exception $e) {
            Log::error('Error departements index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data departements.' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Departement::class);
        try {
            return view('pages.departements.create');
        } catch (Exception $e) {
            Log::error('Error create student: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman create student.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartementRequest $request)
    {
        $this->authorize('create', Departement::class);
        try {

            $this->departementService->store($request->validated());
            return redirect()
                ->route('student-management.departements.index')
                ->with('success', 'Departement berhasil ditambahkan.');
        } catch (Exception $e) {
            Log::error('Error store departement: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data departement.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement)
    {
        try {
            $departement = $this->departementService->getById($departement->id);
            $classrooms = $this->classroomService->getAll();
            $selectedClassrooms = $departement->classrooms->pluck('id')->toArray();
            return view('pages.departements.edit', compact('departement', 'classrooms', 'selectedClassrooms'));
        } catch (Exception $e) {
            Log::error('Error edit departement: ' . $e->getMessage());
            return redirect()
                ->route('student-management.departements.index')
                ->with('error', 'Departement tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartementRequest $request, Departement $departement)
    {
        try {
            $this->departementService->update($departement->id, $request->validated());
            return redirect()
                ->route('student-management.departements.index')
                ->with('success', 'Departement berhasil diperbaharui.');
        } catch (Exception $e) {
            Log::error('Error update departement: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbaharui data departement.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        try {
            $this->departementService->destroy($departement->id);
            return redirect()
                ->route('student-management.departements.index')
                ->with('success', 'Departement berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Error delete departement: ' . $e->getMessage());
            return redirect()
                ->route('student-management.departements.index')
                ->with('error', 'Terjadi kesalahan saat menghapus departement.');
        }
    }
}
