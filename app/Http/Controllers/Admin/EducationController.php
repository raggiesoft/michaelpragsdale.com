<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Education;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index()
    {
        $educationItems = Education::latest()->get();
        return view('admin.education.index', ['educationItems' => $educationItems]);
    }

    public function create()
    {
        return view('admin.education.create', ['education' => new Education()]);
    }

    public function store(Request $request)
    {
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

        foreach ($validatedData['roles'] as $index => $role) {
            $descriptionText = $role['description'] ?? '';
            $bullets = array_filter(array_map('trim', explode("\n", $descriptionText)));
            $validatedData['roles'][$index]['description'] = ['it' => $bullets, 'cs' => $bullets];
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('assets/images/education', 'public');
            $validatedData['logo'] = $path;
        }

        Education::create($validatedData);
        return redirect()->route('admin.education.index')->with('success', 'Education entry created successfully.');
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', ['education' => $education]);
    }

    public function update(Request $request, Education $education)
    {
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

        foreach ($validatedData['roles'] as $index => $role) {
            $descriptionText = $role['description'] ?? '';
            $bullets = array_filter(array_map('trim', explode("\n", $descriptionText)));
            $validatedData['roles'][$index]['description'] = ['it' => $bullets, 'cs' => $bullets];
        }

        if ($request->hasFile('logo')) {
            if ($education->logo) { Storage::disk('public')->delete($education->logo); }
            $path = $request->file('logo')->store('assets/images/education', 'public');
            $validatedData['logo'] = $path;
        }

        $education->update($validatedData);
        return redirect()->route('admin.education.index')->with('success', 'Education entry updated successfully.');
    }

    public function destroy(Education $education)
    {
        if ($education->logo) { Storage::disk('public')->delete($education->logo); }
        $education->delete();
        return redirect()->route('admin.education.index')->with('success', 'Education entry deleted successfully.');
    }
}
