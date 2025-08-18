<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        return view('admin.jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        return view('admin.jobs.create', ['job' => new Job()]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'period' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_public' => 'nullable',
            'roles' => 'required|array',
            'roles.*.title' => 'required|string|max:255',
            'roles.*.period' => 'nullable|string|max:255',
            'roles.*.description' => 'nullable|string',
        ]);

        $validatedData['is_public'] = $request->has('is_public');

        foreach ($validatedData['roles'] as $index => $role) {
            $descriptionText = $role['description'] ?? '';
            $bullets = array_filter(array_map('trim', explode("\n", $descriptionText)));
            $validatedData['roles'][$index]['description'] = ['it' => $bullets, 'cs' => $bullets];
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('assets/images/employment', 'public');
            $validatedData['logo'] = $path;
        }

        Job::create($validatedData);
        return redirect()->route('admin.jobs.index')->with('success', 'Job entry created successfully.');
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, Job $job)
    {
        $validatedData = $request->validate([
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'period' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_public' => 'nullable',
            'roles' => 'required|array',
            'roles.*.title' => 'required|string|max:255',
            'roles.*.period' => 'nullable|string|max:255',
            'roles.*.description' => 'nullable|string',
        ]);

        $validatedData['is_public'] = $request->has('is_public');

        foreach ($validatedData['roles'] as $index => $role) {
            $descriptionText = $role['description'] ?? '';
            $bullets = array_filter(array_map('trim', explode("\n", $descriptionText)));
            $validatedData['roles'][$index]['description'] = ['it' => $bullets, 'cs' => $bullets];
        }

        if ($request->hasFile('logo')) {
            if ($job->logo) { Storage::disk('public')->delete($job->logo); }
            $path = $request->file('logo')->store('assets/images/employment', 'public');
            $validatedData['logo'] = $path;
        }

        $job->update($validatedData);
        return redirect()->route('admin.jobs.index')->with('success', 'Job entry updated successfully.');
    }

    public function destroy(Job $job)
    {
        if ($job->logo) { Storage::disk('public')->delete($job->logo); }
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job entry deleted successfully.');
    }
}
