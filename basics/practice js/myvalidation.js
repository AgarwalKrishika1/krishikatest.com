$(document).ready(function() {
    // predefined username, referral code
    const usernames = ["user1", "user2", "user3"];
    const validReferralCodes = ["WELCOME1", "DISCOUNT50"];

    // marital status change 
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

    // employment status change
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

    // state and country
    const countryStates = {
        "India": ["Maharashtra", "Delhi", "Karnataka"],
        "USA": ["California", "New York", "Texas", "Florida"],
        "UK": ["England", "Scotland", "Wales", "Northern Ireland"]
    };

    // country change 
    $('#country').on('change', function() {
        const country = $(this).val();
        const stateDropdown = $('#state');

        // empty previous status 
        stateDropdown.empty();

        if (countryStates[country]) {
            // show state field
            $('#stateField').removeClass('hidden');
            
            // default state
            stateDropdown.append('<option value="">Select State</option>');

            // state as per country
            countryStates[country].forEach(function(state) {
                stateDropdown.append('<option value="' + state + '">' + state + '</option>');
            });
        } else {
            // hide state field
            $('#stateField').addClass('hidden');
        }
    });

    // age from dob
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

        // Validate Marital Status (required)
        const maritalStatus = $('#maritalStatus').val();
        if (!maritalStatus) {
            $('#maritalStatusError').removeClass('hidden');
            isValid = false;
        } else {
            $('#maritalStatusError').addClass('hidden');
        }

        // Validate Employment Status (required)
        const employmentStatus = $('#employmentStatus').val();
        if (!employmentStatus) {
            $('#employmentStatusError').removeClass('hidden');
            isValid = false;
        } else {
            $('#employmentStatusError').addClass('hidden');
        }

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
        const maritalStatusValue = $('#maritalStatus').val();
        if (maritalStatusValue === "Divorced") {
            const yearsSinceDivorce = $('#yearsSinceDivorce').val();
            if (yearsSinceDivorce && yearsSinceDivorce > age || !yearsSinceDivorce) {
                $('#yearsSinceDivorceError').removeClass('hidden');
                isValid = false;
            } else {
                $('#yearsSinceDivorceError').addClass('hidden');
            }
        }

        //Validate Spouse name  (if applicable)
        if (maritalStatusValue === "Married") {
            const spouseName = $('#spouseName').val();
            if (!spouseName) {
                $('#spouseNameError').removeClass('hidden');
                isValid = false;
            } else {
                $('#spouseNameError').addClass('hidden');
            }
 
        }


        // Validate Company Name (if applicable)
        const employmentStatusValue = $('#employmentStatus').val();
        if (employmentStatusValue === "Employed" || employmentStatusValue === "Self-Employed") {
            const companyName = $('#companyName').val();
            if (!companyName) {
                $('#companyNameError').removeClass('hidden');
                isValid = false;
            } else {
                $('#companyNameError').addClass('hidden');
            }
        }

        //Validate institute Name  (if applicable)
        if (employmentStatusValue === "Student") {
            const instituteName = $('#instituteName').val();
            if (!instituteName) {
                $('#instituteNameError').removeClass('hidden');
                isValid = false;
            } else {
                $('#instituteNameError').addClass('hidden');
            }
 
        }

        // Validate Country (required)
        const country = $('#country').val();
        if (!country) {
            $('#countryError').removeClass('hidden');
            isValid = false;
        } else {
            $('#countryError').addClass('hidden');
        }

        // Validate State (if country is selected, state is also required)
        const state = $('#state').val();
        if (country && !state) {
            $('#stateError').removeClass('hidden');
            isValid = false;
        } else {
            $('#stateError').addClass('hidden');
        }


        // Validate City (required)
        const city = $('#city').val();
        if (country && state && !city) {
            $('#cityError').removeClass('hidden');
            isValid = false;
        } else {
            $('#cityError').addClass('hidden');
        }


        // Validate Gender
        const gender = $('input[name="gender"]:checked').val();
        if (!gender) {
            $('#genderError').removeClass('hidden');
            isValid = false;
        } else {
            $('#genderError').addClass('hidden');
        }

        // Validate Username
        const username = $('#username').val();
        if (!username) {
            $('#usernameValueError').removeClass('hidden');
            isValid = false;
        } else {
            $('#usernameValueError').addClass('hidden');
        }

        // Validate Referral Code
        const referralCode = $('#referralCode').val();
        if (referralCode && !validReferralCodes.includes(referralCode)) {
            $('#referralCodeError').removeClass('hidden');
            isValid = false;
        } else {
            $('#referralCodeError').addClass('hidden');
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
