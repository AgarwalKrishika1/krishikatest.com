<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch the products from the database (you can add any condition here to filter)
        $products = Products::all();
        
        return view('adminHome', compact('products'));
    }

    public function editProduct($id)
    {
        // Find the product by ID
        $product = Products::findOrFail($id);

        // Return the product to the admin for editing
        return view('admin.edit-product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        // Validate and update the product
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product = Products::findOrFail($id);
        $product->update($request->all());

        // Redirect to admin dashboard after successful update
        return redirect()->route('admin.index')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        // Delete the product from the database
        $product = Products::findOrFail($id);
        $product->delete();

        // Redirect with success message
        return redirect()->route('admin.index')->with('success', 'Product deleted successfully.');
    }


    public function editUser($id)
    {
        // Find the product by ID
        $user = User::findOrFail($id);

        // Return the product to the admin for editing
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Validate and update the product
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        // Redirect to admin dashboard after successful update
        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        // Delete the product from the database
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect with success message
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }
}
