<?php
include "connect.php";

if (($_REQUEST["supplier_id"]) == 0 ) {

	$query = "insert into supplier(supplier_code,name,address,contact) values(
			'".mysqli_real_escape_string($conn,$_REQUEST["supplier_code"])."',
			'".mysqli_real_escape_string($conn,$_REQUEST["name"])."',
            '".mysqli_real_escape_string($conn,$_REQUEST["address"])."',
			'".mysqli_real_escape_string($conn,$_REQUEST["contact"])."')";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}
else {
	
	$query = "update supplier set
				supplier_code='".mysqli_real_escape_string($conn,$_REQUEST["supplier_code"])."',
				name='".mysqli_real_escape_string($conn,$_REQUEST["name"])."',
                address='".mysqli_real_escape_string($conn,$_REQUEST["address"])."',
				contact='".mysqli_real_escape_string($conn,$_REQUEST["contact"])."'
				where supplier_id=".intval($_REQUEST["supplier_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}

echo "success";
?>