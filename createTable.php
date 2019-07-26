<?php
	require 'db_connect.php';

	$sql="CREATE TABLE `food` (
  `foodId` int(200) UNSIGNED AUTO_INCREMENT NOT NULL,
  `foodname` varchar(255) NOT NULL,

  `price` int(100) NOT NULL,
  `item` int(10) DEFAULT NULL,
  PRIMARY KEY(foodId)
)";
   		if (mysqli_query($conn,$sql)===TRUE) {
   		echo "created";
   	} else {
   		die("table not created".mysqli_error($conn));
   	}



   	mysqli_close($conn);
   	?>