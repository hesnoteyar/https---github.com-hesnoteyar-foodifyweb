<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify Web Browser</title>
    <link rel="stylesheet" href="css/order.css">
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
                <a href="#">Order</a>
                <a href="mealprep.php">Meal Prep</a>
                <a href="#">Logout</a>
            </div>
        </ul>
    </nav>
</header>

<body>
    <div class="order-container">
        <h2>What's on your mind?</h2>
        <div class="search-container" >
            <div class="order-input-element">
                <input type="text" id="order" name="order" placeholder="find food you love">
            </div>
            <div class="order-banner-container">
                <img src="images\order_banner1.jpg" alt="banner1">
                <img src="images\order_banner2.png" alt="banner2">
                <img src="images\order_banner3.png" alt="banner3">
            </div>
        </div>

        <div class="siomai-container" containerID="1">
            <label class="siomai-label">Siomai w/ Rice</label>
            <div class="siomai-details">
                <img src="images/siomai_order.png" alt="siomai">
                <div class="quantity-controls">
                    <button class="decrease-btn">-</button>
                    <input type="text" class="quantity-input" value="1">
                    <button class="increase-btn">+</button>
                </div>
            </div>
            <div class="siomai-actions">
                <button class="buy-btn">Buy</button>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </div>

        <div class="adobo-container"containerID="2">
            <label class="adobo-label">Adobo w/ Rice</label>
            <div class="adobo-details">
                <img src="images/siomai_order.png" alt="adobo">
                <div class="quantity-controls">
                    <button class="decrease-btn">-</button>
                    <input type="text" class="quantity-input" value="1">
                    <button class="increase-btn">+</button>
                </div>
            </div>
            <div class="adobo-actions">
                <button class="buy-btn">Buy</button>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </div>

        <div class="mechado-container" containerID="3">
            <label class="mechado-label">Mechado w/ Rice</label>
            <div class="mechado-details">
                <img src="images/siomai_order.png" alt="mechado">
                <div class="quantity-controls">
                    <button class="decrease-btn">-</button>
                    <input type="text" class="quantity-input" value="1">
                    <button class="increase-btn">+</button>
                </div>
            </div>
            <div class="mechado-actions">
                <button class="buy-btn">Buy</button>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </div>

        <div class="paksiw-container" containerID="4">
            <label class="paksiw-label">Paksiw w/ Rice</label>
            <div class="paksiw-details">
                <img src="images/siomai_order.png" alt="paksiw">
                <div class="quantity-controls">
                    <button class="decrease-btn">-</button>
                    <input type="text" class="quantity-input" value="1">
                    <button class="increase-btn">+</button>
                </div>
            </div>
            <div class="paksiw-actions">
                <button class="buy-btn">Buy</button>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </div>

        <div class="pakbet-container" containerID="5">
            <label class="pakbet-label">Pakbet w/ Rice</label>
            <div class="pakbet-details">
                <img src="images/siomai_order.png" alt="pakbet">
                <div class="quantity-controls">
                    <button class="decrease-btn">-</button>
                    <input type="text" class="quantity-input" value="1">
                    <button class="increase-btn">+</button>
                </div>
            </div>
            <div class="pakbet-actions">
                <button class="buy-btn">Buy</button>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </div>
        
    </div>





