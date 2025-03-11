@extends('layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Checkout</h1>
@stop

@section('content')
   
<form action="{{ route('order.checkout') }}" method="POST">
    @csrf
    <label for="address">Address</label>
    <input type="text" name="address" required>
    
    <label for="city">City</label>
    <input type="text" name="city" required>
    
    <label for="postal_code">Postal Code</label>
    <input type="text" name="postal_code" required>

    <button type="submit">Place Order</button>
</form>
@stop

@section('css')
  
    
@stop

@section('js')
    <script> console.log("Hi, !"); </script>
@stop

