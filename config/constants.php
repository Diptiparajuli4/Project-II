<?php 
//Start session
session_start();
//Create constants to store non-repeating Values
define('SITEURL', 'http://localhost/scriptinglanguage28/project-II/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // Database Connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // Selecting Database
?>
