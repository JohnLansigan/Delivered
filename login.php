<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>

    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="login.css">

    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">

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

    <form id='form-container' action="login_process.php" method="post">
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

</body>

</html>