<?php
session_start();

if(isset($_SESSION['id'])) {
    echo $_SESSION['id'];
} else {
    // If user ID is not set in the session, return an error or redirect as needed
    echo "Error: User ID not found";
}
?>