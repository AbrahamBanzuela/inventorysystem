<?php
session_start();

include "connect.php";
$query = "select * from supplier order by supplier.name";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
while ( $row = mysqli_fetch_assoc($result) ) {
	$cH .= "<option value=\"".$row["supplier_id"]."\">".$row["name"]."</option>";
	
}
echo $cH;
?>
