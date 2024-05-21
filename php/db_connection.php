<?php
$servername = "localhost"; 
$username = "u381723726_root"; 
$password = ";ww5|9n1Z"; 
$dbname = "u381723726_G8CASESTUDY"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
