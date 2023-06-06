<?php
session_start();
include "connect.php";

if ( intval($_POST["purchase_id"]) == 0 ) {
	if(count($_SESSION["purchases_details"]) == 0){
        echo "Empty Purchase!";
        return false;
    }

	$query = "insert into purchases(invoice_number,invoice_date,supplier_id) values(
			'".mysqli_real_escape_string($conn,$_POST["invoice_number"])."',
			'".date("Y/m/d",strtotime($_POST["invoice_date"]))."',
			".intval($_POST["supplier_id"]).")";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	if ( $result ) {
		$sale_id = mysqli_insert_id($conn);
		
		for ( $i = 0; $i < count($_SESSION["purchases_details"]); $i++ ) {
			$query = "insert into purchases_details(purchase_id,product_id,quantity,price) values(
						".$sale_id.",
						".$_SESSION["purchases_details"][$i][0].",
						".$_SESSION["purchases_details"][$i][2].",
						".$_SESSION["purchases_details"][$i][3].")";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		}
	}
	sleep(2);
	$_SESSION["purchases_details"] = array();
	
}
else {
	if(count($_SESSION["purchases_details"]) == 0){
        echo "Empty Purchase!";
        return false;
    }
	
	$query = "update purchases set
				invoice_number='".mysqli_real_escape_string($conn,$_POST["invoice_number"])."',
				invoice_date='".date("Y/m/d",strtotime($_POST["invoice_date"]))."',
				supplier_id=".intval($_POST["supplier_id"])."
				where purchase_id=".intval($_POST["purchase_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	if ( $result ) {
		$purchase_id = intval($_POST["purchase_id"]);
		
		$query = "delete from purchases_details where purchase_id=".$purchase_id;
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		
		for ( $i = 0; $i < count($_SESSION["purchases_details"]); $i++ ) {
			$query = "insert into purchases_details(purchase_id,product_id,quantity,price) values(
						".$purchase_id.",
						".$_SESSION["purchases_details"][$i][0].",
						".$_SESSION["purchases_details"][$i][2].",
						".$_SESSION["purchases_details"][$i][3].")";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		}
	}
	sleep(2);
	$_SESSION["purchases_details"] = array();
	
}

echo "success";
?>
