<?php

// Database connection parameters
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

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS menu_order (
    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    price INT(10) NOT NULL
)";

// Execute SQL query to create table
if ($conn->query($sql) === TRUE) {
    // Insert initial data into the table
    $initialData = array(
        array('Food1', 'Siomai', 45),
        array('Food2', 'Adobo', 70),
        array('Food3', 'Mechado', 65),
        array('Food4', 'Paksiw', 55),
        array('Food5', 'Pakbet', 75)
    );

    foreach ($initialData as $data) {
        $id = $data[0];
        $name = $data[1];
        $price = $data[2];

        // SQL to insert data into the table
        $sql = "INSERT INTO menu_order (ID, name, price) VALUES ('$id', '$name', '$price')";

        // Execute SQL query to insert data
        if ($conn->query($sql) !== TRUE) {
            echo "Error inserting data: " . $conn->error;
        }
    }

    echo "Table menu_order created successfully and initial data inserted.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();

?>
