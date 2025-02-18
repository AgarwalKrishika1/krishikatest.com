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
   public function showPaymentForm($orderId)
    {
        $order = Order::findOrFail($orderId);
       // return view('payment.form', compact('order'));
      // return "Payment ";
      return view('payment.form');
    }

    public function processPayment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Handle payment logic (e.g., Stripe, PayPal)

        // After payment is processed successfully:
        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total_price,
            'payment_status' => 'Paid'
        ]);

        // Update order status
        $order->update(['status' => 'Completed']);

        // Clear the cart
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('order.view', $order->id)->with('success', 'Order completed!');
    }


    public function store(Request $request) {
        $input = $request->all();
        $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payment = Payment::create([
                    'r_payment_id' => $response['id'],
                    'method' => $response['method'],
                    'currency' => $response['currency'],
                    'user_email' => $response['email'],
                    'amount' => $response['amount']/100,
                    'json_response' => json_encode((array)$response)
                ]);
            } catch(Exception $e) {
               // return $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        Session::put('success',('Payment Successful'));
        return redirect()->back();
    }

    public function index(){
       return view('payment.form');
    }
}
