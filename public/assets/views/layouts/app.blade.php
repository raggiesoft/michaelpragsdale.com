<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_title ?? "Michael Ragsdale's Portfolio" }}</title>

    {{-- Add your Font Awesome Kit script here --}}
    <script src="https://kit.fontawesome.com/ec060982d4.js" crossorigin="anonymous"></script>

    {{-- Laravel's Vite directive for your CSS and JS --}}
    @vite(['resources/scss/main.scss', 'resources/js/main.js'])

</head>
<body class="{{ $body_class ?? '' }}" data-page-script="{{ $page_script ?? '' }}">

    <a href="#content" class="skip-link">Skip to Main Content</a>

    <div class="page-container">

        @include('layouts.partials._header')

        <main class="site-content" id="content">
            @yield('content')
        </main>

        @include('layouts.partials._footer')

    </div>

</body>
</html>
