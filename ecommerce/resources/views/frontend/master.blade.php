<!DOCTYPE html>
<html>
   <head>
     @include('frontend.css')
   </head>
   <body>

            @if(session('error'))
         <div class="alert alert-danger">
            {{ session('error') }}
         </div>

         <!-- Register Button -->
         <form action="{{ route('register') }}" method="get">
            <button type="submit" class="btn btn-primary">Register</button>
         </form>
      @endif


      @if(session('error_verify'))
      <div class="alert alert-danger">
         {{ session('error_verify') }}
      </div>
   @endif

      <div class="hero_area">
         <!-- header section strats -->
         @include('frontend.header');
         <!-- end header section -->

         <!-- slider section -->
         @include('frontend.slider');
         <!-- end slider section -->
      </div>

      <!-- why section -->
      @include('frontend.why');
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('frontend.arrival');
      <!-- end arrival section -->
      
      {{-- <!-- product section -->
     @extends('frontend.product');
     
      <!-- end product section --> --}}

      <!-- subscribe section -->
     @include('frontend.subscribe');
      <!-- end subscribe section -->

      <!-- client section -->
      @include('frontend.client');
      <!-- end client section -->

      <!-- footer start -->
     @include('frontend.footer');
      <!-- footer end -->
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
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