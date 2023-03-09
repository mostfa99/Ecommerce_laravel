<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscription;
use Illuminate\Contracts\Mail\Mailable;
use App\Models\Subscriber;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $email = $request->input('email');

        // Validate the email address
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);
        // Create a new subscriber in the database
        $subscriber = Subscriber::create(['email' => $email])->save();

        // Send the confirmation email
        Mail::to($email)->send(new NewsletterSubscription());

        // Redirect back with success message

        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
