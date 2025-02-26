{{-- @extends('layouts.app')

@extends('adminlte::page')
@section('content')
<h2>Your Cart</h2> --}}
{{-- @foreach ($cartItems as $item)
    <div>{{ $item->product->name }} - Quantity: {{ $item->quantity }}</div>
    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Remove</button>
    </form>
@endforeach --}}
{{-- 
<a href="{{ route('order.checkout') }}">Proceed to Checkout</a>
@endsection --}}
