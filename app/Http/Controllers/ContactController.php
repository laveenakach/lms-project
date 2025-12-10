<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class ContactController extends Controller
{
     // 📨 Store form submission
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        Contact::create($validated);

        // Optionally send email
        // Mail::to('support@datasciencelms.com')->send(new ContactMail($validated));

        return back()->with('success', 'Thank you for contacting us! We’ll get back to you soon.');
    }

    // 📋 Admin - View all contacts
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    // ❌ Delete a message
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'Contact message deleted successfully.');
    }
}
