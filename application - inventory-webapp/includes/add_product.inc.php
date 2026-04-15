<?php
// Jonathan Blackwood 
// HND Software Development 
// Add products include page 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
include '../connect.php';

if (isset($_POST['submit'])) { // If statement for post submission
  $itemname = $_POST['itemname']; // Assigns post values to their $value counterpart
  $volume = $_POST['volume'];
  $unit = $_POST['unit'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $suppliercode = $_POST['suppliercode'];
  $description = $_POST['description'];

  // If statement to check if any of the values entered are empty
  if (empty($itemname) || empty($volume) || empty($unit) || empty($quantity) || empty($price) || empty($suppliercode)) {
    echo "Please fill in all required fields."; // Error message if they are empty
    exit; // Stop further execution
  }
  //SQL query to insert values from $values into stock table
  $sql = "INSERT INTO stock (itemname, volume, unit, quantity, price, suppliercode, description) 
          VALUES ('$itemname', '$volume', '$unit', '$quantity', '$price', '$suppliercode', '$description')";

  $result = mysqli_query($conn, $sql);  // Execute the SQL query

  if ($result) {
    echo "Data inserted successfully";
    echo '<br><button onclick="location.href=\'../add_product.php\'">Go Back to Add Product</button>'; // Button to allow multiple products to be added
    echo '<br><button onclick="location.href=\'../stock.php\'">Go Back to Stock Page</button>'; // Button to go back to stock page
  } else {
    echo "Error inserting data: " . mysqli_error($conn);
  }
}
?>