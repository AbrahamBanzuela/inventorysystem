<?php
session_start();

include "connect.php";


$query = "select * from sales where sale_id=".$_POST["sale_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
if ( $row = mysqli_fetch_assoc($result) ) {
	
	$cH = '{"invoice_number":"'.$row["invoice_number"].'",
			"invoice_date":"'.$row["invoice_date"].'",
			"customer_id":'.$row["customer_id"].'}';
	
}

$query = "select sale_details.*,product.description from sale_details,product where
			sale_details.product_id=product.product_id and
			sale_details.sale_id=".$_POST["sale_id"]." order by sale_details.id";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$_SESSION["sale_details"] = array();
while ( $row = mysqli_fetch_assoc($result) ) {

	$_SESSION["sale_details"][] = array($row["product_id"],$row["description"],$row["quantity"],$row["price"]);
	
}

echo $cH;

?>

