<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\View\Composers\NavigationComposer;
use App\View\Composers\HomeComposer; // <-- Add this line
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.partials._header', NavigationComposer::class);

        // Tell Laravel to run our HomeComposer every time the
        // 'pages.home' view is rendered.
        View::composer('pages.home', HomeComposer::class); // <-- Add this line
    }
}
