<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function index()
{
    $products = Products::all();
    return view('products.index', compact('products'));
}

public function show(Products $product)
{
    return view('products.show', compact('product'));
}

public function create()
    {
       
       return view('products.create');
    }

    public function store(Request $request)
    {
       $request->validate([
        'name'=> 'required',
       ]);

       $task = new Products();
       $task->name = $request->name;
       $task->price = $request->price;
       $task->description = $request->description;
       $task->image = $request->image;

       $task->save();

       return redirect()->route('index');
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

        // Iterate through the products and save to the database
        foreach ($products as $productData) {
            // Assuming you have a Product model with `name`, `price`, `description`, etc.
            Products::create([
                'name' => $productData['title'],
                'price' => $productData['price'],
                'description' => $productData['description'],
                'image' => $productData['image'],
            ]);
        }
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
    Cookie::queue('cart', json_encode($cart), 1 * 1); // Store for 60min
   
    return view('cart.index', compact('cart'));
}
    // View the cart
    public function viewCart()
{
    // Retrieve the cart from the cookie
    $cart = json_decode(Cookie::get('cart', '[]'), true); // Get cart, default to empty array if not set

    return view('cart.index', compact('cart'));
}
}
