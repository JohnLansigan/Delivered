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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body onload='prompts()'>

    <div id='nav-container'>

        <a href = "index.php"><img id='logo' src="icon.png" alt="logo.png"></a>

        <div id='middle-nav'>

            <a href="index.php"><button id='home'>Home</button></a>
            <a href="about.php"><button id='about'>About</button></a>
            <a href="terms.php"><button id='terms'>Terms</button></a>
            <a href="create.php"><button id='create'>Create</button></a>
            <?php
                session_name("session_delivered");
                session_start();

                $servername = "127.0.0.1";
                $username = "root";
                $password = "";
                $dbname = "db_delivered";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
                    $loggedInUserID = $_SESSION["userID"];

                    $adminCheckSql = "SELECT adminID FROM tbl_admins WHERE userID = ?";
                    $adminCheckStmt = $conn->prepare($adminCheckSql);
                    $adminCheckStmt->bind_param("i", $loggedInUserID);
                    $adminCheckStmt->execute();
                    $adminCheckResult = $adminCheckStmt->get_result();

                    if ($adminCheckResult->num_rows > 0) {
                        echo "<a href='dashboard.php'><button id='dashboard'>Admin</button></a>";
                    }
                    $adminCheckStmt->close();
                }
            ?>

        </div>
        <?php
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

    <div id='create-container'>

        <div id='top-container'>

            <h1>New Message</h1>
            
            <a href="index.php"><button id='cancel' onmouseover="cancelOver(event)" onmouseout="cancelOut(event)">Cancel</button></a>

        </div>

        <hr>

        <div id='recipient-container'>

            <h2>To: </h2>

            <input id='recipient' type="text" placeholder='Recipient' maxlength=50 require>

        </div>

        <hr>

        <div id='reply-container'>

            <div id='reply'></div>

        </div>

        <div id='message-container' onclick='clearMessage(event)'>

            <div id='message' onkeyup="charactersLeft(event)" contenteditable="false"></div>
            <h2 id='delivered'>Delivered</h2>

        </div>

        <div id='bottom-container'>

            <div id='prompt'>
                <div id='characters'>0 characters</div>
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

        function clearMessage(event)
        {
            if(document.getElementById('message').innerHTML == 'Type message here')
                document.getElementById('message').innerHTML = '';
        }

        function charactersLeft(event)
        {
            document.getElementById('characters').innerHTML = document.getElementById('message').innerText.trim().length + " characters";
        }

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
                    setTimeout(replyPrompt, 70);
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
                setTimeout(messagePrompt, 70);
                }
                else
                {
                    document.getElementById("message").contentEditable = true;
                }
            }

            setTimeout(messagePrompt, 2500);

        }

        document.getElementById("send").addEventListener("click", function (e) {
    e.preventDefault();

    const message = document.getElementById("message").innerText.trim();
    const recipient = document.getElementById("recipient").value.trim();

    if (!message || message === "Type message here" || !recipient) 
    {
        Swal.fire
        ({
            title: 'Invalid Message!',
            text: 'Both the message and recipient are required',
            icon: 'error',
            confirmButtonText: 'Reload Page'
        })
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "submit_message.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) 
            {
                Swal.fire
                ({
                    title: "Delivered!",
                    icon: 'success',
                    showDenyButton: true,
                    confirmButtonText: "View Message",
                    denyButtonText: `Send Another`
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php";
                } else if (result.isDenied) {
                    window.location.href = "create.php";
                }
                });
            } 
            else 
            {
                Swal.fire
                ({
                    title: 'Failed to Deliver!',
                    icon: 'error',
                    confirmButtonText: 'Reload Page'
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        window.location.href = "create.php";
                    }
                });
            }
        }
    };

        const params = `message=${encodeURIComponent(message)}&recipient=${encodeURIComponent(recipient)}`;
        xhr.send(params);
    });

    </script>
    
</body>

</html>