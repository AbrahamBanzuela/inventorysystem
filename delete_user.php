<?php
include "connect.php";


$query = "delete from users where login_id=".$_POST["login_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));


?>
