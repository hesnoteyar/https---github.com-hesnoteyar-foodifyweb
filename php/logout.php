<?php
// logout.php

session_start(); // Start the session

$servername = "localhost";
$username = "u381723726_root";
$password = ";ww5|9n1Z";
$database = "u381723726_G8CASESTUDY";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $logout_time = date('Y-m-d H:i:s');
    $update_sql = "UPDATE user_logs SET logout_time = '$logout_time' WHERE user_id = '$user_id' AND logout_time IS NULL";
    $conn->query($update_sql);
}

$conn->close();

session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Optionally, you can redirect to the login page or homepage
header("Location: ../index.html"); // Replace with your login page or homepage
exit();
?>
