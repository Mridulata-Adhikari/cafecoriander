<?php 
	require_once('includes/db_connect.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration Form</title>
   <link rel="stylesheet" type="text/css" href="Stylesheet.css" />
</head>
<style>
input[type=text], input[type=email], input[type=password], input[type=float], 
select {
  width: 30%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1
}
input[type=text]:focus, input[type=password]:focus input[type=email]:focus, input[type=float]:focus
{
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}


button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 20%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}
}


</style>
<body  style="margin: auto; padding-top: 2%; width: 800;">  
<div id="wrapper">

            <nav  id="frequent">
                    <ul id="faq">
                    <li><a href="#">How to Order</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
                <ul id="log">
                <li><a href="register.php"> Sign Up</a></li>
                <li><a href="login.php"> 🔒 Login</a></li>
                </ul>
            </nav>
            <div id="banner">     
            <img src="banner.jpg" width="1070">      
            </div>

            
            <nav id="navigation" >
                
                <ul id="nav">
                    <li ><a  href="index.php">Home</a></li>
                    <li><a href="foodlist.php">Menu</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    

                </ul>
            </nav>
            <div id="contentarea">  
<div style="width: 30% margin:0; padding-top:20;" align="center">
	<?php 
		if(isset($_GET['process']) && $_GET['process'] == "update"){
		$sql = "SELECT * FROM user WHERE userId='".$_GET['id']."'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$fullname = $row['fullname'];
			$username = $row['username'];
			$emailid = $row['emailid'];
		}
	?>
	<div><h1 align="center" style="color: white top:10;">User Record Update Form</h4></div>
	<?php }else{ ?>
	<div><h1 align="center" style="color: white top:10;">Sign Up</h4></div>
	<h2><img src="cupcake.png" ></h2>
	<?php
	}
	?>
	
	<form action="registerUser.php" style=" align-content: center; top: 10" method="POST">
		<label>Fullname</label>
		<input type="text" name="fullname" /><br>
		<label>Email ID</label>
		<input type="email" name="emailid" /><br>
		<label>Username</label>
		<input type="text" name="username" /><br>
		<label>Password</label>
		<input type="password" name="password" /><br>
		<label>Password</label>
		<input type="password" name="confirmPassword" /><br>
		<label>Mobile no.</label>
		<input type="float" name="mobileno"/> <br>
    <input type="text" name="usertype" value="user" style="display:none;"/>
		<button name="registerButton" type="submit">Sign Up</button>
		<label>Remember me</label>
		<input type="checkbox" checked="unchecked" name="remember" style="margin-bottom:15px">
		<p>By creating an account you agree to our <a style="color:dodgerblue">Terms & Privacy</a>.</p>
	</form>
	<p>Already Have an Account ? <a href="login.php">Login Here</a></p>
</body>
</html>