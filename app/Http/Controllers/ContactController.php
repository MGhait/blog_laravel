<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request) {
        //make a separte StoreContactRequest 
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        
        Contact::create($data);
        return back()->with('success-message', 'Your Message Sent Successfully');
    }
}
