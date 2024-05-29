<?php
session_start(); // Start the session

// Database connection details
$servername = "localhost";
$username = "u381723726_root";
$password = ";ww5|9n1Z";
$dbname = "u381723726_G8CASESTUDY";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user ID from the session
$userID = null;
if(isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
} else {
    // If user ID is not set in the session, return an error or redirect as needed
    echo "Error: User ID not found";
}

// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS transactions (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,  -- Add user_id field to store the user ID
    order_name VARCHAR(255) NOT NULL,
    order_price FLOAT NOT NULL,
    order_quantity INT(6) NOT NULL,
    total_price FLOAT NOT NULL,
    room_number INT(6) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Check if the session variables are set and user ID is retrieved
if($userID) {
    // Retrieve session variables
    $orderName = isset($_SESSION['order_name']) ? $_SESSION['order_name'] : null;
    $orderPrice = isset($_SESSION['order_price']) ? $_SESSION['order_price'] : null;
    $orderQuantity = isset($_SESSION['order_quantity']) ? $_SESSION['order_quantity'] : null;

    // Calculate the total price
    $totalPrice = $orderPrice;

    // Check if the form is submitted and payment method is set
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payment_method']) && isset($_POST['room_number'])) {
        // Retrieve session variables
        if ($orderName && $orderPrice && $orderQuantity) {
            $roomNumber = intval($_POST['room_number']);
            $paymentMethod = $_POST['payment_method'];

            // Insert data into table
            $stmt = $conn->prepare("INSERT INTO transactions (user_id, order_name, order_price, order_quantity, total_price, room_number, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isdiids", $userID, $orderName, $orderPrice, $orderQuantity, $totalPrice, $roomNumber, $paymentMethod);

            if ($stmt->execute() === TRUE) {
                echo '<script>alert("Kindly wait for your food to arrive!")</script>';
                echo '<script>window.location.href = "/home.php";</script>';
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Session data not found";
        }
    }
} else {
    // User ID not set in session
    echo "Error: User ID not found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="css/receipt.css?version=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background">
        <img src="images/backgroundmain.jpg" alt="bg">
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

            <form action="" method="post">
                <div class="delivery-input">
                    <label for="room_number">Deliver to: </label>
                    <input type="number" id="room_number" name="room_number" required>
                </div>
                <div class="payment-buttons">
                    <button type="submit" name="payment_method" value="cash">Pay with Cash</button>
                    <button type="submit" name="payment_method" value="cash">Pay with Points</button>

                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
