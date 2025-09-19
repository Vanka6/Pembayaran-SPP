<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use Exception;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\ClassroomServiceInterface;

class ClassroomController extends Controller
{

    private $classroomService;

    public function __construct(ClassroomServiceInterface $classroomService)
    {
        $this->classroomService = $classroomService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Classroom::class);
        try {
            $classrooms = $this->classroomService->getAll();
            return view('pages.classrooms.index', compact('classrooms'));
        } catch (Exception $e) {
            Log::error('Error classrooms index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data classrooms.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Classroom::class);
        try {
            return view('pages.classrooms.create');
        } catch (Exception $e) {
            Log::error('Error create student: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman create student.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request)
    {
        $this->authorize('create', Classroom::class);
        try {
            $this->classroomService->store($request->validated());
            return redirect()
                ->route('student-management.classrooms.index')
                ->with('success', 'Classroom berhasil ditambahkan.');
        } catch (Exception $e) {
            Log::error('Error store classroom: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data classroom.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        try {
            $classroom  = $this->classroomService->getById($classroom->id);
            return view('pages.classrooms.edit', compact('classroom'));
        } catch (Exception $e) {
            Log::error('Error edit classroom: ' . $e->getMessage());
            return redirect()
                ->route('student-management.classrooms.index')
                ->with('error', 'Classroom tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        try {
            $this->classroomService->update($classroom->id, $request->validated());
            return redirect()
                ->route('student-management.classrooms.index')
                ->with('success', 'Classroom berhasil diperbaharui.');
        } catch (Exception $e) {
            Log::error('Error update classroom: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbaharui data classroom.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        try {
            $this->classroomService->destroy($classroom->id);
            return redirect()
                ->route('student-management.classrooms.index')
                ->with('success', 'Classroom berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Error delete classroom: ' . $e->getMessage());
            return redirect()
                ->route('student-management.classrooms.index')
                ->with('error', 'Terjadi kesalahan saat menghapus classroom.');
        }
    }
}
