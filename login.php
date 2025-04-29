<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered] - Login</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
</head>
<body>
    <div id='nav-container'>
        <a href = "index.php"><img id='logo' src="icon.png" alt="logo.png"></a>
        <div id='middle-nav'>
            <a href="index.php"><button id='home'>Home</button></a>
            <a href="about.php"><button id='about'>About</button></a>
            <a href="terms.php"><button id='terms'>Terms</button></a>
            <a href="create.php"><button id='create'>Create</button></a>
        </div>
    </div>

    <div id="form-container">
        <h1>Login</h1>
        <form action="login_process.php" method="post">
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
             <?php
                session_name("deliveredSession");
                session_start();
                if (isset($_SESSION['login_error'])) {
                    echo "<p style='color: red;'>" . $_SESSION['login_error'] . "</p>";
                    unset($_SESSION['login_error']); 
                }
            ?>
            <br>
            <input type="submit" value="Login">
        </form>
        <p>No account yet? <a href="signup.php">Create an account</a></p>
    </div>

    <div id='footer-container'>
        <div>
            <h2>[Delivered]</h2>
            <p>a passion project.</p>
            <br><br>
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
