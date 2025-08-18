<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\EducationController;
use App\Models\Job;
use App\Models\Education;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| Public-Facing Web Routes
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
        'page_title'  => 'Projects - Michael Ragsdale',
        'body_class'  => 'page-projects has-sidebar',
        'page_script' => 'project-filter',
        'sidebar'     => 'sidebars._sidebar-default',
        'projects'    => $projects
    ]);
});

Route::get('/projects/{project_id}', function ($project_id) {
    $project = Project::where('project_id', $project_id)->firstOrFail();
    return view('pages.projects.detail', [
        'page_title'  => $project->name,
        'body_class'  => 'page-project-detail has-sidebar',
        'page_script' => 'live-code-embed',
        'sidebar'     => 'sidebars._sidebar-project-detail',
        'project'     => $project
    ]);
});

Route::get('/employment', function () {
    $jobs = Job::where('is_public', true)->get();
    return view('pages.employment', [
        'page_title'  => 'Employment History',
        'body_class'  => 'page-employment has-sidebar',
        'page_script' => 'employment-filter',
        'sidebar'     => 'sidebars._sidebar-employment',
        'jobs'        => $jobs
    ]);
});

Route::get('/education', function () {
    $education_items = Education::all();
    return view('pages.education', [
        'page_title'      => 'Education & Certifications',
        'body_class'      => 'page-education has-sidebar',
        'sidebar'         => 'sidebars._sidebar-education',
        'education_items' => $education_items
    ]);
});

Route::get('/about-me', function () {
    return view('pages.about-me', [
        'page_title'  => 'About Michael Ragsdale',
        'body_class'  => 'page-about has-sidebar',
        'sidebar'     => 'sidebars._sidebar-about'
    ]);
});

Route::get('/about-me/salary', [SalaryController::class, 'show']);

Route::get('/contact', function () {
    return view('pages.contact', [
        'page_title'  => 'Contact Me',
        'body_class'  => 'page-contact has-sidebar',
        'sidebar'     => 'sidebars._sidebar-contact',
        'page_script' => 'contact-flow'
    ]);
});

Route::post('/contact', [ContactController::class, 'store']);

Route::get('/api-docs', function () {
    return view('pages.api-docs', [
        'page_title' => 'API Documentation',
        'body_class' => 'page-api-docs full-width',
        'sidebar'    => ''
    ]);
});


/*
|--------------------------------------------------------------------------
| Admin & Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('jobs', JobController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('education', EducationController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
