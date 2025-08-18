{{-- resources/views/errors/503.blade.php --}}
@extends('layouts.app')

@php
    $page_title = 'Service Unavailable (503)';
    $body_class = 'page-error full-width';
@endphp

@section('content')
<div class="container text-center py-12">
    <div class="max-w-2xl mx-auto">

        <i class="fa-duotone fa-person-digging fa-5x text-amber-400"></i>

        <h1 class="mt-6 text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
            Under Maintenance
        </h1>

        <p class="mt-6 text-base leading-7 text-gray-600 dark:text-gray-400">
            We're currently performing some scheduled maintenance. We'll be back online shortly. Thank you for your patience!
        </p>

    </div>
</div>
@endsection
