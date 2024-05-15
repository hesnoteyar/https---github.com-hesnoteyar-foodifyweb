<?php
session_start(); // Start the session

// Check if the session variables are set
if(isset($_SESSION['order_name']) && isset($_SESSION['order_price']) && isset($_SESSION['order_quantity'])) {
    // Retrieve session variables using JavaScript from sessionStorage
    echo "<script>";
    echo "var orderName = sessionStorage.getItem('order_name');";
    echo "var orderPrice = sessionStorage.getItem('order_price');";
    echo "var orderQuantity = sessionStorage.getItem('order_quantity');";
    echo "</script>";

    // Calculate the total price
    echo "<script>";
    echo "var totalPrice = orderPrice * orderQuantity;";
    echo "</script>";

    // Display the receipt using JavaScript
    echo "<h1>Receipt</h1>";
    echo "<p>Order Name: <span id='orderName'></span></p>";
    echo "<p>Order Price: <span id='orderPrice'></span></p>";
    echo "<p>Quantity: <span id='orderQuantity'></span></p>";
    echo "<p>Total Price: <span id='totalPrice'></span></p>";

    // JavaScript to populate receipt details
    echo "<script>";
    echo "document.getElementById('orderName').innerText = orderName;";
    echo "document.getElementById('orderPrice').innerText = orderPrice;";
    echo "document.getElementById('orderQuantity').innerText = orderQuantity;";
    echo "document.getElementById('totalPrice').innerText = totalPrice;";
    echo "</script>";
} else {
    // Session data not found
    echo "<h1>Session data not found</h1>";
}
?>
