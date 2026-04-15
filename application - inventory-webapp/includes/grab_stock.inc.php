<?php
// Jonathan Blackwood 
// HND Software Development 
// Grab stock include page 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
include '../connect.php';

$query = "SELECT * FROM stock"; // Select statement to select all from stock
$result = mysqli_query($conn, $query); // Stores result in $result

if (mysqli_num_rows($result) > 0) { // If statement to check if results from database query return any rows
    while ($row = mysqli_fetch_assoc($result)) { // Assigns $result to rows for each table column
        echo "<tr>";
        echo "<td>" . $row['itemname'] . "</td>";
        echo "<td>" . $row['volume'] . "</td>";
        echo "<td>" . $row['unit'] . "</td>";
        echo "<td>£" . $row['price'] . "</td>";
        echo "<td>" . $row['suppliercode'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found.</td></tr>"; // Else for if no records found
}

mysqli_close($conn); // Close the connection
?>
