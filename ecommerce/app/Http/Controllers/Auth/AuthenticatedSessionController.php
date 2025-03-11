<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
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
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }


    public function customLogout(Request $request)
    {
        // logged-in user
        $user = Auth::user();

        // if logged-in user
        if ($user) {
            // cart from session
            $cartData = session('cart', []);

            // cart from cookie(if exists)
            $cookieCart = json_decode(Cookie::get('cart', '[]'), true);

            // Merge 
            $mergedCart = array_merge($cartData, $cookieCart);

            // Save to db
            if (!empty($mergedCart)) {
                Cart::updateOrCreate(
                    ['user_id' => $user->id], // Find by user_id
                    ['items' => json_encode($mergedCart)] // Store as JSON
                );
            }

            //clear session,cookie
            session()->forget('cart');
            Cookie::queue(Cookie::forget('cart'));
        }

        // logout
        Auth::guard('web')->logout();

        // Invalidate the session and regenerate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect after logout
        return redirect('/');
    }
}
