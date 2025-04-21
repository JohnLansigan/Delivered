<?php
session_name("session_delivered");
session_start();

//localhost OR 127.0.0.1
$servername = "127.0.0.1"; 
$username = "root"; 
$password = ""; 
$dbname = "db_delivered";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];
    $repassword = $_POST["repassword"]; 

    if (empty($fname) || empty($lname) || empty($address) || empty($email) || empty($username) || empty($password) || empty($repassword)) {
        $error = "All fields are required.";
    } elseif ($password !== $repassword) {
        $error = "Passwords do not match.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO tbl_users (fname, lname, address, email, username, password)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssss", $fname, $lname, $address, $email, $username, $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION["username"] = $username; 
                header("Location: signup_success.php"); 
                exit();
            } else {
                $error = "Error during registration: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error = "Error preparing the SQL statement: " . $conn->error;
        }
    }

    if (isset($error)) {
        $_SESSION["signup_error"] = $error;
        header("Location: signup.php"); 
        exit();
    }
}

$conn->close();

?>