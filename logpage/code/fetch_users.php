<?php
session_start();
include '../db/config.php';
header('Content-Type: application/json');

$sql = "SELECT id, username, position, email FROM users ORDER BY id DESC";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
