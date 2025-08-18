{{-- resources/views/home.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Michael Ragsdale</h1>
                <p class="hero-subtitle">Web Developer & Creator</p>
                <p class="hero-text">
                    Building accessible, user-friendly, and maintainable applications from the ground up. I specialize in turning complex problems into clean, elegant digital solutions.
                </p>
                <div class="hero-actions">
                    <a href="{{ url('projects') }}" class="button button-primary button-lg">
                        <i class="fa-duotone fa-laptop-code fa-fw"></i> View My Work
                    </a>
                    <a href="{{ url('resume') }}" class="button button-outline-secondary button-lg">
                        <i class="fa-duotone fa-file-lines fa-fw"></i> View Résumé
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
