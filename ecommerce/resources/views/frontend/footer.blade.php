<footer>
    <div class="container">
       <div class="row">
          <div class="col-md-4">
              <div class="full">
                 <div class="logo_footer">
                   <a href="#"><img width="210" src="/images/logo.png" alt="#" /></a>
                 </div>
                 <div class="information_f">
                   <p><strong>ADDRESS:</strong> 28 White tower, Street Name New York City, USA</p>
                   <p><strong>TELEPHONE:</strong> +91 987 654 3210</p>
                   <p><strong>EMAIL:</strong> yourmain@gmail.com</p>
                 </div>
              </div>
          </div>
          <div class="col-md-8">
             <div class="row">
             <div class="col-md-7">
                <div class="row">
                   <div class="col-md-6">
                <div class="widget_menu">
                   <h3>Menu</h3>
                   <ul>
                      <li><a href="/">Home</a></li>
                      <li><a href="/about">About</a></li>
                      <li><a href="/testimonial">Testimonial</a></li>
                      <li><a href="/blog">Blog</a></li>
                      <li><a href="/contact">Contact</a></li>
                   </ul>
                </div>
             </div>
             <div class="col-md-6">
                <div class="widget_menu">
                   <h3>Account</h3>
                   <ul>
                     
                      @if (Route::has('login'))
               
                      @auth
                      <li><a href="/">Account</a></li>
                      <li>
                      
                        <form id="logout-form" action="{{ route('custom.logout') }}" method="POST" class="d-inline">
                           @csrf
                           <button type="submit" style="background: none; border: none; color: black; padding: 0; outline: none; box-shadow: none;">
                              {{ __('Logout') }}
                          </button>
                          
                       </form>
                       
                     </li>
                      <li><a href="test-products">Shopping</a></li>

                       @else
                       <li><a href="/">Account</a></li>
                       <li><a href="/login">Login</a></li>
                      <li><a href="/register">Register</a></li>
                       <li><a href="test-products">Shopping</a></li>
                      @endauth
                     @endif
                   </ul>
                </div>
             </div>
                </div>
             </div>     
             </div>
          </div>
       </div>
    </div>
 </footer>
