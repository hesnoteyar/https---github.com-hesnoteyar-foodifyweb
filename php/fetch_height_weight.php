<?php
// Assuming this file is named fetch_height_weight.php

// Connect to your database
$servername = "localhost";
$username = "u381723726_root";
$password = ";ww5|9n1Z";
$database = "u381723726_G8CASESTUDY";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Debugging: Log successful connection
    error_log("Connected to database successfully");
}

// Fetch user ID from GET parameters
if(isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare SQL statement to fetch height and weight based on user ID
    $sql = "SELECT height, weight FROM users WHERE id = $userId";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if data was retrieved
    if ($result->num_rows > 0) {
        // Fetch height and weight from the result set
        $row = $result->fetch_assoc();
        $height = $row['height'];
        $weight = $row['weight'];

        // Return height and weight as JSON
        echo json_encode(array("height" => $height, "weight" => $weight));
    } else {
        // If no data found for the user ID, return an error message
        echo "Error: Height and weight data not found for user ID " . $userId;
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If user ID parameter is not provided, return an error message
    echo "Error: User ID parameter missing";
}
?>
