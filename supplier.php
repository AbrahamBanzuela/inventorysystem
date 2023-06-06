<?php

include "connect.php";

session_start();

if(isset($_SESSION['admin_name'])){

?>
<html>
	<head>
		<?php
		include "head.php";
		?>
		<script src="js/supplier.js"></script>
	</head>
	
	
	<body ">
		
		<div class="container-fluid"> <!-- Container DIV for BOOTSTRAP -->
			
			<?php
			include "pulldown_menu.php";
			?>	
			<br><br><br>
			<div class="rows">
				
				<div class="col-sm-6">
				<form>
					<h2>Supplier</h2>
					<div class="input-group mb-3">
						<label>Supplier Code:</label>
						<input type="text" class="form-control input-sm" disabled="true" id="supplier_code" size="8" maxlength="20">
					</div>
					<div class="input-group mb-3">
						<label>Name:</label>
						<input type="text" class="form-control input-sm" disabled="true" id="name" size="17" maxlength="100">
					</div>
					<div class="input-group mb-3">
						<label>Address:</label>
						<input type="text" class="form-control input-sm" disabled="true" id="address" size="20" maxlength="100">
					</div>
					<div class="input-group mb-3">
						<label>Contact:</label>
						<input type="text" class="form-control input-sm" disabled="true" id="contact" size="20" maxlength="100">
					</div>
				</form>
					
					<input type="hidden" value="0" id="supplier_id">
					
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