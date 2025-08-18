{{-- resources/views/errors/404.blade.php --}}
@extends('layouts.app')

{{-- Define the page-specific variables for your layout --}}
@php
    $page_title = 'Page Not Found (404)';
    $body_class = 'page-error full-width';
@endphp

@section('content')
<div class="container text-center py-12">
    <div class="max-w-2xl mx-auto">

        <i class="fa-duotone fa-map-signs fa-5x text-indigo-400"></i>

        <h1 class="mt-6 text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
            Page Not Found
        </h1>

        <p class="mt-6 text-base leading-7 text-gray-600 dark:text-gray-400">
            Sorry, we couldn’t find the page you’re looking for. It might have been moved, or the URL may have been mistyped.
        </p>

        {{-- Search Bar --}}
        <div class="mt-10">
            <form action="{{ url('/search') }}" method="GET" class="flex justify-center">
                <input type="search" name="q" placeholder="Try searching the site..." class="w-full max-w-sm rounded-l-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500">
                <button type="submit" class="button button-primary rounded-l-none">Search</button>
            </form>
        </div>

        {{-- Helpful Links --}}
        <div class="mt-10">
            <p class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Or, try one of these popular pages:</p>
            <div class="flex items-center justify-center gap-x-6">
                <a href="{{ url('/') }}" class="button button-outline-secondary">Home</a>
                <a href="{{ url('/resume') }}" class="button button-outline-secondary">Résumé</a>
                <a href="{{ url('/projects') }}" class="button button-outline-secondary">Projects</a>
                <a href="{{ url('/contact') }}" class="button button-outline-secondary">Contact</a>
            </div>
        </div>

    </div>
</div>
@endsection
