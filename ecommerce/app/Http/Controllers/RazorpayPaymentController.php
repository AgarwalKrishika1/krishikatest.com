<?php

  

namespace App\Http\Controllers;

  

use Exception;

use Razorpay\Api\Api;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

  

class RazorpayPaymentController extends Controller

{

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function index()

    {        

        return view('payment.razorpayView');

    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function store(Request $request)

    {

        $input = $request->all();

       

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        

        $payment = $api->payment->fetch($input['razorpay_payment_id']);


        if(count($input)  && !empty($input['razorpay_payment_id'])) {

            try {

                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

  

            } catch (Exception $e) {

                return  $e->getMessage();

                Session::put('error',$e->getMessage());

                return redirect()->back();

            }

        }

        Session::put('success', 'Payment successful');
    
        return redirect('test-products')->with(setcookie('cart','',time()-3600));

    }

}