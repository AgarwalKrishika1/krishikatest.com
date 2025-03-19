$(document).ready(function() {
    // Predefined lists for usernames and referral codes
    const usernames = ["user1", "john_doe", "alice_smith"];
    const referralCodes = ["WELCOME1", "DISCOUNT50"];

    // Handle Marital Status Change
    $('#maritalStatus').on('change', function() {
        const maritalStatus = $(this).val();
        if (maritalStatus === "Married") {
            $('#spouseNameField').removeClass('hidden');
            $('#yearsSinceDivorceField').addClass('hidden');
        } else if (maritalStatus === "Divorced") {
            $('#spouseNameField').addClass('hidden');
            $('#yearsSinceDivorceField').removeClass('hidden');
        } else {
            $('#spouseNameField').addClass('hidden');
            $('#yearsSinceDivorceField').addClass('hidden');
        }
    });

    // Handle Employment Status Change
    $('#employmentStatus').on('change', function() {
        const employmentStatus = $(this).val();
        if (employmentStatus === "Employed" || employmentStatus === "Self-Employed") {
            $('#companyNameField').removeClass('hidden');
            $('#instituteNameField').addClass('hidden');
        } else if (employmentStatus === "Student") {
            $('#companyNameField').addClass('hidden');
            $('#instituteNameField').removeClass('hidden');
        } else {
            $('#companyNameField').addClass('hidden');
            $('#instituteNameField').addClass('hidden');
        }
    });

        // Object to store states based on country
    const countryStates = {
    "India": ["Maharashtra", "Delhi", "Karnataka"],
    "USA": ["California", "New York", "Texas", "Florida"],
    "UK": ["England", "Scotland", "Wales", "Northern Ireland"]
    };

    // Handle Country Change (For India, USA, UK - show State dropdown)
    $('#country').on('change', function() {
    const country = $(this).val();
    const stateDropdown = $('#state');

    // Clear the previous state options
    stateDropdown.empty();

    if (countryStates[country]) {
        // Show the state field
        $('#stateField').removeClass('hidden');
        
        // Add the default "Select State" option
        stateDropdown.append('<option value="">Select State</option>');

        // Add states corresponding to the selected country
        countryStates[country].forEach(function(state) {
            stateDropdown.append('<option value="' + state + '">' + state + '</option>');
        });
    } else {
        // Hide the state field if no states are needed (e.g., USA or UK)
        $('#stateField').addClass('hidden');
    }
    });

    // Calculate Age based on DOB
    $('#dob').on('change', function() {
        const dob = new Date($(this).val());
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const month = today.getMonth() - dob.getMonth();
        if (month < 0 || (month === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        $('#age').val(age);
    });

    // Check Username Availability
    $('#username').on('input', function() {
        const username = $(this).val();
        if (usernames.includes(username)) {
            $('#usernameError').removeClass('hidden');
        } else {
            $('#usernameError').addClass('hidden');
        }
    });

    // Validate Referral Code using AJAX
    $('#referralCode').on('input', function() {
        const referralCode = $(this).val();
        if (referralCodes.includes(referralCode)) {
            $('#referralCodeError').addClass('hidden');
        } else {
            $('#referralCodeError').removeClass('hidden');
        }
    });

    // Handle form submission
    $('#registrationForm').on('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        let isValid = true;

        // Validate Full Name (only letters and spaces)
        const fullName = $('#fullName').val();
        if (!/^[a-zA-Z\s]+$/.test(fullName)) {
            $('#fullNameError').removeClass('hidden');
            isValid = false;
        } else {
            $('#fullNameError').addClass('hidden');
        }

        // Validate Email Format
        const email = $('#email').val();
        if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
            $('#emailError').removeClass('hidden');
            isValid = false;
        } else {
            $('#emailError').addClass('hidden');
        }

        // Validate Password
        const password = $('#password').val();
        if (password.length < 6) {
            $('#passwordError').removeClass('hidden');
            isValid = false;
        } else {
            $('#passwordError').addClass('hidden');
        }

        // Validate Confirm Password
        const confirmPassword = $('#confirmPassword').val();
        if (confirmPassword !== password) {
            $('#confirmPasswordError').removeClass('hidden');
            isValid = false;
        } else {
            $('#confirmPasswordError').addClass('hidden');
        }

        // Validate Phone Number
        const phone = $('#phone').val();
        if (phone && !/^\d{10}$/.test(phone)) {
            $('#phoneError').removeClass('hidden');
            isValid = false;
        } else {
            $('#phoneError').addClass('hidden');
        }

        // Validate Age
        const age = $('#age').val();
        if (!age || age <= 0) {
            $('#ageError').removeClass('hidden');
            isValid = false;
        } else {
            $('#ageError').addClass('hidden');
        }


        // Validate Years Since Divorce (if applicable)
        const maritalStatus = $('#maritalStatus').val();
        if (maritalStatus === "Divorced") {
            const yearsSinceDivorce = $('#yearsSinceDivorce').val();
            if (yearsSinceDivorce && yearsSinceDivorce > age) {
                $('#yearsSinceDivorceError').removeClass('hidden');
                isValid = false;
            } else {
                $('#yearsSinceDivorceError').addClass('hidden');
            }
        }

        // Validate Gender
        const gender = $('input[name="gender"]:checked').val();
        if (!gender) {
            $('#genderError').removeClass('hidden');
            isValid = false;
        } else {
            $('#genderError').addClass('hidden');
        }

        // Validate Terms & Conditions
        const terms = $('#terms').is(':checked');
        if (!terms) {
            $('#termsError').removeClass('hidden');
            isValid = false;
        } else {
            $('#termsError').addClass('hidden');
        }

        // If everything is valid, show success message and submit the form
        if (isValid) {
            $('#successMessage').removeClass('hidden');
            // Normally, you would submit the form via AJAX or standard submission
            // this.submit();  // Uncomment if using regular submission
        }
    });
});
