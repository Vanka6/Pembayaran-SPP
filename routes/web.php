<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::middleware(['auth'])->group(function () {
    /**
     * Dashboard Management Routes
     */
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    /**
     * Auth Management Routes
     */
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    /**
     * User Management Routes
     */
    Route::resource('/users', UserController::class);

    /**
     * Role Management Routes
     */
    Route::resource('/roles', RoleController::class);

    /**
     * Permission Management Routes
     */
    Route::resource('/permissions', PermissionController::class);
});
