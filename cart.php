<?php
// cart.php
$total_amount = $_POST['overall_total'];

// Database connection details
$servername = "localhost";
$username = "u381723726_root";
$password = ";ww5|9n1Z";
$dbname = "u381723726_G8CASESTUDY"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch cart items
$sql = "SELECT food_name, quantity, total_amount FROM cart_items";
$result = $conn->query($sql);

$overall_total = 0; // Initialize overall total amount
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify Web Browser</title>
    <link rel="stylesheet" href="css/cart.css">
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
                <a href="">Cart</a>
                <a href="mealprep.php">Meal Prep</a>
                <a href="#" id="logoutLink">Logout</a> <!-- Logout link with ID for JavaScript -->
            </div>
        </ul>
    </nav>
</header>


    <main>
        <form id="checkoutForm" method="POST" action="checkout.php">
            <?php
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Food Name</th><th>Quantity</th><th>Total Amount</th></tr>";
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . htmlspecialchars($row["food_name"]) . "</td><td>" . htmlspecialchars($row["quantity"]) . "</td><td>" . htmlspecialchars($row["total_amount"]) . "</td></tr>";
                    $overall_total += $row["total_amount"]; // Add item total amount to overall total
                }
                echo "</table>";
                echo "<p><strong>Overall Total Amount:</strong> ₱" . htmlspecialchars($overall_total) . "</p>"; // Display overall total
                echo '<input type="hidden" name="overall_total" value="' . htmlspecialchars($overall_total) . '">';
            } else {
                echo "Your cart is empty.";
            }
            ?>
            <input type="hidden" name="overall_total" value="<?php echo htmlspecialchars($overall_total); ?>">
            <button type="submit" class="button-proceed">Proceed to checkout</button>
        </form>
    </main>


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

</body>
</html>
