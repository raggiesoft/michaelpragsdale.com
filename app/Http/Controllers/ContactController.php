<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMessage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // 1. Honeypot Check: If this field is filled, it's a bot.
        if (!empty($request->input('website'))) {
            return back()->with('success', 'Thank you for your message!');
        }

        // 2. Validation: Ensure the required fields are filled and valid.
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // 1. Strip all HTML tags from the message for base security.
        $message = strip_tags($validated['message']);

        // 2. "De-fang" any potential URLs to prevent email clients from autolinking them.
        $message = str_replace('.', '[.]', $message);
        $message = str_replace(':', '[:]', $message);

        // 3. Send the Email
        try {
            Mail::to('hireme@michaelpragsdale.com')->send(new ContactFormMessage($validated));
        } catch (\Exception $e) {
            // Handle potential mail sending errors
            return back()->with('error', 'Sorry, there was an issue sending your message. Please try again later.');
        }

        // 4. Redirect back with a success message.
        return back()->with('success', 'Thank you for your message! I will get back to you shortly.');
    }
}
