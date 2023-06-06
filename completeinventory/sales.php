<?php

include "connect.php";

session_start();

if(isset($_SESSION['admin_name'])){

?>
<html>
	<?php
	$_SESSION["sale_details"] = array();
	?>
	
	<head>
		<?php
		include "head.php";
		?>
		<script src="js/sales.js"></script>
	</head>
	
	
	<body style="background-color: wheat;">
		
		<div class="container-fluid small"> <!-- Container DIV for BOOTSTRAP -->
			
			<?php
			include "pulldown_menu.php";
			?>	
			<br><br><br>
			<div class="rows">
				
				<div class="col-sm-10">
					
					<h2>Sales</h2>
					Invoice #:&nbsp;<input type="text" size="10" maxlength="10" disabled="true" id="invoice_number">&nbsp;&nbsp;
					Date:&nbsp;<input type="date" size="10" maxlength="10" disabled="true" id="invoice_date"><br><br>
					Customer:&nbsp;<select disabled="true" id="customers_id"></select>
					<hr>
					<input type="hidden" value="0" id="sale_id">
					
					<div id="details">
					</div>
					
					Product:&nbsp;<select disabled="true" id="product_id"></select>&nbsp;
					Qty:<input id="quantity" disabled="true" type="text" value="0" class="text-right" size="5">&nbsp;
					Price:<input id="price" disabled="true" type="text" value="0" class="text-right" size="10">&nbsp;
					Total:<input id="total" disabled="true" type="text" value="0" class="text-right" size="10">&nbsp;
					<button type="button" id="btn_add_product" disabled="true" class="btn btn-success">Add Product</button>
					
					<hr>
					<button type="button" id="btn_new" class="btn btn-primary">New</button>
					<button type="button" disabled="true" id="btn_cancel" class="btn btn-danger">Cancel</button>
					<button type="button" disabled="true" id="btn_delete" class="btn btn-danger">Delete</button>
					<button type="button" id="btn_view" class="btn btn-info">View</button>
					
					<div id="message" class="hidden"></div>
					
				</div>
				
			</div>
			
			<div id="view_window" class="modal fade" role="dialog">

				<div class="modal-dialog modal-lg" style="width:70%; height:90%; margin:auto;">

					<!-- Modal content-->
					<div class="modal-content">
						
						<br><br>
						<div id="records" class="col-sm-12"></div>
						
						
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</body>
</html>
<?php
}
else{
header ("Location: index.php?error= ACCESS DENIED PLEASE LOGIN!");
exit();
}
?>