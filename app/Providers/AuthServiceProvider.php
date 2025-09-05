<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Gates\UserGate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Role::class => \App\Policies\RolePolicy::class,
        \App\Models\Permission::class => \App\Policies\PermissionPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies(); // WAJIB

        // Tambahan: Register Gate custom kalau ada
        UserGate::define();
    }
}
