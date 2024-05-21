<?php
session_start();
require 'php/db_connection.php'; // Make sure this path is correct

// Check if user ID is set in the session
if (!isset($_SESSION['id'])) {
    // If user ID is not set in the session, return an error or redirect as needed
    echo json_encode(['error' => 'User ID not found']);
    exit; // Stop further execution
}

// User ID is set, proceed to fetch user data
$user_id = $_SESSION['id'];

$sql = "SELECT height, weight FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    echo json_encode($user_data);
} else {
    echo json_encode(['error' => 'User not found']);
}

$stmt->close();
$conn->close();
?>
