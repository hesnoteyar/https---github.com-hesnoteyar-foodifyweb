<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify Web Browser</title>
    <link rel="stylesheet" href="css/mealprep.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="background">
    <img src="images/backgroundmain.jpg" alt="bg">
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
                <a href="#">Meal Prep</a>
                <a href="#">Logout</a>
            </div>
        </ul>
    </nav>
</header>

<main>
    <h2>This is the meal prep page</h2>
    <div class="search-section">
        <input type="text" id="recipeSearch" placeholder="Search for a recipe">
        <button id="searchButton">Search</button>
    </div>
    <div id="results"></div>
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

    // Event listener for the search button
    $(document).ready(function(){
    // Event listener for the search button
    $("#searchButton").click(function(){
        const query = $("#recipeSearch").val();
        if(query){
            getNutritionalAnalysis(query);
        } else {
            alert("Please enter a search term.");
        }
    });

    // Function to fetch nutritional analysis using the Edamam API
    function getNutritionalAnalysis(query){
        const appId = '8c2a19f6'; // Replace with your Edamam App ID
        const appKey = '675dac6ff02b7220e2e5a1abcf9ae49a'; // Replace with your Edamam App Key

        $.ajax({
            url: `https://api.edamam.com/api/nutrition-data?app_id=${appId}&app_key=${appKey}&ingr=${query}`,
            type: "GET",
            success: function(response){
                displayNutritionalAnalysis(response);
            },
            error: function(xhr, status, error){
                console.error(error); // Log any errors to the console
            }
        });
    }

    // Function to display nutritional analysis
    function displayNutritionalAnalysis(nutritionData){
        const resultsDiv = $("#results");
        resultsDiv.empty(); // Clear previous results

        const nutritionDiv = `
            <div class="nutrition">
                <h3>Nutritional Analysis</h3>
                <p>Calories: ${nutritionData.calories}</p>
                <p>Protein: ${nutritionData.totalNutrients.PROCNT.quantity} ${nutritionData.totalNutrients.PROCNT.unit}</p>
                <p>Fat: ${nutritionData.totalNutrients.FAT.quantity} ${nutritionData.totalNutrients.FAT.unit}</p>
                <p>Carbohydrates: ${nutritionData.totalNutrients.CHOCDF.quantity} ${nutritionData.totalNutrients.CHOCDF.unit}</p>
                <img src="${nutritionData.image}" alt="Nutritional Image">
            </div>
        `;
        resultsDiv.append(nutritionDiv);
    }
});

});
</script>
</body>
</html>
