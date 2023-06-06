<?php

include "connect.php";

session_start();

if(isset($_SESSION['admin_name'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
		<?php
		include "head.php";
		?>
		<script src="js/view_inventory.js"></script>
	</head>
<body style="background-color: wheat;">
<?php
			include "pulldown_menu.php";
			?>	
			<br><br><br>
<form onload="return false;">
<h2>Inventory Report</h2>
<h4> Inventory Date:</h4>
    <form method='submit'>
      <label>Date: </label><input type="date" id="date1"> 

	  <button type="button" class="btn btn-primary" id="btn_process">Process Inventory</button>
	  <button type="button" class="btn btn-success" id="btn_print">Print Report</button>
</form>

<div style="clear:both;"></div> <!-- line break -->
        <br><br>
            <div style="height:60%; width: 70%; border:solid 3px black; oveflow-y:scroll; overflow-x:hidden; position:absolute; margin-left:100px;">
			<div id="records" class="load-body"></div>
		
		</div>
        <div style="clear:both;"></div> <!-- line break -->
        <br><br>
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