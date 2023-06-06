
<nav class="navbar navbar-inverse navbar-fixed-top">
		
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		</button>
		<a class="navbar-brand" style="color:Black;" href="admin_page.php">Inventory System Program</a>
	</div>
	
	<div class="collapse navbar-collapse menubar" id="myNavbar" style="color:charcoal;">
		<ul class="nav navbar-nav">
			
			<li class="dropdown">
				
				<a class="dropdown-toggle active" data-toggle="dropdown" href="#">Files<span class="caret"></span></a>
				
				<ul class="dropdown-menu" >
					<li><a href="customer.php">Customers</a></li>
					<li><a href="supplier.php">Supplier</a></li>
					<li><a href="products.php">Products</a></li>
					<li><a href="physical_inventory.php">Physical Inventory</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				
				<a class="dropdown-toggle active" data-toggle="dropdown" href="#">Transaction<span class="caret"></span></a>
				
				<ul class="dropdown-menu">
					<li><a href="sales.php">Sales</a></li>
					<li><a href="purchases.php">Purchases</a></li>
				</ul>
			</li>
			<li class="dropdown">
				
				<a class="dropdown-toggle active" data-toggle="dropdown" href="#">Report<span class="caret"></span></a>
				
				<ul class="dropdown-menu">
					<li><a href="sales_report.php">Sales Summary</a></li>
					<li><a href="purchase_report.php">Purchases Summary</a></li>
					<li><a href="inventory_report.php">Inventory Report</a></li>
				</ul>
			</li>
			<li class="dropdown">
				
				<a class="dropdown-toggle active" data-toggle="dropdown" href="#">Account<span class="caret"></span></a>
				
				<ul class="dropdown-menu">
					<li><a href="users.php">Users</a></li>
					<li><a href="change.php">Change Password</a></li>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out" >Log-out&nbsp;</span></a></li>
		</ul>
	</div>
	
</nav>