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

@include('frontend.header')
    <section>
        <div class="container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <h2>Enter Shipping Information</h2>
            <form action="{{ route('order.saveShipping') }}" method="POST" novalidate>
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
                <br><br>
            </form>
        </div>
        </section>
        
        
 <!-- jQery -->
 <script src="/home/js/jquery-3.4.1.min.js"></script>
 <!-- popper js -->
 <script src="/home/js/popper.min.js"></script>
 <!-- bootstrap js -->
 <script src="/home/js/bootstrap.js"></script>
 <!-- custom js -->
 <script src="/home/js/custom.js"></script>
 @include('frontend.footer')

</body>
</html>


