<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\UsuarioServiceInterface;
use App\Services\UsuarioService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UsuarioServiceInterface::class, UsuarioService::class);
    }

    public function boot()
    {
        //
    }
}