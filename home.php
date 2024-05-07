<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify Web Browser</title>
    <link rel="stylesheet" href="css/home.css">
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
                <a href="#home">Home</a>
                <a href="#" id="profileLink">Profile</a> <!-- Profile link with ID for JavaScript -->
                <a href="history.php">History</a>
                <a href="order.php">Order</a>
                <a href="mealprep.php">Meal Prep</a>
                <a href="#">Logout</a>
            </div>
        </ul>
    </nav>

    <div class="row banner">
        <div class="banner-room">
            <img class="imagehome" src="images/homepageimg.png" alt="image">
            <h1>Healthy eating,
                <br>made easy
                <br>with foodify.

                <br><button class="button">Order Now</button>
            </h1>
        </div>
    </div>
</header>

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

</body>
</html>
