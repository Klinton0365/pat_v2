<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Save to database
        $contact = Contact::create($validated);

        // Send emails
        Mail::to($validated['email'])->send(new ContactMail($validated)); // To user
        Mail::to('admin@pureaquatech.com')->send(new ContactMail($validated, true)); // To admin

        return response()->json(['success' => true, 'message' => 'Your message has been sent successfully!']);
    }
}
