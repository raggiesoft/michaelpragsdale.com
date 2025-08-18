<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Job;
use App\Models\Education;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| Public-Facing Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.home', [
        'page_title' => 'Home - Michael Ragsdale',
        'body_class' => 'page-home full-width',
        'sidebar'    => ''
    ]);
});

Route::get('/resume', function () {
    $jobs = Job::where('is_public', true)->get();
    $education = Education::all();
    $projects = Project::all();
    return view('pages.resume', [
        'page_title'  => 'Interactive Resume',
        'body_class'  => 'page-resume full-width',
        'page_script' => 'employment-filter resume-toggler project-filter',
        'sidebar'     => '',
        'jobs'        => $jobs,
        'education'   => $education,
        'projects'    => $projects
    ]);
});

Route::get('/projects', function () {
    $projects = Project::all();
    return view('pages.projects', [
        'page_title'  => 'Projects',
        'body_class'  => 'page-projects has-sidebar',
        'page_script' => 'project-filter',
        'sidebar'     => '_sidebar-default',
        'projects'    => $projects
    ]);
});

Route::get('/projects/{project_id}', function ($project_id) {
    $project = Project::where('project_id', $project_id)->firstOrFail();
    return view('pages.projects.detail', [
        'page_title'  => $project->name,
        'body_class'  => 'page-project-detail has-sidebar',
        'page_script' => 'live-code-embed',
        'sidebar'     => '_sidebar-project-detail',
        'project'     => $project
    ]);
});

Route::get('/employment', function () {
    $jobs = Job::where('is_public', true)->get();
    return view('pages.employment', [
        'page_title'  => 'Employment History',
        'body_class'  => 'page-employment has-sidebar',
        'page_script' => 'employment-filter',
        'sidebar'     => '_sidebar-employment',
        'jobs'        => $jobs
    ]);
});

Route::get('/education', function () {
    $education_items = Education::all();
    return view('pages.education', [
        'page_title'      => 'Education & Certifications',
        'body_class'      => 'page-education has-sidebar',
        'sidebar'         => '_sidebar-education',
        'education_items' => $education_items
    ]);
});

Route::get('/about-me', function () {
    return view('pages.about-me', [
        'page_title'  => 'About Michael Ragsdale',
        'body_class'  => 'page-about has-sidebar',
        'sidebar'     => '_sidebar-about'
    ]);
});

Route::get('/about-me/salary', [SalaryController::class, 'show']);

Route::get('/contact', function () {
    return view('pages.contact', [
        'page_title'  => 'Contact Me',
        'body_class'  => 'page-contact has-sidebar',
        'sidebar'     => '_sidebar-contact',
        'page_script' => 'contact-flow'
    ]);
});

Route::post('/contact', [ContactController::class, 'store']);


/*
|--------------------------------------------------------------------------
| Admin & Authentication Routes (from Laravel Breeze)
|--------------------------------------------------------------------------
*/

// --- BREEZE AUTHENTICATION & ADMIN ROUTES ---

Route::middleware(['auth', 'verified'])->group(function () {
    // The main admin dashboard view (Read)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Show the form to create a new job (Create)
    Route::get('/dashboard/jobs/create', [DashboardController::class, 'create'])->name('jobs.create');

    // Store the new job in the database (Create)
    Route::post('/dashboard/jobs', [DashboardController::class, 'store'])->name('jobs.store');

    // Show the form to edit an existing job (Update)
    Route::get('/dashboard/jobs/{job}/edit', [DashboardController::class, 'edit'])->name('jobs.edit');

    // Update the job in the database (Update)
    Route::patch('/dashboard/jobs/{job}', [DashboardController::class, 'update'])->name('jobs.update');

    // Delete a job (Delete)
    Route::delete('/dashboard/jobs/{job}', [DashboardController::class, 'destroy'])->name('jobs.destroy');

    // Breeze Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// This line includes all the other necessary authentication routes
// (login, register, password reset, etc.) from a separate file.
require __DIR__.'/auth.php';
