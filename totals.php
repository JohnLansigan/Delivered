<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "db_delivered";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo json_encode(['error' => "Database connection failed: " . $conn->connect_error]);
        exit();
    }

    // Query to get the total counts
    $sql = "SELECT 
            (SELECT COUNT(*) FROM tbl_users) as total_users,
            (SELECT COUNT(*) FROM tbl_admins) as total_admins,
            (SELECT COUNT(*) FROM tbl_messages) as total_messages";

    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => "Error fetching totals: " . $conn->error]);
    }

    $conn->close();
?>