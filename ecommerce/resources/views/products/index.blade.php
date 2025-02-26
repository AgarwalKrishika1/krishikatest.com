<!DOCTYPE html>
<html>
    <head>
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Site Metas -->
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="/images/favicon.png" type="">
        <title>E-commerce website</title>
        <!-- bootstrap core css -->
        <link rel="stylesheet" type="text/css" href="/home/css/bootstrap.css" />
        <!-- font awesome style -->
        <link href="/home/css/font-awesome.min.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="/home/css/style.css" rel="stylesheet" />
        <!-- responsive style -->
        <link href="/home/css/responsive.css" rel="stylesheet" />
     </head>
<body>

<div class="products-container">
    <div id="products-list" class="products-list">
        <!-- Products will be dynamically inserted here -->
    </div>
</div>
 <!-- jQery -->
 <script src="/home/js/jquery-3.4.1.min.js"></script>
 <!-- popper js -->
 <script src="/home/js/popper.min.js"></script>
 <!-- bootstrap js -->
 <script src="/home/js/bootstrap.js"></script>
 <!-- custom js -->
 <script src="/home/js/custom.js"></script>
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





