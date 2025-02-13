<?php
session_start();
include('db.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all messages from the database
$query = "SELECT m.message, m.created_at, u.username FROM messages m 
          JOIN users u ON m.user_id = u.user_id ORDER BY m.created_at ASC";
$result = $conn->query($query);

// Handle message submission via AJAX
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $message = $conn->real_escape_string($_POST['message']);
    $user_id = $_SESSION['user_id'];

    // Insert the message into the database
    $query = "INSERT INTO messages (user_id, message) VALUES ('$user_id', '$message')";
    if ($conn->query($query) === TRUE) {
        echo "Message sent";  // Respond to AJAX with success
    } else {
        echo "Error: " . $conn->error;
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>

    <!-- Link to CSS file -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div id="chat-container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

    <!-- Display the chat messages -->
    <div id="chat-box">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <p><strong><?php echo $row['username']; ?>:</strong> <?php echo $row['message']; ?>
               <span><?php echo $row['created_at']; ?></span></p>
        <?php } ?>
    </div>

    <!-- Form to send a new message -->
    <form method="POST" action="chat.php">
        <input type="text" name="message" required>
        <button type="submit">Send</button>
    </form>
</div>

<!-- Link to JS file -->
<script src="assets/js/chat.js"></script>

</body>
</html>
