<x-app-layout :page_title="$page_title" :body_class="$body_class" :sidebar="$sidebar">
    <div class="container">
        {{-- Use array syntax for all properties --}}
        <h1>{{ $project['name'] }}</h1>
        <p class="lead">{{ $project['tagline'] }}</p>

        @if(isset($project['details']['tech_stack']))
            <div class="mb-4">
                <x-tech-tag-list :tags="$project['details']['tech_stack']" />
            </div>
        @endif

        @if(isset($project['details']['story']))
            <div class="prose">
                <h2>The Story</h2>
                <p>{{ $project['details']['story'] }}</p>
            </div>
        @endif

        @if(isset($project['details']['features']))
            <div class="prose mt-4">
                <h2>Key Features</h2>
                <ul>
                    @foreach($project['details']['features'] as $feature)
                        <li>{!! \Illuminate\Support\Str::markdown($feature) !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($project['details']['compatibility']))
            <div class="prose mt-4">
                <h2>Compatibility</h2>
                <ul>
                    @foreach($project['details']['compatibility'] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</x-app-layout>
