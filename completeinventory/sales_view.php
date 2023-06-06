<?php


echo "<h3>".date("m/d/Y",strtotime($_REQUEST["date_from"]))." to ".date("m/d/Y",strtotime($_REQUEST["date_to"]))."</h3>";


$conn = mysqli_connect("localhost","root","","inventory");

$query = "select sales.invoice_number,sales.invoice_date,
concat(customers.last_name,', ',customers.first_name,' ',substr(customers.middle_name,1,1),'.') as customers_name,
group_concat(product.product_code SEPARATOR '<br>') as code,
group_concat(sale_details.quantity SEPARaTOR '<br>') as product_quantity,
group_concat(sale_details.price SEPARATOR '<br>') as product_price,
group_concat(sale_details.quantity * sale_details.price separator '<br>') as total,
sum(sale_details.quantity * sale_details.price) as gtotal
from product, sales, sale_details, customers 
where invoice_date between '".date('Y/m/d',strtotime($_REQUEST["date_from"]))."'
and '".date('Y/m/d',strtotime($_REQUEST["date_to"]))."' and sales.customers_id = customers.customers_id 
and sale_details.product_id = product.product_id and sales.sale_id = sale_details.sale_id 
group by sales.customers_id order by invoice_date,invoice_number";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$customer = "";
$cH = "<table class='table table-striped table-bordered table-hover table-responsive' border='1' style='font-size:15px; width: 95%; margin: 1em' cellspacing='0'>";

$index = 0;
$priceTotal = 0;
$priceGrandTotal = 0;

while ($row = mysqli_fetch_assoc($result)) {
    if ($customer !== $row["customers_name"]) {
        
        $customer = $row["customers_name"];

        $cH .= "<tr>
            <th class='text-center'>Invoice #</th>
            <th class='text-center'>Invoice Date</th>
			<th class='text-center'>Customer Name</th>
            <th class='text-center'>Code</th>
            <th class='text-center'>Qty</th>
			<th class='text-center'>Price</th>
            <th class='text-center'>Total</th>
        </tr>";
    }


        $cH .= "<tr style='text-align:left;'>
                    <td class='text-center'>".$row["invoice_number"]."</th>
					<td class='text-center'>".$row["invoice_date"]."</th>
					<td class='text-center'>".$row["customers_name"]."</th>
                    <td class='text-center'>".$row["code"]."</th>
                    <td class='text-center'>".$row["product_quantity"]."</th>
                    <td class='text-right'>".$row["product_price"]."</th>
					<td class='text-right'>".$row["total"]."</th>
                </tr>";

        $priceTotal += round($row["gtotal"],2);
        $priceGrandTotal += round($row["gtotal"],2);

        $index++;
        $next_row = mysqli_fetch_assoc($result);
        if ($customer !== $next_row["customer_name"]) {
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
