<?php
include_once 'includes/db_connect.php';
include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php'); // Redirecting To Home Page
}

      $cid = $_POST['cid'];
      $name  = $_POST['foodname'];
      $images = $_POST['images_path'];
      $price = $_POST['price'];

$sql = "INSERT INTO FOOD (`cid`, `foodname`, `images_path`, `price`) VALUES('" . $cid . "','" . $name . "','" . $images . "','" . $price . "')";
      if(mysqli_query($conn,$sql) === TRUE){
        echo "Food Added Successfully";
      }else{
        die("data not submitted".mysqli_error($conn));
      }

$conn->close();

?>