<?php

namespace App\Providers;

use App\BusinessLogic\ContactService;
use App\BusinessLogicInterfaces\IContactService;
use App\DataAccess\ContactRepository;
use App\DataAccessInterfaces\IContactRepository;
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
        $this->app->bind(IContactRepository::class, ContactRepository::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IContactService::class, ContactService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
