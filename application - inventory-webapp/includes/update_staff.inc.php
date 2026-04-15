<!-- Jonathan Blackwood -->
<!-- HND Software Development -->
<!-- Update staff include page -->
<!-- 23/05/2023 -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<?php
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
include "../connect.php"; 
include "../classes.php";

// Get the form data
if (!isset($_POST['staffID'], $_POST['lname'], $_POST['age'], $_POST['role'], $_POST['wage'])) { // Check if any data has been left out the form
    echo "Error: Required form fields missing."; // Error display if yes
    exit();
}

$staffID = $_POST['staffID']; // Assign staffID from post to $staffID
$lname = $_POST['lname'];   // Assign lname from post to $lname
$age = $_POST['age'];   //Assign age from post to $age 
$role = $_POST['role']; //Assign role from post to $role
$wage = $_POST['wage']; //Assign wage from post to $wage

// Update the staff member's data in the database
$query = "UPDATE staff SET lname='$lname', age='$age', role='$role', wage='$wage' WHERE staffID='$staffID'"; // SQL query to set all data in the database to that from post
$result = mysqli_query($conn, $query); // Execute SQL query

if ($result) { // Check for query errors
    echo "Staff member data updated successfully.";
} else {
    echo "Error: " . mysqli_error($conn); // Error if any query errors
}
?>
<body>
    <button onclick="window.location.href = '../update_staff.php';">Edit Another User</button> <!-- Options to edit further or return -->
    <button onclick="window.location.href = '../rota.php';">Return</button>
</body>
</html>
