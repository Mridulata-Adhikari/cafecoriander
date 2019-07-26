<?php
session_start();
require_once('includes/db_Connect.php');

?>



<html>

  <head>
    <title> Menu </title>
    <link rel="stylesheet" type="text/css" href="Stylesheet.css" />
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
       
  <div id="wrapper">
             <nav  id="frequent">
                    <ul id="faq">
                    <li><a href="#">How to Order</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
<?php 
if(isset($_SESSION['login_user1'])){

?>


          <ul id="log">
            <li> Welcome <?php echo $_SESSION['login_user1']; ?> </li>
            <li><a href="managerindex.php"><span class="glyphicon glyphicon-user"></span> MANAGER INDEX</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-user"></span> Log Out </a></li>
          </ul>
<?php
}
else if (isset($_SESSION['login_user2'])) {
  ?>
           <ul id="log"; class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>  Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li><a href="cart.php"> <span class="glyphicon glyphicon-user"></span> Cart </a> </li>
              (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>)
             </a></li>
            <li><a href="logout_u.php"> Log Out </a></li>
          </ul>
  <?php        
}
else {

  ?>

<ul id="log">
            <li><a href="customersignup.php">SIGN UP</a></li>
            <li><a href="customerlogin.php">LOGIN</a></li>
             
 <?php
}
?>
</ul>
</nav>
            <div id="banner">     
            <img src="banner.jpg" width="1040">      
            </div>

            
            <nav id="navigation" >
                
                <ul id="nav">
                    <li ><a  href="index.php">Home</a></li>
                    <li>
                    <div class="dropdown">
                         <a href="menu.php">Menu</a>
 
  <div class="dropdown-content">
    <a href="cat1.php">Bakery</a>
    <a href="cat2.php">Meals</a>
    <a href="cat3.php">Dessert</a>
  </div>
</div></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    

                </ul>
            </nav>
<?php

$sql = "SELECT * FROM food where cid=2";
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

</html>0