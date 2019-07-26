<?php
  session_start();

  require_once 'helpers/security.php';
  require_once 'Mailer/PHPMailerAutoload.php';

  $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
  $fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : [];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Contact form</title>
    <link rel="stylesheet" href="main.css">
      <link rel="icon" href="images/cc6.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
       <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

  <link rel="stylesheet" type = "text/css" href ="css/index.css">
  <style>
            /* Dropdown Button */
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #3e8e41;}
        </style>

  </head>

  <body>
          <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Cafe Coriander</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active" ><a href="index.php">Home</a></li>
            <li><a href="menu.php"><span class="glyphicon glyphicon-cutlery"></span> Food Menu </a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact Us</a></li>

          </ul>

<?php
if(isset($_SESSION['login_user1'])){

?>


          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user1']; ?> </a></li>
            <li><a href="managerindex.php">MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
<?php
}
else if (isset($_SESSION['login_user2'])) {
  ?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li><a href="cart4.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
              (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>)
             </a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
  <?php        
}
else {

  ?>

<ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="signup.php"> User Sign-up</a></li>
              <li> <a href="managersignup.php"> Manager Sign-up</a></li>
              
            </ul>
            </li>

            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li> <a href="customerlogin.php"> User Login</a></li>
              <li> <a href="managerlogin.php"> Manager Login</a></li>
             
            </ul>
            </li>
          </ul>

<?php
}
?>


        </div>

      </div>
    </nav>

    <div class="wide">
        <div class="col-xs-5 line"><hr></div>
        <div class="col-xs-2 logo"><img src="images/cafecoriander.png"></div>
        <div class="col-xs-5 line"><hr></div>
    </div>
    <div id="wrapper"> 
      <p style="text-align: center;">
    <div class="contact" align="center">
      <?php if(!empty($errors)): ?>
        <div class="panel" align="center">
          <ul>
            <li style="text-align: center;" ><?php echo implode('</li><li>', $errors); ?></li>
          </ul>
        </div>
      <?php endif; ?>
      
    <h1 style="color: white;">Feedbacks and Comments</h1>
    <form action="contactprocess.php" method="post" style="align-content: center;">

        <input class="name" type="text" name="name" autocomplete="off " placeholder="Your Name"<?php echo isset($fields['name']) ? ' value="' . e($fields['name']) . '"' : '' ?>>

        <input class="email" type="text" name="email" autocomplete="off" placeholder="Your Email Address"<?php echo isset($fields['email']) ? ' value="' . e($fields['email']) . '"' : '' ?>>

        <textarea class="message" name="message" rows="8" placeholder="Your Message"><?php echo isset($fields['message']) ? e($fields['message']) : '' ?></textarea>
      <input class="button" type="submit" value="Send" >
        </p>
        </div>
    </form>
     <footer class="container-fluid bg-4 text-center">
  <p> Cafe Coriander 2018 | &copy All Rights Reserved </p>
  </footer>
  </body>
</html>

<?php

  unset($_SESSION['errors']);
  unset($_SESSION['fields']);
 ?>
