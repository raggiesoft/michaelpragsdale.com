{{--
    This form partial requires a `$job` variable.
    It can be a new, empty Job model or an existing one from the database.
--}}
@csrf

@php
    // Prepare the roles data for Alpine.js.
    // 1. Check for old input from a failed validation.
    // 2. If no old input, use the roles from the existing $job model.
    // 3. If it's a new job with no roles, create a default empty role structure.
    $roles = old('roles', $job->roles ?? [['title' => '', 'period' => '', 'description' => '']]);

    // For the description textarea, we need to convert the saved array of bullet points
    // back into a single string with newlines.
    foreach ($roles as $index => $role) {
        if (is_array($role['description'])) {
            $roles[$index]['description'] = implode("\n", $role['description']['it'] ?? []);
        }
    }
@endphp

<div class="space-y-6">
    {{-- Company --}}
    <div class="form-group">
        <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company</label>
        <input type="text" id="company" name="company" value="{{ old('company', $job->company) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500" required>
    </div>

    {{-- Location --}}
    <div class="form-group">
        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
        <input type="text" id="location" name="location" value="{{ old('location', $job->location) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    {{-- Period --}}
    <div class="form-group">
        <label for="period" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Overall Period</label>
        <input type="text" id="period" name="period" value="{{ old('period', $job->period) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    {{-- Is Public --}}
    <div class="form-group">
        <label for="is_public" class="flex items-center">
            <input type="checkbox" id="is_public" name="is_public" value="1" @if(old('is_public', $job->is_public)) checked @endif class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Visible on public site?</span>
        </label>
    </div>

    {{-- Roles (Handled with JavaScript) --}}
    <div x-data='{ roles: @json($roles) }'>
        <h4 class="text-md font-semibold mb-2">Roles</h4>
        <template x-for="(role, index) in roles" :key="index">
            <div class="p-4 mb-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="form-group">
                    <label :for="'role_title_' + index">Role Title</label>
                    <input type="text" :id="'role_title_' + index" :name="'roles[' + index + '][title]'" x-model="role.title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-600">
                </div>
                <div class="form-group mt-4">
                    <label :for="'role_period_' + index">Role Period</label>
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
                <button type="button" @click="roles.splice(index, 1)" class="text-red-500 mt-2 text-sm">Remove Role</button>
            </div>
        </template>
        <button type="button" @click="roles.push({ title: '', period: '', description: '' })" class="button button-outline-secondary">Add Another Role</button>
    </div>
</div>
