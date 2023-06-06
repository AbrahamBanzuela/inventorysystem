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
		<script src="js/users.js"></script>
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
					<h2>User List</h2>
					<div class="input-group mb-3">
						<label>Name:</label>
						<input type="text" class="form-control input-sm" disabled="true" id="names" size="30" maxlength="100">
					</div>
					<div class="input-group mb-3">
						<label>Username:</label>
						<input type="text" class="form-control input-sm" disabled="true" id="username" size="25" maxlength="100">
					</div>
					<div class="input-group mb-3">
						<label>Password:</label>
						<input type="text" class="form-control input-sm" disabled="true" id="password" size="25" maxlength="100">
					</div>
					<div class="input-group mb-3">
						<label>Password:</label>
						<select disabled="true" id="user_type" value="">
							<option value="admin">admin</option>
						</select>
					</div>
				</form>
					
					<input type="hidden" value="0" id="login_id">
					
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
