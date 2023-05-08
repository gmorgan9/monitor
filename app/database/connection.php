<!-- WORKING -->
<?php
// date_default_timezone_set('America/Denver');


$servername = "127.0.0.1";
$username = "DBadmin";
$password = "DBadmin123!";
$database = "monitor";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} 
?>