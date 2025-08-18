{{-- resources/views/errors/500.blade.php --}}
@extends('layouts.app')

@php
    $page_title = 'Server Error (500)';
    $body_class = 'page-error full-width';
@endphp

@section('content')
<div class="container text-center py-12">
    <div class="max-w-2xl mx-auto">

        <i class="fa-duotone fa-server fa-5x text-red-400"></i>

        <h1 class="mt-6 text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
            Internal Server Error
        </h1>

        <p class="mt-6 text-base leading-7 text-gray-600 dark:text-gray-400">
            Sorry, something went wrong on our end. We have been notified and are working to fix the issue. Please try again later.
        </p>

        <div class="mt-10">
            <a href="{{ url('/') }}" class="button button-primary">
                <i class="fa-duotone fa-house fa-fw"></i> Go back home
            </a>
        </div>

    </div>
</div>
@endsection
