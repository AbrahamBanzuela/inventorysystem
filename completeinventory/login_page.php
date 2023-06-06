<?php
include("connect.php");

session_start();

$uname = mysqli_real_escape_string($conn,$_POST['username']);
$pass = mysqli_real_escape_string($conn,$_POST['password']);
$user_type = $_POST['user_type'];

if(empty($uname)){
    header("location: index.php?error=Username is Required");
    exit();
}
elseif(empty($pass)){
    header("location:index.php?error=Password is Required");
    exit();
}

$select = "SELECT * FROM users WHERE username = '$uname' && password = '$pass'";
$result = mysqli_query($conn,$select);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);

    if($row['user_type'] == 'admin'){
        $_SESSION['admin_name'] = $row['names'];
        header("location:admin_page.php");
    }
}
    else{
        header("location: index.php?error=Incorrect Username Or Password");
        exit();
}
?>