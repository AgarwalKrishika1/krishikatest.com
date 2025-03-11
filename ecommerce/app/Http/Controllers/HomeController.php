<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\SaleSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     if (Auth::check() && Auth::user()->type == 'admin') {
    //         return view('adminHome');
    //     }
    //     elseif(!Auth::check()){
    //         $sales = SaleSlider::all();  // Get active sales
       
    //         return view('frontend.master',compact('sales'));
    //     }
    //     return view('frontend.master',compact('sales'));
    // }   


    public function index()
    {
        // Show the master page by default
        echo Auth::check();
        if (Auth::check() && Auth::user()->type == 'admin') {
            return view('adminHome');
        }
        $sales = SaleSlider::all();
        return view('frontend.master', compact('sales'));
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
