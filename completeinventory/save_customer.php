<?php
include "connect.php";

if (($_REQUEST["customers_id"]) == 0 ) {

	$query = "insert into customers(customers_code,last_name,first_name,middle_name,address,contact_number) values(
			'".mysqli_real_escape_string($conn,$_REQUEST["customers_code"])."',
			'".mysqli_real_escape_string($conn,$_REQUEST["last_name"])."',
            '".mysqli_real_escape_string($conn,$_REQUEST["first_name"])."',
			'".mysqli_real_escape_string($conn,$_REQUEST["middle_name"])."',
            '".mysqli_real_escape_string($conn,$_REQUEST["address"])."',
			'".mysqli_real_escape_string($conn,$_REQUEST["contact_number"])."')";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}
else {
	
	$query = "update customers set
				customers_code='".mysqli_real_escape_string($conn,$_REQUEST["customers_code"])."',
				last_name='".mysqli_real_escape_string($conn,$_REQUEST["last_name"])."',
                first_name='".mysqli_real_escape_string($conn,$_REQUEST["first_name"])."',
				middle_name='".mysqli_real_escape_string($conn,$_REQUEST["middle_name"])."',
                address='".mysqli_real_escape_string($conn,$_REQUEST["address"])."',
				contact_number='".mysqli_real_escape_string($conn,$_REQUEST["contact_number"])."'
				where customers_id=".intval($_REQUEST["customers_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}

echo "success";
?>