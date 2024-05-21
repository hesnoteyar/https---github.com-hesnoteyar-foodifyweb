<?php
$servername = "localhost"; // e.g., "localhost"
$username = "u381723726_root"; // e.g., "root"
$password = ";ww5|9n1Z"; // e.g., ""
$dbname = "u381723726_G8CASESTUDY"; // e.g., "my_database"

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
