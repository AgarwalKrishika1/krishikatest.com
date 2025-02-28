<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Products;
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
    
    // Check if the user is logged in
    if (Auth::check()) {
        
        $cart = session('cart', []); 

        //product already in cart
        $found = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['name'] == $product->name) {
                $cartItem['quantity']++; 
                $found = true;
                break;
            }
        }

        // add product to cart
        if (!$found) {
            $cart[] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        // store cart to session
        session(['cart' => $cart]);

    } else {
        // For non-logged-in users, retrieve the cart from the cookie
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        // product already in cart
        $found = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['name'] == $product->name) {
                $cartItem['quantity']++; // Increase quantity if product is already in the cart
                $found = true;
                break;
            }
        }

        // add to cart
        if (!$found) {
            $cart[] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        Cookie::queue('cart', json_encode($cart), 60); // Store cart for 60 minutes
    }

    return redirect()->route('products.addToCartView');
}


public function addToCartView(Request $request){

    // Check if the user is logged in
    if (Auth::check()) {
        // Retrieve the cart from the session for logged-in users   
        $cart = session('cart', []);
    } else {
        // For non-logged-in users, retrieve the cart from the cookie
        $cart = json_decode(Cookie::get('cart', '[]'), true);
    }

    return view('cart.index', compact('cart'));

}
}
