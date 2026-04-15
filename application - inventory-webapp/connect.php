
<?php
// Jonathan Blackwood 
// HND Software Development 
// Classes page 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
// Connection details for XAMPP database
$my_host = "localhost";
$my_db = "vinndb";
$my_db_username = "root";
$my_db_password = "";
$conn = mysqli_connect($my_host, $my_db_username, $my_db_password, $my_db);
//Uncomment below to check database connection
/*try {
		

		
		if($DB){
			
			echo "Success! Result Found";

		}else{
			echo "Database connection can not be established.";
		}

} catch (Exception $ex) {
	echo $ex->getMessage();
}
*/
?>