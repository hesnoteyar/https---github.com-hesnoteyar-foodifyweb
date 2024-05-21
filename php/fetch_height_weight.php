<?php
session_start();

// Database connection
$servername = "localhost";
$username = "u381723726_root";
$password = ";ww5|9n1Z";
$database = "u381723726_G8CASESTUDY";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    // Query to fetch height and weight from the database
    $sql = "SELECT height, weight FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row); // Return height and weight as JSON
    } else {
        echo json_encode(array('error' => 'Height or weight not found for user'));
    }
} else {
    echo json_encode(array('error' => 'User ID not found in session'));
}

// Close connection
$conn->close();
?>
