<?php 
// Jonathan Blackwood 
// HND Software Development 
// Update staff page, used to create selection for staff member, then use SQL to date new data and update database with new staff details 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser

include 'connect.php';
session_start();
$isManager = $_SESSION["isManager"];

if ($isManager) { // Display content for ismanager = 1
    
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style/style.css">
  <?php include 'header.php'; ?>
</head>
<body>
<?php

include "classes.php";

// SQL statement to get staffID, fname, and lname from staff table
$query = "SELECT staffID, fname, lname FROM staff";
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}

// Create a dropdown list of staff members
echo '<div class="centre-top-container">';
echo "<form action='update_staff.php' method='post'>";
echo "<select name='staffID'>";

while ($row = mysqli_fetch_assoc($result)) { // While loop to display staff members first name last name
    echo "<option value='" . $row['staffID'] . "'>" . $row['fname'] . " " . $row['lname'] . "</option>";
}

echo "</select>";
echo "<input type='submit' value='Select'>";
echo "</form>";
echo '</div>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Handle form submission
    if (!isset($_POST['staffID'])) {// If statement to check if staffID selected
        echo "Error: Staff ID not selected.";
        exit();
    }
    $selectedStaffID = $_POST['staffID'];

    // Fetch the staff member's data from the database
    $query = "SELECT * FROM staff WHERE staffID = '$selectedStaffID'";
    $result = mysqli_query($conn, $query); // Execute SQL query

    // Check for query errors
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    $staff = new Staff(); // Create a Staff object

    if ($row = mysqli_fetch_assoc($result)) { // If statement for if $result from SQL statement returns values
        $staff->setFname($row['fname']);
        $staff->setLname($row['lname']);
        $staff->setAge($row['age']);
        $staff->setRole($row['role']);
        $staff->setWage($row['wage']); // Assigns staff values using setters
        // Form to display with values already assigned from database
        echo "<form class='staff-form' action='includes/update_staff.inc.php' method='post'>";
        echo "<input type='hidden' name='staffID' value='" . $selectedStaffID . "'>";
        echo "First Name: <input type='text' name='fname' value='" . $staff->getFname() . "'><br>";
        echo "Last Name: <input type='text' name='lname' value='" . $staff->getLname() . "'><br>";
        echo "Age: <input type='text' name='age' value='" . $staff->getAge() . "'><br>";
        echo "Role: <input type='text' name='role' value='" . $staff->getRole() . "'><br>";
        echo "Wage: <input type='text' name='wage' value='" . $staff->getWage() . "'><br>"; // Auto populates values in using getters
        echo "<input type='submit' value='Update'>";
        echo "</form>";
    } else {
        echo "Staff member not found.";
    }
}

?>
<?php include 'footer.php'; ?>
</body>
</html>
<?php }
else {
    // Redirect for ismanager = 0
    header("Location: index.php");
    exit();
} ?>