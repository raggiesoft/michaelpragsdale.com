@extends('layouts.app')

@section('content')
    <div class="container py-12">
        <header class="page-header">
            <h1>Search Results</h1>
            <p class="lead">Found {{ $jobs->count() + $projects->count() + $education->count() }} result(s) for "{{ $query }}"</p>
        </header>

        <div class="space-y-12">
            {{-- Employment Results --}}
            @if($jobs->isNotEmpty())
                <section>
                    <h2 class="text-2xl font-bold mb-4">Employment</h2>
                    <ul class="history-list">
                        @foreach($jobs as $job)
                            @include('partials._history-item-job', ['job' => $job])
                        @endforeach
                    </ul>
                </section>
            @endif

            {{-- Project Results --}}
            @if($projects->isNotEmpty())
                <section>
                    <h2 class="text-2xl font-bold mb-4">Projects</h2>
                    <div class="auto-grid">
                        {{-- We need to create a reusable project card partial for this --}}
                        @foreach($projects as $project)
                            <p>{{ $project->name }}</p> {{-- Placeholder --}}
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Education Results --}}
            @if($education->isNotEmpty())
                <section>
                    <h2 class="text-2xl font-bold mb-4">Education</h2>
                    <ul class="history-list">
                        {{-- We need to create a reusable education item partial for this --}}
                        @foreach($education as $edu_item)
                            <p>{{ $edu_item->institution }}</p> {{-- Placeholder --}}
                        @endforeach
                    </ul>
                </section>
            @endif

            {{-- No Results Message --}}
            @if($jobs->isEmpty() && $projects->isEmpty() && $education->isEmpty())
                <p class="text-center text-gray-500">No results were found for your search. Please try a different term.</p>
            @endif
        </div>
    </div>
@endsection
