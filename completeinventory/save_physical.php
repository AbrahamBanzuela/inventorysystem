<?php
session_start();
include "connect.php";

if ( intval($_POST["physical_id"]) == 0 ) {
    if(count($_SESSION["physical_inventory_details"]) == 0){
        echo "Empty Inventory Product!";
        return false;
    }

	$query = "insert into physical_inventory(inventory_date) values(
			'".date("Y/m/d",strtotime($_POST["inventory_date"]))."')";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	if ( $result ) {
		$sale_id = mysqli_insert_id($conn);
		
		for ( $i = 0; $i < count($_SESSION["physical_inventory_details"]); $i++ ) {
			$query = "insert into physical_inventory_details(physical_id,product_id,quantity,cost) values(
						".$sale_id.",
						".$_SESSION["physical_inventory_details"][$i][0].",
						".$_SESSION["physical_inventory_details"][$i][2].",
						".$_SESSION["physical_inventory_details"][$i][3].")";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		}
	}
	sleep(2);
	$_SESSION["physical_inventory_details"] = array();
	
}
else {
	if(count($_SESSION["physical_inventory_details"]) == 0){
        echo "Empty Inventory Product!";
        return false;
    }
	$query = "update physical_inventory set
				inventory_date='".date("Y/m/d",strtotime($_POST["inventory_date"]))."'
				where physical_id=".intval($_POST["physical_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	if ( $result ) {
		$sale_id = intval($_POST["physical_id"]);
		
		$query = "delete from physical_inventory_details where physical_id=".$sale_id;
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		
		for ( $i = 0; $i < count($_SESSION["physical_inventory_details"]); $i++ ) {
			$query = "insert into physical_inventory_details(physical_id,product_id,quantity,cost) values(
						".$sale_id.",
						".$_SESSION["physical_inventory_details"][$i][0].",
						".$_SESSION["physical_inventory_details"][$i][2].",
						".$_SESSION["physical_inventory_details"][$i][3].")";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		}
	}
	sleep(2);
	$_SESSION["physical_inventory_details"] = array();
	
}

echo "success";
?>
