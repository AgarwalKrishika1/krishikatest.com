<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        // Get the logged-in user
    $user = Auth::user();
       
    // Check if the user is logged in and has a cart in the session
    if ($user && $request->session()->has('cart')) {
        // Get the cart data from the session
        $cartData = Session::get('cart');
        //session()->flash('cart_data', $cartData);
        // Save the cart to the database (or update if it already exists)
        Cart::updateOrCreate(
            ['user_id' => $user->id], // Look for the user by their ID
            ['items' => json_encode($cartData)] // Store the cart items as a JSON string
        );
    }


        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
