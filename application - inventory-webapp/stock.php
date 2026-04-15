<?php 
// Jonathan Blackwood 
// HND Software Development 
// Stock page, used as navigation page for user to select which section of the stock functionality they would like to use 
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
      <link rel="stylesheet" type="text/css" href="style/style.css">
      <?php include 'header.php'; ?>
    </head>
      <body>
        <div class = "centre-container">
        <h1>Stock Management System</h1>
          <button onclick="location.href='add_product.php'">Add Product</button> <!-- Navigation for stock section -->
          <button onclick="location.href='update_stock.php'">Update Stock</button>
          <button onclick="location.href='view_stock.php'">View Stock</button>
          <button onclick="location.href='historical_stock.php'">View Historical Updates</button>
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