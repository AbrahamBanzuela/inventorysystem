<?php
session_start();
include "connect.php";


$query = "select * from product where product_id=".$_POST["product_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
if ( $row = mysqli_fetch_assoc($result) ) {
	
	$cH = '{"product_code":"'.$row["product_code"].'",
			"description":"'.$row["description"].'",
			"price":'.$row["price"].'}';
	
}


echo $cH;

?>