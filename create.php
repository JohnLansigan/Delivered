<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>

    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="create.css">

    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0; 
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-button {
            background-color: black;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            display: flex; 
            align-items: center;
            gap: 5px; 
            height: 100%;
        }

        .dropdown-button:hover {
            background-color: #2791f5;
        }

        .dropdown-button img {
    height: 2.3vh; 
    width: auto;  
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
        <?php
        session_name("deliveredSession");
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

    <div id='create-container'>

        <div id='top-container'>

            <h1>New Message</h1>
            
            <button id='cancel' onmouseover="cancelOver(event)" onmouseout="cancelOut(event)">Cancel</button>

        </div>

        <hr>

        <div id='recipient-container'>

            <h2>To: </h2>

            <input id='recipient' type="text" placeholder='Recipient'>

        </div>

        <hr>

        <div id='reply-container'>

            <div>What's on your mind?</div>

        </div>

        <div id='message-container'>

            <div id='message' contenteditable="true">Type message here</div>
            <h2 id='delivered'>Delivered</h2>

        </div>

        <div id='bottom-container'>

            <div id='prompt'>
                Send Message?
                <button id='send'>↑</button>
            </div>     

        </div>

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

    <script>

        function cancelOver(event) 
        {
            document.getElementById('delivered').innerHTML = "Not Delivered";
            document.getElementById('delivered').style.color = "red";
        }

        function cancelOut(event) 
        {
            document.getElementById('delivered').innerHTML = "Delivered";
            document.getElementById('delivered').style.color = "#63636b";
        }

    </script>
    
</body>

</html>