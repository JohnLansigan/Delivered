<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "db_delivered";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["attribute"]) && isset($_POST["value"]) && isset($_POST["userID"])) {
    $attribute = $_POST["attribute"];
    $value = $_POST["value"];
    $userID = $_POST["userID"]; // Get the userID

    switch ($attribute) {
        case "First Name":
            $sql = "UPDATE tbl_users SET fname = ?, dateUpdated = CURRENT_TIMESTAMP WHERE userID = ?";
            break;
        case "Last Name":
            $sql = "UPDATE tbl_users SET lname = ?, dateUpdated = CURRENT_TIMESTAMP WHERE userID = ?";
            break;
        case "Address":
            $sql = "UPDATE tbl_users SET address = ?, dateUpdated = CURRENT_TIMESTAMP WHERE userID = ?";
            break;
        case "Username":
            // Check if the username is already taken (excluding the current user)
            $checkSql = "SELECT userID FROM tbl_users WHERE username = ? AND userID != ?";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bind_param("si", $value, $userID);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                echo "username_taken"; // Send this specific error back to JS
                $conn->close();
                exit();
            }
            $checkStmt->close();
            $sql = "UPDATE tbl_users SET username = ?, dateUpdated = CURRENT_TIMESTAMP WHERE userID = ?";
            break;
        default:
            echo "Invalid attribute";
            $conn->close();
            exit();
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $value, $userID); // "s" for string, "i" for integer

    if ($stmt->execute()) {
        echo "success"; // Send a success message back to the JavaScript
    } else {
        echo "Error updating record: " . $stmt->error; //send error
    }

    $stmt->close();
} else {
    echo "Invalid data received"; //   Send an error message back to the JavaScript
}
$conn->close();
?>
