<?php
session_start(); // Start the session

// Include database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "G8CASESTUDY";

// Check if the session variable for user ID is set
if(isset($_SESSION['id'])) {
    // Retrieve the user ID from the session
    $userID = $_SESSION['id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to insert item into cart
    function insertCartItem($conn) {
        global $userID;

        // Check if data is set in the POST request
        if(isset($_POST['quantity']) && isset($_POST['foodName']) && isset($_POST['totalAmount'])) {
            // Retrieve data
            $quantity = $_POST['quantity'];
            $foodName = $_POST['foodName'];
            $totalAmount = $_POST['totalAmount'];

            // Prepare and execute SQL query to insert item into cart
            $stmt = $conn->prepare("INSERT INTO cart_items (user_id, food_name, quantity, total_amount) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isii", $userID, $foodName, $quantity, $totalAmount);

            if ($stmt->execute() === TRUE) {
                // Item added to cart successfully
                echo "Item added to cart successfully.";
            } else {
                // Error adding item to cart
                echo "Error: " . $conn->error;
            }

            // Close statement
            $stmt->close();
        } else {
            // Data not set in the POST request
            echo "Error: Data not received.";
        }
    }

    // Check if the table already exists
    $tableExistsQuery = "SHOW TABLES LIKE 'cart_items'";
    $tableExistsResult = $conn->query($tableExistsQuery);

    if ($tableExistsResult->num_rows == 0) {
        // Table does not exist, create it
        $createTableQuery = "CREATE TABLE cart_items (
            ID INT(11) AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) NOT NULL,
            food_name VARCHAR(255) NOT NULL,
            quantity INT(11) NOT NULL,
            total_amount INT(11) NOT NULL
        )";

        if ($conn->query($createTableQuery) === TRUE) {
            // Table created successfully, insert data
            insertCartItem($conn);
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } else {
        // Table already exists, insert data
        insertCartItem($conn);
    }

    // Close connection
    $conn->close();
} else {
    // User ID not set in session
    echo "Error: User ID not found.";
}
?>
