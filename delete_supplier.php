<?php
include "connect.php";


$query = "delete from supplier where supplier_id=".$_POST["supplier_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));


?>