<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function allContact()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }
    public function storeContact(Request $req)
    {
        $req->validate([
            'email' => 'required|min:10',
            'address' => 'required',
            'phone' => 'required',
        ]);
        Contact::insert([
            'email' => $req->email,
            'address' => $req->address,
            'phone' => $req->phone,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->route('all.contact')->with('success', 'Inserted contact successfully');
    }
    public function createContactForm(Request $req)
    {
        // $req->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'subject' => 'required',
        //     'message' => 'required',
        // ]);
        ContactForm::insert([
            'name' => $req->name,
            'email' => $req->email,
            'subject' => $req->subject,
            'message' => $req->message,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->route('contact')->with('success', 'Send message successfully');
    }
}
