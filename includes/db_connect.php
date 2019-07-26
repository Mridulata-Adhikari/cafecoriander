<?php
$servername ="localhost";
$username = "root";
$password = "";
$dbname = "cafecoriander";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn){
   
    die ("database not connected".mysqli_connect_error());
}



?>
