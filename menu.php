<?php
session_start();
require_once('includes/db_Connect.php');

?>



<html>

  <head>
    <title> Menu </title>
    <link rel="stylesheet" type="text/css" href="Stylesheet.css" />
      <link rel="icon" href="images/cc6.png" type="image/gif" sizes="16x16">
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

<?php

$sql = "SELECT * FROM food ORDER BY foodId";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{

  while($row = mysqli_fetch_assoc($result)){

?>
<div class="col-md-4">
<form method="post" action="cart4.php?action=add&id=<?php echo $row["foodId"]; ?>">

<img width="200px"; height="200px"; align="center"; src="<?php echo $row["images_path"];  ?>" >
<h5 "><?php echo $row["foodname"]; ?></h5>
<h5 >&#8360; <?php echo $row["price"]; ?>/-</h5>
<h5 ">Quantity: <input type="number" min="1" max="25" name="quantity" value="1" style="width: 60px;"> </h5>
<input type="hidden" name="hidden_name" value="<?php echo $row["foodname"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
<input type="submit" name="add" style="margin-top:5px;" value="Add to Cart">
</div>
</form>
      
     
<?php
}
}
  ?>
</body>
 <footer class="container-fluid bg-4 text-center">
  <p> Cafe Coriander 2018 | &copy All Rights Reserved </p>
  </footer>
</html>