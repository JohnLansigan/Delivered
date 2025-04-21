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

    <form id='form-container' action="process_login.php" method="post">
        <h1>Log In</h1>

        <div>
            <label for="useremail">Email or Username</label>
            <input id='useremail' type="text" maxlength=50 name="username">
        </div>

        <div>
            <label for="password">Password</label>
            <input id='password' type="password" maxlength=50 name="password">
        </div>

        <button type="submit">Login</button>

        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>

    </form>

</body>

</html>