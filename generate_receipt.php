<?php
session_start(); // Start the session

// Check if data is set in the POST request
if(isset($_POST['quantity']) && isset($_POST['foodName']) && isset($_POST['totalAmount'])) {
    // Log received data
    $logMessage = date('Y-m-d H:i:s'). " - Received data: Quantity: ". $_POST['quantity']. ", Food Name: ". $_POST['foodName']. ", Total Amount: ". $_POST['totalAmount']. "\n";
    file_put_contents('receipt_log.txt', $logMessage, FILE_APPEND);

    // Retrieve data
    $quantity = $_POST['quantity'];
    $foodName = $_POST['foodName'];
    $totalAmount = $_POST['totalAmount'];

    // Set session variables
    $_SESSION['order_name'] = $foodName;
    $_SESSION['order_price'] = $totalAmount;
    $_SESSION['order_quantity'] = $quantity;

    // Redirect to receipt.php
    header('Location: receipt.php');
    exit(); // Ensure no further code is executed
} else {
    // Data not set in the POST request
    echo "Error: Data not received.";
}
?>
