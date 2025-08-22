<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SearchController;

// --- Static Pages ---
Route::view('/', 'pages.home')->name('home');
Route::view('/resume', 'pages.resume')->name('resume');
Route::view('/about-me', 'pages.about-me')->name('about-me');
Route::view('/education', 'pages.education')->name('education');
Route::view('/employment', 'pages.employment')->name('employment');
Route::view('/api-docs', 'pages.api-docs')->name('api-docs');

// --- Projects (Reverted to read from JSON) ---
Route::get('/projects', function () {
    $projects = json_decode(file_get_contents(resource_path('json/projects.json')), true);
    return view('pages.projects', [
        'projects' => $projects,
        'sidebar' => 'sidebars._sidebar-projects'
    ]);
})->name('projects.index');

Route::get('/projects/{project_slug}', function ($project_slug) {
    $projects = json_decode(file_get_contents(resource_path('json/projects.json')), true);
    $project = collect($projects)->firstWhere('id', $project_slug); // Use 'id' to match JSON structure
    if (!$project) {
        abort(404);
    }
    return view('pages.projects.detail', [
        'project' => $project,
        'sidebar' => 'sidebars._sidebar-project-detail'
    ]);
})->name('projects.show');


// --- Contact Form ---
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// --- Salary Checker ---
Route::get('/about-me/salary', [SalaryController::class, 'show'])->name('salary.show');
Route::post('/api/v1/salary-check', [SalaryController::class, 'check'])->name('api.v1.salary.check');

// --- Search ---
Route::get('/search', [SearchController::class, 'search'])->name('search');

// --- API Routes ---
Route::prefix('api/v1')->name('api.v1.')->group(function () {
    Route::get('/employment', [\App\Http\Controllers\Api\V1\JobController::class, 'index'])->name('employment.index');
    Route::get('/projects', [\App\Http\Controllers\Api\V1\ProjectController::class, 'index'])->name('projects.index');
    Route::get('/education', [\App\Http\Controllers\Api\V1\EducationController::class, 'index'])->name('education.index');
});

// --- Admin & Auth Routes ---
require __DIR__.'/auth.php';

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('education', \App\Http\Controllers\Admin\EducationController::class, ['as' => 'admin']);
    Route::resource('jobs', \App\Http\Controllers\Admin\JobController::class, ['as' => 'admin']);
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class, ['as' => 'admin']);
});
