<x-app-layout :page_title="'Home'" :body_class="'page-home full-width'">
    <div class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Michael Ragsdale</h1>
                <p class="hero-subtitle">Web Developer & Creator</p>
                <p class="hero-text">
                    Building accessible, user-friendly, and maintainable applications from the ground up. I specialize in turning complex problems into clean, elegant digital solutions.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('projects.index') }}" class="button button-primary button-lg">
                        <i class="fa-duotone fa-laptop-code fa-fw"></i> View My Work
                    </a>
                    <a href="{{ route('resume') }}" class="button button-outline-secondary button-lg">
                        <i class="fa-duotone fa-file-lines fa-fw"></i> View Résumé
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="home-about">
        <div class="container">
            <div class="about-grid">
                <div class="about-image">
                    <img src="{{ asset('assets/images/michael-ragsdale-profile.jpg') }}" alt="A professional headshot of Michael Ragsdale.">
                </div>
                <div class="about-text">
                    <h2 class="section-title">A Lifelong Passion for Building</h2>
                    <p>I wrote my first line of HTML in 1997, and I've been fascinated with building for the web ever since. My journey has taken me from classic Visual Basic applications to modern, database-driven sites. This portfolio is a living document of that journey, showcasing my commitment to clean code, accessible design, and continuous learning.</p>
                    <a href="{{ route('about-me') }}" class="button button-primary">More About Me</a>
                </div>
            </div>
        </div>
    </section>

    <section class="home-featured-work">
        <div class="container">
            <h2 class="section-title">Featured Work</h2>
            <div class="auto-grid">
                @if($featuredProjects->isNotEmpty())
                    @foreach($featuredProjects as $project)
                        <div class="card clickable-card" data-link="{{ route('projects.show', ['project_slug' => $project['id']]) }}" role="link" tabindex="0">
                            <div class="card-body">
                                {{-- Use array syntax to access project data --}}
                                <h3 class="card-title h4">{{ $project['name'] }}</h3>
                                <p class="card-text">{{ $project['short_description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="section-cta">
                <a href="{{ route('projects.index') }}" class="button button-outline-secondary">View All Projects</a>
            </div>
        </div>
    </section>
</x-app-layout>
