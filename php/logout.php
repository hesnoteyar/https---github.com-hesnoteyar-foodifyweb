<?php
// logout.php

session_start(); // Start the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Optionally, you can redirect to the login page or homepage
header("Location: ../index.html"); // Replace with your login page or homepage
exit();
?>
