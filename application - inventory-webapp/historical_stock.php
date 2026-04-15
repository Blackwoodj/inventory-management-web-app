
<?php 
// Jonathan Blackwood 
// HND Software Development 
// Classes page 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <title>Historical Stock Changes</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <?php

    // SQL query to fetch data from tables using alias sh. for stock_history and s for stock, 
    $query = "SELECT sh.*, s.itemname, s.volume, s.unit, s.price, s.suppliercode, s.description
              FROM stock_history sh
              INNER JOIN stock s ON sh.itemID = s.itemID";
    $result = mysqli_query($conn, $query); // Execute SQL query

    
    if (mysqli_num_rows($result) > 0) { // Checking if any records are returned
        echo "<div class='table-container'>";
        echo "<table class='stock-table'>";
        echo "<tr>
                <th>Item Name</th>
                <th>Volume</th>
                <th>Unit</th>
                <th>Old Quantity</th>
                <th>New Quantity</th>
                <th>Quantity Change</th>
                <th>Price</th>
                <th>Supplier Code</th>
                <th>Description</th>
                <th>Date of change</th>
              </tr>";

        
        while ($row = mysqli_fetch_assoc($result)) { // While to loop through data for each stock item
            echo "<tr>";
            echo "<td>" . $row['itemname'] . "</td>";
            echo "<td>" . $row['volume'] . "</td>";
            echo "<td>" . $row['unit'] . "</td>";
            echo "<td>" . $row['old_quantity'] . "</td>";
            echo "<td>" . $row['new_quantity'] . "</td>";
            echo "<td>" . $row['quantity_change'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['suppliercode'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['timestamp'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    } else {
        echo "No records found."; // error check for if no records found
    }

    mysqli_close($conn); // Close database connection
    ?>

    <?php include 'footer.php'; ?>
    
</body>
</html>