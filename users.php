<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="users.css">
    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
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

    <div id='users-container'>

        <h1>All Users</h1>
        
        <?php
            // Fetch all users, their admin status, and the count of their messages
            $sql = "SELECT u.userID, u.username, a.adminID, COUNT(m.messageID) AS messageCount, u.address, u.email, u.fname, u.lname, u.dateCreated, u.password, a.dateCreated AS adminCreated
                    FROM tbl_users u
                    LEFT JOIN tbl_admins a ON u.userID = a.userID
                    LEFT JOIN tbl_messages m ON u.userID = m.userID
                    GROUP BY u.userID
                    ORDER BY u.username ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div>";
                    echo "<div>";
                    echo "<button class='details' onclick='userDetails(" . $row["userID"] . ")'>Details</button>";
                    echo "<div class='user'>" . htmlspecialchars($row["username"]) . "</div>"; 
                    echo "<div class='count'>" . $row["messageCount"] . " messages</div>";
                    if (is_null($row["adminID"])) {
                        echo "<button class='delete' onclick='deleteUser(" . $row["userID"] . ")'>Delete</button>";
                    } else {
                        echo "<button class='admin'>Admin</button>"; // Or any other indication
                    }
                    echo "</div>";
                    echo "<div id='user-" . $row["userID"] . "' style='display: none'>";
                        echo "<div>Created On: " . $row["dateCreated"] . "</div>";
                        if (is_null($row["adminID"])) {
                        } else {
                            echo "<div>Admin Since: " . $row["adminCreated"] . "</div>";
                        }
                        echo "<div>User ID: " . $row["userID"] . "</div>";
                        if (is_null($row["adminID"])) {
                        } else {
                            echo "<div>Admin ID: " . $row["adminID"] . "</div>";
                        }
                        echo "<div>First Name: " . $row["fname"] . "</div>";
                        echo "<div>Last Name: " . $row["lname"] . "</div>";
                        echo "<div>Username: " . $row["username"] . "</div>";
                        echo "<div>Email: " . $row["email"] . "</div>";
                        echo "<div>Address: " . $row["address"] . "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<div>No users found.</div>";
            }
            $conn->close();
        ?>

    </div>

    <script>
        function deleteUser(userID) {
            Swal.fire({
                title: 'Delete User?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('delete_user.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'userID=' + userID
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                data.success,
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else if (data.error) {
                            Swal.fire(
                                'Error!',
                                data.error,
                                'error'
                            );
                        } else {
                            Swal.fire(
                                'Oops!',
                                'Unknown error occurred.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        Swal.fire(
                            'Error!',
                            'Error deleting user. Please check the console.',
                            'error'
                        );
                    });
                }
            })
        }

        function userDetails(buttonElement) 
        {
            var userElement = document.getElementById("user-" + buttonElement); 
            if (userElement) {
                if (userElement.style.display === "none") {
                    userElement.style.display = "block";
                } else {
                    userElement.style.display = "none";
                }
            }
        }
    </script>

</body>
</html>
