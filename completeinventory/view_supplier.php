<?php
include "connect.php";


$query = "select supplier.supplier_id,supplier.supplier_code,supplier.name,supplier.address,supplier.contact from supplier order by supplier.name";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-striped table-bordered table-hover table-responsive' style='font-size:12px' cellspacing='0'>
			<tr>
				<th style='background-color: lightblue; text-align: center'>Supplier #</th>
				<th style='background-color: lightblue; text-align: center'>Supplier Name</th>
				<th style='background-color: lightblue; text-align: center'>Address</th>
                <th style='background-color: lightblue; text-align: center'>Contact</th>
			</tr>";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["supplier_id"]."'>
				<td style='text-align: center'>".$row["supplier_code"]."</td>
				<td style='text-align: center'>".$row["name"]."</td>
				<td style='text-align: center'>".$row["address"]."</td>
                <td style='text-align: center'>".$row["contact"]."</td>
			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>