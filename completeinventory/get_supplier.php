<?php

include "conn.php";

$query = "select * from supplier where supplier_id=".$_REQUEST["supplier_id"];
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";

if ( $row = mysqli_fetch_assoc($result) ) {
	
	$cH = '{';
	$cH .= '"supplier_code":"'.$row["supplier_code"].'",';
	$cH .= '"name":"'.$row["name"].'",';
	$cH .= '"address":"'.$row["address"].'",';
    $cH .= '"contact":"'.$row["contact"].'"';
	$cH .= '}';
	
} 


echo $cH;

?>