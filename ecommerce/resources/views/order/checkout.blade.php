{{-- need to make changes here for better ui --}}

@extends('layout')

@extends('adminlte::page')


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
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

