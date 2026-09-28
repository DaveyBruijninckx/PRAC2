<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        $content = "Naam: " . $name . "\n"
            . "E-mail: " . $email . "\n"
            . "Datum: " . now() . "\n\n"
            . "Bericht:\n" . $message . "\n";

        Storage::put('contact/contact_' . now()->format('Y-m-d_H-i-s') . '.txt', $content);

        return redirect('/contact/')->with('success', 'Bedankt! Je bericht is verstuurd.');
    }
}
