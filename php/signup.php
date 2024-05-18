<?php

// Database connection parameters
$servername = "localhost";
$username = "u381723726_root";
$password = ";ww5|9n1Z";
$database = "u381723726_G8CASESTUDY";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    // Database creation success message removed
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($database);

// Check if the database selection was successful
if ($conn->error) {
    die("Error selecting database: " . $conn->error);
}

// Define the table creation query
$table_query = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    middlename VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    age INT(3) NOT NULL,
    house VARCHAR(100) NOT NULL,
    barangay VARCHAR(100) NOT NULL,
    region VARCHAR(100) NOT NULL,
    postal INT(6) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    height INT(3) NOT NULL,
    weight INT(3) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Execute the table creation query
if ($conn->query($table_query) === TRUE) {
    // Table creation success message removed
} else {
    echo "Error creating table: " . $conn->error;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password1'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $house = $_POST['house'];
    $barangay = $_POST['barangay'];
    $region = $_POST['region'];
    $postal = $_POST['postal'];
    $phone = $_POST['phone'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email='$email'";
    $check_email_result = $conn->query($check_email_query);
    if ($check_email_result->num_rows > 0) {
        header("Location: /emailexist.html");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    // SQL query to insert data into users table
    $insert_query = "INSERT INTO users (username, email, password, firstname, middlename, lastname, age, house, barangay, region, postal, phone, height, weight) 
                     VALUES ('$username', '$email', '$password', '$firstname', '$middlename', '$lastname', '$age', '$house', '$barangay', '$region', '$postal', '$phone', '$height', '$weight')";

    // Execute the insert query
    if ($conn->query($insert_query) === TRUE) {
        header("Location: /verification.html");
        exit(); 
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();

?>
