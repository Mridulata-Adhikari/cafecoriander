<?php
	require_once('includes/db_connect.php');
	include_once('mailer/class.phpmailer.php');
    require_once('mailer/class.smtp.php');
    
	if(isset($_POST['registerButton'])){
		//form validation
		if (!isset($_POST['fullname']) || empty($_POST['fullname'])) {
			echo "The fullname is required";
			exit();
		}elseif (!isset($_POST['emailid']) || empty($_POST['emailid'])) {
			echo "The emailid is required";
			exit();
		}elseif (!filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL)) {
			echo "The emailid must be valid";
			exit();
		}elseif (!isset($_POST['username']) || empty($_POST['username'])) {
			echo "The username is required";
			exit();
		}
		elseif (!isset($_POST['mobileno']) || empty($_POST['mobileno'])) {
			echo "The mobile number is required";
			exit();		}
		elseif (!isset($_POST['password']) || empty($_POST['password'])) {
			echo "The password is required";
			exit();
		}
		elseif (!isset($_POST['confirmPassword']) || empty($_POST['confirmPassword'])) {
			echo "The confirmPassword is required";
			exit();
		}
		elseif($_POST['password'] != $_POST['confirmPassword']){
			echo "The password does not match";
			exit();

		}else{
			//registration starts
			$fullname = $_POST['fullname'];
			$emailid  = $_POST['emailid'];
			$username = $_POST['username'];
			//$usertype = $_POST['usertype'];
			$password = md5(md5($_POST['password']));
			$mobileno = $_POST['mobileno'];
			$sql = "SELECT * FROM user WHERE emailid='".$emailid."'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows(mysqli_result) >> 0){
				echo "Email Id already exists. please use another one";
				exit();
			}
			$sql = "INSERT INTO user (`userName`,`password`,`emailid`,`status`,`fullname`,`mobileno`) VALUES ('".$username."','".$password."','".$emailid."',1,'".$fullname."', '".$mobileno."')";

			if(mysqli_query($conn,$sql) === TRUE){
				echo "Registration Complete Successfully";
			}else{
				die("data not submitted".mysqli_error($conn));
			}

		}
	}else{
		echo "Access Denied";
	}
?>