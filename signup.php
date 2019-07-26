<?php

session_start();
require_once('includes/db_connect.php');
include('login_u.php'); 

require_once 'class.user.php';
// define a user
$reg_user = new USER();
/**/

$display = array( /*an array to hold user input to the form so that upon submission the form does not go blank*/
    'txtuname' => '',
    'txtemail' => '',
    'txtpass' => '',
);

if($_SERVER['REQUEST_METHOD'] == 'POST'){ /*supports the array that keeps the form from going blank upon submission*/
    foreach($_POST as $key => $value){
        if(isset($display[$key])){
            $display[$key] = htmlspecialchars($value);
        }
    }
}

if($reg_user->is_logged_in()!="") /*if the user is logged in, they are redirected automatically to the home page*/
{
    $reg_user->redirect('index.php');
}


if(isset($_POST['btn-signup'])) /*if the signup button is clicked, go through the selection structure below*/
{
    include_once('mailer/class.phpmailer.php');

    require_once('mailer/class.smtp.php');
    $uname = trim($_POST['txtuname']); 
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtpass']);
    $code  =(uniqid(rand()));
	   	   if($uname=="") { /*if name is empty give specific message*/
			   $msg = "
				<div class='alert alert-danger'>
				    <button class='close' data-dismiss='alert'>&times;</button> 
				    <strong>Please!</strong> Provide a user name that does not contain symbols or white spaces. 
			   </div>";
		   }
		   else if (!(ctype_alnum($uname)) ) { /*if name is not only letters or numbers give specific message*/
      		 $msg = "
				<div class='alert alert-danger'>
				    <button class='close' data-dismiss='alert'>&times;</button>
				 <strong>Sorry!</strong> User names may only contain letters or numbers. 
				 They may not contain symbols or empty spaces. 
			 </div>"; 
		   }
		   else if($email=="") { /*if email is empty give specific message*/
			   $msg = "
				<div class='alert alert-danger'>
				    <button class='close' data-dismiss='alert'>&times;</button>
			 	  <strong>Please!</strong> Provide a valid email address. 
			  </div>"; 
		   }
		   else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { /*sanitize and validate email address input*/
			   $msg = "
				<div class='alert alert-danger'>
				    <button class='close' data-dismiss='alert'>&times;</button>
			      <strong>Please!</strong> Provide a valid email address.
			   </div>"; 
		   }
		   else if($upass=="") { /*does not accept an empty password */
			     $msg = "
				<div class='alert alert-danger'>
				    <button class='close' data-dismiss='alert'>&times;</button>
			       <strong>Please!</strong> Provide a password at least 6 characters long.
			    </div>"; 
		   }
		   else if(strlen($upass) < 6) /*does not accept a password less than 6 characters long*/
		   {
			    $msg = "
				<div class='alert alert-danger'>
				    <button class='close' data-dismiss='alert'>&times;</button>
					Passwords must be at least <strong>6</strong> characters long.
				</div>"; 
		   }
		   else /*if no errors in user input, run query to see if email already exists in database*/
		   {
			 
				$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
				$stmt->execute(array(":email_id"=>$email));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
			if($stmt->rowCount() > 0) /*if the email is already in the database, already registered, give message to sign in*/
			{
				$msg = "
				<div class='alert alert-danger'>
				    <button class='close' data-dismiss='alert'>&times;</button>
				<strong>Sorry!</strong> We already have that email address on an account. Please sign in. 
				</div>";
			}
			else /*if there are no errors and the email is not already in the database, a validation email 		   
			       goes out and user information is stored with an 'N' status for not confirmed*/
			{
					if($reg_user->register($uname,$email,$upass,$code))
					{
						$id = $reg_user->lasdID();
						$key = base64_encode($id);
						$id = $key;
			
						$message = "     
				  Hello $uname,
				  <br />
				  <h2>Thank you for signing up with Cafe Coriander!</h2> <br/>
				
				  Please click the link below to verify your account and to start ordering delicious food from our website. 
				  <br/></br>
				  <a href='https://localhost/cafecoriander/verify.php?id=$id&code=$code'>Click HERE to Activate</a>
				  <br/><br/>
				  <h3>If you did not register with us, kindly ignore our email.</h3>
				  <h3>Do not reply to this email.</h3>
				  Thanks, <br>
				  Cafe Coriander";
			
						$subject = "Confirm Registration";
			
						$reg_user->send_mail($email,$message,$subject);
						$msg = "
				 <div class='alert alert-success'>
				  <button class='close' data-dismiss='alert'>&times;</button>
				  <strong>Success!</strong>  We've sent an email to $email.
								Please click on the confirmation link in the email to create your account. 
				   </div>
				 ";
					}
					else
					{
						echo "sorry, we could not process your registration...";
					}
    }
}}
?> 
<!DOCTYPE html> <!--BEGIN HTML REGISTRATION FORM-->
<html>
<head>
    <title>Cafe Coriander</title>
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
<body id="login">
<div class="container">
	<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-login">
                    <!--Sign up form -->
    
                 <form class="form-signin" method="post">
                                <h2 class="form-signin-heading">Sign Up</h2><hr />
                   <?php
							if(isset($msg))
							{
								echo $msg;
							}
							else
							{
								?>
								<div class='alert alert-info'>
									Please register with us!
								</div>
								<?php
							}
							?>             
                <div class="container" style="margin-top: 4%; margin-bottom: 2%; align-content: center;">
      <div class="col-md-5 col-md-offset-4">
      <div class="panel panel-primary">
        <div class="panel-heading"> Create Account </div>
        <div class="panel-body">
          
        <form role="form" action="verify.php" method="POST" >
         
        <div class="row">
          <div class="form-group col-xs-12">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> User Name: </label>
            <div class="input-group">
              <input class="form-control" id="txtuname" type="text" name="txtuname" placeholder="Your username" value="<?php echo 		                                $display['txtuname']; ?>" required="" autofocus="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

     
        <div class="row">
          <div class="form-group col-xs-12">
            <label for="email"><span class="text-danger" style="margin-right: 5px;">*</span> Email: </label>
            <div class="input-group">
              <input class="form-control" id="txtemail" type="email" name="txtemail" placeholder="Email" required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span> Password: </label>
            <div class="input-group">
              <input class="form-control" id="txtpass" type="password" name="txtpass" placeholder="Password" required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></label>
            </span>
              
            </div>           
          </div>
        </div>  

        <div class="row">
          <div class="form-group col-xs-4">
              <button class="btn btn-primary" type="submit" name="btn-signup">Sign Up</button>
          </div>

        </div>
        <label style="margin-left: 5px;">or</label> <br>
       <label style="margin-left: 5px;"><a href="customerlogin.php">Have an account? Login.</a></label>

        </form>

        </div>
        
      </div>
      
    </div>
    </div>
                                 
                            </form> 
                              		                               
						</div> <!--panel-->
				</div> <!-- /row -->
		  </div> <!-- /col -->
	</div> <!-- /container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script> 
</body>
</html>