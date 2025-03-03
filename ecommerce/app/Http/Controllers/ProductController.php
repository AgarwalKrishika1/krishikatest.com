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

// public function addToCart($id)
// {
//     $product = Products::find($id);

//     if (!$product) {
//         return redirect()->route('products.index')->with('error', 'Product not found!');
//     }
    
//     // Check if the user is logged in
//     if (Auth::check()) {
        
//         $cart = session('cart', []); 

//         // Check if the cart exists in the session and merge guest cart if needed
//         $this->mergeGuestCartToUserCart($cart);


//         //product already in cart
//         $found = false;
//         foreach ($cart as &$cartItem) {
//             if ($cartItem['name'] == $product->name) {
//                 $cartItem['quantity']++; 
//                 $found = true;
//                 break;
//             }
//         }

//         // add product to cart
//         if (!$found) {
//             $cart[] = [
//                 'name' => $product->name,
//                 'price' => $product->price,
//                 'quantity' => 1,
//                 'image' => $product->image
//             ];
//         }

//         // store cart to session
//         session(['cart' => $cart]);

//     } else {
//         // For non-logged-in users, retrieve the cart from the cookie
//         $cart = json_decode(Cookie::get('cart', '[]'), true);

//         // product already in cart
//         $found = false;
//         foreach ($cart as &$cartItem) {
//             if ($cartItem['name'] == $product->name) {
//                 $cartItem['quantity']++; // Increase quantity if product is already in the cart
//                 $found = true;
//                 break;
//             }
//         }

//         // add to cart
//         if (!$found) {
//             $cart[] = [
//                 'name' => $product->name,
//                 'price' => $product->price,
//                 'quantity' => 1,
//                 'image' => $product->image
//             ];
//         }

//         Cookie::queue('cart', json_encode($cart), 60); // Store cart for 60 minutes
//     }

//     return redirect()->route('products.addToCartView');
// }

public function addToCart($id)
{
    $product = Products::find($id);

    if (!$product) {
        return redirect()->route('products.index')->with('error', 'Product not found!');
    }

    // Check if the user is logged in
    if (Auth::check()) {
        $user = Auth::user();
        $cart = session('cart', []); // Retrieve cart from session for logged-in users



        // Check if the user has a cart in the database and merge it
        $databaseCart = Cart::where('user_id', $user->id)->first();
        if ($databaseCart) {
            // Check if it's already an array or a JSON string
            if (is_array($databaseCart->items)) {
                $databaseCartItems = $databaseCart->items; // It's already an array
            } else {
                $databaseCartItems = json_decode($databaseCart->items, true); // Decode the JSON string
            }

            // Merge cart data from the database if any
            $this->mergeDatabaseCartToSession($cart, $databaseCartItems);

            
        }

        // Merge guest cart if needed
        $this->mergeGuestCartToUserCart($cart);

        // Check if the product is already in the cart
        $found = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['name'] == $product->name) {
                $cartItem['quantity']++;
                $found = true;
                break;
            }
        }

        // If the product is not found in the cart, add it
        if (!$found) {
            $cart[] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        // Store updated cart in session
        session(['cart' => $cart]);

    } else {
        // For non-logged-in users (guest users), retrieve the cart from the cookie
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        // Check if the product is already in the cart
        $found = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['name'] == $product->name) {
                $cartItem['quantity']++;
                $found = true;
                break;
            }
        }

        // If the product is not found, add it
        if (!$found) {
            $cart[] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        // Store cart for 60 minutes in the cookie
        Cookie::queue('cart', json_encode($cart), 60); // Store for 60 minutes
    }

    return redirect()->route('products.addToCartView');
}


// Helper method to merge guest cart (from cookie) into the user cart (session)
protected function mergeGuestCartToUserCart(&$cart)
{
    // Check if there's a cart in the cookie (for guest users)
    $guestCart = json_decode(Cookie::get('cart', '[]'), true);

    if (!empty($guestCart)) {
        // Merge guest cart items into the session cart
        foreach ($guestCart as $guestItem) {
            $found = false;
            foreach ($cart as &$cartItem) {
                // If product already in the cart, just increase the quantity
                if ($cartItem['name'] == $guestItem['name']) {
                    $cartItem['quantity'] += $guestItem['quantity'];
                    $found = true;
                    break;
                }
            }

            // If product is not found in the cart, add it
            if (!$found) {
                $cart[] = $guestItem;
            }
        }

        // After merging, remove the guest cart cookie
        Cookie::queue(Cookie::forget('cart'));
    }
}


