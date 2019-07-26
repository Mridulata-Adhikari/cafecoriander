<?php  
session_start();
require_once 'includes/db_connect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Coriander Cafe</title>
        <link rel="stylesheet" type="text/css" href="Stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>

    </head>
    <body>
            <? php include("header.php");
            ?>


  

       
  <div id="wrapper">
            
     <nav  id="frequent">
                        <ul id="faq">
                    <li><a href="#">How to Order</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
<?php 
if(isset($_SESSION['login_user1'])){

?>


          <ul id="log"; style="text-align: center;" ">
            <li> Welcome <?php echo $_SESSION['login_user1']; ?> </li>
            <li><a href="managerindex.php"><span class="glyphicon glyphicon-user"></span> Manager Index</a></li>
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

<ul id="log"; class="nav navbar-nav navbar-right">
            <li><a href="customerlogin.php">Login</a></li>
            <li><a href="signup.php";>Sign Up</a></li>             
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

          
            	<img align="center" src="cafe.jpeg" width="900px">
            	<h2>Coriander Cafe</h2>
            	<p style="font-size: 18px;  font-family: 'verdana'">Coriander cafe, established in 2018 is a hip and trendy cafe. We aim to provide our customers with a pleasant food and hope to be worth their time. Considering this busy world, we have undertaken ourselves to become a food delivering cafe. Any dessert, any baked good you need shall be delivered right on your doorstep with nary a hitch to provide you with best food while not compromising your time in this busy world. </p>
            	
              <img  align="center" style="color: blue top: 10"; src="food.jpg"; width="900px">
              <h2><a href="menu.php"> Menu</a></h2>
            	<p style="font-size: 18px;  font-family: 'verdana'">Take a look at our menu! Varied from tasty Bakery Items to amazing meals, ending with a tasty dessert for the sweet tooths. we offer all to you. All mouthwatering food, so inexpensive delivered right to your doorstep whenever you want. Don't think, just look and eat whatever you want to eat. </p>
            </div>
          
            
            <footer>
                <p>All rights reserved</p>
            </footer>
        </div>
    </body>
</html>
