<?php
include "connect.php";

if ( intval($_POST["product_id"]) == 0 ) {

	$query = "insert into product(product_code,description,price) values(
			'".mysqli_real_escape_string($conn,$_POST["product_code"])."',
			'".mysqli_real_escape_string($conn,$_POST["description"])."',
			".floatval($_POST["price"]).")";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}
else {
	
	$query = "update product set
				product_code='".mysqli_real_escape_string($conn,$_POST["product_code"])."',
				description='".mysqli_real_escape_string($conn,$_POST["description"])."',
				price=".floatval($_POST["price"])."
				where product_id=".intval($_POST["product_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}

echo "success";
?>