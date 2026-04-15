
<?php 
//Jonathan Blackwood -->
// HND Software Development -->
// Schedule selection page, used to give options for managers to create or view schedules, and users to view tables -->
// 23/05/2023 -->
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser

include 'connect.php'; 
session_start();


if (!isset($_SESSION["userID"])) { // Check if the user is logged in
    header("Location: index.php");// If not, redirect
    exit();
}

$isManager = $_SESSION["isManager"];

if ($isManager) {
    // Display content for ismanager = 1
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <?php include 'header.php'; ?>
    </head>
        <body>
                <div class = "centre-container">
                    <h1>Schedule Management System</h1>
                    <button onclick="location.href='create_schedule.php'">Create Schedule</button> <!-- Button Selection for create /view -->
                    <button onclick="location.href='view_schedules.php'">View Completed Schedules</button>
                </div>
                <?php include 'footer.php'; ?>
        </body>
    </html>
    <?php
} else if (!$isManager) {
        // Display content for ismanager = 0
        // Displaying page to view schedules only for non management user
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="style/style.css">
            <?php include 'header.php'; ?>
        </head>
            <body>
                    <div class = "centre-container">
                        <h1>Schedule Viewer</h1>
                        <button onclick="location.href='view_schedules.php'">View Completed Schedules</button>
                    </div>
                    <?php include 'footer.php'; ?>
            </body>
        </html>
        <?php
} else {
    // Redirect for no user logged in
    header("Location: index.php");
    exit();
}
?>