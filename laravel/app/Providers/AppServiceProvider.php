<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\{
    TaskService,
    TaskServiceI,
    ProjectService,
    ProjectServiceI,
    EmployeeService,
    EmployeeServiceI
};

use App\Repositories\{
    TaskRepository,
    TaskRepositoryI,
    ProjectRepository,
    EmployeeRepository,
    ProjectRepositoryI,
    EmployeeRepositoryI
};


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmployeeRepositoryI::class, EmployeeRepository::class);
        $this->app->bind(TaskRepositoryI::class, TaskRepository::class);
        $this->app->bind(ProjectRepositoryI::class, ProjectRepository::class);

        $this->app->bind(EmployeeServiceI::class, EmployeeService::class);
        $this->app->bind(TaskServiceI::class, TaskService::class);
        $this->app->bind(ProjectServiceI::class, ProjectService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
