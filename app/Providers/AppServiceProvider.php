<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\View\Composers\NavigationComposer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Tell Laravel to run our NavigationComposer every time the 
        // 'layouts.partials._header' view is rendered.
        View::composer('layouts.partials._header', NavigationComposer::class);
    }
}