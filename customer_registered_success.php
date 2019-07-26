<html>

  <head>
    <title></title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/manager_registered_success.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">

  <body>


<?php
require_once 'includes/db_connect.php';

$fullname = $conn->real_escape_string($_POST['fullname']);
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
//$contact = $conn->real_escape_string($_POST['contact']);
//$address = $conn->real_escape_string($_POST['address']);
//$password = $conn->real_escape_string($_POST['password']);

$query = "INSERT into tbl_users (username,email,password) VALUES('" . $username . "','" . $email . "','" . $password ."')";
$success = $conn->query($query);

if (!$success){
	die("Couldnt enter data: ".$conn->error);
}

$conn->close();

?>


<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h2> <?php echo "Welcome $fullname!" ?> </h2>
		<h1>Your account has been created.</h1>
		<p>Login Now from <a href="customerlogin.php">HERE</a></p>
	</div>
</div>

    </body>

</html>