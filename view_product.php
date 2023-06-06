<?php
include "connect.php";


$query = "select * from product order by product_code";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-striped table-bordered table-hover table-responsive' style='font-size:12px' cellspacing='0'>
			<tr>
				<th style='background-color: lightblue; text-align: center'>Code</th>
				<th style='background-color: lightblue; text-align: center'>Description</th>
				<th style='background-color: lightblue; text-align: center'>Price</th>
			</tr>
";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["product_id"]."'>
				<td style='text-align: center'>".$row["product_code"]."</td>
				<td style='text-align: center'>".$row["description"]."</td>
				<td style='text-align: center'>".$row["price"]."</td>
			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>