<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

public function remove($index)
{
    // logged in user
    if (Auth::check()) {
        // cart from session
        $cart = session('cart', []); 

        // if item exists
        if (isset($cart[$index])) {
            // remove
            unset($cart[$index]);

            // reindex 
            $cart = array_values($cart);

            // cart empty, clear session
            if (empty($cart)) {
                session()->forget('cart');
            } else {
                //update session
                session(['cart' => $cart]);
            }
            //backi to view 
            return redirect()->route('products.addToCartView')->with('success', 'Item removed from cart');
        }

        // item not in session, error
        return redirect()->route('products.addToCartView')->with('error', 'Item not found in cart');
    } 
    else {
        // cart from cookie if not logged in
        $cart = json_decode(Cookie::get('cart', '[]'), true); 

        // if item in cookie
        if (isset($cart[$index])) {
            //remove
            unset($cart[$index]);

            //reindex
            $cart = array_values($cart);

            // cart empty, remove cookiee
            if (empty($cart)) {
                Cookie::queue(Cookie::forget('cart'));
            } else {
                // update cart cookie
                Cookie::queue('cart', json_encode($cart), 60); 
            }

            return redirect()->route('products.addToCartView')->with('success', 'Item removed from cart');
        }

       // item not in cookie, error
        return redirect()->route('products.addToCartView')->with('error', 'Item not found in cart');
    }
}

}
