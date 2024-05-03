<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "G8CASESTUDY";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password1"];
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    $age = $_POST["age"];
    $house = $_POST["house"];
    $barangay = $_POST["barangay"];
    $region = $_POST["region"];
    $postal = $_POST["postal"];
    $phone = $_POST["phone"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];

    // SQL query to insert data into users table
    $sql = "INSERT INTO users (username, email, password, firstname, middlename, lastname, age, house, barangay, region, postal, phone, height, weight) 
            VALUES ('$username', '$email', '$password', '$firstname', '$middlename', '$lastname', '$age', '$house', '$barangay', '$region', '$postal', '$phone', '$height', '$weight')";

    if ($conn->query($sql) === TRUE) {
        header("Location: /foodifyweb/index.html");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
