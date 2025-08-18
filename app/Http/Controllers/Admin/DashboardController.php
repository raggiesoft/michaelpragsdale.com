<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index() {
        $jobs = Job::latest()->get();
        return view('admin.dashboard', ['jobs' => $jobs]);
    }

    public function create() {
        return view('admin.jobs.create');
    }

// in app/Http/Controllers/Admin/DashboardController.php

// in app/Http/Controllers/Admin/DashboardController.php

public function store(Request $request)
{
    $validated = $request->validate([
        'company' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'period' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'is_public' => 'boolean',
        'roles' => 'required|array',
        'roles.*.title' => 'required|string',
        'roles.*.period' => 'nullable|string',
        'roles.*.description' => 'nullable|string', // Add validation for the new field
    ]);

    $validated['is_public'] = $request->has('is_public');

    // Process the description for each role
    foreach ($validated['roles'] as $index => $role) {
        $descriptionText = $role['description'] ?? '';
        // Split the text by newlines, trim whitespace, and remove empty lines
        $bullets = array_filter(array_map('trim', explode("\n", $descriptionText)));

        // Save the same bullet points for both IT and CS views
        $validated['roles'][$index]['description'] = [
            'it' => $bullets,
            'cs' => $bullets
        ];
    }

    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('assets/images/employment', 'public');
        $validated['logo'] = $path;
    }

    Job::create($validated);
    return redirect()->route('dashboard')->with('success', 'Job entry created successfully.');
}

public function update(Request $request, Job $job)
{
    $validated = $request->validate([
        'company' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'period' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'is_public' => 'boolean',
        'roles' => 'required|array',
        'roles.*.title' => 'required|string',
        'roles.*.period' => 'nullable|string',
        'roles.*.description' => 'nullable|string',
    ]);

    $validated['is_public'] = $request->has('is_public');

    // Process the description for each role
    foreach ($validated['roles'] as $index => $role) {
        $descriptionText = $role['description'] ?? '';
        $bullets = array_filter(array_map('trim', explode("\n", $descriptionText)));
        $validated['roles'][$index]['description'] = [
            'it' => $bullets,
            'cs' => $bullets
        ];
    }

    if ($request->hasFile('logo')) {
        if ($job->logo) { \Illuminate\Support\Facades\Storage::disk('public')->delete($job->logo); }
        $path = $request->file('logo')->store('assets/images/employment', 'public');
        $validated['logo'] = $path;
    }

    $job->update($validated);
    return redirect()->route('dashboard')->with('success', 'Job entry updated successfully.');
}

    public function edit(Job $job) {
        return view('admin.jobs.edit', ['job' => $job]);
    }


    public function destroy(Job $job) {
        $job->delete();
        return redirect()->route('dashboard')->with('success', 'Job entry deleted successfully.');
    }
}
