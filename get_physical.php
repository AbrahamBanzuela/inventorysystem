<?php
session_start();

include "connect.php";


$query = "select * from physical_inventory where physical_id=".$_POST["physical_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
if ( $row = mysqli_fetch_assoc($result) ) {
	
	$cH = '{"inventory_date":"'.$row["inventory_date"].'"}';
	
}

$query = "select physical_inventory_details.*,product.description from physical_inventory_details,product where
            physical_inventory_details.product_id=product.product_id and
			physical_inventory_details.physical_id=".$_POST["physical_id"]." order by physical_inventory_details.physicalinventory_id";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$_SESSION["physical_inventory_details"] = array();
while ( $row = mysqli_fetch_assoc($result) ) {

	$_SESSION["physical_inventory_details"][] = array($row["product_id"],$row["description"],$row["quantity"],$row["cost"]);
	
}

echo $cH;

?>

