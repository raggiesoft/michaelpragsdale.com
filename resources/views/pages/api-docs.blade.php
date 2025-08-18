@extends('layouts.app')

@section('content')
    <div class="container py-12">
        <header class="page-header">
            <h1>API Documentation</h1>
            <p class="lead">A public, read-only API for my professional history.</p>
        </header>

        <div class="max-w-4xl mx-auto">
            <section class="resume-section">
                <h2>Introduction</h2>
                <p>To demonstrate my backend development skills and provide a "single source of truth" for my portfolio data, I have created a public, read-only REST API. This API serves the core content of this website (Employment, Projects, and Education) directly from the database in a clean JSON format.</p>
                <p>This is the same API that will be used to power the interactive résumé when it is rebuilt with Vue.js.</p>
            </section>

            <section class="resume-section">
                <h2>Endpoints</h2>
                <p>The following endpoints are available. They all respond to `GET` requests and return data in a standard JSON format.</p>

                <div class="space-y-6 mt-6">
                    {{-- Employment Endpoint --}}
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                        <h3 class="font-mono text-lg">
                            <span class="font-bold text-green-600">GET</span> /api/v1/employment
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Returns a collection of all public employment history entries, sorted by the most recent.</p>
                        <a href="{{ url('/api/v1/employment') }}" target="_blank" class="text-indigo-500 hover:underline mt-2 inline-block">Try it out &rarr;</a>
                    </div>

                    {{-- Projects Endpoint --}}
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                        <h3 class="font-mono text-lg">
                            <span class="font-bold text-green-600">GET</span> /api/v1/projects
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Returns a collection of all projects, sorted by the most recent.</p>
                        <a href="{{ url('/api/v1/projects') }}" target="_blank" class="text-indigo-500 hover:underline mt-2 inline-block">Try it out &rarr;</a>
                    </div>

                    {{-- Education Endpoint --}}
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                        <h3 class="font-mono text-lg">
                            <span class="font-bold text-green-600">GET</span> /api/v1/education
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Returns a collection of all education and certification entries, sorted by the most recent.</p>
                        <a href="{{ url('/api/v1/education') }}" target="_blank" class="text-indigo-500 hover:underline mt-2 inline-block">Try it out &rarr;</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
