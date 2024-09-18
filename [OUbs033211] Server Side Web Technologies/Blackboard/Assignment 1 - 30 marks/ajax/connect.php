<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "university";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if(!$conn){
   die('Could not Connect My Sql:' .mysqli_connect_error());
}

?>