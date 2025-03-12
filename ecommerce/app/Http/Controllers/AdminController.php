<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch the products from the database (you can add any condition here to filter)
       // $products = Products::all();
        
        return view('adminHome');
    }

    public function editProduct($id)
    {

        $product = Products::findOrFail($id);

        return view('admin.edit-product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product = Products::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('admin.index')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
   
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.index')->with('success', 'Product deleted successfully.');
    }


    public function editUser($id)
    {
        
        $user = User::findOrFail($id);

        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }

        public function deleteOrder($id)
    {
        $order = order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.index')->with('success', 'Order deleted successfully.');
    }

}
