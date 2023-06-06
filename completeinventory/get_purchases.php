<?php
session_start();

include "connect.php";


$query = "select * from purchases where purchase_id=".$_POST["purchase_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
if ( $row = mysqli_fetch_assoc($result) ) {
	
	$cH = '{"invoice_number":"'.$row["invoice_number"].'",
			"invoice_date":"'.$row["invoice_date"].'",
			"supplier_id":'.$row["supplier_id"].'}';
	
}

$query = "select purchases_details.*,product.description from purchases_details,product where
			purchases_details.product_id=product.product_id and
			purchases_details.purchase_id=".$_POST["purchase_id"]." order by purchases_details.purchases_id";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$_SESSION["purchases_details"] = array();
while ( $row = mysqli_fetch_assoc($result) ) {

	$_SESSION["purchases_details"][] = array($row["product_id"],$row["description"],$row["quantity"],$row["price"]);
	
}

echo $cH;

?>

