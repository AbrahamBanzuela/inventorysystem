<?php
session_start();

include "connect.php";
$query = "select * from customer order by customer.last_name";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
while ( $row = mysqli_fetch_assoc($result) ) {
	$cH .= "<option value=\"".$row["customer_id"]."\">".$row["last_name"]." ".$row["first_name"]."</option>";
	
}
echo $cH;
?>
