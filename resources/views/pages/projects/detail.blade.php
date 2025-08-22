{{-- resources/views/pages/projects/detail.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="page-header project-header">
            <h1>{{ $project->name }}</h1>
            <p class="lead">{{ $project->tagline }}</p>
        </header>

        <div class="project-detail-layout">
            <article class="project-main-content">

                {{-- Display the project's story if it exists --}}
                @if (!empty($project->details['story']))
                    <section class="resume-section">
                        <h2>The Story</h2>
                        {{-- The nl2br function converts newlines in your story text to <br> tags --}}
                        <p>{!! nl2br(e($project->details['story'])) !!}</p>
                    </section>
                @endif

                {{-- Display the key features if they exist --}}
                @if (!empty($project->details['features']))
                    <section class="resume-section">
                        <h2>Key Features</h2>
                        <ul>
                            @foreach ($project->details['features'] as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                {{-- Only show the script embed section for the docx-converter project --}}
                @if ($project->project_id === 'docx-converter')
                    <section class="resume-section">
                        <h2>The Script</h2>
                        <p>The complete PowerShell script is displayed below, live from the project's GitHub repository.</p>
                        <div class="page-github-embed">
                            <pre class="line-numbers pre-wrap"><code id="script-container" class="language-powershell">Loading script...</code></pre>
                        </div>
                    </section>
                @endif

            </article>

            {{-- The sidebar is now handled by the main layout file --}}
        </div>
    </div>
@endsection
