<?php
include "connect.php";

if ( intval($_POST["login_id"]) == 0 ) {

	$query = "insert into users (names,username,password,user_type) values(
        '".mysqli_real_escape_string($conn,$_REQUEST["names"])."',
        '".mysqli_real_escape_string($conn,$_REQUEST["username"])."',
        '".mysqli_real_escape_string($conn,$_REQUEST["password"])."',
        '".mysqli_real_escape_string($conn,$_REQUEST["user_type"])."')";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}
else {
	
	$query = "update users set
				names='".mysqli_real_escape_string($conn,$_POST["names"])."',
				username='".mysqli_real_escape_string($conn,$_POST["username"])."',
                password='".mysqli_real_escape_string($conn,$_POST["password"])."',
				user_type='".mysqli_real_escape_string($conn,$_POST["user_type"])."'
				where login_id=".intval($_POST["login_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}

echo "success";
?>