<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $cart = session()->get('cart', []);

        // Check if product already exists in the cart
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        // Save cart to session
        session()->put('cart', $cart);

        return view('cart.index', compact('cart'));
    }

    // View the cart
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }





    // public function addToCart($id)
    // {
        
    //     $product = Products::find($id);
        
    //     if (!$product) {
    //         return redirect()->route('products.index')->with('error', 'Product not found!');
    //     }

    //     $user_id = Auth::check() ? Auth::id() : session()->getId();

    //     $cart = Cart::firstOrCreate(
    //         ['user_id' => $user_id],
    //         ['user_id' => $user_id] // Default data if a cart doesn't exist
    //     );
    
    //     // Check if the product is already in the cart
    //     $cartItem = cart_item::where('cart_id', $cart->id)
    //                         ->where('product_id', $product->id)
    //                         ->first();
    
    //     if ($cartItem) {
    //         // If the product is already in the cart, increment its quantity
    //         $cartItem->quantity++;
    //         $cartItem->save();
    //     } else {
    //         // If the product is not in the cart, add it
    //         cart_item::create([
    //             'cart_id' => $cart->id,
    //             'product_id' => $product->id,
    //             'quantity' => 1
    //         ]);
    //     }
    
    //     // Return the cart view with the updated cart data
    //     $cart = $cart->load('items.product');  // Load the related items with product details
    //     return view('cart.index', compact('cart'));
    // }
}
