@include('frontend.header')
<head>
    <link rel="shortcut icon" href={{"/images/favicon.png"}} type="">
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href={{"/home/css/bootstrap.css"}} />
    <!-- font awesome style -->
    <link href={{"/home/css/font-awesome.min.css"}} rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href={{"/home/css/style.css"}} rel="stylesheet" />
    <!-- responsive style -->
    <link href={{"/home/css/responsive.css"}} rel="stylesheet" />
</head>

<section>
    <section class="inner_page_head">
        <div class="container_fuild">
           <div class="row">
              <div class="col-md-12">
                 <div class="full">
                    <h3>payment</h3>
                 </div>
              </div>
           </div>
        </div>
     </section>
        <section>         
            <br>
        </section>
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
</section>

<body>
 <!-- jQery -->
 <script src="home/js/jquery-3.4.1.min.js"></script>
 <!-- popper js -->
 <script src="home/js/popper.min.js"></script>
 <!-- bootstrap js -->
 <script src="home/js/bootstrap.js"></script>
 <!-- custom js -->
 <script src="home/js/custom.js"></script>
</body>