<?php
session_name("session_delivered");
session_start();

header('Content-Type: application/json'); // Ensure JSON response

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "db_delivered";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["messageID"]) && is_numeric($_POST["messageID"])) {
        $messageID = intval($_POST["messageID"]);

        $sql = "DELETE FROM tbl_messages WHERE messageID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $messageID);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Message deleted successfully"]);
        } else {
            echo json_encode(["error" => "Error deleting message: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Invalid messageID"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>