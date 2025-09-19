<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\SchoolYear;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreSchoolYearRequest;
use App\Http\Requests\UpdateSchoolYearRequest;
use App\Services\Interfaces\SchoolYearServiceInterface;

class SchoolYearController extends Controller
{
    private $schoolYearService;

    public function __construct(SchoolYearServiceInterface $schoolYearService)
    {
        $this->schoolYearService = $schoolYearService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', SchoolYear::class);
        try {
            $schoolYears = $this->schoolYearService->getAll();
            return view('pages.school-years.index', compact('schoolYears'));
        } catch (Exception $e) {
            Log::error('Error school-years index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data school-years.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', SchoolYear::class);
        try {
            return view('pages.school-years.create');
        } catch (Exception $e) {
            Log::error('Error create school year: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman create school year.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolYearRequest $request)
    {
        $this->authorize('create', SchoolYear::class);
        try {
            $this->schoolYearService->store($request->validated());
            return redirect()
                ->route('student-management.school-years.index')
                ->with('success', 'School year berhasil ditambahkan.');
        } catch (Exception $e) {
            Log::error('Error store school year: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data school year.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolYear $schoolYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolYear $schoolYear)
    {
        try {
            $schoolYear  = $this->schoolYearService->getById($schoolYear->id);
            return view('pages.school-years.edit', compact('schoolYear'));
        } catch (Exception $e) {
            Log::error('Error edit school year: ' . $e->getMessage());
            return redirect()
                ->route('student-management.school-years.index')
                ->with('error', 'School year tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolYearRequest $request, SchoolYear $schoolYear)
    {
        try {
            $this->schoolYearService->update($schoolYear->id, $request->validated());
            return redirect()
                ->route('student-management.school-years.index')
                ->with('success', 'School year berhasil diperbaharui.');
        } catch (Exception $e) {
            Log::error('Error update school year: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbaharui data school year.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolYear $schoolYear)
    {
        try {
            $this->schoolYearService->destroy($schoolYear->id);
            return redirect()
                ->route('student-management.school-years.index')
                ->with('success', 'School year berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Error delete school year: ' . $e->getMessage());
            return redirect()
                ->route('student-management.school-years.index')
                ->with('error', 'Terjadi kesalahan saat menghapus school year.');
        }
    }
}
