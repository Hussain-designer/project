<?php
header('Content-Type: application/json');
include '../db/config.php';

$activities = [];

$sql = "SELECT username, activity, activity_time FROM activities ORDER BY activity_time DESC";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $activities[] = $row;
    }
}

echo json_encode($activities);
exit;
?>
