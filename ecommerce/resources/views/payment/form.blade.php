{{-- @extends('layout') --}}
@extends('adminlte::page')
@section('content')
{{-- <h2>Payment for Order #{{ $order->id }}</h2> --}}

{{-- <form action="{{ route('payment.process', $order->id) }}" method="POST">
    @csrf
    <!-- Payment Gateway Integration -->
    <button type="submit">Pay Now</button>
</form> --}}

<div class="card card-default">
    <div class="card-header">
        Laravel - Razorpay Payment Gateway Integration
    </div>
    <div class="card-body text-center">
        <form action="{{ route('razorpay.payment.store') }}" method="POST" >

            <?php
            session_start();
            
            // Access the saved total
            if (isset($_SESSION['total_amount'])) {
                $cartTotalForPayment = $_SESSION['total_amount']*100;
                session(['cart_total' => $cartTotalForPayment]);
                // Use this value for the payment process
                //echo "Your total for payment is: " . $cartTotalForPayment;
            } else {
                echo "Total not found. Please try again.";
            }
            ?>
            
            @csrf 
            <script src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="{{ env('RAZORPAY_KEY') }}"
                    {{-- data-amount="$cartTotalForPayment" --}}
                    data-amount="{{ session('cart_total') }}"
                    {{-- data-buttontext="{{ $cartTotalForPayment}}" --}}
                     data-buttontext="pay {{ session('cart_total')/100 }}"
                    data-name="GeekyAnts official"
                    data-description="Razorpay payment"
                    data-image="/images/logo-icon.png"
                    data-prefill.name="ABC"
                    data-prefill.email="abc@gmail.com"
                    data-theme.color="#ff7529">
            </script>
        </form>
    </div>
</div>
@endsection
