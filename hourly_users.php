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

// Create a temporary table with all hourly timestamps for the last 12 hours
$conn->query("CREATE TEMPORARY TABLE IF NOT EXISTS hourly_series (hour DATETIME)");
$conn->query("INSERT INTO hourly_series (hour)
             SELECT DATE_FORMAT(DATE_SUB(NOW(), INTERVAL (n) HOUR), '%Y-%m-%d %H:00:00')
             FROM (SELECT @row := @row + 1 as n FROM 
                   (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11) t,
                   (SELECT @row := -1) r
                  ) numbers
             ORDER BY n");

// SQL query to count user registrations per hour, joined with the hourly series
$sql = "SELECT 
            hs.hour,
            COUNT(u.dateCreated) as user_count
        FROM hourly_series hs
        LEFT JOIN tbl_users u ON DATE_FORMAT(u.dateCreated, '%Y-%m-%d %H:00:00') = hs.hour
        WHERE hs.hour >= DATE_SUB(NOW(), INTERVAL 12 HOUR)
        GROUP BY hs.hour
        ORDER BY hs.hour";

$result = $conn->query($sql);

$data = array();
$labels = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Use date('M d, h:i A', ...) for 12-hour format with AM/PM
        $labels[] = date('M d, h:i A', strtotime($row['hour']));
        $data[] = (int)$row['user_count'];
    }
}

// Include suggestedMax and stepSize in the JSON output
header('Content-Type: application/json');
echo json_encode(array(
    'labels' => $labels,
    'data' => $data,
    'yAxis' => array(
        'suggestedMax' => 5,
        'stepSize' => 1,
        'min' => 0
    )
));

$conn->close();
?>
