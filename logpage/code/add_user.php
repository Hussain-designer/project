<?php 
session_start();
include '../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);   // new user being registered
    $position = trim($_POST['position']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Who is performing this action (session user or system)
    $sessionUser = isset($_SESSION['username']) ? $_SESSION['username'] : "System";

    // Check if username or email exists
    $check = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
    $check->bind_param("ss", $username, $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "Username or Email already exists!";

        // ❌ Log failed attempt
        $activity = "Attempted to create a user but username/email already exists: " . $username;
        $activity_time = date("Y-m-d H:i:s");
        $log = $conn->prepare("INSERT INTO activities (username, activity, activity_time) VALUES (?, ?, ?)");
        $log->bind_param("sss", $sessionUser, $activity, $activity_time);
        $log->execute();

    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, position, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $position, $email, $password);

        if ($stmt->execute()) {
            echo "success";

            // ✅ Log successful creation
            $activity = "Created a new user: " . $username;
            $activity_time = date("Y-m-d H:i:s");

            $log = $conn->prepare("INSERT INTO activities (username, activity, activity_time) VALUES (?, ?, ?)");
            $log->bind_param("sss", $sessionUser, $activity, $activity_time);
            $log->execute();
        } else {
            echo "error";

            // ❌ Log DB error
            $activity = "Failed to create user: " . $username . " (DB error)";
            $activity_time = date("Y-m-d H:i:s");
            $log = $conn->prepare("INSERT INTO activities (username, activity, activity_time) VALUES (?, ?, ?)");
            $log->bind_param("sss", $sessionUser, $activity, $activity_time);
            $log->execute();
        }
    }
}
?>
