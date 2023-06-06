<?php
session_start();
if ( !isset($_SESSION["physical_inventory_details"]) )
	$_SESSION["physical_inventory_details"] = array();
	
$_SESSION["physical_inventory_details"][] = array($_POST["product_id"],$_POST["description"],floatval($_POST["quantity"]),floatval($_POST["cost"]));
?>
