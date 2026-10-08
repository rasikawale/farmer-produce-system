<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /* ================= CONTACT FORM ================= */

    // Show contact page
    public function create()
    {
        return view('contact.create');
    }

    /* ================= STORE MESSAGE ================= */

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        Contact::create([
            'user_id' => auth()->id(),
            'role' => auth()->user()->role, // farmer or buyer
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open'
        ]);

        return redirect()
            ->back()
            ->with('success', 'Your message has been sent to admin successfully.');
    }
}
