<?php
// Check if containerID is set in the POST request
if(isset($_POST['containerID'])) {
    // Database connection configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "G8CASESTUDY";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to fetch price based on containerID
    $containerID = $_POST['containerID'];
    $sql = "SELECT price FROM menu_order WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $containerID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Fetch price from the result set
        $row = $result->fetch_assoc();
        $price = $row['price'];

        // Return price as JSON response
        echo json_encode(array('price' => $price));
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