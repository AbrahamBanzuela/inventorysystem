<?php

include("connect.php");

session_start();

if(isset($_SESSION['admin_name'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include "head.php";
?>
 </head>
<body >
<?php
include "pulldown_menu.php";
?>
<br><br><br>
<div class="rows">
    <div class="col-sm-6">   
    <form action="change_pass.php" method="POST">
    	<h4>Change Password</h4>
        <?php if(isset($_GET['error'])) { ?>
                <p class="error" style="color: red; text-align: left;"> <?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if(isset($_GET['success'])) { ?>
                <p class="success" style="color: green; text-align: left;"> <?php echo $_GET['success']; ?></p>
            <?php } ?> 
        <div class="input-group mb-3">
            <label>Username</label>
            <input type="text" class="form-control input-sm" placeholder="Username ID" name="username" size="19">
        </div>
        <div class="input-group mb-3">
            <label>Old Password</label>
            <input type="password" class="form-control input-sm" placeholder="Old Password" name="oldpass" size="15">
        </div>
        <div class="input-group mb-3">
            <label>New Password</label>
            <input type="password" class="form-control input-sm" class="form-control input-sm" placeholder="New Password" name="newpass" size="14">
        </div>
        <div class="input-group mb-3">
            <label>Confirm Password</label>
            <input type="password" class="form-control input-sm" placeholder="Confirm Password" name="cpass" size="10">
        </div>
        <button type="submit" class="btn btn-success" id="btn_save">Save</button>
        <a href="admin_page.php"><button type="button" class="btn btn-info" id="btn_return">Home</button></a> 
    </form>	
</div>
</div>
</body>
</html>
<?php
}
else{
    header("location:index.php?error= ACCESS DENIED PLEASE LOGIN!");
    exit();
}
?>	