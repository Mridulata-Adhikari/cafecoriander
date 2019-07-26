<?php


?>
<!DOCTYPE html>
<html>

  <head>
    <title> </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">

    <div id="wrapper">
    <div class="col-xs-9">
      <div  style="padding: 0px 100px 100px 100px;">
        <form action="editfood1.php" method="POST">
        <br>
          <h3  text-align: center; font-size: 30px;"> <ELEMENT></ELEMENT> EDIT FOOD add_food_items</h3>
            <input type="int" id="cid" size="100" name="cid" placeholder="Your Food Category" required="">
            <input type="text" id="foodname" size="100" name="foodname" placeholder="Your Food name" required="">
             <input type="text" id="images_path" size="100" name="images_path" placeholder="Your Food Image Path [images/<filename>.<extention>]" required="">
            <input type="text" id="price" size="100" name="price" placeholder="Your Food Price (NPR)" required="">
          <div class="form-group">
          <button type="submit" id="submit" name="submit"> EDIT FOOD </button>    
      </div>
        </form>

        </div>
    </div>
  </body>
</html>