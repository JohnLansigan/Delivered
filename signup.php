<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>

    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="signup.css">

    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
    <style>
        .error-message {
            color: red;
            font-size: 1em;
        }
    </style>

</head>

<body>

    <div id='nav-container'>

        <img id='logo' src="icon.png" alt="logo.png">

        <div id='middle-nav'>

            <a href="index.php"><button id='home'>Home</button></a>
            <a href="about.php"><button id='about'>About</button></a>
            <a href="terms.php"><button id='terms'>Terms</button></a>
            <a href="create.php"><button id='create'>Create</button></a>

        </div>

        <a href="login.php"><button id='login'><img src="profile.png" alt="profile.png">Login</button></a>

    </div>

    <form id='form-container' action="signup_process.php" method="post" onsubmit="return validateForm()">
        <h1>Sign up</h1>

        <div>
            <div>
                <label for="fname">First Name <strong>*</strong></label>
                <label for="lname">Last Name <strong>*</strong></label>
            </div>

            <div>
                <input id='fname' type="text" maxlength=50 name="fname" required onkeyup="validateFirstName()">
                <input id='lname' type="text" maxlength=50 name="lname" required onkeyup="validateLastName()">
            </div>
            
            <div>
                <p id="fname-error" class="error-message"></p>
                <p id="lname-error" class="error-message"></p>
            </div>

        </div>

        <div>
            <label for="address">Address <strong>*</strong></label>
            <input id='address' type="text" maxlength=250 name="address" required onkeyup="validateAddress()">
            <p id="address-error" class="error-message"></p>
        </div>

        <div>
            <label for="email">Email <strong>*</strong></label>
            <input id='email' type="email" maxlength=100 name="email" required onkeyup="validateEmail()">
            <p id="email-error" class="error-message"></p>
        </div>

        <div>
            <label for="username">Username <strong>*</strong></label>
            <input id='username' type="text" maxlength=50 name="username" required onkeyup="validateUsername()">
            <p id="username-error" class="error-message"></p>
        </div>

        <div>
            <label for="password">Password <strong>*</strong></label>
            <input id='password' type="password" maxlength=50 name="password" required onkeyup="validatePassword(); validateRePassword()">
            <div id="password-error" class="error-message"></div>
        </div>


        <div>
            <label for="repassword">Re-enter Password <strong>*</strong></label>
            <input id='repassword' type="password" maxlength=50 name="repassword" required onkeyup="validateRePassword()">
            <input type="checkbox" onclick="repassToggle()"  id="show">
            <label for="checkbox">Show Passwords</label>
            <div id="repassword-error" class="error-message"></div>
        </div>

        <hr>

        <div>
            <input type="checkbox" id="accept" name="accept" required onchange="validateAccept()">
            <label for="accept">By signing up you agree to our <a>Terms and conditions</a></label>
            <div id="accept-error" class="error-message"></div>
        </div>

        <button type="submit">Sign Up</button>

        <p>Already have an account? <a href="login.php">Log In</a></p>

    </form>

    <div id='footer-container'>

        <div>

            <h2>[Delivered]</h2>
            <p>a passion project.</p>
            <br>
            <br>
            <p>© 2025 [Delivered] All rights reserved</p>

        </div>

        <div>

            <h3>Links</h3>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="terms.php">Terms</a>
            <a href="create.php">Create</a>

        </div>

        <div>

            <h3>The Project</h3>
            <p>News</p>
            <p>Partners</p>
            <p>Contact Us</p>
            <p>Contact Us</p>

        </div>

        <div>

            <h3>Services</h3>
            <p>Feedback</p>
            <p>Report Bugs</p>
            <p>Download</p>
            <p>Get Help</p>

        </div>

        <div>

            <h3>Socials</h3>
            <p>Instagram</p>
            <p>Facebook</p>
            <p>Twitter</p>
            <p>TikTok</p>

        </div>

    </div>

    <script>
        function validateFirstName() {
            const fnameInput = document.getElementById('fname');
            const fnameError = document.getElementById('fname-error');
            if (fnameInput.value.trim() === '') {
                fnameError.textContent = 'First name is required.';
                return false;
            } else {
                fnameError.textContent = '';
                return true;
            }
        }

        function validateLastName() {
            const lnameInput = document.getElementById('lname');
            const lnameError = document.getElementById('lname-error');
            if (lnameInput.value.trim() === '') {
                lnameError.textContent = 'Last name is required.';
                return false;
            } else {
                lnameError.textContent = '';
                return true;
            }
        }

        function validateAddress() {
            const addressInput = document.getElementById('address');
            const addressError = document.getElementById('address-error');
            if (addressInput.value.trim() === '') {
                addressError.textContent = 'Address is required.';
                return false;
            } else {
                addressError.textContent = '';
                return true;
            }
        }

        function validateEmail() {
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('email-error');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailInput.value.trim() === '') {
                emailError.textContent = 'Email is required.';
                return false;
            } else if (!emailRegex.test(emailInput.value)) {
                emailError.textContent = 'Invalid email format.';
                return false;
            } else {
                emailError.textContent = '';
                return true;
            }
        }

        function validateUsername() {
            const usernameInput = document.getElementById('username');
            const usernameError = document.getElementById('username-error');
            if (usernameInput.value.trim() === '') {
                usernameError.textContent = 'Username is required.';
                return false;
            } else if (usernameInput.value.length < 3) {
                usernameError.textContent = 'Username must be at least 3 characters long.';
                return false;
            } else {
                usernameError.textContent = '';
                return true;
            }
        }

        function validatePassword() {
            const passwordInput = document.getElementById('password');
            const passwordError = document.getElementById('password-error');
            const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[0-9]).{8,}$/;
            if (passwordInput.value.trim() === '') {
                passwordError.textContent = 'Password is required.';
                return false;
            } else if (!passwordRegex.test(passwordInput.value)) {
                passwordError.textContent = 'Password must be at least 8 characters and include one capital letter, one special character, and one number.';
                return false;
            } else {
                passwordError.textContent = '';
                return true;
            }
        }

        function validateRePassword() {
            const passwordInput = document.getElementById('password');
            const repasswordInput = document.getElementById('repassword');
            const repasswordError = document.getElementById('repassword-error');
            if (repasswordInput.value.trim() === '') {
                repasswordError.textContent = 'Please re-enter your password.';
                return false;
            } else if (passwordInput.value !== repasswordInput.value) {
                repasswordError.textContent = 'Passwords do not match.';
                return false;
            } else {
                repasswordError.textContent = '';
                return true;
            }
        }

        function validateAccept() {
            const acceptCheckbox = document.getElementById('accept');
            const acceptError = document.getElementById('accept-error');
            if (!acceptCheckbox.checked) {
                acceptError.textContent = 'You must accept the terms and conditions.';
                return false;
            } else {
                acceptError.textContent = '';
                return true;
            }
        }


        function validateForm() {
            const isFirstNameValid = validateFirstName();
            const isLastNameValid = validateLastName();
            const isAddressValid = validateAddress();
            const isEmailValid = validateEmail();
            const isUsernameValid = validateUsername();
            const isPasswordValid = validatePassword();
            const isRePasswordValid = validateRePassword();
            const isAcceptValid = validateAccept();

            return isFirstNameValid && isLastNameValid && isAddressValid && isEmailValid && isUsernameValid && isPasswordValid && isRePasswordValid && isAcceptValid;
        }

        function repassToggle() {
            var x = document.getElementById("password");
            var y = document.getElementById("repassword");
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
            }

    </script>

</body>

</html>