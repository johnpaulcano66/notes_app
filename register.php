<?php
// Include database configuration file
require_once 'db_config.php';

// Initialize variables
$username = $password = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are set
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Sanitize user input to prevent SQL injection
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Always hash passwords before storing them
        $password = password_hash($password, PASSWORD_DEFAULT);

        // SQL to insert a new user
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ss", $username, $password);
            if ($stmt->execute()) {
                echo "Registered successfully";
            } else {
                $error = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error = "Failed to prepare the SQL statement.";
        }
    } else {
        $error = "Username or password not provided.";
    }
}

// Close the database connection
$conn->close();
?>
