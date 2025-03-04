<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Products;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function index()
{
    $products = Products::all();
    return view('products.product', compact('products'));
}

public function fetchProductsByCategory($category)
{
    // Fetch products by the given category
    $productsByCategory = Products::where('category', $category)->get();
    return view('products.productByCategory', compact('productsByCategory'));
}

public function fetchSortedProducts()
{
    // Fetch products by the given category
    $sortedProducts = Products::orderBy('name', 'desc')->get();
    return view('products.sortedProduct', compact('sortedProducts'));
}


public function fetchAndSaveProducts()
{
    // Instantiate Guzzle HTTP client
    $client = new Client();

    // API URL (fake eCommerce API for this example)
    $url = 'https://fakestoreapi.com/products';

    // Make the GET request
    $response = $client->get($url);

    // Parse the JSON response
    $products = json_decode($response->getBody(), true);

    // Prepare an array for batch insertion
    $productData = [];
    foreach ($products as $product) {
        // Check if product already exists
        $existingProduct = Products::where('name', $product['title'])->first();

        if (!$existingProduct) {
            $productData[] = [
                'name' => $product['title'],
                'price' => $product['price'],
                'description' => $product['description'],
                'category' => $product['category'],
                'image' => $product['image'],
                'created_at' => now(), 
                'updated_at' => now(), 
            ];
        }
    }

    // Insert all products that do not already exist
    if (!empty($productData)) {
        Products::insert($productData);
    }

    // Fetch all saved products (if needed)
    $savedProducts = Products::all();

    return response()->json([
        'message' => 'Products fetched and saved successfully.',
        'products' => $savedProducts
    ]);
}

public function addToCart($id)
{
    $product = Products::find($id);

    if (!$product) {
        return redirect()->route('products.index')->with('error', 'Product not found!');
    }

    //user logged
    if (Auth::check()) {
        $user = Auth::user();
        $cart = session('cart', []); // session cart

        // db cart and merge 
        $databaseCart = Cart::where('user_id', $user->id)->first();
        //db item array or json
        if ($databaseCart) {
            $databaseCartItems = is_array($databaseCart->items) 
                ? $databaseCart->items 
                : json_decode($databaseCart->items, true);

            // merge to session
            $this->mergeDatabaseCartToSession($cart, $databaseCartItems);
        }

        // merge guest cookie
        $this->mergeGuestCartToUserCart($cart);

        //if in cart
        $found = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['name'] == $product->name) {
                $cartItem['quantity']++;
                $found = true;
                break;
            }
        }

        // if not in cart, add
        if (!$found) {
            $cart[] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        // update session
        session(['cart' => $cart]);

    } else {
        // guest user, cookie cart
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        // if in cart
        $found = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['name'] == $product->name) {
                $cartItem['quantity']++;
                $found = true;
                break;
            }
        }

        // if not in cart
        if (!$found) {
            $cart[] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        //store cookie
        Cookie::queue('cart', json_encode($cart), 60); 
    }

    return redirect()->route('products.addToCartView');
}



//merge cookie method
protected function mergeGuestCartToUserCart(&$cart)
{
    // if cookie cart
    $guestCart = json_decode(Cookie::get('cart', '[]'), true);

    if (!empty($guestCart)) {
        // merge to session
        foreach ($guestCart as $guestItem) {
            $found = false;
            foreach ($cart as &$cartItem) {
                // in cart, increase quantity
                if ($cartItem['name'] == $guestItem['name']) {
                    $cartItem['quantity'] += $guestItem['quantity'];
                    $found = true;
                    break;
                }
            }

            // add if not in cart
            if (!$found) {
                $cart[] = $guestItem;
            }
        }

        // merge and remove frrom cookie
        Cookie::queue(Cookie::forget('cart'));
    }
}



// merge db cart
protected function mergeDatabaseCartToSession(&$cart, $databaseCartItems)
{
    if (!empty($databaseCartItems)) {
        foreach ($databaseCartItems as $dbItem) {
            $found = false;
            foreach ($cart as &$cartItem) {
                if ($cartItem['name'] == $dbItem['name']) {
                    $cartItem['quantity'] += $dbItem['quantity'];
                    $found = true;
                    break;
                }
            }

            // not found, add
            if (!$found) {
                $cart[] = $dbItem;
            }
        }
    }
}



public function addToCartView(Request $request)
{
    // user logged 
    if (Auth::check()) {
        $user = Auth::user();
        $cart = session('cart', []);

        // merge db cart
        $databaseCart = Cart::where('user_id', $user->id)->first();
        if ($databaseCart) {
            $databaseCartItems = is_array($databaseCart->items) 
                ? $databaseCart->items 
                : json_decode($databaseCart->items, true);

            // merge
            $this->mergeDatabaseCartToSession($cart, $databaseCartItems);
            //update session
            session(['cart' => $cart]); 

            // delete from db
            $databaseCart->delete(); 
        }

        //merge cookie cart
        $guestCart = json_decode(Cookie::get('cart', '[]'), true);
        if (!empty($guestCart)) {
            $this->mergeGuestCartToUserCart($cart);
            //update session
            session(['cart' => $cart]); 
            //remove cookie
            Cookie::queue(Cookie::forget('cart')); 
        }

    } else {
        // cookie cart for non logged user
        $cart = json_decode(Cookie::get('cart', '[]'), true);
    }

    return view('cart.index', compact('cart'));
}

}
