<?php
session_start();

$nIndex = intval($_REQUEST['index']);

if(isset($_SESSION["purchases_details"]))

$_SESSION["purchases_details"][$nIndex][3] = floatval($_REQUEST["price"]);

?>