<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Quantity controls
        const decreaseBtns = document.querySelectorAll('.decrease-btn');
        decreaseBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                let currentValue = parseInt(btn.nextElementSibling.value);
                if (currentValue > 1) {
                    btn.nextElementSibling.value = currentValue - 1;
                }
            });
        });

        const increaseBtns = document.querySelectorAll('.increase-btn');
        increaseBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                let currentValue = parseInt(btn.previousElementSibling.value);
                btn.previousElementSibling.value = currentValue + 1;
            });
        });

        const quantityInputs = document.querySelectorAll('.quantity-input');
        quantityInputs.forEach(function(input) {
            input.addEventListener('keydown', function(event) {
                event.preventDefault();
            });
        });

        // Buy and Add to Cart functionality
        const buyBtns = document.querySelectorAll('.buy-btn, .add-to-cart-btn');
        buyBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                let containerID = btn.parentElement.parentElement.getAttribute('containerID');
                fetchPrice(containerID, btn); // Pass btn as a parameter
            });
        });

        function fetchPrice(containerID, btn) {
            // AJAX request to fetch price from the database
            $.ajax({
                url: "php/fetch_price.php", // PHP script to fetch price
                type: "POST",
                data: { containerID: containerID }, // Send container ID to PHP script
                success: function(response) {
                    let data = JSON.parse(response);
                    let price = data.price;
                    let foodName = data.foodName;
                    let quantity = parseInt(btn.parentElement.parentElement.querySelector('.quantity-input').value);
                    let totalAmount = price * quantity;
                    let action = btn.classList.contains('buy-btn') ? 'buy' : 'addToCart';
                    if (action === 'buy') {
                        generateReceipt(quantity, foodName, totalAmount);
                    } else {
                        addToCart(quantity, foodName, totalAmount);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any errors to the console
                }
            });
        }

        function generateReceipt(quantity, foodName, totalAmount) {
    // Log data to console
    console.log("Data to be sent:", { quantity: quantity, foodName: foodName, totalAmount: totalAmount });

    // Set session variables using sessionStorage
    sessionStorage.setItem('order_name', foodName);
    sessionStorage.setItem('order_price', totalAmount);
    sessionStorage.setItem('order_quantity', quantity);

    console.log("Session variables set:", {
        order_name: sessionStorage.getItem('order_name'),
        order_price: sessionStorage.getItem('order_price'),
        order_quantity: sessionStorage.getItem('order_quantity')
    });

    // AJAX request to generate receipt
    $.ajax({
        url: "generate_receipt.php",
        type: "POST",
        data: { quantity: quantity, foodName: foodName, totalAmount: totalAmount },
        success: function(response) {
            // Redirect to receipt page
            window.location.href = "receipt.php";
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error); // Log AJAX errors
            alert("Error: Data not received."); // Show an alert for debugging
        }
    });
}

        function addToCart(quantity, foodName, totalAmount) {
            // Display confirmation message
            alert("Data to be sent to cart: Quantity: " + quantity + ", Food Name: " + foodName + ", Total Amount: " + totalAmount);

            // AJAX request to add item to cart
            $.ajax({
                url: "php/add_to_cart.php", // PHP script to add item to cart
                type: "POST",
                data: { quantity: quantity, foodName: foodName, totalAmount: totalAmount },
                success: function(response) {
                    // Redirect to cart page or display success message
                    alert("Item added to cart successfully: " + response);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error); // Log AJAX errors
                    alert("Error: Failed to add item to cart."); // Show an alert for debugging
                }
            });
        }
    });
</script>




<?php
// Include database connection configuration
$servername = "localhost";
$username = "u381723726_root";
$password = ";ww5|9n1Z";
$database = "u381723726_G8CASESTUDY";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the table already exists
$tableExistsQuery = "SHOW TABLES LIKE 'menu_order'";
$tableExistsResult = $conn->query($tableExistsQuery);

if ($tableExistsResult->num_rows == 0) {
    // Table does not exist, create it
    $createTableQuery = "CREATE TABLE menu_order (
        ID INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price INT(11) NOT NULL
    )";

    if ($conn->query($createTableQuery) === TRUE) {
        // Table created successfully, insert initial data
        $insertDataQuery = "INSERT INTO menu_order (name, price) VALUES
            ('Siomai', 45),
            ('Adobo', 70),
            ('Mechado', 65),
            ('Paksiw', 55),
            ('Pakbet', 75)";

        if ($conn->query($insertDataQuery) === TRUE) {
            echo "Menu order table created and initial data inserted successfully.";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }
}
// Close connection
$conn->close();
?>

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
</script>