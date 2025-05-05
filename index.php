<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="index.css">
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
        session_name("deliveredSession");
        session_start();
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
            echo "<div class='dropdown'>";
            echo "  <a href='account.php'><button class='dropdown-button'><img src='profile.png' alt='profile.png'><span>" . htmlspecialchars($_SESSION["username"]) . "</span></button></a>";
            echo "  <div class='dropdown-content'>";
            echo "    <a href='logout.php'>Logout</a>";
            echo "  </div>";
            echo "</div>";
        } else {
            echo "<a href='login.php'><button id='login'><img src='profile.png' alt='profile.png'>Login</button></a>";
        }
        ?>
    </div>

    <div id='intro-container'>

        <h1>Welcome to<br>[DELIVERED]</h1>

        <h2>Voice out the thoughts you could never get out.<br>One message at a time.</h2>

        <a href="create.php"><button><h2>Deliver a Message</h2></button></a>

        <img id='woman' src="woman.png" alt="woman.png">

        <div id='works'><h1>This is how Delivered works</h1></div>

        <div id='steps'>

            <div id='numbers'><h2>1</h2></div>
            <h2>Sign up and log in<br>to your account.</h2>

            <div id='numbers'><h2>2</h2></div>
            <h2>Create your message<br>to be delivered.</h2>

            <div id='numbers'><h2>3</h2></div>
            <h2>Submit the note and<br>wait for delivery.</h2>

        </div>

        <br>

    </div>

    <div id='messages-container'>

        <div id='search-container'>

            <input type="text" name="search" id="search" placeholder='Look for recipient'>

            <button>Search</button>

        </div>

        <h1>What people are saying</h1>

    </div>

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
