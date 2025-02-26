@include('frontend.header')

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
<h2>Your Cart</h2>

@if(count($cart) >= 1)

    <ul>
        @foreach($cart as $index => $item)
            <li>
                <strong>{{ $item['name'] }}</strong> 
                - Rs {{ $item['price'] }} 
                x {{ $item['quantity'] }}
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" style="width:50px;height:50px;">
            </li>
            <form action="{{ route('cart.remove', ['index' => $index]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Remove</button>
            </form>
        @endforeach
    </ul>

    <?php
        // Assuming this is the total calculation block
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Store the total in a session variable
        session_start();
        $_SESSION['total_amount'] = $total;
        ?>
        <h3>Total: Rs <?php echo $total; ?></h3>

        
    <br>
    <a href="/products" class="btn btn-primary">Back</a>
    <br><br>
    <form action="{{ route('order.checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Checkout</button>
    </form>
    <br>
   
@else
    <p>Your cart is empty.</p>
@endif

 <!-- jQery -->
 <script src="/home/js/jquery-3.4.1.min.js"></script>
 <!-- popper js -->
 <script src="/home/js/popper.min.js"></script>
 <!-- bootstrap js -->
 <script src="/home/js/bootstrap.js"></script>
 <!-- custom js -->
 <script src="/home/js/custom.js"></script>

</body>
</html>

@include('frontend.footer')




