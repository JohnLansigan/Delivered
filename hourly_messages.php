<?php
// get_hourly_message_counts.php (Modified for Cumulative Hourly Counts)

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
// This ensures that hourly slots are based on Manila time.
$timezone = new DateTimeZone('Asia/Manila');

// --- 1. Get messages SENT IN EACH HOUR for the last 24 hours ---
// The start of our 24-hour window in Manila time
$start_time_manila = new DateTime('now', $timezone);
$start_time_manila->modify('-23 hours'); // Go back 23 hours to include the current hour as the 24th
$start_time_manila->setTime($start_time_manila->format('H'), 0, 0); // Align to the start of that hour

// Convert the start time to UTC if your dateCreated is stored in UTC
// For this example, we'll assume dateCreated and server operations are effectively in Manila time
// or that MySQL's NOW() aligns with the intended scope.
// If dateCreated IS UTC, you'd do: $start_time_utc_string = $start_time_manila->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d H:i:s');
// And use that in the query. For simplicity, assuming direct comparison works for your setup.

$sql_hourly_counts = "
    SELECT
        DATE_FORMAT(dateCreated, '%Y-%m-%d %H:00:00') AS hour_slot_key,
        COUNT(*) AS messages_in_hour
    FROM
        tbl_messages
    WHERE
        dateCreated >= '" . $start_time_manila->format('Y-m-d H:00:00') . "'
        AND dateCreated < DATE_ADD('" . $start_time_manila->format('Y-m-d H:00:00') . "', INTERVAL 24 HOUR)
    GROUP BY
        hour_slot_key
    ORDER BY
        hour_slot_key ASC;
";
// Note: The WHERE clause now precisely defines a 24-hour window starting from $start_time_manila

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

// --- 2. Prepare hourly slots for the last 24 hours and calculate cumulative counts ---
$final_labels = [];        // For X-axis display
$cumulative_data_points = []; // For Y-axis (cumulative counts)
$running_total = 0;

// Iterate through each of the last 24 hours, starting from 23 hours ago up to the current hour
$current_hour_iterate = new DateTime('now', $timezone);
$current_hour_iterate->modify('-23 hours');
$current_hour_iterate->setTime($current_hour_iterate->format('H'), 0, 0); // Align to start of the hour

for ($i = 0; $i < 24; $i++) {
    $hour_key = $current_hour_iterate->format('Y-m-d H:00:00'); // Key for lookup
    $display_label = $current_hour_iterate->format('M d, H:00'); // User-friendly label

    // Add messages SENT IN THIS specific hour to the running total
    if (isset($messages_per_specific_hour[$hour_key])) {
        $running_total += $messages_per_specific_hour[$hour_key];
    }

    $final_labels[] = $display_label;
    $cumulative_data_points[] = $running_total;

    $current_hour_iterate->modify('+1 hour');
}

// --- Output JSON ---
echo json_encode(['labels' => $final_labels, 'data' => $cumulative_data_points]);

$conn->close();
?>