<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\RoleServiceInterface;

class UserController extends Controller
{
    private $userService;
    private $roleService;

    public function __construct(UserServiceInterface $userService, RoleServiceInterface $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index()
    {
        try {
            $users = $this->userService->getAll();
            return view('pages.users.index', compact('users'));
        } catch (Exception $e) {
            Log::error('Error users index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data users.');
        }
    }

    public function create()
    {
        try {
            $roles = $this->roleService->getAll();
            return view('pages.users.create', compact('roles'));
        } catch (Exception $e) {
            Log::error('Error create user: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman create user.');
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $this->userService->store($request->validated());
            return redirect()
                ->route('user-management.users.index')
                ->with('success', 'User berhasil ditambahkan.');
        } catch (Exception $e) {
            Log::error('Error store user: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data user.');
        }
    }

    public function edit($id)
    {
        try {
            $user  = $this->userService->getById($id);
            $roles = $this->roleService->getAll();
            return view('pages.users.edit', compact('user', 'roles'));
        } catch (Exception $e) {
            Log::error('Error edit user: ' . $e->getMessage());
            return redirect()
                ->route('user-management.users.index')
                ->with('error', 'User tidak ditemukan.');
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $this->userService->update($id, $request->validated());
            return redirect()
                ->route('user-management.users.index')
                ->with('success', 'User berhasil diperbarui.');
        } catch (Exception $e) {
            Log::error('Error update user: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data user.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->userService->destroy($id);
            return redirect()
                ->route('user-management.users.index')
                ->with('success', 'User berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Error delete user: ' . $e->getMessage());
            return redirect()
                ->route('user-management.users.index')
                ->with('error', 'Terjadi kesalahan saat menghapus user.');
        }
    }
}
