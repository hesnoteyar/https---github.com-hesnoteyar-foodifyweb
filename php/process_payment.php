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

echo "<script>console.log('Overall Total value:', " . json_encode($_POST['overall_total'] ?? 'Not set') . ");</script>";


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
    $orderName = "cart order"; // Set the order name to "cart order"
    $orderPrice = $_POST['total_amount']; // Retrieve total amount from form submission
    $orderQuantity = 1; // Set the order quantity to 1 (assuming it's one cart order)

    // Calculate the total price
    $totalPrice = $_POST['total_amount']; // Retrieve total amount from form submission

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

            // Delete contents of the cart_items table
            $delete_sql = "DELETE FROM cart_items";
            if ($conn->query($delete_sql) === FALSE) {
                echo "Error deleting cart items: " . $conn->error;
            }
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
