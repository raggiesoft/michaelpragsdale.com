@csrf

@php
    // Prepare the roles data for Alpine.js, ensuring it's always an array.
    $roles = old('roles', $education->roles ?? [['title' => '', 'period' => '', 'description' => '']]);

    // For the description textarea, convert the saved array of bullet points back into a single string with newlines.
    foreach ($roles as $index => $role) {
        if (is_array($role['description'] ?? null)) {
            $roles[$index]['description'] = implode("\n", $role['description']['it'] ?? []);
        }
    }
@endphp

<div class="space-y-6">
    {{-- Institution --}}
    <div>
        <label for="institution" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Institution</label>
        <input type="text" id="institution" name="institution" value="{{ old('institution', $education->institution) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600" required>
    </div>

    {{-- Location --}}
    <div>
        <label for="location" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Location</label>
        <input type="text" id="location" name="location" value="{{ old('location', $education->location) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">
    </div>

    {{-- Period --}}
    <div>
        <label for="period" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Overall Period</label>
        <input type="text" id="period" name="period" value="{{ old('period', $education->period) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">
    </div>

    {{-- Categories --}}
    <div>
        <label for="categories" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Categories (space-separated)</label>
        <input type="text" id="categories" name="categories" value="{{ old('categories', $education->categories) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">
    </div>

    {{-- Roles (Dynamic with Alpine.js) --}}
    <div x-data='{ roles: @json($roles) }'>
        <h4 class="text-md font-semibold mb-2">Degrees / Certificates</h4>
        <template x-for="(role, index) in roles" :key="index">
            <div class="p-4 mb-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="form-group">
                    <label :for="'role_title_' + index">Title</label>
                    <input type="text" :id="'role_title_' + index" :name="'roles[' + index + '][title]'" x-model="role.title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">
                </div>
                <div class="form-group mt-4">
                    <label :for="'role_period_' + index">Period</label>
                    <input type="text" :id="'role_period_' + index" :name="'roles[' + index + '][period]'" x-model="role.period" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">
                </div>
                <div class="form-group mt-4">
                    <label :for="'role_description_' + index">Description (one bullet point per line)</label>
                    <textarea
                        :id="'role_description_' + index"
                        :name="'roles[' + index + '][description]'"
                        x-model="role.description"
                        rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600"
                    ></textarea>
                </div>
                <button type="button" @click="roles.splice(index, 1)" class="text-red-500 mt-2 text-sm">Remove</button>
            </div>
        </template>
        <button type="button" @click="roles.push({ title: '', period: '', description: '' })" class="button button-outline-secondary">Add Another Degree/Certificate</button>
    </div>
</div>
