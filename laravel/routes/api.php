<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\EmployeeProjectController;


Route::group(['prefix' => 'v1'], function () {
    Route::prefix('employees')->group(function () {
        // Podstawowe operacje CRUD
        Route::get('/', [EmployeeController::class, 'index']);
        Route::post('/', [EmployeeController::class, 'store']);
        Route::get('/{employee}', [EmployeeController::class, 'show']);
        Route::put('/{employee}', [EmployeeController::class, 'update']);
        Route::delete('/{employee}', [EmployeeController::class, 'destroy']);

        // Relacje z projektami
        Route::get('/{employee}/projects', [EmployeeProjectController::class, 'getProjects']);
        Route::post('/{employee}/projects', [EmployeeProjectController::class, 'assignProject']);
        Route::delete('/{employee}/projects/{projectId}', [EmployeeProjectController::class, 'removeProject']);

        // Relacje z zadaniami
        Route::get('/{employee}/tasks', [EmployeeTaskController::class, 'getTasks']);
        Route::post('/{employee}/tasks', [EmployeeTaskController::class, 'assignTask']);
        Route::delete('/{employee}/tasks/{taskId}', [EmployeeTaskController::class, 'removeTask']);
    });

    // Grupa tras dla projektów (Projects)
    Route::prefix('projects')->group(function () {
        // Podstawowe operacje CRUD
        Route::get('/', [ProjectController::class, 'index']);
        Route::post('/', [ProjectController::class, 'store']);
        Route::get('/{project}', [ProjectController::class, 'show']);
        Route::put('/{project}', [ProjectController::class, 'update']);
        Route::delete('/{project}', [ProjectController::class, 'destroy']);

        // Relacje z pracownikami
        Route::get('/{project}/employees', [EmployeeProjectController::class, 'getEmployees']);
        Route::post('/{project}/employees', [EmployeeProjectController::class, 'assignEmployee']);
        Route::delete('/{project}/employees/{employeeId}', [EmployeeProjectController::class, 'removeEmployee']);

        // Relacje z zadaniami
        Route::get('/{project}/tasks', [ProjectTaskController::class, 'getTasks']);
        Route::post('/{project}/tasks', [ProjectTaskController::class, 'createTask']);
    });

    // Grupa tras dla zadań (Tasks)
    Route::prefix('tasks')->group(function () {
        // Podstawowe operacje CRUD
        Route::get('/', [TaskController::class, 'index']);
        Route::post('/', [TaskController::class, 'store']);
        Route::get('/{task}', [TaskController::class, 'show']);
        Route::put('/{task}', [TaskController::class, 'update']);
        Route::delete('/{task}', [TaskController::class, 'destroy']);

        // Relacje z pracownikami
        Route::get('/{task}/employees', [EmployeeTaskController::class, 'getEmployees']);
        Route::post('/{task}/employees', [EmployeeTaskController::class, 'assignEmployee']);
        Route::delete('/{task}/employees/{employeeId}', [EmployeeTaskController::class, 'removeEmployee']);

        // Relacje z projektem
        Route::get('/{task}/project', [ProjectTaskController::class, 'getProject']);
        Route::patch('/{task}/project', [ProjectTaskController::class, 'changeProject']);
    });
});
