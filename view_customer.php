<?php
include "connect.php";


$query = "select customers.customers_id,customers.customers_code,CONCAT(customers.last_name,' , ',customers.first_name,' ',substr(customers.middle_name,1,1),'.') as customers, 
customers.address,customers.contact_number from customers order by customers.last_name";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-striped table-bordered table-hover table-responsive' style='font-size:12px' cellspacing='0'>
			<tr>
				<th style='background-color: lightblue; text-align: center'>Customer #</th>
				<th style='background-color: lightblue; text-align: center'>Customer Name</th>
				<th style='background-color: lightblue; text-align: center'>Address</th>
                <th style='background-color: lightblue; text-align: center'>Contact</th>
			</tr>";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["customers_id"]."'>
				<td style='text-align: center'>".$row["customers_code"]."</td>
				<td style='text-align: center'>".$row["customers"]."</td>
				<td style='text-align: center'>".$row["address"]."</td>
                <td style='text-align: center'>".$row["contact_number"]."</td>
			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>