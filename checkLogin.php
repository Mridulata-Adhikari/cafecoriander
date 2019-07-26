<?php
	session_start();
	require_once('includes/db_connect.php');
	if(isset($_POST['loginButton'])){
		//form validation
		if (!isset($_POST['emailid']) || empty($_POST['emailid'])) {
			$_SESSION['msg'] = "The emailid is required";
			header("Location:login.php");
			exit();
		}elseif (!filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL)) {
			$_SESSION['msg'] = "The emailid must be valid";
			header("Location:login.php");
			exit();
		}
		elseif (!isset($_POST['password']) || empty($_POST['password'])) {
			$_SESSION['msg'] = "The password is required";
			header("Location:login.php");
			exit();
		}
		else{
			//login starts
			$emailid = $_POST['emailid'];
			$password = md5(md5($_POST['password']));
			$sql = "SELECT * FROM user WHERE emailid='".$emailid."' AND password = '".$password."' AND status = 1";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0)
			{

				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0) 
				{
					while ($row=mysqli_fetch_assoc($result)) 
					{
						$_SESSION['userEmailId'] = $row['emailid'];
						//$_SESSION['username']=$row['username'];
						$_SESSION['fullname']=$row['fullname'];
						$_SESSION['user_logged_in'] = 1;

						
					}
					
				}
				header("Location:index1.php");
			}else{
				$_SESSION['msg'] = "username or password invalid";
				header("Location:login.php");
				}
			}
		}else{
		echo "Access Denied";
	}
?>