<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\Interfaces\PermissionServiceInterface;

class RoleController extends Controller
{

    private $roleService;
    private $permissionService;

    public function __construct(RoleServiceInterface $roleService, PermissionServiceInterface $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = $this->roleService->getAll();
            return view('pages.roles.index', compact('roles'));
        } catch (Exception $e) {
            Log::error('Error roles index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data roles.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $permissions = $this->permissionService->getAll();
            return view('pages.roles.create', compact('permissions'));
        } catch (Exception $e) {
            Log::error('Error create role: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman create role.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $this->roleService->store($request->validated());
            return redirect()
                ->route('user-management.roles.index')
                ->with('success', 'Role berhasil ditambahkan.');
        } catch (Exception $e) {
            Log::error('Error store role: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data role.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        try {
            $role  = $this->roleService->getById($role->id);
            $permissions = $this->permissionService->getAll();
            return view('pages.roles.edit', compact('role', 'permissions'));
        } catch (Exception $e) {
            Log::error('Error edit role: ' . $e->getMessage());
            return redirect()
                ->route('user-management.roles.index')
                ->with('error', 'Role tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            $this->roleService->update($role->id, $request->validated());
            return redirect()
                ->route('user-management.roles.index')
                ->with('success', 'Role berhasil diperbaharui.');
        } catch (Exception $e) {
            Log::error('Error update role: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbaharui data role.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $this->roleService->destroy($role->id);
            return redirect()
                ->route('user-management.roles.index')
                ->with('success', 'Role berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Error delete role: ' . $e->getMessage());
            return redirect()
                ->route('user-management.roles.index')
                ->with('error', 'Terjadi kesalahan saat menghapus role.');
        }
    }
}
