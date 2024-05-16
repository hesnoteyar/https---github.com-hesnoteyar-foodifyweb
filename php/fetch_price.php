<?php
// Check if containerID is set in the POST request
if(isset($_POST['containerID'])) {
    // Database connection configuration
    $servername = "localhost";
    $username = "u381723726_root";
    $password = ";ww5|9n1Z";
    $database = "u381723726_G8CASESTUDY";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to fetch price and name based on containerID
    $containerID = $_POST['containerID'];
    $sql = "SELECT name, price FROM menu_order WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $containerID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Fetch price and name from the result set
        $row = $result->fetch_assoc();
        $price = $row['price'];
        $foodName = $row['name'];

        // Return price and name as JSON response
        echo json_encode(array('price' => $price, 'foodName' => $foodName));
    } else {
        // No rows returned, handle error or return default value
        echo json_encode(array('error' => 'Price not found'));
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    // containerID not set in the POST request
    echo json_encode(array('error' => 'containerID not set'));
}
?>
