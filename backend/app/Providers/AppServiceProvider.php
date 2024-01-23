<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\BusinessLogicInterfaces\IUserService;
use App\BusinessLogic\UserService;
use App\DataAccessInterfaces\IUserRepository;
use App\DataAccess\UserRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IUserService::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
