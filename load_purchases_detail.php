<?php
session_start();
$cH = "<table class='table table-striped table-bordered table-hover table-responsive' style='font-size:12px' cellspacing='0'>
			<tr>
				<th style='background-color: lightblue; text-align: center'>No.</th>
				<th style='background-color: lightblue; text-align: center'>Product</th>
				<th style='background-color: lightblue; text-align: center'>Qty</th>
				<th style='background-color: lightblue; text-align: center'>Price</th>
				<th style='background-color: lightblue; text-align: center'>Total</th>
				<th style='background-color: lightblue; text-align: center'>Action</th>
			</tr>";

$nTotal = 0;
for ( $i = 0; $i < count($_SESSION["purchases_details"]); $i++ ) {
		
	$nT = round($_SESSION["purchases_details"][$i][2]*$_SESSION["purchases_details"][$i][3],2);
	$cH .= "<tr class='details' >
				<td style='text-align: center'>".($i+1).".</td>
				<td style='text-align: center'>".$_SESSION["purchases_details"][$i][1]."</td>
				<td style='text-align: center'><input type='text' class='quantity1' id='quantity1".$i."' index='".$i."' value=".number_format($_SESSION["purchases_details"][$i][2],2)."></td>
				<td style='text-align: center'><input type='text' class='price' id='price".$i."' index='".$i."' value=".number_format($_SESSION["purchases_details"][$i][3],2)."></td>
				<td style='text-align: center'>".number_format($nT,2)."</td>
				<td style='text-align: center'><button type='button' class='remove_detail btn btn-danger' index='".$i."'>Delete</button></td>
			</tr>";
				
				
	$nTotal += $nT;
}

$cH .= "<tr>
			<td colspan='4' style='background-color: lightblue; text-align: center'>Total P</td><td style='background-color: lightblue; text-align: center'><strong>".number_format($nTotal,2)."</strong></td>
		</tr>
		</table>";
echo $cH;
?>