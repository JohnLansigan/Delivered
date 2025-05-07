<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="messages.css">
    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
  
</head>

<body>
    <div id='nav-container'>
        <a href = "index.php"><img id='logo' src="icon.png" alt="logo.png"></a>
        <div id='middle-nav'>
            <a href="index.php"><button id='home'>Home</button></a>
            <a href="dashboard.php"><button id='dashboard'>Dashboard</button></a>
            <a href="users.php"><button id='users'>Users</button></a>
            <a href="messages.php"><button id='allMessages'>Messages</button></a>
            
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

    <div id='messages-container'>
        <h1>All Messages</h1>

        <?php
        // Fetch all messages and the username of the sender
        $sql = "SELECT m.messageID, m.message, m.dateCreated, u.username, m.recipient
                FROM tbl_messages m
                JOIN tbl_users u ON m.userID = u.userID
                ORDER BY m.dateCreated DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $bannedWords = array("fuck", "shit", "bitch", "cunt", "faggot");
            
            while ($row = $result->fetch_assoc()) {

                $message = htmlspecialchars($row["message"]);
                $warningCount = 0;

                 // Check for banned words
                foreach ($bannedWords as $word) {
                    $wordCount = substr_count(strtolower($message), strtolower($word)); // Case-insensitive count
                    $warningCount += $wordCount;
                }

                echo "<div class='message-container'>";
                echo "<div>";
                echo "<button class='expand' onclick='expandMessage(" . $row["messageID"] . ")'>Expand</button>";
                echo "<div class='admin'>" . htmlspecialchars($row["username"]) . "</div>";
                echo "<div class='admin'>" . htmlspecialchars($row["dateCreated"]) . "</div>";
                echo "<div class='".($warningCount > 0 ? "red" : "normal")."'>Warnings: " . $warningCount . "</div>";
                echo "<button class='delete' onclick='deleteMessage(" . $row["messageID"] . ")'>Delete</button>";
                echo "</div>";
                echo "<p id='message-" . $row["messageID"] . "' style='display: none'><strong>To: " . htmlspecialchars($row["recipient"]) . "</strong><br><br>" . htmlspecialchars($row["message"]) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<div>No messages found.</div>";
        }
        $conn->close();
        ?>

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
        function deleteMessage(messageID) {
            if (confirm("Are you sure you want to delete this message?")) {
                fetch('delete_message.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'messageID=' + messageID
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.success);
                        window.location.reload();
                    } else if (data.error) {
                        alert(data.error);
                    } else {
                        alert('Unknown error occurred.');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('Error deleting message. Please check the console.');
                });
            }
        }

        function expandMessage(buttonElement) 
        {
            var messageElement = document.getElementById("message-" + buttonElement); 
            if (messageElement) {
                if (messageElement.style.display === "none") {
                    messageElement.style.display = "block";
                } else {
                    messageElement.style.display = "none";
                }
            }
        }
    </script>

</body>
</html>
