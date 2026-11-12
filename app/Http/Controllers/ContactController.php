<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmission;
use App\Models\SiteSetting;

class ContactController extends Controller
{
    public function index()
    {
        try {
            $settings = SiteSetting::first();
        } catch (\Throwable $e) {
            $settings = null;
        }

        return view('contact.index', compact('settings'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'service_type' => 'nullable|string|in:air-freight,sea-freight,ground-freight,warehousing'
        ]);

        // Send email
        try {
            $contactEmail = SiteSetting::getSetting('contact_email');
        } catch (\Throwable $e) {
            $contactEmail = null;
        }
        Mail::to(config('mail.contact.address', $contactEmail ?: config('mail.from.address')))
            ->send(new ContactFormSubmission($validated));

        return redirect()->route('contact.index')
            ->with('success', 'Thank you for your message. We will get back to you shortly.');
    }
}
