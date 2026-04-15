
<?php
// Jonathan Blackwood 
// HND Software Development 
// Update stock page, containing form and SQl for updating stock amounts within database 
// 23/05/2023 
include 'connect.php'; 
session_start();
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser


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
    <?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <title>Stock Table</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <?php

    // Handling form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newQuantities = $_POST['new_quantity'];
    

foreach ($newQuantities as $qn => $newQuantity) {
    $itemId = $_POST['item_id'][$qn]; 

    // Retrieve the item name and the old quantity from the stock table
    $query = "SELECT itemname, quantity FROM stock WHERE itemID = $itemId";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $itemName = $row['itemname'];
    $oldQuantity = intval($row['quantity']); // Convert to integer

    // Validate if the new quantity is an integer
    if (!is_numeric($newQuantity) || intval($newQuantity) != $newQuantity) {
        echo "Invalid quantity input for item: $itemName";
        continue; // Skip to the next iteration
    }

    $quantityChange = intval($newQuantity) - $oldQuantity; // Calculate the quantity change and convert to int

    // SQL query to add data into stock table
    $updateQuery = "UPDATE stock SET quantity = $newQuantity, quantity_change = $quantityChange WHERE itemID = $itemId";
    mysqli_query($conn, $updateQuery); // Execute SQL query

    $timestamp = date('Y-m-d H:i:s'); // Get the current date and time

    // SQL query to add data to stock_history for viewing historical changes
    $insertQuery = "INSERT INTO stock_history (itemID, old_quantity, new_quantity, quantity_change, timestamp)
                   VALUES ('$itemId', '$oldQuantity', '$newQuantity', '$quantityChange', '$timestamp')";
    mysqli_query($conn, $insertQuery); // Execute SQL query
}

    }

    // SQL statement to select all from stock then execute
    $query = "SELECT * FROM stock";
    $result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) { // Checking if any records are returned
    echo "<form method='POST'>";
    echo "<div class='table-container'>";
    echo "<table class='stock-table'>";
    echo "<tr>
            <th>Item Name</th>
            <th>Volume</th>
            <th>Unit</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Supplier Code</th>
            <th>Description</th>
            <th>New Quantity</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) { // Looping through the records and displaying them in table rows
        echo "<tr>";
        echo "<td>" . $row['itemname'] . "</td>";
        echo "<td>" . $row['volume'] . "</td>";
        echo "<td>" . $row['unit'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['suppliercode'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td><input type='number' name='new_quantity[]' value='" . $row['quantity'] . "'></td>";
        echo "<input type='hidden' name='item_id[]' value='" . $row['itemID'] . "'>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
    echo "<div class='submit-container'>";
    echo "<button class='submit-button' type='submit'>Update Quantities</button>";
    echo "</div>";
    echo "</form>";
    include 'footer.php';
} else {
    echo "No records found.";
}

} else {
    // Redirect for ismanager = 0
    header("Location: index.php");
    exit();
}
?>