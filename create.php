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

</head>

<body onload='prompts()'>

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

            <div id='reply'></div>

        </div>

        <div id='message-container'>

            <div id='message' contenteditable="true"></div>
            <h2 id='delivered'>Delivered</h2>

        </div>

        <div id='bottom-container'>

            <div id='prompt'>
                Send Message?
                <button id='send' onmouseover="sendOver(event)" onmouseout="sendOut(event)">↑</button>
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
            document.body.style.backgroundColor = "lightcoral";
        }

        function cancelOut(event) 
        {
            document.getElementById('delivered').innerHTML = "Delivered";
            document.getElementById('delivered').style.color = "#63636b";
            document.body.style.backgroundColor = "#8e8e93";
        }

        function sendOver(event) 
        {
            document.body.style.backgroundColor = "lightgreen";
            typeNextChar();
        }

        function sendOut(event) 
        {
            document.body.style.backgroundColor = "#8e8e93";
        }

        function prompts()
        {

            let reply = document.getElementById("reply");
            let replytText = "What's on your mind?";
            let x = 0;

            function replyPrompt() 
            {
                if (x < replytText.length) 
                {
                    reply.innerText += replytText.charAt(x);
                    x++;
                    setTimeout(replyPrompt, 70); // Adjust speed here (milliseconds)
                }
            }

            replyPrompt();

            let message = document.getElementById("message");
            let messageText = "Type message here";
            let i = 0;

            function messagePrompt() 
            {
                if (i < messageText.length) {
                    message.innerText += messageText.charAt(i);
                i++;
                setTimeout(messagePrompt, 70); // Adjust speed here (milliseconds)
                }
            }

            setTimeout(messagePrompt, 2500);

        }

    </script>
    
</body>

</html>