<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "db_delivered";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DATE_FORMAT(dateCreated, '%Y-%m-%d %H:00:00') as hour, COUNT(*) as user_count
        FROM tbl_users
        WHERE dateCreated >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
        GROUP BY hour
        ORDER BY hour";

$result = $conn->query($sql);

$data = array();
$labels = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = date('M d, H:i', strtotime($row['hour']));
        $data[] = $row['user_count'];
    }
}

header('Content-Type: application/json');
echo json_encode(array('labels' => $labels, 'data' => $data));

$conn->close();
?>
