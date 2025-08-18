<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\JobController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\EducationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Laravel automatically prefixes all routes in this file with '/api'.
| We will add our own 'v1' prefix for versioning.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/employment', [JobController::class, 'index']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/education', [EducationController::class, 'index']);
});
