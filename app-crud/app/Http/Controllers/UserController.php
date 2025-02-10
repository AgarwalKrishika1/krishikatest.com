<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('products.index', ['users'=>$users]);
    }

    public function create(Request $request){
        return view('users.create');
    }

    public function store(Request $request){
        //dd($request);
        $data = $request->validate([
            'name'=> 'required',
            'email'=> 'required|numeric',
            'password'=> 'required|numeric|hidden',
            'role' => 'nullable',
        ]);

        $newProduct = User::create($data);

        return redirect(route('products.index'));
    }
}
