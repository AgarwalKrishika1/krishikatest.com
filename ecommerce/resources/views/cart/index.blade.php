@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cart</h1>
@stop

@section('content')

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
<h2>Your Cart</h2>

@if(count($cart) >= 1)

    <ul>
        @foreach($cart as $index => $item)
            <li>
                <strong>{{ $item['name'] }}</strong> 
                - ${{ $item['price'] }} 
                x {{ $item['quantity'] }}
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" style="width:50px;height:50px;">
            </li>
            <form action="{{ route('cart.remove', ['index' => $index]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Remove</button>
            </form>
        @endforeach
    </ul>

    {{-- <h3>Total: {{ array_sum(array_map(function($item) {
        return $item['price'] * $item['quantity'];
    }, $cart)) }}</h3> --}}

    <?php
        // Assuming this is the total calculation block
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Store the total in a session variable
        session_start();
        $_SESSION['total_amount'] = $total;
        ?>
        <h3>Total: $<?php echo $total; ?></h3>

        
    <br>
    <a href="/products" class="btn btn-primary">Back</a>
    <br><br>
    <form action="{{ route('order.checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Checkout</button>
    </form>
    <br>
   
@else
    <p>Your cart is empty.</p>
@endif

</body>
</html>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop





