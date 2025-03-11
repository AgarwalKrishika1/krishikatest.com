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
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body class="sub_page">
      <div class="hero_area">
         <!-- header section strats -->
        
         @include('frontend.header')
         <!-- end header section -->
      </div>
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Product Grid</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- product section -->
     
     <section class="product_section">
   
   <div class="container">
     
         <br>
         <div class="dropdown">
            
           <button class="dropbtn">Filter by Categories
            <i class="fa fa-caret-down"></i>
           </button>
           <div class="dropdown-content">
            
             <a href="{{ route('products.index', ['category' => 'jewelery']) }}">Jewelery</a>
             <a href="{{ route('products.index', ['category' => 'electronics']) }}">Electronics</a>
             <a href="{{ route('products.index', ['category' => "men's clothing"]) }}">Men's clothing</a>
             <a href="{{ route('products.index', ['category' => "women's clothing"]) }}">Women's clothing</a>
           </div>
         </div>

         <div class="dropdown" >
            
            <button class="dropbtn">Sort
             <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
               <a href="{{ route('products.index', ['sort' => 'asc']) }}">Price(Low to High)</a>
               <a href="{{ route('products.index', ['sort' => 'desc']) }}">Price(High to Low)</a>
            </div>
          </div>
      <div class="row">
         
         @foreach($products as $product)
         <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="{{route('products.addToCart', $product->id)}}" class="option1">
                        Add To Cart
                     </a>
                     <a href="{{route('products.addToCart', $product->id)}}" class="option2">
                        Buy Now
                     </a>
                  </div>
               </div>
               <div class="img-box">
                  <img src="{{ $product->image }}" alt="">
               </div>
               <div class="detail-box">
                  <h5>
                     {{ $product->name }}
                  </h5>
                  <h6>
                     Rs {{ $product->price }}
                  </h6>
               </div>
            </div>
         </div>
         @endforeach
      </div>
      <div class="btn-box">
         <a href="{{ route('products.index') }}">
            View All products
         </a>
      </div>
      <br>
   </div>
</section>
      <!-- end product section -->
      <!-- footer section -->
     @include('frontend.footer')
      <!-- footer section -->
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>