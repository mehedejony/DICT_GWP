<?php
// Database connection parameters
$host = "your_host";  // usually "localhost"
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_id']) && $_POST['form_id'] == 'login_form') {
    // Retrieve user input
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    // Sanitize user input to prevent SQL injection (you should use prepared statements for better security)
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query to check user credentials
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        echo "Login successful!";
        // You can redirect or perform other actions after successful login
    } else {
        echo "Login failed. Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>
