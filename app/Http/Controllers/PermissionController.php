<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Exception;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\PermissionServiceInterface;

class PermissionController extends Controller
{

    private $permissionService;

    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $permissions = $this->permissionService->getAll();
            return view('pages.permissions.index', compact('permissions'));
        } catch (Exception $e) {
            Log::error('Error permissions index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data permissions.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('pages.permissions.create');
        } catch (Exception $e) {
            Log::error('Error create permission: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman create permission.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        try {
            $this->permissionService->store($request->validated());
            return redirect()
                ->route('user-management.permissions.index')
                ->with('success', 'Permission berhasil ditambahkan.');
        } catch (Exception $e) {
            Log::error('Error store permission: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data permission.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        try {
            $permission  = $this->permissionService->getById($permission->id);
            return view('pages.permissions.edit', compact('permission'));
        } catch (Exception $e) {
            Log::error('Error edit permission: ' . $e->getMessage());
            return redirect()
                ->route('user-management.permissions.index')
                ->with('error', 'Permission tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        try {
            $this->permissionService->update($permission->id, $request->validated());
            return redirect()
                ->route('user-management.permissions.index')
                ->with('success', 'Permission berhasil diperbaharui.');
        } catch (Exception $e) {
            Log::error('Error update permission: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbaharui data permission.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try {
            $this->permissionService->destroy($permission->id);
            return redirect()
                ->route('user-management.permissions.index')
                ->with('success', 'Permission berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Error delete permission: ' . $e->getMessage());
            return redirect()
                ->route('user-management.permissions.index')
                ->with('error', 'Terjadi kesalahan saat menghapus permission.');
        }
    }
}
