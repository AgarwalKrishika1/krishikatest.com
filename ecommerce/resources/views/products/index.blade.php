{{-- 
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Products</h1>
@stop

@section('content')
    --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href="{{ asset('public/frontend/css/custom.css') }}">
    
</head>

<body>

<div class="products-container">
    <div id="products-list" class="products-list">
        <!-- Products will be dynamically inserted here -->
    </div>
</div>
<script src='public/frontend/js/bootstrap.bundle.js'></script>
<script>
    // Make an AJAX request to fetch products from the backend
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/fetch-products')
            .then(response => response.json())
            .then(data => {
                
                if (data.products) {
                    let productsList = document.getElementById('products-list');
                    productsList.innerHTML = ''; // Clear previous content
                    data.products.forEach(product => {
                        // Create product HTML
                        let productHTML = `
                            <div class="product-card">
                                <img src="${product.image}" alt="${product.name}" class="product-img" style="height:100px; width:100px;">
                                <h3 class="product-name">${product.name}</h3>
                                <p class="text-wrap">${product.description}</p>
                                <p>${product.category}</p>
                                <p class="product-price">Rs ${product.price}</p>
                                <a href="/add-to-cart/${product.id}" class="add-to-cart-btn">Add to Cart</a>
                                 
                            </div>
                            
                        `;
                        // Append each product to the product list container
                        // $('#product-details').html(productHtml);
                        productsList.innerHTML += productHTML;
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    });
  
</script>

<style>
    .product-img{
        width:"100px !important";
        height:"100px !important"
    }
</style>
</body>
</html>
{{-- @stop --}}

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop






