<?php
session_start();
include '../db/config.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sessionUser = isset($_SESSION['username']) ? $_SESSION['username'] : "System";

    $deletedUser = "";
    $get = $conn->prepare("SELECT username FROM users WHERE id=? LIMIT 1");
    $get->bind_param("i", $id);
    $get->execute();
    $result = $get->get_result();
    if ($row = $result->fetch_assoc()) {
        $deletedUser = $row['username'];
    }
    $get->close();

    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";

        $activity = "Deleted user account: " . $deletedUser . " (ID: $id)";
        $activity_time = date("Y-m-d H:i:s");
        $log = $conn->prepare("INSERT INTO activities (username, activity, activity_time) VALUES (?, ?, ?)");
        $log->bind_param("sss", $sessionUser, $activity, $activity_time);
        $log->execute();
    } else {
        echo "error";
        
        $activity = "Failed to delete user account (ID: $id)";
        $activity_time = date("Y-m-d H:i:s");
        $log = $conn->prepare("INSERT INTO activities (username, activity, activity_time) VALUES (?, ?, ?)");
        $log->bind_param("sss", $sessionUser, $activity, $activity_time);
        $log->execute();
    }
}
?>
