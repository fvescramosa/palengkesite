<?php

namespace App\Http\Controllers\Admin;

use App\ContactUs;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    //

    public function index(){

        $contacts = ContactUs::all();

        return view('admin.contact-us.show', compact(['contacts']));
    }
    public function find($id){

        $contact = ContactUs::findOrFail($id);
        return new ContactUsMail($contact);
    }
}
