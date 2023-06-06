<?php

include "connect.php";

session_start();

if(isset($_SESSION['admin_name'])){

?>

<html>
	<head>
		<?php
		include("head.php");
		?>
	</head>
	
	
	<body style="background-color: charcoal;">
		
		<div class="container"> <!-- Container DIV for BOOTSTRAP -->
			
			<?php
			include("pulldown_menu.php");
			?>
				
            <h2 class="page-header">Welcome <?php echo $_SESSION['admin_name']?></h2>
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
<style>

	.page-header{text-align: center; color: navy; font-size: 70px; font-family: sans-serif; margin-top: 150px;}
</style>