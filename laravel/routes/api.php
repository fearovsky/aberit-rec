<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('employees', 'App\Http\Controllers\EmployeeController')->only([
        'index',
        'store',
        'show',
        'update',
        'destroy'
    ]);
});
