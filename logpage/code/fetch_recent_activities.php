<?php
header('Content-Type: application/json'); 
include __DIR__ . '/../db/config.php';

error_reporting(E_ERROR | E_PARSE);

$activities = [];
$sql = "SELECT id, username, activity, activity_time 
        FROM activities 
        ORDER BY activity_time DESC 
        LIMIT 5";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    exit;
}

while ($row = $result->fetch_assoc()) {
    $activities[] = $row;
}

echo json_encode($activities);
exit;
?>
