<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="account.css">
    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
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

    <div id='info-container'>

        <h1>Account Information</h1>

        <?php
            if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
                $user_id = $_SESSION["userID"];
                
                $sql = "SELECT u.userID, u.fname, u.lname, u.address, u.email, u.username, u.dateCreated as uCreated, u.dateUpdated, a.adminID, a.dateCreated as aCreated 
                FROM tbl_users u
                LEFT JOIN tbl_admins a ON u.userID = a.userID
                WHERE u.userID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<div class='attribute'>User ID</div><div class='info'>" . $row["userID"] . "</div><button class='delete' onclick='deleteUser(" . $row["userID"] . ")'>Delete</button>";
                    if ($row["adminID"] != null) {
                        echo "<div class='attribute'>Admin ID</div><div class='info'>" . $row["adminID"] . "</div>";
                    }
                    echo "<div class='attribute'>Date Created</div><div class='info'>" . $row["uCreated"] . "</div>";
                    if ($row["adminID"] != null) {
                        echo "<div class='attribute'>Admin ID</div><div class='info'>" . $row["aCreated"] . "</div>";
                    }
                    echo "<div class='attribute'>Last Updated</div><div class='info'>" . $row["dateUpdated"] . "</div>";
                    echo "<div class='attribute'>Email</div><div class='info'>" . $row["email"] . "</div>";
                    echo "<div class='attribute'>Username</div><div class='info'>" . $row["username"] . "</div><button onclick='editAttribute(this)'>Edit</button>";
                    echo "<div class='attribute'>First Name</div><div class='info'>" . $row["fname"] . "</div><button onclick='editAttribute(this)'>Edit</button>";
                    echo "<div class='attribute'>Last Name</div><div class='info'>" . $row["lname"] . "</div><button onclick='editAttribute(this)'>Edit</button>";
                    echo "<div class='attribute'>Address</div><div class='info'>" . $row["address"] . "</div><button onclick='editAttribute(this)'>Edit</button>";
                } else {
                    echo "<div class='user-info'>No user information found.</div>";
                }
                $stmt->close();
            } else {
                echo "<div class='user-info'>Please log in to view your account information.</div>";
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
        function editAttribute(element) {
            // Get the parent div of the button, which contains the attribute and info
            const infoDiv = element.previousElementSibling;
            const attributeDiv = infoDiv.previousElementSibling;

            // Store the current text and remove the edit button
            const currentText = infoDiv.textContent;
            infoDiv.contentEditable = "true";
            infoDiv.focus(); // Make it immediately editable
            element.style.display = "none"; // Hide the edit button

            // Create a save button
            const saveButton = document.createElement("button");
            saveButton.textContent = "Save";
            saveButton.onclick = function() {
                // Get the new text
                const newText = infoDiv.textContent;

                // Revert to non-editable and update the text
                infoDiv.contentEditable = "false";
                // infoDiv.textContent = newText; // Removed: We'll update with PHP

                // Show the edit button again and remove the save button
                element.style.display = "";
                saveButton.remove();

                // Use AJAX to send the updated data to the server
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_account.php", true); // Create a new php file called update_account.php
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the response from the server (optional)
                        console.log(xhr.responseText);
                        // Update the HTML only if the server confirms success
                        if (xhr.responseText === "success") {

                            if (attributeDiv.textContent.includes("Username")) 
                            {
                                fetch('logout.php')
                                .then(response => {
                                    // Only redirect to login.php after logout.php is done
                                    window.location.href = "login.php";
                                })
                                .catch(error => {
                                    console.error("Error during logout:", error);
                                    // Even if logout.php fails, you might still want to redirect to login
                                    window.location.href = "login.php";
                                });
                            } else 
                            {
                                Swal.fire
                                ({
                                    title: "Updated!",
                                    text: 'Account has been updated.',
                                    icon: 'success'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "account.php";
                                }else{
                                    window.location.href = "account.php";
                                }
                                });
                            }
                        } else if (xhr.responseText === "username_taken") {
                            Swal.fire({
                                title: 'Not Updated!',
                                text: 'Username is already taken.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            infoDiv.textContent = currentText; // revert
                        }else {
                            alert("Failed to update. Please try again.");
                            infoDiv.textContent = currentText; // revert to old text
                        }
                    }
                };
                const attributeName = attributeDiv.textContent; // Remove the colon
                const data = "attribute=" + encodeURIComponent(attributeName) + "&value=" + encodeURIComponent(newText) + "&userID=" + <?php echo $_SESSION["userID"]; ?>; //add the userID
                xhr.send(data);
            };
            // Insert the save button after the infoDiv
            element.parentNode.insertBefore(saveButton, element.nextSibling);

            //handle the enter key
            infoDiv.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); //prevent a newline
                    saveButton.click(); //trigger save
                }
            });
        }

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
                                'Your account has been deleted.',
                                'success'
                            ).then(() => {
                                 window.location.href = "logout.php";
                            });
                           
                        } else if (data.error) {
                            Swal.fire(
                                'Error',
                                data.error,
                                'error'
                            );
                        } else {
                            Swal.fire(
                                'Error',
                                'Unknown error occurred.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        Swal.fire(
                            'Error',
                            'Error deleting user. Please check the console.',
                            'error'
                        );
                    });
                }
            })
        }
    </script>

</body>
</html>
