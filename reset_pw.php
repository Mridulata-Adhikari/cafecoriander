<?php

require_once 'class.user.php';
$user = new USER(); 

if(empty($_GET['id']) && empty($_GET['code'])) /*if a user tries to access this page directly they are redirected to index.php*/
{
    $user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code'])) /*code must match the password reset request*/
{
    $id = base64_decode($_GET['id']);
    $code = $_GET['code'];

    $stmt = $user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid AND tokenCode=:token");
    $stmt->execute(array(":uid"=>$id,":token"=>$code));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() == 1)
    {
        if(isset($_POST['btn-reset-pass'])) /*passwords must be the same*/
        {
            $pass = $_POST['pass'];
            $cpass = $_POST['confirm-pass'];

            if($cpass!==$pass)
            {
                $msg = "
				<div class='alert alert-danger'>
				  <button class='close' data-dismiss='alert'>&times;</button>
				  <strong>Sorry!</strong> Password doesn't match. </span>
      			</div>";
            }
		else if($pass=="") { /*does not accept an empty password */
			    $msg = "
				<div class='alert alert-danger'>
				    <button class='close' data-dismiss='alert'>&times;</button>
			       <strong>Please!</strong> Provide a password at least 6 characters long. </span>
			    </div>"; 
		   }
		   else if(strlen($pass) < 6) /*does not accept a password less than 6 characters long*/
		   {
			    $msg = "
				<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					Passwords must be at least <strong>6</strong>  characters long.</span>
				</div>"; 
		   }	
		
            else /*acceptable password is updated in the database and the user is redirected to the index page for sign in.*/ 
            {
				$cpass = password_hash($cpass, PASSWORD_DEFAULT);
                $stmt = $user->runQuery("UPDATE tbl_users SET userPass=:upass WHERE userID=:uid");
                $stmt->execute(array(":upass"=>$cpass,":uid"=>$rows['userID']));
                $msg = "
					<div class='alert alert-success'>
					   <button class='close' data-dismiss='alert'>&times;</button>
					   Password changed. You will be redirected to the sign in page.
      				</div>";
                header("refresh:5;index.php");
            }
        }
    }
    else
    {
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
<body id="login"> <!--THE RESET FORM-->
<div class="container">
	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
                    <div class='alert alert-success'>
                        <strong>Hello </strong>  <?php echo $rows['userName'] ?>.  Reset your password here.
                    </div>
                    <form class="form-signin" method="post">
                        <h3 class="form-signin-heading">Password Reset.</h3><hr />
                        <?php
                        if(isset($msg))
                        {
                            echo $msg;
                        }
                        ?>
                        <input type="password" class="input-block-level" placeholder="New Password" name="pass"/>
                        <input type="password" class="input-block-level" placeholder="Confirm New Password" name="confirm-pass"/>
                        <hr />
                        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Reset Your Password</button>
                    </form>
            </div>
          </div>
        </div>
    </div> <!-- /container -->

	 <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>     
</body>
</html>