<?php
// Jonathan Blackwood
// HND Software Development
// Log in AJAX page
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
require_once "includes/login.inc.php";

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Retrieve values of loginField and password
    $loginField = $_POST["loginField"];
    $password = $_POST["password"];
 
    $user = validateLoginCredentials($loginField, $password); // Calls validateLoginCredentials function , passes loginField and password

    if ($user !== null) { // Check if data is correct, and then statts a session and assigns data to userID, username and isManager
        session_start();
        $_SESSION["userID"] = $user["userID"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["isManager"] = $user["ismanager"];

        $response = array("success" => true);
    } else { // Error check for incorrect data
        $response = array("success" => false, "message" => "Invalid email/username or password");
    }

    // Set response header to JSON
    header("Content-Type: application/json");
    echo json_encode($response); // Convert into string 
}
?>
