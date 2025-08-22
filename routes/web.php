<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SearchController;

// --- Static Pages ---
Route::get('/', function () {
    return view('pages.home', [
        'page_title' => 'Home',
        'body_class' => 'page-home full-width',
    ]);
})->name('home');

Route::get('/resume', function () {
    return view('pages.resume', [
        'page_title' => 'Résumé',
        'body_class' => 'page-resume',
    ]);
})->name('resume');

Route::get('/about-me', function () {
    return view('pages.about-me', [
        'page_title' => 'About Me',
        'body_class' => 'page-about-me has-sidebar',
        'sidebar' => 'sidebars._sidebar-about-me'
    ]);
})->name('about-me');

Route::get('/education', function () {
    return view('pages.education', [
        'page_title' => 'Education',
        'body_class' => 'page-education has-sidebar',
        'sidebar' => 'sidebars._sidebar-education'
    ]);
})->name('education');

Route::get('/employment', function () {
    return view('pages.employment', [
        'page_title' => 'Employment History',
        'body_class' => 'page-employment has-sidebar',
        'sidebar' => 'sidebars._sidebar-employment'
    ]);
})->name('employment');

Route::get('/api-docs', function () {
    return view('pages.api-docs', [
        'page_title' => 'API Documentation',
        'body_class' => 'page-api-docs',
    ]);
})->name('api-docs');


// --- Projects (Reading from JSON) ---
Route::get('/projects', function () {
    $projectsArray = json_decode(file_get_contents(resource_path('json/projects.json')), true);
    return view('pages.projects', [
        'projects' => collect($projectsArray),
        'sidebar' => 'sidebars._sidebar-projects',
        'page_title' => 'Projects',
        'body_class' => 'page-projects has-sidebar',
    ]);
})->name('projects.index');

Route::get('/projects/{project_slug}', function ($project_slug) {
    $projects = json_decode(file_get_contents(resource_path('json/projects.json')), true);
    $project = collect($projects)->firstWhere('id', $project_slug);
    if (!$project) {
        abort(404);
    }
    return view('pages.projects.detail', [
        'project' => $project,
        'sidebar' => 'sidebars._sidebar-project-detail',
        'page_title' => $project['name'],
        'body_class' => 'page-project-detail has-sidebar',
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

// --- Admin & Auth Routes (DISABLED) ---
// require __DIR__.'/auth.php';

// Route::middleware(['auth'])->prefix('admin')->group(function () {
//     Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

//     Route::resource('education', \App\Http\Controllers\Admin\EducationController::class, ['as' => 'admin']);
//     Route::resource('jobs', \App\Http\Controllers\Admin\JobController::class, ['as' => 'admin']);
//     Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class, ['as' => 'admin']);
// });

