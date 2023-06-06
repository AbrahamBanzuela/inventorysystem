<?php
include("connect.php");


$query = "select purchases.*,supplier.name from purchases,supplier
		where purchases.supplier_id=supplier.supplier_id
		order by purchases.invoice_date desc,purchases.invoice_number desc";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-striped table-bordered table-hover table-responsive' style='font-size:12px' cellspacing='0'>
			<tr>
				<th style='background-color: lightblue; text-align: center'>Invoice #</th>
				<th style='background-color: lightblue; text-align: center'>Date</th>
				<th style='background-color: lightblue; text-align: center'>Supplier</th>
			</tr>
";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["purchase_id"]."'>
				<td style='text-align: center'>".$row["invoice_number"]."</td>
				<td style='text-align: center'>".date("m/d/Y",strtotime($row["invoice_date"]))."</td>
				<td style='text-align: center'>".$row["name"]."</td>
			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>

