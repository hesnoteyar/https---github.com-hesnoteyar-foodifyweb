<?php
session_start(); // Start the session

// Check if the session variables are set
if(isset($_SESSION['order_name']) && isset($_SESSION['order_price']) && isset($_SESSION['order_quantity'])) {
    // Retrieve session variables
    $orderName = $_SESSION['order_name'];
    $orderPrice = $_SESSION['order_price'];
    $orderQuantity = $_SESSION['order_quantity'];

    // Calculate the total price
    $totalPrice = $orderPrice * $orderQuantity;

    // Display the receipt
    echo "<h1>Receipt</h1>";
    echo "<p>Order Name: $orderName</p>";
    echo "<p>Order Price: $orderPrice</p>";
    echo "<p>Quantity: $orderQuantity</p>";
    echo "<p>Total Price: $totalPrice</p>";
} else {
    // Session data not found
    echo "<h1>Session data not found</h1>";
}
?>
