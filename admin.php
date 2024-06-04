<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['id']) || $_SESSION['id'] !== 'admin') {
    header("Location: /"); // Redirect to the homepage if not admin
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Foodify Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="css/admin.css">
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

            <ul class="right-links">
                <li><a href="#" id="logoutLink">Logout</a> <!-- Logout link with ID for JavaScript -->
            </ul>
        </nav>

        <div class="row banner">
            <div class="banner-room">
                <img class="imagehome" src="images/homepageimg.png" alt="image">
                <h1>Admin Panel
                    <br>Manage Foodify
                </h1>
            </div>
        </div>
    </header>

    <section id="admin-panel">
        <div class="center">
            <section id="admin-panel">
    <div class="center">
        <h1>Welcome, Admin</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Log ID</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Browser Used</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to the database
                $servername = "localhost";
                $username = "u381723726_root";
                $password = ";ww5|9n1Z";
                $database = "u381723726_G8CASESTUDY";
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch data from user_logs table
                $sql = "SELECT * FROM user_logs";
                $result = $conn->query($sql);

                // Check if there are rows in the result
                if ($result->num_rows > 0) {
                    // Loop through each row of the result
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["log_id"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["browser_used"] . "</td>";
                        echo "<td>" . $row["login_time"] . "</td>";
                        echo "<td>" . $row["logout_time"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</section>
        </div>
        <!-- Add admin functionalities here -->
    </section>

    <footer>
        <!-- Footer content if any -->
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
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
