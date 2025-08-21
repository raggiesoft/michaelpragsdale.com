<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaryController extends Controller
{
    // --- YOUR SECRET CONFIGURATION ---
    // These values are now secure on the server.
    private int $salaryMinimum = 72000;
    private int $salaryPreferred = 80000;

    /**
     * Display the salary checker page.
     */
    public function show()
    {
        return view('pages.salary', [
            'page_title'  => 'Salary Checker',
            'body_class'  => 'page-salary-checker has-sidebar',
            'sidebar'     => 'sidebars._sidebar-about-me',
            'page_script' => 'salary-checker'
        ]);
    }

    /**
     * Handle the API request to check the salary.
     */
    public function check(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'low' => 'required|numeric|min:1',
            'high' => 'nullable|numeric|min:0',
            'type' => 'required|in:yearly,hourly',
        ]);

        $low = (float) $validated['low'];
        $high = (float) ($validated['high'] ?? $low);
        if ($high < $low) {
            $high = $low;
        }

        // Normalize to a yearly salary
        $yearlyLow = ($validated['type'] === 'hourly') ? $low * 40 * 52 : $low;

        // --- The Comparison Logic ---
        if ($yearlyLow >= $this->salaryPreferred) {
            return response()->json([
                'status' => 'success',
                'title' => 'Excellent Starting Point!',
                'message' => 'Thank you! A salary range starting at $' . number_format($yearlyLow) . ' aligns well with my expectations.'
            ]);
        } elseif ($yearlyLow >= $this->salaryMinimum) {
            return response()->json([
                'status' => 'success',
                'title' => 'A Good Starting Point',
                'message' => 'Thank you. A salary range starting at $' . number_format($yearlyLow) . ' meets the minimum requirements for consideration.'
            ]);

        } else {
            return response()->json([
                'status' => 'danger',
                'title' => 'Thank You, But...',
                'message' => 'Sorry, a salary range starting at $' . number_format($yearlyLow) . ' is below the minimum threshold.'
            ]);
        }
    }
}
