<?php
require_once 'includes/db_connect.php';
include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php'); // Redirecting To Home Page
}

$cheks = implode("','", $_POST['checkbox']);
$sql = "DELETE FROM `FOOD` WHERE `food`.`foodid`= $cheks ";
$result = mysqli_query($conn,$sql); 

header('Location: deletefood.php');

?>