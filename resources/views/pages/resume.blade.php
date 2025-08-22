@php
    // Fetch data from JSON and convert to a Collection
    $projects = json_decode(file_get_contents(resource_path('json/projects.json')), true);
    $featuredProjects = collect($projects)->where('is_featured', true)->take(3);
@endphp

<x-app-layout :page_title="'Résumé'" :body_class="'page-resume'">
    <div class="container">
        <div class="resume-header">
            <h1>Michael Ragsdale</h1>
            <p class="lead">Senior Web Developer</p>
            <div class="resume-contact">
                <span><i class="fa-duotone fa-fw fa-location-dot"></i> Virginia Beach, VA</span>
                <span><i class="fa-duotone fa-fw fa-envelope"></i> <a href="mailto:hireme@michaelpragsdale.com">hireme@michaelpragsdale.com</a></span>
                <span><i class="fa-brands fa-fw fa-linkedin"></i> <a href="https://www.linkedin.com/in/michael-ragsdale-raggiesoft/" target="_blank" rel="noopener noreferrer">LinkedIn Profile</a></span>
            </div>
        </div>

        <section class="resume-section">
            <h2 class="section-title">Summary</h2>
            <p>Highly skilled and motivated Senior Web Developer with over a decade of experience in building accessible, user-friendly, and maintainable applications. Proven ability to work with modern frameworks like Laravel and legacy systems, with a strong focus on writing clean, well-documented code. Passionate about solving complex problems and translating user needs into elegant digital solutions.</p>
        </section>

        <section class="resume-section">
            <h2 class="section-title">Skills</h2>
            <div class="skills-grid">
                <div class="skill-category">
                    <h3>Languages & Frameworks</h3>
                    <ul>
                        <li>PHP, Laravel</li>
                        <li>JavaScript (ES6+)</li>
                        <li>HTML5, CSS3, SCSS</li>
                        <li>SQL (MySQL)</li>
                        <li>C#, ASP.NET (Familiar)</li>
                        <li>Visual Basic 6 (Legacy)</li>
                    </ul>
                </div>
                <div class="skill-category">
                    <h3>Tools & Platforms</h3>
                    <ul>
                        <li>Git, GitHub</li>
                        <li>DigitalOcean, Laravel Forge</li>
                        <li>WordPress</li>
                        <li>Visual Studio Code</li>
                        <li>Windows & Linux Environments</li>
                        <li>MS-DOS, Windows for Workgroups 3.11</li>
                    </ul>
                </div>
                <div class="skill-category">
                    <h3>Concepts & Practices</h3>
                    <ul>
                        <li>Object-Oriented Programming (OOP)</li>
                        <li>Web Accessibility (WCAG)</li>
                        <li>Responsive Design</li>
                        <li>REST API Development</li>
                        <li>Agile/Scrum Methodologies</li>
                        <li>Server Administration</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="resume-section">
            <h2 class="section-title">Featured Projects</h2>
            <div class="auto-grid">
                @if($featuredProjects->isNotEmpty())
                    @foreach($featuredProjects as $project)
                        <div class="card clickable-card" data-link="{{ route('projects.show', ['project_slug' => $project['id']]) }}" role="link" tabindex="0">
                            <div class="card-body">
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
        </section>

    </div>
</x-app-layout>
