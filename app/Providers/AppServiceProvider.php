<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot()
{
    //$this->registerPolicies();

    Gate::define('admin', function ($user) {
        return $user->is_admin; // Ajusta según tu modelo de usuario
    });
}
}
