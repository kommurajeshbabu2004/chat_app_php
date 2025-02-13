<?php
include('db.php');  // Include the database connection

session_start(); // Start the session for the logged-in user

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            header("Location: chat.php"); // Redirect to the chat page
            exit();
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "No user found with that username.";
    }
}
?>

<!-- HTML Form for Login -->
<form method="POST" action="login.php">
    <label for="username">Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>
