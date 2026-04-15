<!-- Jonathan Blackwood -->
<!-- HND Software Development -->
<!-- Header page, including navigation links -->
<!-- 23/05/2023 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="https://kit.fontawesome.com/c90b3c7013.js" crossorigin="anonymous"></script> <!-- Link to fontawesome for icon use -->
</head>
<body>
    <nav>
        <div class="logo">
            <img src="images/vinnlogo.png" class="logoimg" alt="Village Inn Logo">
        </div>
        <div class="companyName">
            <h4>The Village Inn</h4>
        </div>
        <ul class="nav-links">
            <?php
            error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
            ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
            if (session_status() === PHP_SESSION_NONE) { // Check if session started
                session_start(); // If not, start session
            }

            if (isset($_SESSION["isManager"]) && $_SESSION["isManager"]) { // Header data to be displayed if isManager from session = 1, or true
                echo '<li><a href="rota.php"><i class="fas fa-clock"></i> Schedules</a></li>';
                echo '<li><a href="update_staff.php"><i class="fas fa-user"></i> Update Staff</a></li>';
                echo '<li><a href="stock.php"><i class="fas fa-beer-mug-empty"></i> Stock</a></li>';
                echo '<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log out</a></li>';
            } else if (isset($_SESSION["isManager"]) && !$_SESSION["isManager"]) { // Header data to be displayed if isManager from session is 0, or false
                echo '<li><a href="rota.php"><i class="fas fa-calendar-alt"></i> Rota</a></li>';
                echo '<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log out</a></li>';
            }
            ?>
        </ul>
    </nav>
</body>
</html>
