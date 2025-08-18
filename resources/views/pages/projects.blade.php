{{-- resources/views/pages/projects.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="page-header">
            <h1>My Projects</h1>
            <p class="lead">A selection of applications and utilities I've built to solve problems and explore new technologies.</p>
        </header>

        @php
            // Generate unique categories from the projects' tech_stack
            $unique_tech = [];
            if ($projects->isNotEmpty()) {
                foreach ($projects as $project) {
                    if (!empty($project->tech_stack)) {
                        foreach ($project->tech_stack as $tech) {
                            if (!empty($tech)) {
                                $key = strtolower(trim($tech));
                                $unique_tech[$key] = $tech;
                            }
                        }
                    }
                }
            }
            ksort($unique_tech);
        @endphp
        <div id="project-filter" class="filter-tabs">
            <span>Filter by:</span>
            <button class="button active" data-filter="all">All</button>
            @foreach ($unique_tech as $slug => $displayName)
                <button class="button" data-filter="{{ $slug }}">
                    {{ $displayName }}
                </button>
            @endforeach
        </div>

        <div class="auto-grid" id="project-list">
            @forelse ($projects as $project)
                <div
                    class="card clickable-card @if($project->is_featured) card-featured @endif"
                    data-link="{{ url('/projects/' . $project->project_id) }}"
                    data-category="{{ strtolower(implode(' ', $project->tech_stack ?? [])) }}"
                    role="link"
                    tabindex="0">

                    <div class="card-body">
                        <h2 class="card-title h3">{{ $project->name }}</h2>
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

                    @if (!empty($project->repo_url))
                        <div class="card-footer">
                            <a href="{{ $project->repo_url }}" class="button button-outline-secondary">
                                <i class="fa-brands fa-github fa-fw"></i> View Code
                            </a>
                        </div>
                    @endif
                </div>
            @empty
                <p>There are no projects to display at this time.</p>
            @endforelse
        </div>
    </div>
@endsection
