<?php

$servername ="localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);
if ($conn){
    echo "server connected";
}
 else {
    die ("server not connected".mysqli_connect_error());
}
//create database
$sql = "CREATE DATABASE cafeWebsite";
if (mysqli_query ($conn, $sql) === TRUE){
    echo "database created";
}
 else {
     die("database not created".mysqli_error($conn));
 }

//create table


?>

