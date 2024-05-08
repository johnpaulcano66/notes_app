<?php
// login.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming the form field for username is named 'username' and for password is 'password'
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Include database configuration file
    require_once 'db_config.php'; // Adjust the path as necessary

    // Create a connection to the MySQL database
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE,);

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select the user by username
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, start new session
                $_SESSION['user_id'] = $id;
                header("Location: dashboard.php"); // Redirect to dashboard
                exit(); // It's important to call exit() after a header redirect
            } else {
                // Password is not correct
                echo "Invalid username or password.";
            }
        } else {
            // No user found with that username
            echo "Invalid username or password.";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }

    $conn->close();
}
?>
