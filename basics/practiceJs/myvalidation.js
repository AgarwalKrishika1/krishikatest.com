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

        // empty previous state 
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

    // username availability
    $('#username').on('input', function() {
        const username = $(this).val();
        if (usernames.includes(username)) {
            $('#usernameError').removeClass('hidden');
        } else {
            $('#usernameError').addClass('hidden');
        }
    });





    //form submission errors
    $('#registrationForm').on('submit', function(event) {
        event.preventDefault(); //not submit

        let isValid = true;

        // fullname (only letters and spaces)
        const fullName = $('#fullName').val();
        if (!/^[a-zA-Z\s]+$/.test(fullName)) {
            $('#fullNameError').removeClass('hidden');
            isValid = false;
        } else {
            $('#fullNameError').addClass('hidden');
        }

        // email format
        const email = $('#email').val();
        if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
            $('#emailError').removeClass('hidden');
            isValid = false;
        } else {
            $('#emailError').addClass('hidden');
        }

        // passwrod
        const password = $('#password').val();
        if (password.length < 6) {
            $('#passwordError').removeClass('hidden');
            isValid = false;
        } else {
            $('#passwordError').addClass('hidden');
        }

        // confirm password
        const confirmPassword = $('#confirmPassword').val();
        if (confirmPassword !== password) {
            $('#confirmPasswordError').removeClass('hidden');
            isValid = false;
        } else {
            $('#confirmPasswordError').addClass('hidden');
        }

        // phone number
        const phone = $('#phone').val();
        if (phone && !/^\d{10}$/.test(phone)) {
            $('#phoneError').removeClass('hidden');
            isValid = false;
        } else {
            $('#phoneError').addClass('hidden');
        }

        //age
        const age = $('#age').val();
        if (!age || age <= 0) {
            $('#ageError').removeClass('hidden');
            isValid = false;
        } else {
            $('#ageError').addClass('hidden');
        }


        // gender
        const gender = $('input[name="gender"]:checked').val();
        if (!gender) {
            $('#genderError').removeClass('hidden');
            isValid = false;
        } else {
            $('#genderError').addClass('hidden');
        }

        //marital status dropdown
        const maritalStatus = $('#maritalStatus').val();
        if (!maritalStatus) {
            $('#maritalStatusError').removeClass('hidden');
            isValid = false;
        } else {
            $('#maritalStatusError').addClass('hidden');
        }

        //divorce years (if applicable)
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

        // Spouse name  (if applicable)
        if (maritalStatusValue === "Married") {
            const spouseName = $('#spouseName').val();
            if (!spouseName) {
                $('#spouseNameError').removeClass('hidden');
                isValid = false;
            } else {
                $('#spouseNameError').addClass('hidden');
            }
 
        }

        // Employment Status (required)
        const employmentStatus = $('#employmentStatus').val();
        if (!employmentStatus) {
            $('#employmentStatusError').removeClass('hidden');
            isValid = false;
        } else {
            $('#employmentStatusError').addClass('hidden');
        }
        

        //Company Name (if applicable)
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

        //institute Name  (if applicable)
        if (employmentStatusValue === "Student") {
            const instituteName = $('#instituteName').val();
            if (!instituteName) {
                $('#instituteNameError').removeClass('hidden');
                isValid = false;
            } else {
                $('#instituteNameError').addClass('hidden');
            }
 
        }

        //Country (required)
        const country = $('#country').val();
        if (!country) {
            $('#countryError').removeClass('hidden');
            isValid = false;
        } else {
            $('#countryError').addClass('hidden');
        }

        // State (as country selected)
        const state = $('#state').val();
        if (country && !state) {
            $('#stateError').removeClass('hidden');
            isValid = false;
        } else {
            $('#stateError').addClass('hidden');
        }


        // City (as country and state selected)
        const city = $('#city').val();
        if (country && state && !city) {
            $('#cityError').removeClass('hidden');
            isValid = false;
        } else {
            $('#cityError').addClass('hidden');
        }


        // Username
        const username = $('#username').val();
        if (!username) {
            $('#usernameValueError').removeClass('hidden');
            isValid = false;
        } else {
            $('#usernameValueError').addClass('hidden');
        }

        //Referral Code
        const referralCode = $('#referralCode').val();
        if (referralCode && !validReferralCodes.includes(referralCode)) {
            $('#referralCodeError').removeClass('hidden');
            isValid = false;
        } else {
            $('#referralCodeError').addClass('hidden');
        }

        //Terms & Conditions
        const terms = $('#terms').is(':checked');
        if (!terms) {
            $('#termsError').removeClass('hidden');
            isValid = false;
        } else {
            $('#termsError').addClass('hidden');
        }

        // no error submit 
        if (isValid) {
            var formData = $(this).serialize();
    
            $.ajax({
                url: 'submit.php', 
                type: 'POST',
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        $('#errorMessage').addClass('hidden');
                        $('#successMessage').removeClass('hidden');
                    } else {
                        $('#successMessage').addClass('hidden');
                        $('#errorMessage').removeClass('hidden');
                        $('#errorMessage').text(response.message);  
                    }
                },
                error: function() {
                    $('#errorMessage').removeClass('hidden');
                }
            });
        }
    });
});
