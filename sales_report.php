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
		<script src="js/view.js"></script>
	</head>
<body style="background-color: wheat;">
<?php
			include "pulldown_menu.php";
			?>	
			<br><br><br>
<form onload="return false;">
<h2>Sales Summary Report</h2>
<h4> Sales Date:</h4>
    <form method='submit'>
      <label>From: </label><input type="date" id="date_from"> 
      <label>To: </label><input type="date" id="date_to">

	  <button type="button" class="btn btn-primary" id="btn_process">Process Report</button>
	  <button type="button" class="btn btn-success" id="btn_print">Print Report</button>
</form>

<div style="clear:both;"></div> <!-- line break -->
        <br><br>
            <div style="height:50%; width: 70%; border:solid 3px black; oveflow-y:scroll; overflow-x:hidden; position:absolute; margin-left:100px;">
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