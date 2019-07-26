
<?php 
require_once 'includes/db_connect.php';
$sql = "SELECT * FROM manager";
$result = mysqli_query($conn, $sql);

  while($row = mysqli_fetch_assoc($result)){

 ?>
 <table>
 	<tr>
 	<th>username</th>
 	<th>Fullname</th>
 </tr>
 <tr>
 	<th><?php echo $row['username'];  ?></th>
 	<th><?php echo $row['fullname'];  ?></th>
 </tr>
 </table>
 <?php } ?>