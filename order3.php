<?php
session_start();
require_once 'includes/db_connect.php';
if(!isset($_SESSION['login_user2'])){
header("location: customerlogin.php"); //Redirecting to login Page
}
?>

<html>

  <head>
    <title> Cart | Cafe Coriander </title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/">
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
            <li><a href="cart4.php"> <span class="glyphicon glyphicon-user"></span> Cart </a> </li>
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
$num1 = rand(100000,999999);
$gtotal = 0;
  foreach($_SESSION["cart"] as $keys => $values)
  {
    $username = $_SESSION["login_user2"];
    $F_ID = $values["food_foodid"];
  //  $username = $_SESSION["user_username"];
    $foodname = $values["food_foodname"];
    $quantity = $values["food_quantity"];
    $price =  $values["food_price"];
    $total = ($values["food_quantity"] * $values["food_price"]);
    $order_date = date('Y-m-d');
    $ordid = $num1; 
    
    $gtotal = $gtotal + $total; ?>
     
<?php

     $query = "INSERT INTO `ORDERS` (F_ID, foodname, price,  quantity, order_date, ordid) 
              VALUES ('" . $F_ID . "','" . $foodname . "','" . $price . "','" . $quantity . "','" . $order_date . "','" . $ordid . "')";
             

              $success = $conn->query($query);  
                      

      if(!$success)
      {
        ?>
        <div class="container">
          <div class="jumbotron">
            <h1>Something went wrong!</h1>
            <p>Try again later.</p>
          </div>
        </div>

        <?php
      }
      
  }
    $_SESSION['order'] = $ordid;

        ?>
        <h3>Your Order Id is <?php echo "$ordid"; ?></h3>
        <br>
<h1 class="text-center">Grand Total: &#8360;<?php echo "$gtotal"; ?>/-</h1>
<h5 class="text-center">including all service charges. (no delivery charges applied)</h5>
<br>
<h1 class="text-center">
  <a href="cart4.php"><button class="btn btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span> Go back to cart</button></a>
  <a href="payment.php"><button class="btn btn-success" value=""><span class="glyphicon glyphicon-"></span> Proceed with Ordering</button></a>
</h1>
</div>
<?php
if(isset($_POST['btn-success'])) /*if the signup button is clicked, go through the selection structure below*/
{
    include_once('mailer/class.phpmailer.php');

    require_once('mailer/class.smtp.php');
      
            $message = "     
          Hello $uname,
          <br />
          <h2>Thank you for ordering with cafe coriander. </h2>
         <table>

    <h3>Your Orders are: </h3>  
        <p>Order id:<?php echo $ordid; ?></p>
         <?php    ?>
    <tr>
      <th>S.N.</th>
      <th>Order Id</th>
      <th>Food ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Order date</th>

    </tr>
    <?php



      $total= 0;
      $i = 1;
      $sql = "SELECT * FROM orders where ordid =$ordid ";
      $result = mysqli_query($conn,$sql);
       foreach($_SESSION["cart"] as $keys => $values)
  {
      while($row=mysqli_fetch_assoc($result)){
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row['order_ID']; ?></td>
      <td><?php echo $row['F_ID']; ?></td>
      <td><?php echo $row['foodname']; ?></td>
      <td>&#8360; <?php echo $row['price']; ?></td>
      <td><?php echo $row['quantity']; ?></td>
      <td><?php echo $row['order_date']; ?></td>
     <?php 
         $total= $total+ ($row['price'] * $row['quantity']);
      ?>
        </tr>
    <?php
        $i++;
      }
    }
    ?>
    <tr>
    <td colspan="4" align="right">Total</td>
    <td align="right">&#8360; <?php echo number_format($total, 2); ?></td>
<td></td>
</tr>
  </table> 

          ";
      
            $subject = "Confirm Registration";
      
           $reg_user->send_mail($email,$message,$subject);
            $msg = "
         <div class='alert alert-success'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Success!</strong>  We've sent an email to $email.
                Please click on the confirmation link in the email to verify your order. 
           </div>
         ";
          }
          else
          {
            echo "sorry, we could not process your order...";
          }
          ?>
<br><br><br><br><br><br>
 <footer class="container-fluid bg-4 text-center">
  <p> Cafe Coriander 2018 | &copy All Rights Reserved </p>
  </footer>
        </body>
</html>