<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Education;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    /**
     * Display a list of all education entries.
     */
    public function index()
    {
        $educationItems = Education::latest()->get();
        return view('admin.education.index', ['educationItems' => $educationItems]);
    }

    /**
     * Show the form for creating a new education entry.
     */
    public function create()
    {
        return view('admin.education.create', ['education' => new Education()]);
    }

    /**
     * Store a newly created education entry in the database.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data, including the logo.
        $validatedData = $request->validate([
            'institution' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'period' => 'nullable|string|max:255',
            'categories' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roles' => 'required|array',
            'roles.*.title' => 'required|string',
            'roles.*.period' => 'nullable|string',
            'roles.*.description' => 'nullable|string',
        ]);

        // 2. Process the description for each role.
        foreach ($validatedData['roles'] as $index => $role) {
            $descriptionText = $role['description'] ?? '';
            $bullets = array_filter(array_map('trim', explode("\n", $descriptionText)));
            $validatedData['roles'][$index]['description'] = [
                'it' => $bullets,
                'cs' => $bullets
            ];
        }

        // 3. Handle the file upload.
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('assets/images/education', 'public');
            $validatedData['logo'] = $path;
        }

        // 4. Create the new education record.
        Education::create($validatedData);

        return redirect()->route('admin.education.index')->with('success', 'Education entry created successfully.');
    }

    /**
     * Show the form for editing the specified education entry.
     */
    public function edit(Education $education)
    {
        return view('admin.education.edit', ['education' => $education]);
    }

    /**
     * Update the specified education entry in the database.
     */
    public function update(Request $request, Education $education)
    {
        // 1. Validate the incoming data.
        $validatedData = $request->validate([
            'institution' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'period' => 'nullable|string|max:255',
            'categories' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roles' => 'required|array',
            'roles.*.title' => 'required|string',
            'roles.*.period' => 'nullable|string',
            'roles.*.description' => 'nullable|string',
        ]);

        // 2. Process the description for each role.
        foreach ($validatedData['roles'] as $index => $role) {
            $descriptionText = $role['description'] ?? '';
            $bullets = array_filter(array_map('trim', explode("\n", $descriptionText)));
            $validatedData['roles'][$index]['description'] = [
                'it' => $bullets,
                'cs' => $bullets
            ];
        }

        // 3. Handle the file upload for updates.
        if ($request->hasFile('logo')) {
            // Delete the old logo file if it exists.
            if ($education->logo) {
                Storage::disk('public')->delete($education->logo);
            }
            $path = $request->file('logo')->store('assets/images/education', 'public');
            $validatedData['logo'] = $path;
        }

        // 4. Update the education record.
        $education->update($validatedData);

        return redirect()->route('admin.education.index')->with('success', 'Education entry updated successfully.');
    }

    /**
     * Remove the specified education entry from the database.
     */
    public function destroy(Education $education)
    {
        // Optional: Delete the associated logo file from storage.
        if ($education->logo) {
            Storage::disk('public')->delete($education->logo);
        }
        $education->delete();
        return redirect()->route('admin.education.index')->with('success', 'Education entry deleted successfully.');
    }
}
