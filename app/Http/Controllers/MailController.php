<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class MailController extends Controller
{


    public function send()
    {
        // logger($tableau->toArray());
        Request::validate([
            'email' => ['required', 'email'],
            'subject' => ['required', 'max:500'],
            'contenu' => ['required'],
        ]);
        $data = Request::all();
        Mail::to('charles@notilac.fr')->send(new Contact($data));
        return redirect()->back()->with('message', 'Email envoyé');;
    }
}
