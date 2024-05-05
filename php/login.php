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

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    header("Location: /foodifyweb/home.html");
    exit(); 

} else {
    echo "Invalid email or password";
}

// Close the database connection
$conn->close();
?>
