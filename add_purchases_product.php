<?php
session_start();
if ( !isset($_SESSION["purchases_details"]) )
	$_SESSION["purchases_details"] = array();
	
$_SESSION["purchases_details"][] = array($_POST["product_id"],$_POST["description"],floatval($_POST["quantity"]),floatval($_POST["price"]));
?>
