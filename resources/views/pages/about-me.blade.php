{{-- resources/views/pages/about-me.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="page-header">
            <h1>About Me</h1>
            <p class="lead">An overview of my professional background and resources for recruiters.</p>
        </header>

        <section class="about-intro resume-section">
            <div class="about-intro__image">
                <img src="{{ asset('assets/images/michael-ragsdale-profile.jpg') }}" alt="A professional headshot of Michael Ragsdale.">
            </div>
            <div class="about-intro__text">
                <h2>Developer & Problem-Solver</h2>
                <p>Hello! I'm Michael Ragsdale, a web developer based in Norfolk, Virginia. My passion lies in building practical, user-friendly digital tools from the ground up. I enjoy the entire process, from structuring back-end logic with PHP to creating accessible, responsive front-end experiences with modern SCSS and JavaScript.</p>
                <p>This portfolio is a living document of my journey. Below, you'll find links to my interactive résumé, detailed work history, and other resources. Thank you for visiting.</p>
            </div>
        </section>

        <div class="row" style="--grid-gutter-y: var(--spacing-lg);">

            <div class="col-12 col-md-6">
                <div class="card card-icon-link">
                    <div class="card-body">
                        <i class="fa-duotone fa-file-lines fa-3x card-icon"></i>
                        <h2 class="card-title h3">Interactive Résumé</h2>
                        <p class="card-text">View my full work history, education, and skills. Filter my experience to find what's most relevant to you.</p>
                        <a href="{{ url('resume') }}" class="button button-primary stretched-link">View Résumé</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card card-icon-link">
                    <div class="card-body">
                        <i class="fa-duotone fa-graduation-cap fa-3x card-icon"></i>
                        <h2 class="card-title h3">Education History</h2>
                        <p class="card-text">A summary of my academic background, degrees, and professional certifications in Information Technology and Leadership.</p>
                        <a href="{{ url('education') }}" class="button button-primary stretched-link">View Education</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card card-icon-link">
                    <div class="card-body">
                        <i class="fa-duotone fa-calculator fa-3x card-icon"></i>
                        <h2 class="card-title h3">Salary Checker</h2>
                        <p class="card-text">To ensure alignment, use this tool to see if an opportunity's compensation meets my requirements before reaching out.</p>
                        <a href="{{ url('about-me/salary') }}" class="button button-primary stretched-link">Use Salary Checker</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card card-icon-link">
                    <div class="card-body">
                        <i class="fa-duotone fa-calendar-days fa-3x card-icon"></i>
                        <h2 class="card-title h3">Schedule Interview</h2>
                        <p class="card-text">Ready to talk? Use my Calendly link to directly schedule a time that works for both of us. No back-and-forth emails required.</p>
                        <a href="{{ url('contact') }}" class="button button-primary stretched-link">Schedule Now</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
