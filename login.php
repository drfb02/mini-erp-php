<?php
session_start();
include 'config.php';

function sendAlertEmail($username, $ip) {
    $to = 'admin@example.com';
    $subject = 'Unauthorized Login Attempt';
    $message = "Login attempt failed:\nUsername: $username\nIP: $ip\nTime: " . date('Y-m-d H:i:s');
    $headers = 'From: noreply@mini-erp.com';
    mail($to, $subject, $message, $headers);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $login_status = 'failed';

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $login_status = 'success';
        echo "<script>var audio = new Audio('success.mp3'); audio.play();</script>";
        header('Refresh:1; URL=dashboard.php');
    } else {
        sendAlertEmail($username, $ip);
        echo "<script>var audio = new Audio('fail.mp3'); audio.play();</script>";
        echo "<p style='color:red;'>Invalid credentials</p>";
    }

    $stmt = $conn->prepare('INSERT INTO login_attempts (username, ip_address, status) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $username, $ip, $login_status);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<form method="post">
    Username: <input type="text" name="username" required /><br/>
    Password: <input type="password" name="password" required /><br/>
    <button type="submit">Login</button>
</form>
</body>
</html>
