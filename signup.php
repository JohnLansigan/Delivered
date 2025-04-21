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

</head>

<body>

    <div id='nav-container'>

        <div id='left-nav'>

            <img id='logo' src="icon.png" alt="logo.png">

            <a href="index.php"><button id='home'>Home</button></a>
            <a href="about.php"><button id='about'>About</button></a>
            <a href="terms.php"><button id='terms'>Terms</button></a>
            <a href="create.php"><button id='create'>Create</button></a>

        </div>

        <div id='right-nav'>

            <a href="signup.php"><img src="profile.png" id='profile' alt="profile.png"></a>

        </div>

    </div>

    <form id='form-container' action="signup_process.php" method="post">
        <h1>Sign up</h1>

        <div>
            <div>
                <label for="fname">First Name <strong>*</strong></label>
                <label for="lname">Last Name <strong>*</strong></label>
            </div>

            <div>
                <input id='fname' type="text" maxlength=50 name="fname">
                <input id='lname' type="text" maxlength=50 name="lname">
            </div>
        </div>

        <div>
            <label for="address">Address <strong>*</strong></label>
            <input id='address' type="text" maxlength=250 name="address">
        </div>

        <div>
            <label for="email">Email <strong>*</strong></label>
            <input id='email' type="text" maxlength=100 name="email">
        </div>

        <div>
            <label for="username">Username <strong>*</strong></label>
            <input id='username' type="text" maxlength=50 name="username">
        </div>

        <div>
            <label for="password">Password <strong>*</strong></label>
            <input id='password' type="password" maxlength=50 name="password">
        </div>

        <div>
            <label for="repassword">Re-enter Password <strong>*</strong></label>
            <input id='repassword' type="password" maxlength=50 name="repassword">
        </div>

        <div>
            <input type="checkbox" id="accept" name="accept">
            <label for="accept">By signing up you agree to our <a href="terms.php">Terms and conditions</a></label>
        </div>

        <button type="submit">Sign Up</button>

        <p>Already have an account? <a href="login.php">Log In</a></p>

    </form>

</body>

</html>