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
                <a href="#" id="logoutLink">Logout</a> <!-- Logout link with ID for JavaScript -->
            </div>
        </ul>
    </nav>
</header>

<main>
    <div class="search-section">
        <input type="text" id="recipeSearch" placeholder="Search for a recipe">
        <button id="searchButton">Search</button>
    </div>
    <div id="intake"></div>
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
            getNutritionalAnalysis(query);
        } else {
            alert("Please enter a search term.");
        }
    });

    // Function to fetch nutritional analysis using the Edamam API
    function getNutritionalAnalysis(query){
        const appId = '8c2a19f6'; 
        const appKey = '675dac6ff02b7220e2e5a1abcf9ae49a'; 

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
            <div class="nutrition-facts">
                <h3>Nutritional Facts</h3>
                <p>Calories: ${nutritionData.calories}</p>
                <div class="nutrient">
                    <span class="nutrient-label">Protein</span>
                    <span>${nutritionData.totalNutrients.PROCNT ? nutritionData.totalNutrients.PROCNT.quantity + ' ' + nutritionData.totalNutrients.PROCNT.unit : 'N/A'}</span>
                </div>
                <div class="nutrient">
                    <span class="nutrient-label">Fat</span>
                    <span>${nutritionData.totalNutrients.FAT ? nutritionData.totalNutrients.FAT.quantity + ' ' + nutritionData.totalNutrients.FAT.unit : 'N/A'}</span>
                </div>
                <div class="nutrient">
                    <span class="nutrient-label">Carbohydrates</span>
                    <span>${nutritionData.totalNutrients.CHOCDF ? nutritionData.totalNutrients.CHOCDF.quantity + ' ' + nutritionData.totalNutrients.CHOCDF.unit : 'N/A'}</span>
                </div>
                <div class="nutrient">
                    <span class="nutrient-label">Fiber</span>
                    <span>${nutritionData.totalNutrients.FIBTG ? nutritionData.totalNutrients.FIBTG.quantity + ' ' + nutritionData.totalNutrients.FIBTG.unit : 'N/A'}</span>
                </div>
                <div class="nutrient">
                    <span class="nutrient-label">Sugars</span>
                    <span>${nutritionData.totalNutrients.SUGAR ? nutritionData.totalNutrients.SUGAR.quantity + ' ' + nutritionData.totalNutrients.SUGAR.unit : 'N/A'}</span>
                </div>
                <div class="nutrient">
                    <span class="nutrient-label">Calcium</span>
                    <span>${nutritionData.totalNutrients.CA ? nutritionData.totalNutrients.CA.quantity + ' ' + nutritionData.totalNutrients.CA.unit : 'N/A'}</span>
                </div>
                <!-- Add more nutrient information here -->
            </div>
        `;
        resultsDiv.append(nutritionDiv);
    }

    // Fetch height and weight from server
    $.ajax({
        url: "php/fetch_height_weight.php",
        type: "GET",
        dataType: "json",
        success: function(response){
            if(response.error){
                console.error(response.error);
                return;
            }
            const height = response.height; // Height in cm
            const weight = response.weight; // Weight in kg

            // Calculate required intake (simplified version)
            const calorieIntake = calculateCalorieIntake(weight, height); // Replace with actual calculation
            const proteinIntake = calculateProteinIntake(weight); // Replace with actual calculation
            const fatIntake = calculateFatIntake(weight); // Replace with actual calculation

            // Display the calculated intake
            displayIntake(height, weight, calorieIntake, proteinIntake, fatIntake);
        },
        error: function(xhr, status, error){
            console.error(error); // Log any errors to the console
        }
    });

    // Function to calculate required calorie intake (simplified version)
    function calculateCalorieIntake(weight, height){
        return 30 * weight + 6.25 * height - 5 * 25; // Example formula (replace with actual calculation)
    }

    // Function to calculate required protein intake (simplified version)
    function calculateProteinIntake(weight){
        return 0.8 * weight; // Example formula (replace with actual calculation)
    }

    // Function to calculate required fat intake (simplified version)
    function calculateFatIntake(weight){
        return 0.3 * weight; // Example formula (replace with actual calculation)
    }

    // Function to display calculated intake
    function displayIntake(height, weight, calorieIntake, proteinIntake, fatIntake){
        const intakeDiv = $("#intake");
        const intakeContent = `
            <div class="intake-facts">
                <h3>Required Daily Intake</h3>
                <table>
                    <tr>
                        <th>Attribute</th>
                        <th>Value</th>
                    </tr>
                    <tr>
                        <td>Height</td>
                        <td>${height ? height + ' cm' : 'N/A'}</td>
                    </tr>
                    <tr>
                        <td>Weight</td>
                        <td>${weight ? weight + ' kg' : 'N/A'}</td>
                    </tr>
                    <tr>
                        <td>Calories</td>
                        <td>${calorieIntake ? calorieIntake.toFixed(2) : 'N/A'}</td>
                    </tr>
                    <tr>
                        <td>Protein</td>
                        <td>${proteinIntake ? proteinIntake.toFixed(2) + ' grams' : 'N/A'}</td>
                    </tr>
                    <tr>
                        <td>Fat</td>
                        <td>${fatIntake ? fatIntake.toFixed(2) + ' grams' : 'N/A'}</td>
                    </tr>
                </table>
            </div>
        `;
        intakeDiv.html(intakeContent);
    }
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


