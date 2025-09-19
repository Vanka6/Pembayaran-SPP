<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DepartementClassroomController;
use App\Http\Controllers\StudentGuardianController;

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

Route::get('/', fn() => redirect()->route('login'));

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::middleware(['auth'])->group(function () {
    /**
     * Dashboard Management Routes
     */
    Route::get('/dashboard', fn() => view('pages.dashboard'))->name('dashboard');

    /**
     * Auth Management Routes
     */
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    // Manajemen User
    Route::prefix('user-management')->as('user-management.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
    });

    Route::prefix('student-management')->as('student-management.')->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('classrooms', ClassroomController::class);
        Route::resource('school-years', SchoolYearController::class);
        Route::resource('departements', DepartementController::class);
        Route::resource('student-guardians', StudentGuardianController::class);

        /**
         * Departement Classroom Routes
         */
        Route::resource('departement-classroom', DepartementClassroomController::class);
    });
});
