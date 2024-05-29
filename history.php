<?php
    session_start(); // Start the session

    // Check if user is logged in
    if (!isset($_SESSION['id'])) {
        // Redirect to the login page if user is not logged in
        header("Location: index.html");
        exit; // Stop further execution
    }

    // Database connection details
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

    // Retrieve the user ID from the session
    $userID = $_SESSION['id'];

    // Query to select transactions for the logged-in user
    $sql = "SELECT * FROM transactions WHERE user_id = $userID";

    $result = $conn->query($sql);

?>





 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify Web Browser</title>
    <link rel="stylesheet" href="css/history.css">
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
                <a href="">History</a>
                <a href="order.php">Order</a>
                <a href="mealprep.php">Meal Prep</a>
                <a href="#" id="logoutLink">Logout</a> <!-- Logout link with ID for JavaScript -->
            </div>
        </ul>
    </nav>
</header>

    <body>
    <div class="history-container">
    <h1>Transaction History</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Order Name</th>
            <th>Order Price</th>
            <th>Order Quantity</th>
            <th>Total Price</th>
            <th>Room Number</th>
            <th>Payment Method</th>
            <th>Order Date</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["order_name"] . "</td>";
                echo "<td>" . $row["order_price"] . "</td>";
                echo "<td>" . $row["order_quantity"] . "</td>";
                echo "<td>" . $row["total_price"] . "</td>";
                echo "<td>" . $row["room_number"] . "</td>";
                echo "<td>" . $row["payment_method"] . "</td>";
                echo "<td>" . $row["reg_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No transactions found</td></tr>";
        }
        ?>
    </table>
</div>
    </body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Click event for the profile link
    $("#profileLink").click(function(e){
        e.preventDefault(); // Prevent default link behavior
        // AJAX request to fetch user ID
        $.ajax({
            url: "php/fetch_user_id.php", // Replace with your PHP file to fetch user ID
            type: "GET",
            success: function(response){
                // Redirect to profile.php with the user ID as URL parameter
                window.location.href = "profile.php?id=" + response;
            },
            error: function(xhr, status, error){
                console.error(error); // Log any errors to the console
            }
        });
    });
});

$(document).ready(function(){
    $("#logoutLink").click(function(e){
        e.preventDefault(); // Prevent default link behavior
        
        // AJAX request to logout
        $.ajax({
            url: "php/logout.php", // Replace with your PHP file to handle logout
            type: "POST",
            success: function(response){
                // Redirect to the login page or homepage
                window.location.href = "index.html"; // Replace with your login page or homepage
            },
            error: function(xhr, status, error){
                console.error("Logout failed:", error); // Log any errors to the console
            }
        });
    });
});
</script>
