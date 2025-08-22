<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $page_title ?? config('app.name', 'Laravel') }}</title>

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/ec060982d4.js" crossorigin="anonymous"></script>

        <!-- Scripts and Styles -->
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body class="{{ $body_class ?? '' }}" data-page-script="{{ $page_script ?? '' }}">
        <a href="#content" class="skip-link">Skip to Main Content</a>
        <div class="page-container">

            @include('layouts.partials._header')

            <div class="site-body-wrapper">

                @if(isset($sidebar) && $sidebar)
                    @include('layouts.partials.' . $sidebar)
                @endif

                <main class="site-content" id="content">
                    <div class="main-content">
                        {{-- This is the new, robust content area --}}
                        @yield('content')
                    </div>
                </main>
            </div>

            @include('layouts.partials._footer')
        </div>
    </body>
</html>
