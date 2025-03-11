
<!DOCTYPE html>
<html>
   <head>
      @include('frontend.css')

      <!-- jQery -->
      <script src="/home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="/home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="/home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="/home/js/custom.js"></script>
   </head>
   <body class="sub_page">
      <div class="hero_area">
         <!-- header section strats -->
         @include('frontend.header');
         <!-- end header section -->
      </div>
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Contact us</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- why section -->
      <section class="why_section layout_padding">
         

         <div class="container">
            <div class="row">
               <div class="col-lg-8 offset-lg-2">
                  <div class="full">
                     <!-- Error message section -->
                           <div id="errorMessages" class="alert alert-danger"  style="display: none;" >
                              <ul id="errorList"></ul>
                        </div>
                     <form id="contactForm" action="{{route('products.index')}}"  novalidate >
                        <fieldset>
                           <input type="text" id="name" placeholder="Enter your full name" name="name" required />
                           <input type="email" id="email" placeholder="Enter your email address" name="email" required />
                           <input type="text" id="subject" placeholder="Enter subject" name="subject" required />
                           <textarea id="message" placeholder="Enter your message" required></textarea>
                           <input type="submit" value="Submit" />
                        </fieldset>
                     </form>
                     
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end why section -->
      <!-- arrival section -->
     @include('frontend.arrival')
      <!-- end arrival section -->
      <!-- footer section -->
      @include('frontend.footer')
      <!-- footer section -->

      <script>
         $(document).ready(function() {
             // When form is submitted
             $("#contactForm").on("submit", function(event) {
                 let isValid = true;
                 let errorMessages = [];

                 // Clear previous error messages
                 $("#errorList").empty(); // Clear the list of errors
                 $("#errorMessages").hide(); // Hide error section initially

                 // Validate Name (not empty)
                 if ($("#name").val().trim() === "") {
                     errorMessages.push("Please enter your name.");
                     isValid = false;
                 }

                 // Validate Email (not empty and valid email format)
                 let email = $("#email").val().trim();
                 if (email === "") {
                     errorMessages.push("Please enter your email.");
                     isValid = false;
                 } else if (!validateEmail(email)) {
                     errorMessages.push("Please enter a valid email address.");
                     isValid = false;
                 }

                 // Validate Subject (not empty)
                 if ($("#subject").val().trim() === "") {
                     errorMessages.push("Please enter the subject.");
                     isValid = false;
                 }

                 // Validate Message (not empty)
                 if ($("#message").val().trim() === "") {
                     errorMessages.push("Please enter your message.");
                     isValid = false;
                 }

                 // If there are errors, show them and prevent form submission
                 if (!isValid) {
                     event.preventDefault();
                     
                     // Display error messages
                     errorMessages.forEach(function(message) {
                         $("#errorList").append("<li>" + message + "</li>");
                     });
                     $("#errorMessages").show(); // Show the error div
                 }
             });

             // Function to validate email format
             function validateEmail(email) {
                 const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                 return emailRegex.test(email);
             }
         });
      </script>
   
   </body>
</html>
