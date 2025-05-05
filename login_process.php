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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];

    $sql = "SELECT userID, username, password FROM tbl_users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userID, $username, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["userID"] = $userID;
            $_SESSION["username"] = $username;
            $_SESSION["logged_in"] = true;
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password. Please try again.";
            $_SESSION["login_error"] = $error;
            header("Location: login.php");
            exit();
        }
    } else {
        $error = "No account found with that username. Please check your username or sign up.";
        $_SESSION["login_error"] = $error;
        header("Location: login.php");
        exit();
    }
    $stmt->close();
    $conn->close();
}
?>
