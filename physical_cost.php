<?php
session_start();

$nIndex = intval($_REQUEST['index']);

if(isset($_SESSION["physical_inventory_details"]))

$_SESSION["physical_inventory_details"][$nIndex][3] = floatval($_REQUEST["cost"]);

?>