<?php 
session_start();
require_once 'includes/db_connect.php';
if(!isset($_SESSION['login_user1'])){
header("location: managerlogin.php"); //Redirecting to login Page
}
 ?>

<!DOCTYPE html>
<html>

  <head>
    <title> </title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/">
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
                    <li><a href="ordersdet.php">Orders Detail</a></li>
                    <li><a href="foodlist.php">View Food</a></li>
                    <li><a href="addfood.php">Insert Food</a></li>
                    <li><a href="deletefood.php">Delete Food</a></li>
                    <li><a href="editfood.php">Edit food</a></li>                    

                </ul>
            </nav>

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
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
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

              
    <div class="col-xs-9">
      <div  style="padding: 0px 100px 100px 100px;">
        <form action="addfoods.php" method="POST">
        <br>
          <h3  text-align: center; font-size: 30px;"> ADD FOOD ITEM </h3>
            <input type="int" id="cid" size="100" name="cid" placeholder="Your Food Category" required="">
            <input type="text" id="foodname" size="100" name="foodname" placeholder="Your Food name" required="">
             <input type="text" id="images_path" size="100" name="images_path" placeholder="Your Food Image Path [images/<filename>.<extention>]" required="">
            <input type="text" id="price" size="100" name="price" placeholder="Your Food Price (NPR)" required="">
          <div class="form-group">
          <button type="submit" id="submit" name="submit"> ADD FOOD </button>    
      </div>
        </form>

        </div>
    </div>
     <footer class="container-fluid bg-4 text-center">
  <p> Cafe Coriander 2018 | &copy All Rights Reserved </p>
  </footer>
  </body>
</html>