<?php
session_start();

$servername = "localhost";
$username = "u381723726_root";
$password = ";ww5|9n1Z";
$database = "u381723726_G8CASESTUDY";

// Establish connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create user_logs table if it doesn't exist
$create_table_sql = "CREATE TABLE IF NOT EXISTS user_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    username VARCHAR(255) NOT NULL,
    browser_used VARCHAR(255) NOT NULL,
    login_time DATETIME NOT NULL,
    logout_time DATETIME
)";

if ($conn->query($create_table_sql) === TRUE) {
    echo "user_logs table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$email = $_POST['email'];
$password = $_POST['password'];

// Check for admin credentials first
if ($email == 'root' && $password == 'admin') {
    // Set session for admin
    $_SESSION['id'] = 'admin';
    
    // Redirect to admin.php
    header("Location: /admin.php");
    exit();
} else {
    // Regular user login
    $sql = "SELECT id, username FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user details
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $username = $row['username'];

        // Set session ID
        $_SESSION['id'] = $id;

        // Insert log into user_logs table
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $login_time = date('Y-m-d H:i:s');
        $insert_log_sql = "INSERT INTO user_logs (user_id, username, browser_used, login_time) 
                           VALUES ('$id', '$username', '$browser', '$login_time')";
        if ($conn->query($insert_log_sql) === TRUE) {
            // Redirect to home.php
            header("Location: /home.php");
            exit();
        } else {
            echo "Error inserting log: " . $conn->error;
        }
    } else {
        echo "Invalid email or password";
    }
}

$conn->close();
?>
