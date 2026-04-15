<?php 
// Jonathan Blackwood 
// HND Software Development 
// View stock page, executes grab_stock and displays current stocks levels for user
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser

include 'connect.php'; 
session_start();

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    // User is not logged in, redirect to the login page
    header("Location: index.php");
    exit();
}

$isManager = $_SESSION["isManager"];

if ($isManager) {
    // Display content for ismanager = 1
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Stock Table</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="javascript/grab_stock.js"></script>
    <?php include 'header.php'; ?>
</head>
<body>
<div class="table-container">
    <table id="stockTable" class="stock-table"> <!-- Table for stock items -->
        <tr>
            <th>Item Name</th>
            <th>Volume</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Supplier Code</th>
            <th>Description</th>
            <th>Quantity currently held</th>
        </tr>
    </table>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
<?php
} else {
    // Redirect for ismanager = 0
    header("Location: index.php");
    exit();
}
?>