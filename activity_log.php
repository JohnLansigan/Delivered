<?php
// activity_log.php
header('Content-Type: application/json');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "db_delivered";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error); // Log the error
    echo json_encode(['error' => "Database connection failed: " . $conn->connect_error]);
    exit();
}

$sql = "SELECT dateCreated AS timestamp FROM tbl_messages 
        UNION 
        SELECT dateCreated FROM tbl_users
        UNION
        SELECT dateCreated FROM tbl_admins
        ORDER BY timestamp DESC
        LIMIT 10";

$result = $conn->query($sql);

if (!$result) {
    error_log("Error executing query: " . $conn->error); // Log the query error
    echo json_encode(['error' => "Error fetching activity log: " . $conn->error]);
    exit();
}

if ($result->num_rows > 0) { //check if there are rows
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] =  $row['timestamp'];
    }
    echo json_encode($data);
}
else{
    echo json_encode([]); //return empty array
}


$conn->close();
?>