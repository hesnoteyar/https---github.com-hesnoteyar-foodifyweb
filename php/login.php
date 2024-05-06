<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "G8CASESTUDY"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT id FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the user ID
    $row = $result->fetch_assoc();
    $id = $row['id'];

    // Start session and set session ID
    session_start();
    $_SESSION['id'] = $id;

    // Redirect to home.php with user ID as URL parameter
    header("Location: /foodifyweb/home.php");
    exit(); 
} else {
    echo "Invalid email or password";
}

// Close the database connection
$conn->close();
?>
