<?php
session_start();
include 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=? LIMIT 1");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // ✅ Set session
        $_SESSION['username'] = $user['username'];  

        // ✅ Log successful login
        $activity = "User logged in";
        $activity_time = date("Y-m-d H:i:s");
        $log = $conn->prepare("INSERT INTO activities (username, activity, activity_time) VALUES (?, ?, ?)");
        $log->bind_param("sss", $user['username'], $activity, $activity_time);
        $log->execute();

        echo "<script>alert('Login successful! Redirecting to dashboard...'); window.location.href='dashboard.php';</script>";
        exit();
    } else {
        // ✅ Log failed login attempt
        $activity = "Failed login attempt with username/email: " . $username;
        $activity_time = date("Y-m-d H:i:s");
        $log = $conn->prepare("INSERT INTO activities (username, activity, activity_time) VALUES (?, ?, ?)");
        $log->bind_param("sss", $username, $activity, $activity_time);
        $log->execute();

        echo "<script>alert('Invalid login! Redirecting to home...'); window.location.href='index.php';</script>";
    }
}
?>
