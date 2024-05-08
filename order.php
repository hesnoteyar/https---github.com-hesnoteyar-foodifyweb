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
        <div class="search-container">
            <div class="order-input-element">
                <input type="text" id="order" name="order" placeholder="find food you love">
            </div>
            <div class="order-banner-container">
                <img src="images\order_banner1.jpg" alt="banner1">
                <img src="images\order_banner2.png" alt="banner2">
                <img src="images\order_banner3.png" alt="banner3">
            </div>
        </div>

        <div class="siomai-container">
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

        <div class="siomai-container">
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
        
    </div>





    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const decreaseBtn = document.querySelector('.decrease-btn');
            const increaseBtn = document.querySelector('.increase-btn');
            const quantityInput = document.querySelector('.quantity-input');
            
            // Function to handle decrease button click
            decreaseBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            // Function to handle increase button click
            increaseBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                quantityInput.value = currentValue + 1;
            });

            // Prevent typing in the input field
            quantityInput.addEventListener('keydown', function(event) {
                event.preventDefault();
            });
        });
    </script>

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