<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    // We will create the index method for this controller later.

    public function create() {
        return view('admin.jobs.create');
    }

    public function store(Request $request) {
        // Validation logic will go here
        Job::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Job entry created successfully.');
    }

    public function edit(Job $job) {
        return view('admin.jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, Job $job) {
        // Validation logic will go here
        $job->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Job entry updated successfully.');
    }

    public function destroy(Job $job) {
        $job->delete();
        return redirect()->route('dashboard')->with('success', 'Job entry deleted successfully.');
    }
}
