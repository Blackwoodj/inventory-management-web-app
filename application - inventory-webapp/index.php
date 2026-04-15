<?php
// Jonathan Blackwood 
// HND Software Development 
// Index, or front page, used to display welcome message to users already logged in, or provide log in section if not 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
include 'connect.php';

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (isset($_SESSION["userID"])) {
    // User is logged in, show welcome message and redirect button
    $username = $_SESSION["username"];
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <title>Welcome</title>
        <?php include 'header.php'; ?>
    </head>
    <body>
        <div class="centre-container">
            <div class="welcome-message">
                <h1>Welcome, <?php echo $username; ?></h1>
                <p>Please continue to the rota page.</p>
                <button onclick="location.href='rota.php'">Continue</button>
            </div>
        </div>
    </body>
    </html>

    <?php
} else {
    // User is not logged in, show login form
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <title>Login</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <!-- Log in form which stores data to be sent to js file -->
        <div class="centre-container"> 
            <div class="login-form">
                <h1>Login</h1>
                <form id="loginForm">
                    <label for="loginField">Username:</label>
                    <input type="text" id="loginField" name="loginField" required><br>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br>

                    <input type="submit" value="Login">
                </form>
            </div>
        </div>
        <!-- Script to handle log in -->
        <script src="javascript/login.js"></script>
        <?php include 'footer.php'; ?>
    </body>
    </html>

    <?php
}
?>