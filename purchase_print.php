<?php
	function generateRow(){
		$contents = '';
		include ('connect.php');

		$query = "select purchases.invoice_number,purchases.invoice_date,supplier.name,
        group_concat(product.product_code SEPARATOR '<br>') as code,
        group_concat(purchases_details.quantity SEPARaTOR '<br>') as product_quantity,
        group_concat(purchases_details.price SEPARATOR '<br>') as product_price,
        group_concat(purchases_details.quantity * purchases_details.price separator '<br>') as total,
        sum(purchases_details.quantity * purchases_details.price) as gtotal
        from product, purchases, purchases_details, supplier 
        where invoice_date between '".date('Y/m/d',strtotime($_REQUEST["date_from"]))."'
        and '".date('Y/m/d',strtotime($_REQUEST["date_to"]))."' and purchases.supplier_id = supplier.supplier_id 
        and purchases_details.product_id = product.product_id and purchases.purchase_id = purchases_details.purchase_id 
        group by purchases.supplier_id order by invoice_date,invoice_number";
		
		$index = 0;
		$priceGrandTotal = 0;
		$priceTotal = 0;
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		while ($row = mysqli_fetch_assoc($result)) {
			$contents .= "<tr>
				<td>".$row['invoice_number']."</td>
				<td>".$row['invoice_date']."</td>
				<td>".$row['name']."</td>
				<td>".$row['code']."</td>
				<td>".$row['product_quantity']."</td>
				<td>".$row['product_price']."</td>
				<td>".$row['total']."</td>
			</tr>";
			$priceTotal += round($row["gtotal"],2);
			$priceGrandTotal += round($row["gtotal"],2);
			$index++;
			$next_row = mysqli_fetch_assoc($result);
				$contents .= "<tr>
							<th></th><th></th><th></th><th></th><th></th>
							<th style='text-align:right;'>Total Price</th>
							<td style='background-color:cyan; color:blue' class='text-right'>".number_format($priceTotal,2)."</td>
						</tr>";
				$priceTotal = 0;
			mysqli_data_seek($result, $index);
		}
		$contents .= "<tr>
		<th></th><th></th><th></th><th></th><th></th>
		<th style='text-align:right;'>Grand Total</th>
		<td style='background-color:cyan; color:blue' class='text-right'>".number_format($priceGrandTotal,2)."</td>
	</tr>";
	$priceGrandTotal = 0;

 
		return $contents;
	}

require_once('pdf/config/tcpdf_config.php');
require_once('pdf/tcpdf.php'); 
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("Purchase Summary Report");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->AddPage();
    $content = '';
    $content .= '
		<h2 align="center">Purchase Summary Report</h2>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th text-align="center" width="10%">Supplier #</th>
				<th text-align="center" width="14%">Delivery Date</th>
				<th text-align="center" width="22%">Supplier</th>
				<th text-align="center" width="15%">Code</th> 
				<th text-align="center" width="10%">Quantity</th>
				<th text-align="center" width="10%">Price</th>
				<th text-align="center" width="15%">Total</th> 
           </tr>  
      '; 
    $content .= generateRow();  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
	$cF = "purchase_report".".pdf";
	$cFile = getcwd()."/".$cF;
	$pdf->Output($cFile, "F");

while ( !file_exists($cFile) ) {
}

echo "<script>location='".$cF."';</script>";
?>