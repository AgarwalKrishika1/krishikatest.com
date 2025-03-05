<!-- resources/views/subscribe.blade.php -->
@if (Auth::check())

<section class="subscribe_section">
    <div class="container-fluid">
        <div class="box">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="subscribe_form">
                        <div class="heading_container heading_center">
                            <h3>Subscribed</h3>
                        </div>
                        <p>You have already subscribed</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@else

<section class="subscribe_section">
    <div class="container-fluid">
        <div class="box">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="subscribe_form">
                        <div class="heading_container heading_center">
                            <h3>Subscribe To Get Discount Offers</h3>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>

                        <!-- Display validation errors (if any) -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                          
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <input type="email" name="email" placeholder="Enter your email" required>
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

