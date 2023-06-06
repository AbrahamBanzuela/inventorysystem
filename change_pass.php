<?php
include "connect.php";

session_start();

$uname = mysqli_real_escape_string($conn,$_POST['username']);
$oldpass = mysqli_real_escape_string($conn,$_POST['oldpass']);
$newpass = mysqli_real_escape_string($conn,$_POST['newpass']);
$cpass = mysqli_real_escape_string($conn,$_POST['cpass']);

$query = mysqli_query($conn, "SELECT username,password FROM users WHERE username = '$uname' AND password = '$oldpass'");
$num = mysqli_fetch_array($query);

if($num>0){
    $con = mysqli_query($conn,"UPDATE users SET password = '$newpass' WHERE username = '$uname'");
    header("location: change.php?success=Password Change Successfully");
    exit();
}else{
    header("location: change.php?error=Password Does Not Match");
    exit();
}
?>