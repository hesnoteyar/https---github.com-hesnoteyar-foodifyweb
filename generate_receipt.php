<?php
// Check if data is set in the POST request
if(isset($_POST['quantity']) && isset($_POST['foodName']) && isset($_POST['totalAmount'])) {
    // Log received data
    $logMessage = date('Y-m-d H:i:s'). " - Received data: Quantity: ". $_POST['quantity']. ", Food Name: ". $_POST['foodName']. ", Total Amount: ". $_POST['totalAmount']. "\n";
    file_put_contents('receipt_log.txt', $logMessage, FILE_APPEND);

    // Retrieve data
    $quantity = $_POST['quantity'];
    $foodName = $_POST['foodName'];
    $totalAmount = $_POST['totalAmount'];

    // Generate receipt data
    $receiptData = array(
        'price' => $totalAmount, // or calculate the price based on quantity and foodName
        'foodName' => $foodName,
        'quantity' => $quantity
    );

    // Output JSON data
    echo json_encode($receiptData);
} else {
    // Data not set in the POST request
    echo "Error: Data not received.";
}
?>