@csrf

@php
    // Prepare the tech stack data for Alpine.js.
    // We convert the simple array ['PHP', 'SCSS'] into an array of objects [{'name': 'PHP'}, {'name': 'SCSS'}]
    // This is necessary for Alpine's x-for directive to track each item correctly when adding or removing.
    $tech_stack_items = collect(old('tech_stack', $project->tech_stack ?? []))->map(fn($tech) => ['name' => $tech])->all();
@endphp

<div class="space-y-6">
    {{-- Project Name --}}
    <div>
        <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Project Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $project->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600" required>
    </div>

    {{-- Tagline --}}
    <div>
        <label for="tagline" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tagline</label>
        <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $project->tagline) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">
    </div>

    {{-- Short Description --}}
    <div>
        <label for="short_description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Short Description</label>
        <textarea id="short_description" name="short_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">{{ old('short_description', $project->short_description) }}</textarea>
    </div>

    {{-- Story --}}
    <div>
        <label for="details[story]" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Story</label>
        <textarea id="details[story]" name="details[story]" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">{{ old('details.story', $project->details['story'] ?? '') }}</textarea>
    </div>

    {{-- Features --}}
    <div>
        <label for="details[features]" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Features (one per line)</label>
        <textarea id="details[features]" name="details[features]" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">{{ old('details.features', isset($project->details['features']) ? implode("\n", $project->details['features']) : '') }}</textarea>
    </div>

    {{-- Tech Stack (Dynamic with Alpine.js) --}}
    <div x-data='{ techStack: @json($tech_stack_items) }'>
        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Technology Stack</label>
        <template x-for="(tech, index) in techStack" :key="index">
            <div class="flex items-center mt-2">
                <input type="text" :name="'tech_stack[' + index + ']'" x-model="tech.name" class="block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">
                <button type="button" @click="techStack.splice(index, 1)" class="ml-2 text-red-500 hover:text-red-700">&times;</button>
            </div>
        </template>
        <button type="button" @click="techStack.push({ name: '' })" class="mt-2 text-sm text-indigo-600 hover:text-indigo-900">Add Technology</button>
    </div>

    {{-- Live URL --}}
    <div>
        <label for="live_url" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Live URL</label>
        <input type="url" id="live_url" name="live_url" value="{{ old('live_url', $project->live_url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">
    </div>

    {{-- Repo URL --}}
    <div>
        <label for="repo_url" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Repository URL</label>
        <input type="url" id="repo_url" name="repo_url" value="{{ old('repo_url', $project->repo_url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">
    </div>

    {{-- Is Featured --}}
    <div class="block">
        <label for="is_featured" class="inline-flex items-center">
            <input type="checkbox" id="is_featured" name="is_featured" value="1" @if(old('is_featured', $project->is_featured)) checked @endif class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Featured Project?</span>
        </label>
    </div>
</div>
