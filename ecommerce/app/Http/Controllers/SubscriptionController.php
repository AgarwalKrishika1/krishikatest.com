<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function showSubscriptionForm()
    {
        // Return the view with the subscription form
        return view('frontend.subscribe');
    }

    public function handleSubscription(Request $request)
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Get the logged-in user
            $user = Auth::user();
            //dd($user->email);
            // Validate the email (You can store this email for future use)
            $validated = $request->validate([
                'email' => 'required|email',
            ]);
            //dd($validated['email']);
            // Here you can add the email to your database or mail list
            // For example: Subscription::create(['email' => $validated['email']]);

            // Return a success message
            if($user->email == $validated['email'] && $user->email_verified_at ){
                echo "You have been subscribed ";
               // return  redirect()->route('home');
            }else{
                echo "error";
                //return redirect(route('home'));
               
            }
            //return redirect()->route('subscribe.form')->with('status', 'Subscription successful!');
        } else {
            // If the user is not logged in, show an error message
            //return redirect()->route('subscribe.form')->withErrors(['login' => 'You must be logged in to subscribe.']);
            echo "Error need to login";
        }
    }
}
