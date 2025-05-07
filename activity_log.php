<?php
// activity_log.php
header('Content-Type: application/json');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "db_delivered";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT u.username, 'account_created' AS event_type, u.dateCreated AS event_time
        FROM tbl_users u
        UNION
        SELECT u.username, 'admin_permissions' AS event_type, a.dateCreated AS event_time
        FROM tbl_admins a
        JOIN tbl_users u ON a.userID = u.userID
        UNION
        SELECT u.username, 'message_delivered' AS event_type, m.dateCreated AS event_time
        FROM tbl_messages m
        JOIN tbl_users u ON m.userID = u.userID
        ORDER BY event_time DESC
        LIMIT 100";

$result = $conn->query($sql);

if (!$result) {
    die(json_encode(["error" => "Query failed: " . $conn->error]));
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $username = htmlspecialchars($row["username"]);
    $event_type = $row["event_type"];
    $event_time = date("Y-m-d H:i:s", strtotime($row["event_time"]));

    $event_text = "";
    switch ($event_type) {
        case 'account_created':
            $event_text = "[{$username}] Created an account.";
            break;
        case 'admin_permissions':
            $event_text = "[{$username}] Given admin permissions.";
            break;
        case 'message_delivered':
            $event_text = "[{$username}] Delivered a message.";
            break;
        default:
            $event_text = "[{$username}] Performed an unknown action.";
    }
    $data[] = ["event_text" => $event_text, "event_time" => $event_time];
}

echo json_encode($data);

$conn->close();
?>