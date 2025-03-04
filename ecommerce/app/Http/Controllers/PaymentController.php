<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\order;
use Razorpay\Api\Api;
use App\Models\Cart;   
use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
   public function showPaymentForm(Request $request)
    {
      $shipping = $request->session()->get('shipping_data');

        //dd($order);
      return view('payment.form', compact('shipping'));
    }

}
