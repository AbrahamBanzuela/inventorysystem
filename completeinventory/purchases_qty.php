<?php
session_start();

$nIndex = intval($_REQUEST['index']);

if(isset($_SESSION["purchases_details"]))

$_SESSION["purchases_details"][$nIndex][2] = floatval($_REQUEST["quantity1"]);

?>