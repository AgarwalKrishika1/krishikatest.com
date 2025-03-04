{{-- <section class="subscribe_section">
    <div class="container-fuild">
       <div class="box">
          <div class="row">
             <div class="col-md-6 offset-md-3">
                <div class="subscribe_form ">
                   <div class="heading_container heading_center">
                      <h3>Subscribe To Get Discount Offers</h3>
                   </div>
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                   <form action="/subscribed">
                      <input type="email" name="email" placeholder="Enter your email" required>
                      <button>
                      subscribe
                      </button>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section> --}}

{{-- 
 @section('content') --}}
    <section class="subscribe_section">
        <div class="container-fluid">
            <div class="box">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="subscribe_form">
                            <div class="heading_container heading_center">
                                <h3>Subscribe To Get Discount Offers</h3>
                            </div>
                            <p>Subscribe to get discounts.</p>

                            <!-- Show any errors if user is not logged in -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Show success message -->
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form action="{{ route('subscribe') }}" method="POST">
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
{{-- @endsection --}}