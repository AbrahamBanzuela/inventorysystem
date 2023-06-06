<?php
include "connect.php";

$query = "select physical_inventory.physical_id,physical_inventory.inventory_date from physical_inventory
		where physical_inventory.physical_id
		order by physical_inventory.inventory_date desc";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-striped table-bordered table-hover table-responsive' style='font-size:12px' cellspacing='0'>
			<tr>
				<th style='background-color: lightblue; text-align: center'>Physical Inventory Date</th>
			</tr>
";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["physical_id"]."'>
				<td style='text-align: center'>".date("m/d/Y",strtotime($row["inventory_date"]))."</td>
			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>

