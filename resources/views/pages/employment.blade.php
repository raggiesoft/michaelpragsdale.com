@extends('layouts.app')

@section('content')
    {{-- The page content starts immediately, without the wrapper div --}}
    <div class="container">
        <header class="page-header">
            <h1>Employment History</h1>
            <p class="lead">My professional journey and key roles. Use the filters to highlight relevant experience.</p>
            </header>

                @php
                    $unique_categories = [];
                    if ($jobs->isNotEmpty()) {
                        foreach ($jobs as $job) {
                            if (!empty($job->categories)) {
                                $categories_for_job = explode(' ', $job->categories);
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

                <section class="history-section">
                    <ul class="history-list" id="employment-list">
                        @forelse ($jobs as $job)
                            @include('partials._history-item-job', ['job' => $job])
                        @empty
                            <p>There is no employment history to display at this time.</p>
                        @endforelse
                    </ul>
                </section>
            </div>
        </main>
    </div>
@endsection
