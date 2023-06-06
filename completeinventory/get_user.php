<?php
include "connect.php";


$query = "select * from users where login_id=".$_POST["login_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
if ( $row = mysqli_fetch_assoc($result) ) {
	
	$cH = '{"names":"'.$row["names"].'",
			"username":"'.$row["username"].'",
            "password":"'.$row["password"].'",
			"user_type":"'.$row["user_type"].'"}';
	
}


echo $cH;

?>