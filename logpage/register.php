<?php
session_start();
include 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $checkUser = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $checkUser->bind_param("ss", $username, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        echo "Username or email already taken!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $_SESSION['user'] = $username;

            $activity = "New user registered";
            $log = $conn->prepare("INSERT INTO activities (username, activity) VALUES (?, ?)");
            $log->bind_param("ss", $username, $activity);
            $log->execute();


            echo "<script>alert('Registration successful! Redirecting to dashboard...'); window.location.href='dashboard.php';</script>";
            exit();
        } else {
            echo "<script>alert('Registration successful! Redirecting to dashboard...'); window.location.href='dashboard.php';</script>";
        }
    }
}
?>
