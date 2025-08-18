{{-- resources/views/partials/sidebars/_sidebar-project-detail.blade.php --}}
<aside class="site-sidebar">
    <div class="sidebar-inner">

        {{-- This sidebar uses the $project variable passed from the route --}}
        @if (isset($project))
            <div class="widget">
                <h2 class="widget-title">Project Info</h2>

                @php
                    // Use the tech_stack from 'details' if it exists, otherwise use the top-level one.
                    $tech_stack = $project->details['tech_stack'] ?? $project->tech_stack ?? [];
                @endphp
                @if (!empty($tech_stack))
                    <h3 class="widget-subtitle">Technology Stack</h3>
                    <x-tech-tag-list :tags="$tech_stack" />
                @endif

                @if (!empty($project->details['compatibility']))
                    <h3 class="widget-subtitle">Compatibility</h3>
                    <ul class="widget-list">
                        @foreach ($project->details['compatibility'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            @if (!empty($project->live_url) || !empty($project->repo_url))
                <div class="widget">
                    <h2 class="widget-title">Project Links</h2>
                    <ul class="widget-list">
                        @if (!empty($project->repo_url))
                            <li>
                                <a href="{{ $project->repo_url }}">
                                    <i class="fa-brands fa-github fa-fw"></i> View on GitHub
                                </a>
                            </li>
                        @endif
                        @if (!empty($project->live_url))
                            <li>
                                <a href="{{ $project->live_url }}">
                                    <i class="fa-duotone fa-browser fa-fw"></i> View Live
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
        @endif

    </div>
</aside>
