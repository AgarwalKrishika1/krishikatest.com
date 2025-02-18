<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

// public function index()
// {
//     $cart = session()->get('cart', []);
//     return view('cart.index', compact('cart'));
// }

// public function addToCart(Request $request, $productId)
//     {
//         $cart = Cart::updateOrCreate(
//             ['user_id' => auth()->id(), 'product_id' => $productId],
//             ['quantity' => $request->quantity]
//         );
//         return back()->with('success', 'Product added to cart!');
//     }

// public function viewCart()
//     {
//         $cartItems = Cart::where('user_id', auth()->id())->get();
//         return view('cart.view', compact('cartItems'));
//     }


public function remove($id)
{
    // Retrieve the cart from the session
    $cart = session()->get('cart', []);
    
    // Check if the item exists in the cart
    if (isset($cart[$id])) {
        // Remove the item from the cart
        unset($cart[$id]);
        
        // If the cart is empty after removal, clear the session
        if (empty($cart)) {
            
            session()->forget('cart');  // Completely forget the cart from session
            return redirect('add-to-cart/{$id}')->with('success', 'Cart is now empty');
        } else {
            // Otherwise, update the session with the modified cart
            session()->put('cart', $cart);
            //session()->save();
            return redirect()->back()->with('success', 'Item removed from cart');
            
        }  
    }

    // If the item does not exist in the cart, show an error
    return redirect()->back()->with('error', 'Item not found in cart');
}


}
