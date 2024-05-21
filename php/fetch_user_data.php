<?php
session_start();

// Check if user ID is set in the session
if(!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'User ID not found']);
    exit; // Stop execution if user ID is not found
}

// Continue with fetching user data if user ID is set
require __DIR__ . '/php/db_connection.php'; // Ensure the correct path

// Assume user is logged in and user_id is stored in session
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
