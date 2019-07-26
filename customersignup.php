<?php 
session_start();
require_once('includes/db_connect.php');
include('login_m.php'); 
include_once('mailer/class.phpmailer.php');
require_once('mailer/class.smtp.php');
$display = array( /*an array to hold user input to the form so that upon submission the form does not go blank*/
    'fullname' => '',
    'username' => '',
    'email' => '',
    'contact' => '',
    'password' => '',

);

if($_SERVER['REQUEST_METHOD'] == 'POST'){ /*supports the array that keeps the form from going blank upon submission*/
    foreach($_POST as $key => $value){
        if(isset($display[$key])){
            $display[$key] = htmlspecialchars($value);
        }
    }
}


if(isset($_POST['btn-signup'])) /*if the signup button is clicked, go through the selection structure below*/
{
   $query = "INSERT into CUSTOMER(fullname,username,email,contact,address,password) VALUES('" . $fname . "','" . $uname . "','" . $email . "','" . $contact . "','" . $address ."','" . $upass ."')";
$success = $conn->query($query);

if (!$success){
  die("Couldnt enter data: ".$conn->error);
}

$conn->close();
s
    include_once('mailer/class.phpmailer.php');

    require_once('mailer/class.smtp.php');
    $fname = trim($_POST['fullname']); 
    $uname = trim($_POST['username']); 
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);
    $upass = trim($_POST['password']);
    $code  =md5(uniqid(rand()));
     
          if($reg_user->register($uname,$email,$upass,$code))
          {
            $id = $reg_user->lasdID();
            $key = base64_encode($id);
            $id = $key;
      
            $message = "     
          Hello $uname,
          <br />
          <h3>Thank you for registering with Cafe Coriander!</h3> <br/>
          Please click the following link to verify your account and get delicious food delivered right to your doorstep.
          <a href='https://localhost/cafewebsite/verify.php?id=$id&code=$code'>Click HERE to Activate</a>
          <br/><br/>
          <strong> If you did not sign up with Cafe Coriander, kindly ignore this email. <strong>
          <h3> THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY TO THIS MESSAGE. </h3>
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
 ?>
<html>

  <head>
    <title> Customer Signup | Cafe Corinader </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/managersignup.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">

  <body>
     <h1>Hi Guest, <br> Welcome to <span class="edit"> Cafe Coriander </span></h1>
     <br>
   <p>Get started by creating your account</p>
   



    <div class="container" style="margin-top: 4%; margin-bottom: 2%;">
      <div class="col-md-5 col-md-offset-4">
      <div class="panel panel-primary">
        <div class="panel-heading"> Create Account </div>
        <div class="panel-body">
          
        <form role="form" action="verify.php" method="POST">
         
          <div class="row">
          <div class="form-group col-xs-12">
            <label for="fullname"><span class="text-danger" style="margin-right: 5px;">*</span> Full Name: </label>
            <div class="input-group">
              <input class="form-control" id="fullname" type="text" name="fullname" placeholder="Your Full Name" required="" autofocus="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Username: </label>
            <div class="input-group">
              <input class="form-control" id="username" type="text" name="username" placeholder="Your Username" required="">
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
              <input class="form-control" id="email" type="email" name="email" placeholder="Email" required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="contact"><span class="text-danger" style="margin-right: 5px;">*</span> Contact: </label>
            <div class="input-group">
              <input class="form-control" id="contact" type="text" name="contact" placeholder="Contact" required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span></label>
            </span>
              
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="address"><span class="text-danger" style="margin-right: 5px;">*</span> Address: </label>
            <div class="input-group">
              <input class="form-control" id="address" type="text" name="address" placeholder="Address" required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-home" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span> Password: </label>
            <div class="input-group">
              <input class="form-control" id="password" type="password" name="password" placeholder="Password" required="">
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
    </body>

</html>