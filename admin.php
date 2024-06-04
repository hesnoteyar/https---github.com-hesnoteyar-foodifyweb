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
                <li><a href="logout.php">Logout</a></li>
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
            <h1>Welcome, Admin</h1>
            <p>Here you can manage the website content and users.</p>
        </div>
        <!-- Add admin functionalities here -->
    </section>

    <footer>
        <!-- Footer content if any -->
    </footer>

    <script src="js/admin.js"></script>
</body>
</html>
