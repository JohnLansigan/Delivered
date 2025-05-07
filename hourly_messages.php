<?php
// get_hourly_message_counts.php (Modified to show messages per hour in 12-hour format)

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

// Timezone for Manila (UTC+8)
$timezone = new DateTimeZone('Asia/Manila');

// --- 1. Get messages SENT IN EACH HOUR for the last 12 hours ---  (Modified for 12 hours)
$start_time_manila = new DateTime('now', $timezone);
$start_time_manila->modify('-11 hours'); // Changed from 23 to 11
$start_time_manila->setTime($start_time_manila->format('H'), 0, 0);

$sql_hourly_counts = "
    SELECT
        DATE_FORMAT(dateCreated, '%Y-%m-%d %H:00:00') AS hour_slot_key,
        COUNT(*) AS messages_in_hour
    FROM
        tbl_messages
    WHERE
        dateCreated >= '" . $start_time_manila->format('Y-m-d H:00:00') . "'
        AND dateCreated < DATE_ADD('" . $start_time_manila->format('Y-m-d H:00:00') . "', INTERVAL 12 HOUR)  -- Modified from 24 to 12
    GROUP BY
        hour_slot_key
    ORDER BY
        hour_slot_key ASC;
";

$result_hourly = $conn->query($sql_hourly_counts);
$messages_per_specific_hour = [];
if ($result_hourly) {
    while ($row = $result_hourly->fetch_assoc()) {
        $messages_per_specific_hour[$row['hour_slot_key']] = (int)$row['messages_in_hour'];
    }
} else {
    echo json_encode(['error' => "Error fetching hourly data: " . $conn->error]);
    $conn->close();
    exit();
}

// --- 2. Prepare hourly slots for the last 12 hours --- (Modified for 12 hours)
$final_labels = [];
$hourly_data_points = [];

$current_hour_iterate = new DateTime('now', $timezone);
$current_hour_iterate->modify('-11 hours'); // Changed from 23 to 11
$current_hour_iterate->setTime($current_hour_iterate->format('H'), 0, 0);

for ($i = 0; $i < 12; $i++) { // Changed from 24 to 12
    $hour_key = $current_hour_iterate->format('Y-m-d H:00:00');
    // Use 12-hour format with AM/PM.
    $display_label = $current_hour_iterate->format('M d, h:00 A');

    if (isset($messages_per_specific_hour[$hour_key])) {
        $hourly_data_points[] = $messages_per_specific_hour[$hour_key];
    } else {
        $hourly_data_points[] = 0;
    }

    $final_labels[] = $display_label;
    $current_hour_iterate->modify('+1 hour');
}

// --- Output JSON ---
echo json_encode(['labels' => $final_labels, 'data' => $hourly_data_points]);

$conn->close();
?>
