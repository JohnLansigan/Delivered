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
        <?php
        session_name("session_delivered");
        session_start();
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
            echo "<div class='dropdown'>";
            echo "  <button class='dropdown-button'><img src='profile.png' alt='profile.png'><span>" . htmlspecialchars($_SESSION["username"]) . "</span></button>";
            echo "  <div class='dropdown-content'>";
            echo "    <a href='logout.php'>Logout</a>";
            echo "  </div>";
            echo "</div>";
        } else {
            echo "<a href='login.php'><button id='login'><img src='profile.png' alt='profile.png'>Login</button></a>";
        }
        ?>
    </div>

    <div id="form-container">
        <h1>Login</h1>
        <br>
        <form action="login_process.php" method="post">
            <input type="text" name="username" placeholder="Username" required> 
            <input type="password" name="password" id = "passInput" placeholder="Password" required>
            <input type="checkbox" onclick="passToggle()">Show Password
            <input type="submit" value="Login" id='button'>
            <p>No account yet? <a href="signup.php">Create an account</a></p>
            <?php
            if (isset($_SESSION['login_error'])) 
            {
                echo "<p style='color: red;'>" . $_SESSION['login_error'] . "</p>";
                unset($_SESSION['login_error']);    
            }
        ?>
        </form>

        <script>
        function passToggle() {
            var x = document.getElementById("passInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }
            </script>
        
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
