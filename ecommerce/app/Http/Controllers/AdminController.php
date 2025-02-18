<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');  // Ensure only admins can access these routes
    }

    public function index()
    {
        return view('admin.dashboard');  // Create the admin dashboard view
    }
}
