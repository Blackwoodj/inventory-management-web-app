<?php 
// Jonathan Blackwood 
// HND Software Development 
// View schedules page, uses SQL to get data from database, then display schedules within page for each week  
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser

include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'header.php'; ?>
    <title>Schedule Viewer</title>
    <link rel="stylesheet" type="text/css" href="style/schedule_viewer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Schedule Viewer</h1>

    <div class="schedule-tables">
        <?php
            $query = "SELECT DISTINCT firstDay FROM schedules ORDER BY firstDay ASC"; // Query to fetch distinct firstDay values
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) { // Check if there are no schedules available
                echo "<p>No schedules available.</p>";
            } else {
                while ($row = mysqli_fetch_assoc($result)) { // Loop through the firstDay values and display a div table for each week
                    $firstDay = $row['firstDay'];
                    echo '<div class="week-display">' . date('l jS F', strtotime($firstDay)) . '</div>';
                    echo '<table class="stock-table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Staff Name</th>';

                    // Query to fetch distinct days of the week
                    $daysQuery = "SELECT DISTINCT day FROM schedules ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
                    $daysResult = mysqli_query($conn, $daysQuery);

                    // Store the days of the week in an array for later use
                    $daysOfWeek = array();
                    while ($daysRow = mysqli_fetch_assoc($daysResult)) {
                        $daysOfWeek[] = $daysRow['day'];
                    }

                    // Display the table header with the days of the week
                    foreach ($daysOfWeek as $day) {
                        echo '<th>' . $day . '</th>';
                    }

                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    $scheduleQuery = "SELECT s.*, st.fname, st.lname FROM schedules s 
                                      INNER JOIN staff st ON s.staff_id = st.staffID
                                      WHERE s.firstDay = '$firstDay'
                                      ORDER BY st.lname, st.fname, s.day ASC";
                    // Query to fetch the schedule data for the current week using st for staff and s for schedules tables
                    $scheduleResult = mysqli_query($conn, $scheduleQuery);

                    // Check if there are no schedules available for the current week
                    if (mysqli_num_rows($scheduleResult) == 0) {
                        echo '<tr><td colspan="' . (count($daysOfWeek) + 1) . '">No schedules available for this week.</td></tr>';
                    } else {
                        // Initialize an empty array to store the schedule data for each staff member
                        $schedulesByStaff = array();
                        while ($scheduleRow = mysqli_fetch_assoc($scheduleResult)) {
                            $staffID = $scheduleRow['staff_id'];
                            $day = $scheduleRow['day'];
                            $startTime = $scheduleRow['start_time'];
                            $endTime = $scheduleRow['end_time'];
                            $fname = $scheduleRow['fname'];
                            $lname = $scheduleRow['lname'];

                            // Store the schedule data under the respective staff member and day
                            $schedulesByStaff[$staffID][$day]['start'] = $startTime;
                            $schedulesByStaff[$staffID][$day]['end'] = $endTime;
                            $schedulesByStaff[$staffID]['name'] = $fname . ' ' . $lname;
                        }

                        // Loop through the staff members and display the schedule for each day
                        foreach ($schedulesByStaff as $staffID => $scheduleData) {
                            $staffName = $scheduleData['name'];
                            echo '<tr>';
                            echo '<td>' . $staffName . '</td>';

                            foreach ($daysOfWeek as $day) {
                                $scheduleStart = isset($scheduleData[$day]['start']) ? $scheduleData[$day]['start'] : '00:00:00';
                                $scheduleEnd = isset($scheduleData[$day]['end']) ? $scheduleData[$day]['end'] : '00:00:00';

                                // If statement to check if staff are off
                                if ($scheduleStart === '00:00:00' && $scheduleEnd === '00:00:00') {
                                    echo '<td>Off</td>';
                                } else {
                                    // Change the time to HH:MM
                                    $formattedStartTime = date('H:i', strtotime($scheduleStart));
                                    $formattedEndTime = date('H:i', strtotime($scheduleEnd));

                                    echo '<td>' . $formattedStartTime . ' - ' . $formattedEndTime . '</td>';
                                }
                            }

                            echo '</tr>';
                        }
                    }

                    echo '</tbody>';
                    echo '</table>';
                }
            }

            mysqli_close($conn); 
        ?>
    </div>

    <script src="javascript/schedule.js"></script>
</body>
</html>
