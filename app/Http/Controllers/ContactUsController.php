<?php

namespace App\Http\Controllers;

use App\ContactUs;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    //

    public function show(){
        return view('home.contact-us');
    }

    public function create(Request $request){

        $validate = $request->validate([
                'email' => ['required','email'],
                'name' => ['required'],
                'subject' => ['required'],
                'message' => '',
            ]
        );

        $contact = ContactUs::create([
            'to' => env('MAIL_USERNAME'),
            'from' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        Mail::to(env('MAIL_USERNAME'))->send(new ContactUsMail($contact));

        return view('home.contact-us')->with(['response' => 'success', 'message' => 'Your Inquiry has benn sent!']);
    }
}
