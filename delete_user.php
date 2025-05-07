<?php
// delete_user.php
session_name("session_delivered");
session_start();

// Set the content type to JSON *before* any output
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to handle unexpected errors
function handle_error($errno, $errstr, $errfile, $errline) {
    error_log("Unexpected error: $errstr in $errfile:$errline");
    echo json_encode(["error" => "Internal server error"]);
    exit();
}

// Set a custom error handler
set_error_handler("handle_error");

// Register a shutdown function to catch fatal errors
function handle_fatal_error() {
    $error = error_get_last();
    if ($error && $error['type'] === E_ERROR) {
        // Fatal error occurred
        error_log("Fatal error: " . $error['message'] . " in " . $error['file'] . ":" . $error['line']);
        echo json_encode(["error" => "Fatal error: " . $error['message']]);
        exit();
    }
}
register_shutdown_function('handle_fatal_error');


// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the userID is set
    if (isset($_POST["userID"]) && is_numeric($_POST["userID"])) {
        $userID = intval($_POST["userID"]); // Sanitize the userID

        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "db_delivered";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            error_log("Database Connection Error: " . $conn->connect_error);
            echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
            exit();
        }

        // Prepare and execute the delete query
        $sql = "DELETE FROM tbl_users WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);

        if ($stmt->execute()) {
            error_log("User with userID " . $userID . " deleted successfully.");
            echo json_encode(["success" => "User deleted successfully"]);
        } else {
            error_log("Error deleting user with userID " . $userID . ": " . $stmt->error);
            echo json_encode(["error" => "Error deleting user: " . $stmt->error]);
            exit();
        }

        $stmt->close();
        $conn->close();

    } else {
        error_log("Invalid userID provided: " . (isset($_POST["userID"]) ? $_POST["userID"] : 'NULL'));
        echo json_encode(["error" => "Invalid userID"]);
        exit();
    }
} else {
    error_log("Invalid request method: " . $_SERVER["REQUEST_METHOD"]);
    echo json_encode(["error" => "Invalid request"]);
    exit();
}
?>
