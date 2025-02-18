@include('adminlte::page')
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
    <img src="{{ asset('storage/'.$product->img) }}" alt="{{ $product->name }}" >
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p>${{ $product->price }}</p>

    <form action="{{ route('products.addToCart', $product->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>

<style>
    .product-img{
        width:"100px !important";
        height:"100px !important"
    }
</style>
</body>
</html>