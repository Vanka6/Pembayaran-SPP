<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\Interfaces\UserServiceInterface;

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
        $this->authorize('viewAny', User::class);
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
        $this->authorize('create', User::class);
        try {
            $roles = $this->roleService->getAll();
            $statuses = UserStatus::cases();
            return view('pages.users.create', compact('roles', 'statuses'));
        } catch (Exception $e) {
            Log::error('Error create user: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman create user.');
        }
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);
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

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        try {
            $user  = $this->userService->getById($user->id);
            $roles = $this->roleService->getAll();
            $statuses = UserStatus::cases();
            return view('pages.users.edit', compact('user', 'roles', 'statuses'));
        } catch (Exception $e) {
            Log::error('Error edit user: ' . $e->getMessage());
            return redirect()
                ->route('user-management.users.index')
                ->with('error', 'User tidak ditemukan.');
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        try {
            $this->userService->update($user->id, $request->validated());
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

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        try {
            $this->userService->destroy($user->id);
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
