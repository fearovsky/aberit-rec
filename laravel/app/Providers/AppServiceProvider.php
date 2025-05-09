<?php

namespace App\Providers;

use App\Services\EmployeeService;
use App\Services\EmployeeServiceI;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EmployeeRepository;
use App\Repositories\EmployeeRepositoryI;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            EmployeeRepositoryI::class,
            EmployeeRepository::class
        );

        $this->app->bind(
            EmployeeServiceI::class,
            EmployeeService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
