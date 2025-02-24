<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function index()
{
    $products = Products::all();
    return view('products.index', compact('products'));
}

public function showProducts()
{
    // Fetch all saved products from the database
    $products = Products::all();

    return view('products.product', compact('products'));
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
        $productData[] = [
            'name' => $product['title'],
            'price' => $product['price'],
            'description' => $product['description'],
            'category' => $product['category'],
            'image' => $product['image'],
            'created_at' => now(), // Add timestamps
            'updated_at' => now(), // Add timestamps
        ];
    }

    // Insert all products at once
    Products::insert($productData);

    // Fetch all saved products (if needed)
    $savedProducts = Products::all();

    return response()->json([
        'message' => 'Products fetched and saved successfully.',
        'products' => $savedProducts
    ]);
}
    // Add product to cart
    public function addToCart($id)
{
    $product = Products::find($id);

    if (!$product) {
        return redirect()->route('products.index')->with('error', 'Product not found!');
    }
    
    // Retrieve the cart from the cookie
    $cart = json_decode(Cookie::get('cart', '[]'), true); // Get cart, default to empty array if not set
    
    // Check if the product already exists in the cart
    // if (isset($cart[$id])) {
        //     $cart[$id]['quantity']++; // Increase quantity if product is already in the cart
    // } else {
        //     $cart[$id] = [
    //         'name' => $product->name,
    //         'price' => $product->price,
    //         'quantity' => 1,
    //         'image' => $product->image
    //     ];
    // }
    $cart[] = [
        'name' => $product->name,
        'price' => $product->price,
        'quantity' => 1,
        'image' => $product->image
    ];
    // dd($cart);
    Cookie::queue(Cookie::forget('$cart'));
    Cookie::queue('cart', json_encode($cart), 60); // Store for 60min
    return redirect()->route('products.addToCartView') ;

}

public function addToCartView(Request $request){
    
    $cart = json_decode(Cookie::get('cart', '[]'), true);
    // echo"<pre>";
    // print_r($_COOKIE);exit;
    return view('cart.index', compact('cart'));
  

  
}
}
