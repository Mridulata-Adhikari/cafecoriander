<?php 
session_start(); 
require_once('includes/db_Connect.php');
if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === 1){

//save new order
$sql= "INSERT into orders (name, datecreation, status, username) values ("New Order", "'.date('Y-m-d').'", 0, "acc2" )");
mysqli_query(@conn, $sql);


// save order details  for new order

$cart = unserialize(serialize($_SESSION ['cart']));
for ($i=0; $i <count($cart) ; $i++) { 
$sql= "INSERT into ordersdetail (foodid, ordersid, price, quantity) values ('.$cart[$i]->id.', '.$ordersid.', '.$cart[$i]->price.', '.$cart[$i]->quantity' )");
mysqli_query(@conn, $sql);
$ordersid = mysql_insert_id($conn);
}

//clear all products in cart
unset($_SESSION['cart']);

?><!DOCTYPE html>
<html>
<head>
	<title></title>
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
Thanks for shopping with us. Click <a href="menu.php">here</a>to continue shopping. 
</div>
</body>
</html>