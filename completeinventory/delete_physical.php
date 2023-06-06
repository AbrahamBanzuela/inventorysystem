<?php
include "connect.php";


$query = "delete from physical_inventory where physical_id=".$_POST["physical_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$query = "delete from physical_inventory_details where physical_id=".$_POST["physical_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));



?>

