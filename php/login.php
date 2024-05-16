<?php
session_start();

$servername = "localhost";
$username = "u381723726_root";
$password = ";ww5|9n1Z";
$database = "u381723726_G8CASESTUDY";

$conn = new mysqli($servername, $username, $password, $database);

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

    // Set session ID
    $_SESSION['id'] = $id;

    // Redirect to home.php
    header("Location: /foodifyweb/home.php");
    exit(); 
} else {
    echo "Invalid email or password";
}

$conn->close();
?>