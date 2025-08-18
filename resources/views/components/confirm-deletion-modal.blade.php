@props(['title'])

<div
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-60"
    @keydown.escape.window="isOpen = false"
    x-cloak
>
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-md mx-4"
        @click.away="isOpen = false"
    >
        <h3 class="text-lg font-bold mb-2 text-gray-900 dark:text-gray-100">{{ $title }}</h3>
        <p class="mb-4 text-gray-600 dark:text-gray-400" x-text="message"></p>

        <div class="flex justify-end gap-4 mt-6">
            {{-- This button uses Tailwind classes that match the Breeze UI --}}
            <button type="button" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150" @click="isOpen = false">
                No, Cancel
            </button>

            {{-- This form contains the final "Delete" button --}}
            <form :action="actionUrl" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>
