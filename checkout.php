<?php

$total_amount = $_POST['overall_total'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/checkout.css">

    <script>
    console.log('Overall Total:', <?php echo json_encode($_POST['overall_total'] ?? 'Not set'); ?>);
    </script>
    
</head>
<body>

<div class="background">
    <img src="images\backgroundmain.jpg" alt="bg">
</div>

<nav>
    <img src="images/headerleft.png" alt="Logo">
    <ul class="dropdown">
        <button class="dropdownbtn">Menu<i class="ri-arrow-down-s-line"></i></button>
        <div class="dropdown-content">
            <a href="home.php">Home</a>
            <a href="#" id="profileLink">Profile</a> <!-- Profile link with ID for JavaScript -->
            <a href="history.php">History</a>
            <a href="order.php">Order</a>
            <a href="">Cart</a>
            <a href="mealprep.php">Meal Prep</a>
            <a href="#" id="logoutLink">Logout</a> <!-- Logout link with ID for JavaScript -->
        </div>
    </ul>
</nav>

<div class="checkout-container">
    <h1>Checkout</h1>
    <p>Total Amount: ₱<?php echo $total_amount; ?></p>

    <!-- Form for room number and payment method -->
<form action="php/process_payment.php" method="post">
    <div class="checkout-input">
        <label for="room_number">Room Number:</label>
        <input type="number" id="room_number" name="room_number" required>
    </div>
    <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>"> <!-- Add hidden input field for total_amount -->
    <div class="payment-buttons">
        <button type="submit" name="payment_method" value="cash">Pay with Cash</button>
    </div>

    
</form>
</div>

</body>
</html>
