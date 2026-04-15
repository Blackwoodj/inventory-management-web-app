<?php
// Jonathan Blackwood 
// HND Software Development 
// Log in include page 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
require_once "connect.php";

function validateLoginCredentials($loginField, $password) { // Define function and take in loginField and password
    global $conn;

   // SQl statement to check if there are any rows which match the log in information
    $sql = "SELECT * FROM users WHERE (username = '$loginField' OR email = '$loginField') AND password = PASSWORD('$password')";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) { // Checks if query returned one row, which means details are valid
        $row = $result->fetch_assoc();
        return $row;
    }

    return null; // If condition not met, return null
}
?>