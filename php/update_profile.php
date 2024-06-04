<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['id'])) {
    // Connect to MySQL
    $servername = "localhost";
    $username = "u381723726_root";
    $password = ";ww5|9n1Z";
    $database = "u381723726_G8CASESTUDY";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user ID from session
    $id = $_SESSION['id'];

    // Retrieve data from POST request
    $username = $_POST['username'];
    $email = $_POST['email'];
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

    // Prepare and execute SQL query to update user data
    $sql = "UPDATE users SET username=?, email=?, firstname=?, middlename=?, lastname=?, age=?, house=?, barangay=?, region=?, postal=?, phone=?, height=?, weight=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssi", $username, $email, $firstname, $middlename, $lastname, $age, $house, $barangay, $region, $postal, $phone, $height, $weight, $id);

    if ($stmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    // If user is not logged in, return an error
    echo "You are not logged in.";
}
?>
