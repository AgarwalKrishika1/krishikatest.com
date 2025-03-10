<?php

namespace App\Http\Controllers;

use App\Models\SaleSlider;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sales = SaleSlider::all();  // Get active sales
        dd($sales);
        return view('frontend.master',compact('sales'));
    }

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

     public function adminHome(): View

     {
 
         return view('adminHome');
 
     }
}
