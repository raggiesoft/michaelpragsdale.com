<x-app-layout :page_title="$page_title" :body_class="$body_class" :sidebar="$sidebar">
    <div class="container">
        <h1>Projects</h1>
        <p class="lead">A collection of my personal and professional work.</p>

        <div class="auto-grid">
            @if($projects->isNotEmpty())
                @foreach($projects as $project)
                    <div class="card clickable-card" data-link="{{ route('projects.show', ['project_slug' => $project['id']]) }}" role="link" tabindex="0">
                        <div class="card-body">
                            {{-- Use array syntax for all properties --}}
                            <h3 class="card-title h4">{{ $project['name'] }}</h3>
                            @if(isset($project['short_description']))
                                <p class="card-text">{{ $project['short_description'] }}</p>
                            @endif

                            @if(isset($project['details']['tech_stack']))
                                <x-tech-tag-list :tags="$project['details']['tech_stack']" />
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <p>No projects found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
