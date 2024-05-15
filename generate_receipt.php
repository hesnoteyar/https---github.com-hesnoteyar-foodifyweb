<?php
// Check if data is set in the POST request
if(isset($_POST['quantity']) && isset($_POST['foodName']) && isset($_POST['totalAmount'])) {
    // Log received data
    $logMessage = date('Y-m-d H:i:s') . " - Received data: Quantity: " . $_POST['quantity'] . ", Food Name: " . $_POST['foodName'] . ", Total Amount: " . $_POST['totalAmount'] . "\n";
    file_put_contents('receipt_log.txt', $logMessage, FILE_APPEND);

    // Retrieve data
    $quantity = $_POST['quantity'];
    $foodName = $_POST['foodName'];
    $totalAmount = $_POST['totalAmount'];

    // Generate receipt HTML
    $receiptHTML = "<h1>Receipt</h1>";
    $receiptHTML .= "<p>Food: $foodName</p>";
    $receiptHTML .= "<p>Quantity: $quantity</p>";
    $receiptHTML .= "<p>Total Amount: $totalAmount</p>";

    // Output the receipt HTML
    echo $receiptHTML;
} else {
    // Data not set in the POST request
    echo "Error: Data not received.";
}
?>
