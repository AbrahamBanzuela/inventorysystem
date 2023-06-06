
<body>
<div class="sidebar">
<div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="accordion accordion-flush" id="sidebarAccordion">
          <!-- Accordion item 1 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                Files
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
              <div class="accordion-body">
                <ul class="list-unstyled">
                  <li><a href="customer.php">Customer</a></li>
                  <li><a href="supplier.php">Supplier</a></li>
                  <li><a href="products.php">Product</a></li>
                  <li><a href="physical_inventory.php">Physical Inventory</a></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Accordion item 2 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                Transaction
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
              <div class="accordion-body">
                <ul class="list-unstyled">
                  <li><a href="sales.php">Sales</a></li>
                  <li><a href="purchases.php">purchases</a></li>
                  
                </ul>
              </div>
            </div>
          </div>

          <!-- Accordion item 3 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
              Report
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse " data-bs-parent="#sidebarAccordion">
              <div class="accordion-body">
                <ul class="list-unstyled">
                  <li><a href="sales_report.php">Sales Summary</a></li>
                  <li><a href="purchase_report.php">Purchases Summary</a></li>
                  <li><a href="inventory_report.php">Inventory Summary</a></li>
                </ul>
              </div>
            </div>
          </div>

            <!-- Accordion item 4 -->
            <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                Account
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
              <div class="accordion-body">
                <ul class="list-unstyled">
                  <li><a href="users.php">Users</a></li>
                  <li><a href="change.php">Change Password</a></li>
                </ul>
              </div>
            </div>
          </div>
          
          <ul class="nav navbar-nav navbar-right">
		      	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out" >Log-out&nbsp;</span></a></li>
		      </ul>
          <!-- End of Menu -->

        </div>
      </div>

      <div class="col-md-9">
        <!-- Main content -->
      </div>
    </div>
  </div>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</div>  
</body>
</html>
<style>
  body{
    margin:0;
    padding:0;
    box-sizing:border-box;
  }
  .sidebar{
    position: absolute;
    left:o;
  }
</style>  