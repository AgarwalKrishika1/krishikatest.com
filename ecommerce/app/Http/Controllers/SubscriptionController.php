<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\MustVerifyEmail;

class SubscriptionController extends Controller
{
    // Show the subscription form
    public function showForm()
    {
        return view('subscribed');
    }

    // Handle the form submission
    public function subscribe(Request $request)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to subscribe.');
        }

        $user = Auth::user(); // Get the logged-in user

        // Validate the email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',  // Validate email format
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->route('subscribe')
                             ->withErrors($validator)
                             ->withInput();
        }

       
        // Check if the email entered matches the logged-in user's email
        if ($request->email !== $user->email) {
            return redirect()->route('home') // Redirect to a page where the message is displayed
                ->with('error', 'Email does not match. If you wish to continue, please register.');
        }


        // Check if the email is verified
        if (!$user->email_verified_at) {
            return redirect()->route('home') // Redirect to a page where the message is displayed
                ->with('error_verify', 'Email is not verified. If you wish to continue, please verify.');
        }

        // If all checks pass, you can proceed with the subscription process
        // For demonstration purposes, let's assume subscription is successful.
        // You would typically save the subscription in the database or send a notification here.

        return redirect()->route('home')->with('success', 'You have successfully subscribed!');
    }
}
