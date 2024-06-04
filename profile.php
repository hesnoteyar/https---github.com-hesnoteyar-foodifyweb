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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    <a href="#" id="profileLink">Profile</a>
                    <a href="history.php">History</a>
                    <a href="order.php">Order</a>
                    <a href="cart.php">Cart</a>
                    <a href="mealprep.php">Meal Prep</a>
                    <a href="#" id="logoutLink">Logout</a>
                </div>
            </ul>
        </nav>
    </header>

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

        // Prepare and execute SQL query to retrieve user data
        $sql = "SELECT username, email, firstname, middlename, lastname, age, house, barangay, region, postal, phone, height, weight FROM users WHERE id = $id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Output data
            while($row = $result->fetch_assoc()) {
                // Output user profile data
                echo "<div class='profile-info'>";
                echo "<h2>User Profile</h2>";
                echo "<div class='profile-item'><div class='label'>Username:</div><div class='value-container'><div class='value'>".$row["username"]."</div><input type='text' class='edit-value' name='username' value='".$row["username"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>Email:</div><div class='value-container'><div class='value'>".$row["email"]."</div><input type='email' class='edit-value' name='email' value='".$row["email"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>First Name:</div><div class='value-container'><div class='value'>".$row["firstname"]."</div><input type='text' class='edit-value' name='firstname' value='".$row["firstname"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>Middle Name:</div><div class='value-container'><div class='value'>".$row["middlename"]."</div><input type='text' class='edit-value' name='middlename' value='".$row["middlename"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>Last Name:</div><div class='value-container'><div class='value'>".$row["lastname"]."</div><input type='text' class='edit-value' name='lastname' value='".$row["lastname"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>Age:</div><div class='value-container'><div class='value'>".$row["age"]."</div><input type='number' class='edit-value' name='age' value='".$row["age"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>House No., Building, St. Name:</div><div class='value-container'><div class='value'>".$row["house"]."</div><input type='text' class='edit-value' name='house' value='".$row["house"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>Barangay, City:</div><div class='value-container'><div class='value'>".$row["barangay"]."</div><input type='text' class='edit-value' name='barangay' value='".$row["barangay"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>Region, Province:</div><div class='value-container'><div class='value'>".$row["region"]."</div><input type='text' class='edit-value' name='region' value='".$row["region"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>Postal Code:</div><div class='value-container'><div class='value'>".$row["postal"]."</div><input type='text' class='edit-value' name='postal' value='".$row["postal"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>Phone Number:</div><div class='value-container'><div class='value'>".$row["phone"]."</div><input type='text' class='edit-value' name='phone' value='".$row["phone"]."' /></div></div>";
                echo "<div class='profile-item'><div class='label'>Height:</div><div class='value-container'><div class='value'>".$row["height"]."</div><input type='number' class='edit-value' name='height' value='".$row["height"]."' /><div class='unit'>cm</div></div></div>";
                echo "<div class='profile-item'><div class='label'>Weight:</div><div class='value-container'><div class='value'>".$row["weight"]."</div><input type='number' class='edit-value' name='weight' value='".$row["weight"]."' /><div class='unit'>kg</div></div></div>";
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

    <div class="edit-buttons">
        <button id="editButton">Edit</button>
        <button id="saveButton" style="display: none;">Save</button>
    </div>

    <script>
    $(document).ready(function() {
    // Store original values
    var originalValues = {};
    $(".edit-value").each(function() {
        var fieldName = $(this).attr('name');
        originalValues[fieldName] = $(this).val();
    });

    $(".edit-value").hide(); // Initially hide the edit fields

    $("#editButton").click(function() {
        $(".value").hide();
        $(".edit-value").show();
        $("#editButton").hide();
        $("#saveButton").show();
    });

    $("#saveButton").click(function() {
    var formData = {
        id: <?php echo $id; ?>
    };

    // Add all fields to formData
    $(".edit-value").each(function() {
        var fieldName = $(this).attr('name');
        formData[fieldName] = $(this).val();
    });

    $.ajax({
        url: "php/update_profile.php",
        type: "POST",
        data: formData,
        success: function(response) {
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error("Update failed:", error);
        }
    });
});

    $("#logoutLink").click(function(e) {
        e.preventDefault(); // Prevent default link behavior

        // AJAX request to logout
        $.ajax({
            url: "php/logout.php", // Replace with your PHP file to handle logout
            type: "POST",
            success: function(response) {
                // Redirect to the login page or homepage
                window.location.href = "index.html"; // Replace with your login page or homepage
            },
            error: function(xhr, status, error) {
                console.error("Logout failed:", error); // Log any errors to the console
            }
        });
    });
});
    </script>
</body>
</html>
