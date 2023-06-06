<?php
include("connect.php");


$query = "delete from purchases where purchase_id=".$_POST["purchase_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$query = "delete from purchases where purchase_id=".$_POST["purchase_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));



?>

