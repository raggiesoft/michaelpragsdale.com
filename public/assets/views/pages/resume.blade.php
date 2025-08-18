@extends('layouts.app')

@php
    // It's good practice to define helper functions at the top of the Blade file if they are specific to this view.
    if (!function_exists('get_history_item_priority_class')) {
        function get_history_item_priority_class($categories_string) {
            if (str_contains($categories_string, 'current-employer')) return 'is-current';
            if (str_contains($categories_string, 'volunteer') || str_contains($categories_string, 'internship')) return 'is-highlighted';
            return 'is-default';
        }
    }
@endphp

@section('content')
    <main class="site-content" id="content">
        <div class="container">

            <section class="resume-contact-info">
                <h1 class="resume-name">Michael Ragsdale</h1>
                <ul class="contact-links">
                    <li><i class="fa-duotone fa-location-dot fa-fw"></i> Norfolk, VA (Open to Remote in VA)</li>
                    <li><a href="{{ url('contact') }}"><i class="fa-duotone fa-calendar-days fa-fw"></i> Schedule Interview</a></li>
                    <li><a href="https://www.linkedin.com/in/michael-ragsdale-raggiesoft/" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin fa-fw"></i> LinkedIn</a></li>
                    <li><a href="https://github.com/raggiesoft" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-github fa-fw"></i> GitHub</a></li>
                </ul>
            </section>

            <header class="page-header">
                <h2>Interactive Résumé</h2>
                <p class="lead">An overview of my professional background. Use the view toggles and filters to tailor the content.</p>
            </header>

            <section class="resume-section download-links">
                <div class="download-group">
                    <h3 class="download-title">Information Technology Focus</h3>
                    <div class="download-buttons">
                        <a href="https://michaelpragsdale.com/resume/mragsdale-info-tech.pdf" class="button button-primary" target="_blank" rel="noopener"><i class="fa-duotone fa-file-pdf fa-fw"></i> Download PDF</a>
                        <a href="https://michaelpragsdale.com/resume/mragsdale-info-tech.docx" class="button button-outline-secondary" target="_blank" rel="noopener"><i class="fa-duotone fa-file-word fa-fw"></i> Download DOCX</a>
                    </div>
                </div>
                <div class="download-group">
                    <h3 class="download-title">Customer Service Focus</h3>
                    <div class="download-buttons">
                        <a href="https://michaelpragsdale.com/resume/mragsdale-customer-service.pdf" class="button button-primary" target="_blank" rel="noopener"><i class="fa-duotone fa-file-pdf fa-fw"></i> Download PDF</a>
                        <a href="https://michaelpragsdale.com/resume/mragsdale-customer-service.docx" class="button button-outline-secondary" target="_blank" rel="noopener"><i class="fa-duotone fa-file-word fa-fw"></i> Download DOCX</a>
                    </div>
                </div>
            </section>

            <div class="view-toggle filter-tabs">
                <span>View:</span>
                <button class="button active" data-view="it">Information Technology</button>
                <button class="button" data-view="cs">Customer Service</button>
            </div>

            {{-- Professional Summary Sections --}}
            <section class="resume-section resume-view-it">
                <h2>Professional Summary</h2>
                <p>A versatile professional with a proven background in customer-facing roles, team leadership, and operational management. Actively building on a practical foundation in web development and technical problem-solving while pursuing degrees in Information Technology and Leadership. Eager to apply a unique blend of strong communication skills and technical aptitude to an entry-level IT role.</p>
            </section>
            <section class="resume-section resume-view-cs is-hidden">
                <h2>Professional Summary</h2>
                <p>A versatile professional with a proven background in customer-facing roles, team leadership, and operational management. Actively building on a practical foundation in web development and technical problem-solving while pursuing degrees in Information Technology and Leadership. Eager to apply a unique blend of strong communication skills and technical aptitude to a customer service or entry-level IT role.</p>
            </section>

            {{-- Skills Sections --}}
            <section class="resume-section resume-view-it">
                <h2>Technical Skills</h2>
                <div class="skills-list">
                    <div class="skill-category">
                        <h3>Technical</h3>
                        <ul><li>PHP, HTML, CSS, JavaScript, Bootstrap, SQL (MariaDB), REST APIs, Unix/Linux, WCAG, ARIA, Section 508, Deque axe, InstallAware, Inno Setup, NSIS.</li></ul>
                    </div>
                    <div class="skill-category">
                        <h3>Professional</h3>
                        <ul><li>Team Supervision, Customer Service, Front-Desk Operations, Peer Guidance, Problem-Solving, Communication.</li></ul>
                    </div>
                </div>
            </section>
            <section class="resume-section resume-view-cs is-hidden">
                <h2>Core Competencies</h2>
                <div class="skills-list">
                    <div class="skill-category">
                        <h3>Customer Service & Leadership</h3>
                        <ul><li>Team Supervision, Front-Desk Operations, De-escalation & Conflict Resolution, Customer-Centric Problem Solving, Peer Guidance & Training, Cash Handling & Closing Reports.</li></ul>
                    </div>
                    <div class="skill-category">
                        <h3>Communication & Administration</h3>
                        <ul><li>Interpersonal Communication, Document Creation & Management (Google Drive), Administrative Support, Database Management (ActiveNet).</li></ul>
                    </div>
                     <div class="skill-category">
                        <h3>Technical Acumen</h3>
                        <ul><li>Proficient with Customer Relationship Management (CRM) systems, Learning Management Systems (LMS), and knowledgeable in web accessibility standards (WCAG/Section 508) for creating user-friendly documents.</li></ul>
                    </div>
                </div>
            </section>

            {{-- Technical Projects Section --}}
            <section class="resume-section resume-view-it">
                <h2>Technical Projects</h2>
                <div class="auto-grid" id="project-list">
                    @forelse ($projects as $project)
                        <div class="card clickable-card @if(!empty($project['is_featured'])) card-featured @endif" data-link="{{ url($project['url'] ?? '') }}" data-category="{{ strtolower(implode(' ', $project['tech_stack'] ?? [])) }}" role="link" tabindex="0">
                            <div class="card-body">
                                <h3 class="card-title">{{ $project['name'] }}</h3>
                                <p class="card-text">{{ $project['short_description'] ?? $project['description'] }}</p>
                                <ul class="project-tech-list">
                                    @foreach ($project['tech_stack'] as $tech)
                                        <li><span class="tag">{{ $tech }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            @if (!empty($project['repo_url']))
                                <div class="card-footer">
                                    <a href="{{ $project['repo_url'] }}" class="button button-outline-secondary"><i class="fa-brands fa-github fa-fw"></i> View Code</a>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p>No projects to display.</p>
                    @endforelse
                </div>
            </section>

            {{-- Professional Experience Section --}}
            <section class="resume-section" id="resume-employment">
                <h2>Professional Experience</h2>
                @php
                    $unique_categories = [];
                    if (!empty($jobs)) {
                        foreach ($jobs as $job) {
                            if (!empty($job['categories'])) {
                                $categories_for_job = explode(' ', $job['categories']);
                                foreach ($categories_for_job as $category) {
                                    if (!empty($category)) $unique_categories[$category] = true;
                                }
                            }
                        }
                        $unique_categories = array_keys($unique_categories);
                        sort($unique_categories);
                    }
                @endphp
                <div id="employment-filter" class="filter-tabs">
                    <span>Filter by:</span>
                    <button class="button active" data-filter="all">All</button>
                    @foreach ($unique_categories as $category)
                        <button class="button" data-filter="{{ $category }}">{{ ucwords(str_replace('-', ' ', $category)) }}</button>
                    @endforeach
                </div>

                <ul class="history-list" id="employment-list">
                    @forelse ($jobs as $job)
                        @php $priority_class = get_history_item_priority_class($job['categories']); @endphp
                        <li class="history-item {{ $priority_class }}" data-category="{{ $job['categories'] }}">
                            <div class="history-item__period">{{ $job['period'] }}</div>
                            <div class="history-item__content">
                                <div class="history-item__header">
                                    <img class="history-item__logo" src="{{ asset($job['logo']) }}" alt="{{ $job['company'] }} logo">
                                    <div class="history-item__header-text">
                                        <h3 class="history-item__title">{{ $job['company'] }}</h3>
                                        <div class="history-item__subtitle">{{ $job['location'] }}</div>
                                    </div>
                                </div>
                                <div class="history-item__tags">
                                    @php $tags = array_filter(explode(' ', $job['categories'])); @endphp
                                    @if (!empty($tags))
                                        @foreach ($tags as $tag)
                                            <span class="tag tag-{{$tag}}">{{ ucwords(str_replace('-', ' ', $tag)) }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <ul class="role-list">
                                    @foreach ($job['roles'] as $role)
                                        <li class="role-item">
                                            <h4 class="role-title">{{ $role['title'] }}</h4>
                                            @if (!empty($role['period']))
                                                <div class="role-period">{{ $role['period'] }}</div>
                                            @endif
                                            <ul class="role-description resume-view-it">
                                                @foreach (($role['description']['it'] ?? []) as $bullet)
                                                    <li>{{ $bullet }}</li>
                                                @endforeach
                                            </ul>
                                            <ul class="role-description resume-view-cs is-hidden">
                                                @foreach (($role['description']['cs'] ?? []) as $bullet)
                                                    <li>{{ $bullet }}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @empty
                        <p>No employment history to display.</p>
                    @endforelse
                </ul>
            </section>

            {{-- Education Section --}}
            <section id="resume-education" class="resume-section">
                <h2>Education & Certifications</h2>
                <ul class="history-list">
                    @forelse ($education as $edu_item)
                        <li class="history-item is-default">
                            <div class="history-item__period">{{ $edu_item['period'] }}</div>
                            <div class="history-item__content">
                                <div class="history-item__header">
                                    <img class="history-item__logo" src="{{ asset($edu_item['logo']) }}" alt="{{ $edu_item['institution'] }} logo">
                                    <div class="history-item__header-text">
                                        <h3 class="history-item__title">{{ $edu_item['institution'] }}</h3>
                                        <div class="history-item__subtitle">{{ $edu_item['location'] }}</div>
                                    </div>
                                </div>
                                <ul class="role-list">
                                    @foreach ($edu_item['roles'] as $role)
                                        <li class="role-item">
                                            <h4 class="role-title">{{ $role['title'] }}</h4>
                                            @if (!empty($role['period']))
                                                <div class="role-period">{{ $role['period'] }}</div>
                                            @endif
                                            @if(!empty($role['description']))
                                            <ul class="role-description">
                                                @foreach (($role['description']['it'] ?? $role['description']['cs'] ?? []) as $bullet)
                                                    <li>{{ $bullet }}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @empty
                        <p>No education history to display.</p>
                    @endforelse
                </ul>
            </section>

        </div>
    </main>
@endsection
