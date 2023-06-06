<?php


echo "<h3>".date("m/d/Y",strtotime($_REQUEST["date_from"]))." to ".date("m/d/Y",strtotime($_REQUEST["date_to"]))."</h3>";


$conn = mysqli_connect("localhost","root","","inventory");

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

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$name = "";
$cH = "<table class='table table-striped table-bordered table-hover table-responsive' border='1' style='font-size:15px; width: 95%; margin: 1em' cellspacing='0'>";

$index = 0;
$priceTotal = 0;
$priceGrandTotal = 0;

while ($row = mysqli_fetch_assoc($result)) {
    if ($name !== $row["name"]) {
        
        $name = $row["name"];

        $cH .= "<tr>
            <th class='text-center'>Supplier #</th>
            <th class='text-center'>Delivery Date</th>
			<th class='text-center'>Supplier Name</th>
            <th class='text-center'>Code</th>
            <th class='text-center'>Qty</th>
			<th class='text-center'>Price</th>
            <th class='text-center'>Total</th>
        </tr>";
    }


        $cH .= "<tr style='text-align:left;'>
                    <td class='text-center'>".$row["invoice_number"]."</th>
					<td class='text-center'>".$row["invoice_date"]."</th>
					<td class='text-center'>".$row["name"]."</th>
                    <td class='text-center'>".$row["code"]."</th>
                    <td class='text-center'>".$row["product_quantity"]."</th>
                    <td class='text-right'>".$row["product_price"]."</th>
					<td class='text-right'>".$row["total"]."</th>
                </tr>";

        $priceTotal += round($row["gtotal"],2);
        $priceGrandTotal += round($row["gtotal"],2);

        $index++;
        $next_row = mysqli_fetch_assoc($result);
        if ($name !== $next_row["name"]) {
            $cH .= "<tr>
						<th></th><th></th><th></th>
                        <th colspan='3' style='text-align:right;'>Total Price</th>
                        <td style='background-color:cyan; color:blue' class='text-right'>".number_format($priceTotal,2)."</td>
                    </tr>";
			$priceTotal = 0;
        }
        mysqli_data_seek($result, $index);
}


$cH .= "<tr><td colspan='4'></td</tr>
        <tr style='text-align:left;'>
		<th></th><th></th><th></th>
            <th colspan='3' style='text-align:right;'>Grand Total</th>
            <td style='background-color:cyan; color:blue' class='text-right'>".number_format($priceGrandTotal,2)."</td>
        </tr>
        </table>";

echo $cH;


?>
