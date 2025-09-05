<?php
session_start();
include '../db/config.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $username = trim($_POST['username']);
    $position = trim($_POST['position']);
    $email = trim($_POST['email']);

    $sessionUser = isset($_SESSION['username']) ? $_SESSION['username'] : "System";

    $oldData = [];
    $get = $conn->prepare("SELECT username, position, email FROM users WHERE id=? LIMIT 1");
    $get->bind_param("i", $id);
    $get->execute();
    $result = $get->get_result();
    if ($result && $result->num_rows > 0) {
        $oldData = $result->fetch_assoc();
    }
    $get->close();

    $stmt = $conn->prepare("UPDATE users SET username=?, position=?, email=? WHERE id=?");
    $stmt->bind_param("sssi", $username, $position, $email, $id);

    if ($stmt->execute()) {
        echo "success";

        $activity = "Updated user account (ID: $id). Old values: [username={$oldData['username']}, position={$oldData['position']}, email={$oldData['email']}] → New values: [username=$username, position=$position, email=$email]";
        $activity_time = date("Y-m-d H:i:s");

        $log = $conn->prepare("INSERT INTO activities (username, activity, activity_time) VALUES (?, ?, ?)");
        $log->bind_param("sss", $sessionUser, $activity, $activity_time);
        $log->execute();

    } else {
        echo "error";

        $activity = "Failed to update user account (ID: $id)";
        $activity_time = date("Y-m-d H:i:s");

        $log = $conn->prepare("INSERT INTO activities (username, activity, activity_time) VALUES (?, ?, ?)");
        $log->bind_param("sss", $sessionUser, $activity, $activity_time);
        $log->execute();
    }
}
?>
