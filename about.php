<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>

    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="about.css">

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
    </div>
    


    <div id="desc">
        <p>
            <h1><center>LET YOUR MESSAGE <br>
            BE DELIVERED.</center></h1><br>

            <div class = "slide">
                <div class = "slide-wrapper">
                    <center><span><img src = "placeholder.jpg" alt = "slide 1" height = "300px" width = "300px">
                    <img src = "placeholder.jpg" alt = "slide 2" height = "300px" width = "300px">
                    <img src = "placeholder.jpg" alt = "slide 3" height = "300px" width = "300px"></span></center>
                </div>
                <br>
            </div>
            
            <h3>A messaging website addressed to those we can’t, or choose not to, communicate directly. Here, you can anonymously post a message dedicated to a person and be part of our growing community by browsing through the submissions and discover the common threads that weave through our experiences of love, loss, hope, and the myriad of feelings that often remain trapped within. Who knows? The messages you are reading could be about you!</h3>
        </p>
    </div><br><br>

    <div id="panel1">
        <div id="aboutUsPic">
            <img id='ourPic' src="placeholder.jpg" alt="placeholder.jpg" height = "100%" width = "300px">
        </div>
        <div id="aboutUsText">
            <center>
                <div id="aboutUsTitle">
                    <Center><h2>About Us</h2></Center>
                </div>

            <h3>Hello! We are a group of students from the UST College of Information and Computing Sciences. We created this project in partial fulfillment of our requirements for our school. We also wanted to create a freedom wall-like website where users can freely express themselves or lift their feelings by anonymously posting a message to a person they can’t directly send the message to.</h3>
            </center>
        </div>
    </div>
    <br>
    <br>
    <div id="panel1">
        <div id="aboutUsText">
            <center>
                <div id="aboutUsTitle">
                    <Center><h2>About Us</h2></Center>
                </div>

            <h3>We hope that through this platform, users will find comfort in knowing they are not alone in their thoughts and emotions. By allowing anonymous posts, we aim to encourage honesty and vulnerability without fear of judgment or exposure. Each message shared on our site reflects real feelings and experiences, creating a space of empathy and understanding. We believe that even in silence, every voice deserves to be heard and every emotion acknowledged.</h3>
            </center>
        </div>
        <div id="aboutUsPic2">
            <img id='ourPic' src="placeholder.jpg" alt="placeholder.jpg" height = "100%" width = "300px">
        </div>
    </div>
    <br>
    <br>
    <center>
    <div id="joinPanel">
        <div id="joinPanelLogo">
            <img id='ourPic' src="placeholder.jpg" alt="placeholder.jpg" height = "120px" width = "120px">
        </div>
        <h1>Join us in a space where anonymous words<br>are delivered with meaning.</h1>
        <center>
            <a href = "signup.php"><button class = "signupButton">To signup</button></a>
        </center>
    </div>
    </center>
    
    <br><br><br><br><br>
    









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