<?php

require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
    $user->redirect('index.php'); //if ID# and code# are empty disallow access to here and redirect to index page.
}

if(isset($_GET['id']) && isset($_GET['code'])) //if ID and code are set, begin processing...
{
    $id = base64_decode($_GET['id']); //define variables
    $code = $_GET['code'];

    $statusY = "Y"; //Y means email address verified in database, which is the end status for processing here.
    $statusN = "N"; //N means not verified in database, which is how people start here.

    $stmt = $user->runQuery("SELECT userID,userStatus FROM tbl_users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
    $stmt->execute(array(":uID"=>$id,":code"=>$code));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0)
    {
        if($row['userStatus']==$statusN) //account will get verified for users with 'N' status
        {
            $stmt = $user->runQuery("UPDATE tbl_users SET userStatus=:status WHERE userID=:uID");
            $stmt->bindparam(":status",$statusY);
            $stmt->bindparam(":uID",$id);
            $stmt->execute();

            $msg = " 
             <div class='alert alert-success'>
       <button class='close' data-dismiss='alert'>&times;</button>
       <strong>Welcome!</strong> Your account is now activated : <a href='index.php'>Login here</a>
          </div>
          ";
        }
        else  //if someone comes here and types in an already verified email address, they get redirected to index.php/ sign in.
        {
            $msg = "
             <div class='alert alert-error'>
       <button class='close' data-dismiss='alert'>&times;</button>
       <strong>Sorry!</strong> Your account is already activated : <a href='index.php'>Login here</a>
          </div>
          ";
        }
    }
    else  //any other strange situation get redirected to index.php to signin.
    {
        $msg = "
         <div class='alert alert-error'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
      </div>
      ";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Registration</title> 
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shiv -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="login">
<div class="container">
    <?php if(isset($msg)) { echo $msg; } ?>
</div> <!-- /container -->
	 <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>     
</body>
</html>