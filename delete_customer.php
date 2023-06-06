<?php
include "connect.php";


$query = "delete from customers where customers_id=".$_POST["customers_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));


?>