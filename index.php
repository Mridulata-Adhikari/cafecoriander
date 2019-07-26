<?php
session_start();
?>

<html>

  <head>
    <title> Home | Cafe Coriander </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <link rel="icon" href="images/cc6.png" type="image/gif" sizes="16x16">
  <link rel="stylesheet" type = "text/css" href ="css/index.css">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">

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
              <li> <a href="customersignup.php"> User Sign-up</a></li>
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
       <div class="paragraph1">
          <h1>HOW TO ORDER?</h1>
          <p>
            <h4>
              All it takes is 3 easy steps:
            </h4>
          </p>
          <br>
          <p>
            <h3>
              <span class="glyphicon glyphicon-ok tickicon"></span> <u>GO TO OUR MENU PAGE</u>
            </h3>
          </p>
          <p>
            <h4>
              A list of food is displayed with attractive and true images.
            </h4>
          </p>
          <br>
          <p>
            <h3>
              <span class="glyphicon glyphicon-ok tickicon"></span> <u>SELECT YOUR FOOD AND QUANTITY OF FOOD</u>
            </h3>
          </p>
                   <br>
                         <p>
            <h4>
              With a maximum of 25 food items and an array of delicious food, you can order anything you want, any quantity you want. 
          </p>
          <br>
          <p>
          <p>
            <h3>
              <span class="glyphicon glyphicon-ok tickicon"></span> <u> PAY UPON DELIVERY</u>
            </h3>
          </p>
          <p>
            <h4>
              That’s all once everything is in order hit on the checkout and pays cash on delivery.
            </h4>
          </p>
          <br>
          <p>
            <h4>
              Make food come to you with Cafe Coriander.
            </h4>
          </p>
      </div>
              <img align="center" src="images/cafe.jpeg" width="900px">
              <h2>Coriander Cafe</h2>
              <p style="font-size: 18px;  font-family: 'verdana'">Coriander cafe, established in 2018 is a hip and trendy cafe. We aim to provide our customers with a pleasant food and hope to be worth their time. Considering this busy world, we have undertaken ourselves to become a food delivering cafe. Any dessert, any baked good you need shall be delivered right on your doorstep with nary a hitch to provide you with best food while not compromising your time in this busy world. </p>
              
              <img  align="center" style="color: blue top: 10"; src="images/food.jpg"; width="900px">
              <h2><a href="menu.php"> Menu</a></h2>
              <p style="font-size: 18px;  font-family: 'verdana'">Take a look at our menu! Varied from tasty Bakery Items to amazing meals, ending with a tasty dessert for the sweet tooths. we offer all to you. All mouthwatering food, so inexpensive delivered right to your doorstep whenever you want. Don't think, just look and eat whatever you want to eat. </p>
            </div>
  
</body>

  <footer class="container-fluid bg-4 text-center">
  <p> Cafe Coriander 2018 | &copy All Rights Reserved </p>
  </footer>
</html>