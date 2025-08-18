<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                x-data="{ isOpen: false, message: '', actionUrl: '' }"
            >
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Manage Employment History</h3>
                        <a href="{{ route('jobs.create') }}" class="button button-primary">
                            <i class="fa-duotone fa-plus fa-fw"></i> Add New Job
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Company</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role(s) & Period(s)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Public</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($jobs as $job)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium align-top">{{ $job->company }}</td>

                                        {{-- This now correctly displays the title and period for EACH role --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <ul class="list-none p-0 m-0">
                                                @foreach($job->roles as $role)
                                                    <li class="mb-2 last:mb-0">
                                                        <div class="font-bold">{{ $role['title'] }}</div>
                                                        <div>{{ $role['period'] }}</div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap align-top">
                                            @if ($job->is_public)
                                                <span class="inline-flex items-center gap-x-1.5 rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-900 dark:text-green-200">
                                                    <i class="fa-solid fa-check" aria-hidden="true"></i> Yes
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-x-1.5 rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700 dark:bg-red-900 dark:text-red-200">
                                                    <i class="fa-solid fa-xmark" aria-hidden="true"></i> No
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium align-top">
                                            <a href="{{ route('jobs.edit', $job) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Edit</a>

                                            <button
                                                type="button"
                                                @click="
                                                    isOpen = true;
                                                    message = 'Are you sure you want to delete the entry for \'{{ addslashes($job->company) }}\'? This action cannot be undone.';
                                                    actionUrl = '{{ route('jobs.destroy', $job) }}';
                                                "
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 ml-4">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">No jobs found. Add one to get started!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <x-confirm-deletion-modal title="Confirm Deletion" />
            </div>
        </div>
    </div>
</x-app-layout>
