<!-- shipping.blade.php -->
@extends('layouts.app')

@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Products</h1>
@stop

@section('content')
<div class="container">
    <h2>Enter Shipping Information</h2>
    <form action="{{ route('order.saveShipping') }}" method="POST">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" id="city" name="city" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" id="postal_code" name="postal_code" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
    </form>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
