@include('frontend.header')

<!DOCTYPE html>
<html lang="en">
<head>
   @include('frontend.css')
</head>
<body>
    <div class="container">
        <h2 class="my-4">Your Cart</h2>

        @if(count($cart) >= 1)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $index => $item)
                        <tr>
                            <td>
                                <strong>{{ $item['name'] }}</strong>
                                <br>
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" style="width: 50px; height: 50px;">
                            </td>
                            <td>Rs {{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rs {{ $item['price'] * $item['quantity'] }}</td>
                            <td>
                                <form action="{{ route('cart.remove', ['index' => $index]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash "> </i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total Calculation -->
            <?php
                $total = array_sum(array_map(function($item) {
                    return $item['price'] * $item['quantity'];
                }, $cart));
                session(['total_amount' => $total]); // Store the total in the session
            ?>
            <h3>Total: Rs {{ number_format($total, 2) }}</h3>

            <!-- Navigation and Checkout -->
            <div class="my-4">
                <a href="/test-products" class="btn btn-primary">Back to Products</a>
                <br><br>
                <form action="{{ route('order.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Proceed to Checkout</button>
                </form>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>

    <!-- jQuery -->
    <script src="/home/js/jquery-3.4.1.min.js"></script>
    <!-- Popper.js -->
    <script src="/home/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/home/js/bootstrap.js"></script>
    <!-- Custom JS -->
    <script src="/home/js/custom.js"></script>
</body>
</html>

@include('frontend.footer')
