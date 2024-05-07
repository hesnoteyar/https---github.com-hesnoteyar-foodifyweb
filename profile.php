<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify Web Browser</title>
    <link rel="stylesheet" href="css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="background">
    <img src="images\backgroundmain.jpg" alt="bg">
</div>

<header id="home">
    <nav>
        <img src="images/headerleft.png" alt="Logo">
        <ul class="dropdown">
            <button class="dropdownbtn">Menu<i class="ri-arrow-down-s-line"></i></button>
            <div class="dropdown-content">
                <a href="home.php">Home</a>
                <a href="#" id="profileLink">Profile</a> <!-- Profile link with ID for JavaScript -->
                <a href="history.php">History</a>
                <a href="order.php">Order</a>
                <a href="mealprep.php">Meal Prep</a>
                <a href="#">Logout</a>
            </div>
        </ul>
    </nav>

    <?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['id'])) {
    // Connect to MySQL
    $servername = "localhost"; // Change this to your MySQL server hostname if needed
    $username = "root"; // Change this to your MySQL username
    $password = ""; // Change this to your MySQL password
    $database = "G8CASESTUDY"; // Change this to your MySQL database name

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user ID from session
    $id = $_SESSION['id'];

    // Prepare and execute SQL query to retrieve user data
    $sql = "SELECT username, email, firstname, middlename, lastname, age, house, barangay, region, postal, phone, height, weight FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Output data
        while($row = $result->fetch_assoc()) {
            // Output user profile data
            echo "<div class='profile-info'>";
            echo "<h2>User Profile</h2>";
            echo "<div class='profile-item'><div class='label'>Username:</div><div class='value-container'><div class='value'>".$row["username"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>Email:</div><div class='value-container'><div class='value'>".$row["email"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>First Name:</div><div class='value-container'><div class='value'>".$row["firstname"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>Middle Name:</div><div class='value-container'><div class='value'>".$row["middlename"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>Last Name:</div><div class='value-container'><div class='value'>".$row["lastname"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>Age:</div><div class='value-container'><div class='value'>".$row["age"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>House No., Building, St. Name:</div><div class='value-container'><div class='value'>".$row["house"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>Barangay, City:</div><div class='value-container'><div class='value'>".$row["barangay"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>Region, Province:</div><div class='value-container'><div class='value'>".$row["region"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>Postal Code:</div><div class='value-container'><div class='value'>".$row["postal"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>Phone Number:</div><div class='value-container'><div class='value'>".$row["phone"]."</div></div></div>";
            echo "<div class='profile-item'><div class='label'>Height:</div><div class='value-container'><div class='value'>".$row["height"]."</div><div class='unit'>cm</div></div></div>";
            echo "<div class='profile-item'><div class='label'>Weight:</div><div class='value-container'><div class='value'>".$row["weight"]."</div><div class='unit'>kg</div></div></div>";
            echo "</div>";
        }
    } else {
        echo "No user data found.";
    }

    // Close connection
    $conn->close();
} else {
    // If user is not logged in, redirect to login page
    header("Location: /foodifyweb/login.php");
    exit();
}
?>
