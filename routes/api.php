<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// This is a default Laravel route for user authentication, which you can use later.
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// This is the new route for our Salary Checker API.
// It listens for POST requests to the '/api/salary-check' URL.
Route::post('/salary-check', [SalaryController::class, 'check']);
