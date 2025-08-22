<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_title ?? "Michael Ragsdale's Portfolio" }}</title>

    <script src="https://kit.fontawesome.com/ec060982d4.js" crossorigin="anonymous"></script>

    @vite(['resources/scss/app.scss', 'resources/js/app.js', 'resources/js/main.js'])
</head>
    <body class="font-sans antialiased {{ $body_class ?? '' }}">
        <div class="min-h-screen bg-gray-100">

            {{-- This includes the main site header --}}
            @include('layouts.partials._header')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            {{-- This includes the main site footer --}}
            @include('layouts.partials._footer')
        </div>
    </body>
</html>
