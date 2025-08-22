<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $page_title ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts and Styles -->
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased {{ $body_class ?? '' }}">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            {{-- This includes the main site header --}}
            @include('layouts.partials._header')

            <!-- Page Content -->
            <main class="site-content" id="content">
                <div class="site-body-wrapper">
                    @if(isset($sidebar) && $sidebar)
                        @include('layouts.partials.' . $sidebar)
                    @endif

                    <div class="main-content">
                        {{ $slot }}
                    </div>
                </div>
            </main>

            {{-- This includes the main site footer --}}
            @include('layouts.partials._footer')
        </div>
    </body>
</html>
