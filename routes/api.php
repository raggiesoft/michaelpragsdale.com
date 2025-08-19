<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\JobController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\EducationController;
use App\Http\Controllers\SalaryController; // <-- Add this line

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    Route::get('/employment', [JobController::class, 'index']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/education', [EducationController::class, 'index']);

    // This is the missing route for the salary checker
    Route::post('/salary-check', [SalaryController::class, 'check']);
});
