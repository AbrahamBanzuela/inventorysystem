<?php
session_start();

$nIndex = intval($_REQUEST['index']);

if(isset($_SESSION["sale_details"]))

$_SESSION["sale_details"][$nIndex][2] = floatval($_REQUEST["quantity1"]);

?>