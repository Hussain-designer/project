<?php
header('Content-Type: application/json');
include __DIR__ . '/../db/config.php';

error_reporting(E_ERROR | E_PARSE);

$patients = [];
$sql = "SELECT id, card_no, patient_name, ward, date_admitted 
        FROM patients 
        ORDER BY date_admitted DESC 
        LIMIT 5";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    exit;
}

while ($row = $result->fetch_assoc()) {
    $patients[] = $row;
}

echo json_encode($patients);
exit;
?>
