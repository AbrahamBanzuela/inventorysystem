<?php

require_once('pdf/config/tcpdf_config.php');
require_once('pdf/tcpdf.php');

$multiplier = 72/2.54-2.90;
$width = 8.5; // inches
$length = 11;  // inches
$w = round($multiplier*$width);
$l = round($multiplier*$length)-2;
$page_orientation = "P";

include("report.php");


function Head() {

	global $page;
	global $line_height,$char_width;
	global $y;
	global $pdf;
	
	// add a page
	$page++;
	$pdf->AddPage();
	$pdf->SetFont("helvetica", "", 8);
	$pdf->SetXY(1*$char_width,1*$line_height); $pdf->Write($line_height,"Printed : ".date("m/d/y h:i:s a"));
	$pdf->SetFont("helvetica", "", 10);
	$pdf->SetXY(100*$char_width,1*$line_height); $pdf->writeHTML("Page ".number_format($page,0));
	
	$y = 2;
	$pdf->SetFont("helvetica", "B", 11);
	$pdf->SetXY(35*$char_width,$y*$line_height);
	$pdf->Cell(100,$line_height,"Inventory Report",0,0,"C",0);
	$y+=2;
    $pdf->SetFont("helvetica", "B", 11);
	$pdf->SetXY(35*$char_width,$y*$line_height);
    $pdf->Cell(100,$line_height,"As of ".date("m/d/Y",strtotime($_REQUEST["date1"]))."",0,0,"C",0);
	$y+=2;
	
	
	$pdf->SetFont("helvetica", "B", 10);
	$pdf->SetXY(10*$char_width,$y*$line_height);
	$pdf->Cell(20,$line_height,"Product",0,0,"C",0);
	$pdf->Cell(30,$line_height,"Beg.Qty",0,0,"C",0);
	$pdf->Cell(30,$line_height,"Sales.Qty",0,0,"C",0);
	$pdf->Cell(30,$line_height,"Purchase.Qty",0,0,"C",0);
	$pdf->Cell(30,$line_height,"End.Qty",0,0,"C",0);
	$pdf->Cell(30,$line_height,"Price",0,0,"C",0);
    $pdf->Cell(30,$line_height,"Total",0,0,"C",0);
	$pdf->SetFont("helvetica", "", 10);
	$y++;
	
}


$line_height = 4.5;
$char_width = 1.706;
$page = 0;
$max_rows = 55;
$y = $max_rows+1;

include("connect.php");

$query = "select COUNT(DISTINCT product.product_code) as product_count,physical_inventory.physical_id,product.product_code as product,

physical_inventory_details.quantity as physical_quantity,

(select sum(sale_details.quantity) from sale_details where sale_details.product_id = product.product_id) as sale_quantity,

purchases_details.quantity as purchase_quantity,

(select physical_inventory_details.quantity + purchases_details.quantity - sum(sale_details.quantity) from sale_details,physical_inventory_details,purchases_details 
where sale_details.product_id = product.product_id and purchases_details.product_id = product.product_id and physical_inventory_details.product_id = product.product_id) as end_qty,

physical_inventory_details.cost as price,

(select physical_inventory_details.quantity + purchases_details.quantity - sum(sale_details.quantity) from sale_details,physical_inventory_details,purchases_details 
where sale_details.product_id = product.product_id and purchases_details.product_id = product.product_id and physical_inventory_details.product_id = product.product_id) * physical_inventory_details.cost as total

FROM product,physical_inventory_details,sale_details,purchases_details,physical_inventory

where inventory_date='".date('Y/m/d',strtotime($_REQUEST["date1"]))."' and physical_inventory_details.product_id = product.product_id 
and sale_details.product_id = product.product_id and purchases_details.product_id = product.product_id and physical_inventory_details.physical_id = physical_inventory.physical_id
GROUP BY product.product_code;";			
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$num_rows = mysqli_num_rows($result);

if ( $num_rows == 0 ) {
	die("No available report.");
}
if ( $num_rows > 0 ) {
	$row = mysqli_fetch_assoc($result);
	while ( true ) {
		
		if ( $y > $max_rows ) 
			Head();
			
		$pdf->SetXY(10*$char_width,$y*$line_height);
		$pdf->Cell(20,$line_height,$row["product"],1,0,"C",0,"",1);
		$pdf->Cell(30,$line_height,$row["physical_quantity"],1,0,"C",0,"",1);
		$pdf->Cell(30,$line_height,$row["sale_quantity"],1,0,"C",0,"",1);
		$pdf->Cell(30,$line_height,$row["purchase_quantity"],1,0,"C",0,"",1);
		$pdf->Cell(30,$line_height,$row["end_qty"],1,0,"C",0,"",1);
        $pdf->Cell(30,$line_height,$row["price"],1,0,"R",0,"",1);
		$pdf->Cell(25,$line_height,number_format($row["total"],2),1,0,"R",0,"",1);

		$nTotal += round($row["total"],2);
        $product += round($row["product_count"],2);
		$y++;
		$row = mysqli_fetch_assoc($result);
		if ( !$row )
			break;		
	}
		$pdf->SetFont("courier", "B", 9);
	$pdf->SetXY(28*$char_width,$y*$line_height);
	$pdf->Cell(60+40+39,$line_height,"Grand Total",0,0,"R",0,"",1);
	$pdf->Cell(25,$line_height,number_format($nTotal,2),1,0,"R",0,"",1);
	$pdf->SetFont("courier", "", 9);

    $pdf->SetFont("courier", "B", 9);
	$pdf->SetXY(10*$char_width,$y*$line_height);
	$pdf->Cell(20,$line_height,number_format($product,2),1,0,"C",0,"",1);
    $pdf->Cell(30,$line_height,"Product Count",0,0,"c",0,"",1);
	$pdf->SetFont("courier", "", 9);
}

$cF = "test".date("YmdHis").".pdf";
$cFile = getcwd()."/".$cF;
$pdf->Output($cFile, "F");

while ( !file_exists($cFile) ) {
}

echo "<script>location='".$cF."';</script>";

?>
