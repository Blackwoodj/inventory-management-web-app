<?php 
// Jonathan Blackwood 
// HND Software Development 
// Create schedule page, containing class functions for generating table, generating schedule 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <?php
    abstract class DatabaseConnection { // Abstract class for database connection
        protected $conn;

        public function __construct($conn) // Define constructor method
        {
            $this->conn = $conn; // Assign conn
        }
    }

    class Schedule extends DatabaseConnection // Schedule class that extends DatabaseConnection
    {
        public function generateScheduleTable() // Method to generate the schedule table
        {
            $daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'); // Create array containing days of monday to sunday
            $timeFormat = 'H:i:s'; // Sets time format to hours:minutes:seconds

            $query = "SELECT * FROM staff ORDER BY fname, lname"; // SQL query to select all from staff and order by fname then lname
            $result = mysqli_query($this->conn, $query);// Store result to $result

            $staffMembers = []; //Initialize empty array of $staffMembers
            while ($row = mysqli_fetch_assoc($result)) { // Sets each result and assign to row
                $staffMembers[] = $row;
            }

            
            $schedules = []; // Initialize empty array for $schedules
            $query = "SELECT * FROM schedules"; // SQL to select all from schedules
            $result = mysqli_query($this->conn, $query); // Stores result to $result

            while ($row = mysqli_fetch_assoc($result)) { // Retrieve value of staffID from current row and assigns to $staffID
                $staffID = $row['staff_id'];
                $schedules[$staffID] = $row;
            }

            echo '<form action="" method="post">'; // Create the schedule table
            echo '<div>';
            echo '<label for="anchor_date">Select Monday for week start:</label>';
            echo '<input type="date" id="anchor_date" name="anchor_date">';
            echo '</div>';
            echo '<table>';
            echo '<tr><th></th>';
            foreach ($daysOfWeek as $day) { //Starts loop to iterate over each element of $daysOfWeek
                echo "<th>$day</th>";
            }
            echo '</tr>';

            foreach ($staffMembers as $staff) { // Starts loop to iterate over each element of $staffMembers
                $staffID = $staff['staffID']; // Assigns staffID to variable in array
                $fname = $staff['fname'];   //Assigns fname to variable in array
                $lname = $staff['lname'];   //Assigns lname to variable in array

                echo '<tr>';
                echo "<td>$fname $lname</td>"; // Displays first name and last name for within table

                foreach ($daysOfWeek as $day) {
                    $schedule = isset($schedules[$staffID]) ? $schedules[$staffID] : null; // Check no schedule is set for staffID

                    $startTime = $schedule ? date($timeFormat, strtotime($schedule['start_time'])) : '00:00:00'; // Takes data input and assignes to $startTime
                    $endTime = $schedule ? date($timeFormat, strtotime($schedule['end_time'])) : '00:00:00';    // Takes data input and assigns to $endTime

                    echo '<td>';
                    echo "<input type='time' name='start_time[$staffID][$day]' value='$startTime'><br>"; 
                    echo "<input type='time' name='end_time[$staffID][$day]' value='$endTime'>";
                    echo '</td>';
                }

                echo '</tr>';
            }

            echo '</table>';
            echo '<button type="submit" name="create_schedule">Create Schedule</button>';
            echo '</form>';
        }

        public function createSchedule($startTimeArray, $endTimeArray, $anchorDate) // Method to create the schedule
        {
            $daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'); // Assign values of array to days of week

            $anchorDate = mysqli_real_escape_string($this->conn, $anchorDate); // Retrieve the anchor date (monday)

            foreach ($startTimeArray as $staffID => $days) { // Iterate over the submitted data
                foreach ($days as $day => $startTime) {
                    // Retrieve the end time for the current staff and day
                    $endTime = isset($endTimeArray[$staffID][$day]) ? mysqli_real_escape_string($this->conn, $endTimeArray[$staffID][$day]) : '00:00';

                    $startTime = mysqli_real_escape_string($this->conn, $startTime); // Use escape string to ensure value is correct to send to database
                    $endTime = $endTime . ':00'; // Add :00 to the end of the time value
                    $staffID = intval($staffID); // Converts to integer for SQL query

                    $query = "INSERT INTO schedules (day, start_time, end_time, staff_id, firstDay)
                              VALUES ('$day', '$startTime', '$endTime', $staffID, '$anchorDate')";// Insert the schedule into the database
                    mysqli_query($this->conn, $query); // Executes query
                }
            }

            echo '<p class="success-message">Schedule created successfully!</p>'; // Success message for schedule created
        }
    }

    $schedule = new Schedule($conn); // Assigns new instance of Schedule to $schedule vriable

    if (isset($_POST['create_schedule'])) { // Check if form has been submitted
        $startTimeArray = $_POST['start_time']; // Assign value of start_time to $startTimeArray
        $endTimeArray = $_POST['end_time']; // Assign value of end_time to $endTimeArray
        $anchorDate = $_POST['anchor_date'];    //Assign value of anchor_date to $anchorDate

        $schedule->createSchedule($startTimeArray, $endTimeArray, $anchorDate); //Pass data and call createSchedule function
    }

    $schedule->generateScheduleTable();
    ?>
    <?php include 'footer.php'; ?>
</body>
</html>
