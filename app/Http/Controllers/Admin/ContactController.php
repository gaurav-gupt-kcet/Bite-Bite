<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of messages.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', '');
        
        $contacts = Contact::when($status, function($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $unreadCount = Contact::where('status', 'unread')->count();
        
        return view('admin.contacts', compact('contacts', 'status', 'unreadCount'));
    }

    /**
     * Show the specified message.
     */
    public function show(Contact $contact)
    {
        // Mark as read if unread
        if ($contact->status == 'unread') {
            $contact->update(['status' => 'read']);
        }
        
        return view('admin.contact-details', compact('contact'));
    }

    /**
     * Update message status.
     */
    public function updateStatus(Request $request, Contact $contact)
    {
        $contact->update(['status' => $request->status]);

        return redirect('/admin/contacts')->with('success', 'Status updated successfully!');
    }

    /**
     * Remove the message from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect('/admin/contacts')->with('success', 'Message deleted successfully!');
    }
}
