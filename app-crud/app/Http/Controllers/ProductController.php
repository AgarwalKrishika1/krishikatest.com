<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index', ['products'=>$products]);
    }

    public function create(Request $request){
        return view('products.create');
    }

    public function store(Request $request){
        //dd($request);
        $data = $request->validate([
            'name'=> 'required',
            'quantity'=> 'required|numeric',
            'price'=> 'required|numeric',
            'description' => 'nullable',
        ]);

        $newProduct = Product::create($data);

        return redirect(route('products.index'));
    }


    public function edit(Product $product){
        return view('products.edit', ['product'=>$product]);
    }

    public function update(Request $request, Product $product){
        $data = $request->validate([
            'name'=> 'required',
            'quantity'=> 'required|numeric',
            'price'=> 'required|numeric',
            'description' => 'nullable',
        ]);
        $product->update($data);
        return redirect(route('products.index'))->with('success','Product updated');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect(route('products.index'))->with('success','Product deleted');
    }   
}
