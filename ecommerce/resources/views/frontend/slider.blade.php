
 <section class="slider_section">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="slider_bg_box">
            <img src="/images/slider-bg.jpg" alt="">
        </div>
        <div class="carousel-inner">

            @foreach($sales as $index => $sale)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-lg-6">
                                <div class="detail-box">
                                    <h1>
                                        <span>
                                            Sale {{ $sale->discount }}% Off
                                        </span>
                                        <br>
                                        On {{ ucfirst($sale->category) }}
                                    </h1>
                                    <p></p>
                                    <div class="btn-box">
                                        @if ($sale->category == 'all')
                                        <a href="{{ url()->current() . '/test-products' }}" class="btn1">
                                            Shop Now
                                        </a>
                                       @else
                                        <a href="{{ url()->current() . '/test-products?category=' . $sale->category }}" class="btn1">
                                            Shop Now
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="container">
            <ol class="carousel-indicators">
                @foreach($sales as $index => $sale)
                    <li data-target="#customCarousel1" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
