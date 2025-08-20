@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
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

    {{-- About Me Snippet --}}
    <section class="home-about">
        <div class="container">
            <div class="about-grid">
                <div class="about-image">
                    <img src="{{ asset('assets/images/michael-ragsdale-profile.jpg') }}" alt="A professional headshot of Michael Ragsdale.">
                </div>
                <div class="about-text">
                    <h2 class="section-title">A Lifelong Passion for Building</h2>
                    <p>I wrote my first line of HTML in 1997, and I've been fascinated with building for the web ever since. My journey has taken me from classic Visual Basic applications to modern, database-driven sites. This portfolio is a living document of that journey, showcasing my commitment to clean code, accessible design, and continuous learning.</p>
                    <a href="{{ url('about-me') }}" class="button button-primary">More About Me</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Work Section --}}
    <section class="home-featured-work">
        <div class="container">
            <h2 class="section-title">Featured Work</h2>
            <div class="auto-grid">
                @forelse ($featuredProjects as $project)
                    <div
                        class="card clickable-card"
                        data-link="{{ url('/projects/' . $project->project_id) }}"
                        role="link"
                        tabindex="0">

                        <div class="card-body">
                            <h3 class="card-title h4">{{ $project->name }}</h3>
                            <p class="card-text">{{ $project->short_description ?? $project->description }}</p>

                            @if (!empty($project->tech_stack))
                                <ul class="project-tech-list">
                                    @foreach ($project->tech_stack as $tech)
                                        @php
                                            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $tech));
                                        @endphp
                                        <li><span class="tag tag-{{ $slug }}">{{ $tech }}</span></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>No featured projects to display at this time.</p>
                @endforelse
            </div>
            <div class="section-cta">
                <a href="{{ url('projects') }}" class="button button-outline-secondary">View All Projects</a>
            </div>
        </div>
    </section>
@endsection
