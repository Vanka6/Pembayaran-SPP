<?php

namespace App\Providers;

use App\Models\Permission;
use App\Services\AuthService;
use App\Services\RoleService;
use App\Services\UserService;
use App\Services\StudentService;
use App\Services\ClassroomService;
use App\Services\PermissionService;
use App\Services\SchoolYearService;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\DepartementService;
use App\Repositories\StudentRepository;
use Illuminate\Support\ServiceProvider;
use App\Services\StudentGuardianService;
use App\Repositories\ClassroomRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\SchoolYearRepository;
use App\Repositories\DepartementRepository;
use App\Repositories\StudentGuardianRepository;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\StudentServiceInterface;
use App\Services\Interfaces\ClassroomServiceInterface;
use App\Services\Interfaces\PermissionServiceInterface;
use App\Services\Interfaces\SchoolYearServiceInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\DepartementServiceInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Services\Interfaces\StudentGuardianServiceInterface;
use App\Repositories\Interfaces\ClassroomRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface;
use App\Repositories\Interfaces\DepartementRepositoryInterface;
use App\Repositories\Interfaces\StudentGuardianRepositoryInterface;

class ServiceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        /**
         * Repository Binds
         */
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(StudentGuardianRepositoryInterface::class, StudentGuardianRepository::class);
        $this->app->bind(SchoolYearRepositoryInterface::class, SchoolYearRepository::class);
        $this->app->bind(DepartementRepositoryInterface::class, DepartementRepository::class);
        $this->app->bind(ClassroomRepositoryInterface::class, ClassroomRepository::class);

        /**
         * Service Binds
         */
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->bind(PermissionServiceInterface::class, PermissionService::class);
        $this->app->bind(StudentServiceInterface::class, StudentService::class);
        $this->app->bind(StudentGuardianServiceInterface::class, StudentGuardianService::class);
        $this->app->bind(SchoolYearServiceInterface::class, SchoolYearService::class);
        $this->app->bind(DepartementServiceInterface::class, DepartementService::class);
        $this->app->bind(ClassroomServiceInterface::class, ClassroomService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
