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
    $("#searchButton").click(function(){
        const query = $("#recipeSearch").val();
        if(query){
            searchRecipes(query);
        } else {
            alert("Please enter a search term.");
        }
    });

    // Function to search for recipes using the Edamam API
    function searchRecipes(query){
        const appId = '8c2a19f6'; // Replace with your Edamam App ID
        const appKey = '675dac6ff02b7220e2e5a1abcf9ae49a'; // Replace with your Edamam App Key

        $.ajax({
            url: `https://api.edamam.com/search?q=${query}&app_id=${appId}&app_key=${appKey}`,
            type: "GET",
            success: function(response){
                displayResults(response.hits);
            },
            error: function(xhr, status, error){
                console.error(error); // Log any errors to the console
            }
        });
    }

    // Function to display search results
    function displayResults(results){
        const resultsDiv = $("#results");
        resultsDiv.empty(); // Clear previous results

        if(results.length === 0){
            resultsDiv.append("<p>No recipes found.</p>");
            return;
        }

        results.forEach(result => {
            const recipe = result.recipe;
            const recipeDiv = `
                <div class="recipe">
                    <h3>${recipe.label}</h3>
                    <img src="${recipe.image}" alt="${recipe.label}">
                    <p><a href="${recipe.url}" target="_blank">View Recipe</a></p>
                </div>
            `;
            resultsDiv.append(recipeDiv);
        });
    }
});
</script>
</body>
</html>
