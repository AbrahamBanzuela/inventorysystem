<?php
include("connect.php");


$query = "select sales.*,CONCAT(customers.last_name,' , ',customers.first_name,' ',substr(customers.middle_name,1,1),'.') as customers from sales,customers
		where sales.customers_id=customers.customers_id
		order by sales.invoice_date desc,sales.invoice_number desc";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-striped table-bordered table-hover table-responsive' style='font-size:12px' cellspacing='0'>
			<tr>
				<th style='background-color: lightblue; text-align: center'>Invoice #</th>
				<th style='background-color: lightblue; text-align: center'>Date</th>
				<th style='background-color: lightblue; text-align: center'>Customer</th>
			</tr>
";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["sale_id"]."'>
				<td style='text-align: center'>".$row["invoice_number"]."</td>
				<td style='text-align: center'>".date("m/d/Y",strtotime($row["invoice_date"]))."</td>
				<td style='text-align: center'>".$row["customers"]."</td>
			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>

