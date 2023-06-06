<?php
session_start();
array_splice($_SESSION["physical_inventory_details"],intval($_POST["index"]),1);

?>
