<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Employment Card --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Employment</h3>
                    <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-gray-100">{{ $jobCount }} <span class="text-base font-normal text-gray-500 dark:text-gray-400">Entries</span></p>
                    <a href="{{ route('admin.jobs.index') }}" class="text-indigo-500 hover:underline mt-4 inline-block">Manage Jobs &rarr;</a>
                </div>

                {{-- Projects Card --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Projects</h3>
                    <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-gray-100">{{ $projectCount }} <span class="text-base font-normal text-gray-500 dark:text-gray-400">Entries</span></p>

                    {{-- Display a warning if any projects have incomplete data --}}
                    @if($projectsMissingDetails > 0)
                        <p class="text-sm text-yellow-600 dark:text-yellow-400 mt-2">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ $projectsMissingDetails }} project(s) missing details.
                        </p>
                    @endif

                    <a href="{{ route('admin.projects.index') }}" class="text-indigo-500 hover:underline mt-4 inline-block">Manage Projects &rarr;</a>
                </div>

                {{-- Education Card --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Education</h3>
                    <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-gray-100">{{ $educationCount }} <span class="text-base font-normal text-gray-500 dark:text-gray-400">Entries</span></p>
                    <a href="{{ route('admin.education.index') }}" class="text-indigo-500 hover:underline mt-4 inline-block">Manage Education &rarr;</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
