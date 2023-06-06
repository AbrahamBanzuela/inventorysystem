<?php
session_start();

$nIndex = intval($_REQUEST['index']);

if(isset($_SESSION["sale_details"]))

$_SESSION["sale_details"][$nIndex][3] = floatval($_REQUEST["price"]);

?>