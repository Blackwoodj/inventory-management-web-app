<?php
// Jonathan Blackwood 
// HND Software Development 
// Schedule page using SQL to insert data from forms into database 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser

include 'connect.php';

$firstDay = $_POST['firstDay']; // Assigning firstDay to $firstday variable
$startTimes = $_POST['start_time']; //Assigning start_time to $starttimes
$endTimes = $_POST['end_time']; // Assigning end_time to $endTimes

foreach ($startTimes as $staffID => $staffData) { // Loop through the submitted data and save it to the database
    foreach ($staffData as $day => $startTime) {
        $endTime = $endTimes[$staffID][$day];

        // Check if no data is entered for the day, this data will be used as trigger to input a day off
        if (empty($startTime) || empty($endTime)) {
            $startTime = '00:00:00';
            $endTime = '00:00:00';
        }
        // SQL query for inserting the data into the database
        $query = "INSERT INTO schedules (date, day, firstDay, staff_id, start_time, end_time) 
                  VALUES ('$firstDay', '$day', '$firstDay', '$staffID', '$startTime', '$endTime')";

        mysqli_query($conn, $query); // Execute SQL statement
    }
}

// Close the database connection
mysqli_close($conn);

// Set a success flag in the response
$response = array('success' => true);

// Send the JSON-encoded response
header('Content-Type: application/json');
echo json_encode($response);