// In your helper method where you merge database cart
protected function mergeDatabaseCartToSession(&$cart, $databaseCartItems)
{
    // Check if the items field is already an array, if not decode it
    if (!is_array($databaseCartItems)) {
        $databaseCartItems = json_decode($databaseCartItems, true);
    }

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

            // If product is not found in the cart, add it
            if (!$found) {
                $cart[] = $dbItem;
            }
        }
    }
}



public function addToCartView(Request $request)
{
    // Check if the user is logged in
    if (Auth::check()) {

        $user = Auth::user();

        // Retrieve the cart from the session for logged-in users   
        $cart = session('cart', []);


        // Check if the user has a cart in the database and merge it
        $databaseCart = Cart::where('user_id', $user->id)->first();
        if ($databaseCart) {
            // Ensure we decode only if it's a string
            $databaseCartItems = is_array($databaseCart->items) 
                                 ? $databaseCart->items 
                                 : json_decode($databaseCart->items, true);
            // Merge cart data from the database if any
            $this->mergeDatabaseCartToSession($cart, $databaseCartItems);

        }

        // Check if there's a guest cart in the cookie
        $guestCart = json_decode(Cookie::get('cart', '[]'), true);

        if (!empty($guestCart)) {
            // Merge guest cart items with the logged-in user's cart
            foreach ($guestCart as $item) {
                // Check if the product is already in the cart
                $found = false;
                foreach ($cart as &$cartItem) {
                    if ($cartItem['name'] == $item['name']) {
                        $cartItem['quantity'] += $item['quantity'];
                        $found = true;
                        break;
                    }
                }

                // If the product is not found, add it
                if (!$found) {
                    $cart[] = $item;
                }
            }   



            // Store the merged cart in the session
            session(['cart' => $cart]);

            // Remove guest cart cookie
            Cookie::queue(Cookie::forget('cart'));
        }

    } else {
        // For non-logged-in users (guest users), retrieve the cart from the cookie
        $cart = json_decode(Cookie::get('cart', '[]'), true);
        
    }

    return view('cart.index', compact('cart'));
}


// public function addToCartView(Request $request)
// {
//     // Check if the user is logged in
//     if (Auth::check()) {
//         // Retrieve the cart from the session for logged-in users   
//         $cart = session('cart', []);

//         // Check if there's a cart in the cookie (for guest users)
//         $guestCart = json_decode(Cookie::get('cart', '[]'), true);

//         // If the guest cart exists and is not empty, merge it with the session cart
//         if (!empty($guestCart)) {
//             // Merge guest cart items with the logged-in user's cart
//             foreach ($guestCart as $item) {
//                 // Add each item from the guest cart to the user's cart
//                 $found = false;
//                 foreach ($cart as &$cartItem) {
//                     // Check if product is already in the cart
//                     if ($cartItem['name'] == $item['name']) {
//                         // If product exists, increase the quantity
//                         $cartItem['quantity'] += $item['quantity'];
//                         $found = true;
//                         break;
//                     }
//                 }
//                 // If the product is not found in the cart, add it
//                 if (!$found) {
//                     $cart[] = $item;
//                 }
//             }

//             // Now that the cart is merged, save it to the session
//             session(['cart' => $cart]);

//             // Optionally, delete the guest cart cookie
//             Cookie::queue(Cookie::forget('cart'));
//         }
//     } else {
//         // For non-logged-in users, retrieve the cart from the cookie
//         $cart = json_decode(Cookie::get('cart', '[]'), true);
//     }

//     // Return the view with the cart
//     return view('cart.index', compact('cart'));
// }


// public function addToCartView(Request $request)
// {
//     // Check if the user is logged in
//     if (Auth::check()) {
//         // Retrieve the cart from the session for logged-in users   
//         $cart = session('cart', []);

//         // Check if there's a guest cart in the cookie
//         $guestCart = json_decode(Cookie::get('cart', '[]'), true);

//         if (!empty($guestCart)) {
//             // Merge guest cart items with the logged-in user's cart
//             foreach ($guestCart as $item) {
//                 // Check if the product is already in the cart
//                 $found = false;
//                 foreach ($cart as &$cartItem) {
//                     if ($cartItem['name'] == $item['name']) {
//                         $cartItem['quantity'] += $item['quantity'];
//                         $found = true;
//                         break;
//                     }
//                 }

//                 // If the product is not found, add it
//                 if (!$found) {
//                     $cart[] = $item;
//                 }
//             }

//             // Store the merged cart in the session
//             session(['cart' => $cart]);

//             // Remove guest cart cookie
//             Cookie::queue(Cookie::forget('cart'));
//         }

//     } else {
//         // For non-logged-in users (guest users), retrieve the cart from the cookie
//         $cart = json_decode(Cookie::get('cart', '[]'), true);
//     }

//     return view('cart.index', compact('cart'));
// }

}
