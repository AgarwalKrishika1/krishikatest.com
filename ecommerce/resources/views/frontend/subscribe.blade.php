
@if (Auth::check() && auth()->user()->email_verified_at)

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

                        <!-- Error message section -->
                        <div id="errorMessages" class="alert alert-danger" style="display: none;">
                            <ul id="errorList"></ul>
                        </div>

                        <!-- Success message section -->
                        <div id="successMessages" class="alert alert-success" style="display: none;">
                            <p> Please <a href="/register">register with us</a> to continue.</p>
                        </div>

                        <form id="subscription" action="{{ route('register') }}" method="POST" novalidate>
                            @csrf
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>

                            <!-- Display error message for email -->
                            @error('email')
                                <div class="error-message" style="color: red;">
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror

                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // When form is submitted
        $("#subscription").on("submit", function(event) {
            let isValid = true;
            let errorMessages = [];

            // Clear previous error messages
            $("#errorList").empty(); // Clear the list of errors
            $("#errorMessages").hide(); // Hide error section initially
            $("#successMessages").hide(); // Hide success section initially

            // Validate Email (not empty and valid email format)
            let email = $("#email").val().trim();
            if (email === "") {
                errorMessages.push("Please enter your email.");
                isValid = false;
            } else if (!validateEmail(email)) {
                errorMessages.push("Please enter a valid email address.");
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
            } else {
                // If there are no errors, show the success message
                $("#successMessages").show(); // Show the success div
                event.preventDefault(); // Prevent form submission for demo purposes (in real use, you would submit the form)
            }
        });

        // Function to validate email format
        function validateEmail(email) {
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return emailRegex.test(email);
        }
    });
</script>
