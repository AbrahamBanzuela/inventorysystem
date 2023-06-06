<?php

include "connect.php";

$query = "select * from customers where customers_id=".$_REQUEST["customers_id"];
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";

if ( $row = mysqli_fetch_assoc($result) ) {
	
	$cH = '{';
	$cH .= '"customers_code":"'.$row["customers_code"].'",';
	$cH .= '"last_name":"'.$row["last_name"].'",';
    $cH .= '"first_name":"'.$row["first_name"].'",';
    $cH .= '"middle_name":"'.$row["middle_name"].'",';
	$cH .= '"address":"'.$row["address"].'",';
    $cH .= '"contact_number":"'.$row["contact_number"].'"';
	$cH .= '}';
	
} 


echo $cH;

?>