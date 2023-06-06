<?php

include "connect.php";

echo "<h3>As of ".date("m/d/Y",strtotime($_REQUEST["date1"]))."</h3>";


$conn = mysqli_connect("localhost","root","","inventory");

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
GROUP BY product.product_code";


$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$product = "";
$cH = "<table class='table table-striped table-bordered table-hover table-responsive' border='1' style='font-size:15px; width: 95%; margin: 1em' cellspacing='0'>";
$cH .= "<tr>
<th class='text-center'>Product</th>
<th class='text-center'>Beg.Qty</th>
<th class='text-center'>Sales.Qty</th>
<th class='text-center'>Purchases.Qty</th>
<th class='text-center'>End.Qty</th>
<th class='text-center'>Price</th>
<th class='text-center'>Total</th>
</tr>";

$index = 0;
$priceTotal = 0;
$priceGrandTotal = 0;
$productCount = 0;

while ($row = mysqli_fetch_assoc($result)) {

        $cH .= "<tr style='text-align:left;'>
                    <td class='text-center'>".$row["product"]."</th>
					<td class='text-center'>".$row["physical_quantity"]."</th>
					<td class='text-center'>".$row["sale_quantity"]."</th>
                    <td class='text-center'>".$row["purchase_quantity"]."</th>
                    <td class='text-center'>".$row["end_qty"]."</th>
                    <td class='text-right'>".$row["price"]."</th>
					<td class='text-right'>".number_format($row["total"],2)."</th>
                </tr>";

        $productCount += round($row["product_count"],2);
        $priceTotal += round($row["total"],2);
        $priceGrandTotal += round($row["total"],2);

}


$cH .= "<tr></tr>
        <tr style='text-align:left;'>
        <td style='background-color:cyan; color:blue' class='text-center'>".number_format($productCount,2)."</td>
            <th style='text-align:left;'>Product Count</th>
            <td></td><td></td><td></td>
            <th style='text-align:right;'>Grand Total</th>
            <td style='background-color:cyan; color:blue' class='text-right'>".number_format($priceGrandTotal,2)."</td>
        </tr>
        </table>";

echo $cH;


?>
