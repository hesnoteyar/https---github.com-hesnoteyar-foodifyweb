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
} else {
    // Session data not found
    $orderName = $orderPrice = $orderQuantity = $totalPrice = null;
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="css/receipt.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>


<body>
    <div class="background">
        <img src="images\backgroundmain.jpg" alt="bg">
    </div>

    
    <div class="receipt-container">
        <?php if (isset($error) && $error): ?>
            <h1>Session data not found</h1>
        <?php else: ?>
            <h1>Receipt</h1>
            <p>Order Name: <?php echo htmlspecialchars($orderName); ?></p>
            <p>Order Price: <?php echo htmlspecialchars($orderPrice); ?></p>
            <p>Quantity: <?php echo htmlspecialchars($orderQuantity); ?></p>
            <p class="total-price">Total Price: <?php echo htmlspecialchars($totalPrice); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
