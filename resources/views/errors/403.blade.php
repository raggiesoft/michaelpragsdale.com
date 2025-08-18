{{-- resources/views/errors/403.blade.php --}}
@extends('layouts.app')

@php
    $page_title = 'Access Denied (403)';
    $body_class = 'page-error full-width';
@endphp

@section('content')
<div class="container text-center py-12">
    <div class="max-w-2xl mx-auto">

        <i class="fa-duotone fa-shield-halved fa-5x text-orange-400"></i>

        <h1 class="mt-6 text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
            Access Denied
        </h1>

        <p class="mt-6 text-base leading-7 text-gray-600 dark:text-gray-400">
            Sorry, you do not have permission to access this page. This area is restricted to authorized users.
        </p>

        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{ url('/') }}" class="button button-outline-secondary">
                <i class="fa-duotone fa-house fa-fw"></i> Go back home
            </a>
            <a href="{{ route('login') }}" class="button button-primary">
                Log In <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

    </div>
</div>
@endsection
