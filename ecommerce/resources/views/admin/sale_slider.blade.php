{{-- <section class="slider_section ">
   
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="slider_bg_box">
         <img src="/images/slider-bg.jpg" alt="" >
       </div>
       <div class="carousel-inner">
          <div class="carousel-item active">
             <div class="container ">
                <div class="row">
                   <div class="col-md-7 col-lg-6 ">
                      <div class="detail-box">
                         <h1>
                            <span>
                            Sale 20% Off
                            </span>
                            <br>
                            On Jewelery
                         </h1>
                         <p>
                            
                         </p>
                         <div class="btn-box"> --}}
                            {{-- <a href="{{ route('products.index', ['category' => 'jewelery']) }}" class="btn1"> --}}
                              {{-- <a href="/products?category=jewelery" class="btn1">
                            Shop Now
                            </a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="carousel-item ">
             <div class="container ">
                <div class="row">
                   <div class="col-md-7 col-lg-6 ">
                      <div class="detail-box">
                         <h1>
                            <span>
                            Sale 10% Off
                            </span>
                            <br>
                            On Electronics
                         </h1>
                         <p>
                           
                         </p>
                         <div class="btn-box">
                            <a href="/products?category=electronics" class="btn1">
                            Shop Now
                            </a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="carousel-item">
             <div class="container ">
                <div class="row">
                   <div class="col-md-7 col-lg-6 ">
                      <div class="detail-box">
                         <h1>
                            <span>
                            Sale 5% Off
                            </span>
                            <br>
                            On Everything
                         </h1>
                         <p>
                            
                         </p>
                         <div class="btn-box">
                            <a href="/products" class="btn1">
                            Shop Now
                            </a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="container">
          <ol class="carousel-indicators">
             <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
             <li data-target="#customCarousel1" data-slide-to="1"></li>
             <li data-target="#customCarousel1" data-slide-to="2"></li>
          </ol>
       </div>
    </div>
 </section> --}}

 <section class="slider">
   <h2> slider </h2>
   <table class="table">
   <thead>
   <tr>
      <th>discount</th>
      <th>category</th>
      <th> link </th>
      <th>Actions</th>
   </tr>
   </thead>
   <tbody>
       @php
       use App\Models\SaleSlider;
       $sliders = SaleSlider::all();
       @endphp
   @foreach($sliders as $slider)
      <tr>
          <td>{{ $slider->discount }}</td>
          <td>{{ $slider->category }}</td>
          <td>{{ $slider->link }}</td>
          <td></td>
          <td>
              <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-warning">Edit</a>
              <form action="{{ route('admin.sliders.delete', $slider->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
              </form>
          </td>
      </tr>
   @endforeach
   </tbody>
   </table>
   </section>