<?php
    session_name("session_delivered");
    session_start();
    error_log("submit_message.php: Session started");

    if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
        http_response_code(401);
        exit("Unauthorized: Please log in.");
    }

    $servername = "127.0.0.1"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "db_delivered";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        http_response_code(500);
        exit("Database connection failed: " . $conn->connect_error);
    }

    $message = isset($_POST["message"]) ? trim($_POST["message"]) : '';
    $recipient = isset($_POST["recipient"]) ? trim($_POST["recipient"]) : '';

    if (empty($message) || empty($recipient)) {
        http_response_code(400);
        exit("Message and recipient are required.");
    }

    if (!isset($_SESSION["userID"])) {
        http_response_code(403);
        exit("User ID not found in session.");
    }

    $userID = $_SESSION["userID"];

    $sql = "INSERT INTO tbl_messages (userID, message, recipient) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("iss", $userID, $message, $recipient);
        if (!$stmt->execute()) {
            http_response_code(500);
            exit("Database insert failed: " . $stmt->error);
        }
        $stmt->close();
        http_response_code(200);
        exit("Message submitted successfully.");
    } else {
        http_response_code(500);
        exit("SQL preparation failed: " . $conn->error);
    }

    $conn->close();
?>
