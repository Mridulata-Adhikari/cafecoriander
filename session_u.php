<?php
// mysqli_connect() function opens a new connection to the MySQL server.
require_once 'includes/db_connect.php'; //database connection

session_start();// Starting Session

// Storing Session
$user_check=$_SESSION['login_user2'];

// SQL Query To Fetch Complete Information Of User
$query = "SELECT userName FROM tbl_users WHERE username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['userName'];


?>