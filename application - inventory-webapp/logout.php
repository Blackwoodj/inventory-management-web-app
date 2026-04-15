<?php
// Jonathan Blackwood 
// HND Software Development 
// Log out page, used with AJAX to log the user out 
// 23/05/2023 

error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser

// Start the session (if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    // User is not logged in, redirect to the login page
    header("Location: index.php");
    exit();
}

// Handle logout
if (isset($_GET["logout"])) {
    // Clear all session data
    session_unset();
    session_destroy();

    // Send JSON response indicating successful logout
    header("Content-Type: application/json");
    echo json_encode(array("success" => true));
    exit();
}
?>

<!DOCTYPE html> <!-- HTML page to confirm log out -->
<html>
<head>
    <title>Log out?</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <?php include 'header.php'; ?>
</head>
<body>
<div class="centre-container">
        <h1>Logout</h1>
        <p>Are you sure you want to log out?</p>
        <button id="logoutButton">Yes, Log out</button>
    </div>
    <script src="javascript/logout.js"></script>
    <?php include 'footer.php'; ?>
</body>
</html>
