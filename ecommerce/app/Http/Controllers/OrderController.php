<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\shipping;
use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        //$total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        
        // Create Order
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'Pending',
            //'total_price' => $total
        ]);

      // Redirect to shipping form to collect address details
    return redirect()->route('order.shippingForm', $order->id);
       
    }

    public function viewOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('order.view', compact('order'));
    }
    public function saveShipping(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
        ]);
    
        // Get the order by ID
        $order = Order::findOrFail($request->order_id);
    
        // Save shipping details to the Shipping model
        Shipping::create([
            'order_id' => $order->id,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);
    
        // Optionally, update the order status or total price, etc.
        $order->update(['status' => 'Awaiting Payment']);
    
        // Redirect to the payment page
        return redirect()->route('payment.show', $order->id);
    }

    public function shippingForm($orderId)
{
    $order = Order::findOrFail($orderId);
    return view('order.shipping', compact('order'));
}

    
}
