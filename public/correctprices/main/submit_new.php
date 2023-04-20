
<?php include "include/db.php"; 
session_start(); ?>
<?php
if(isset($_POST['submit_password']) && isset($_POST['email']) && isset($_POST['password']))
{
  $email=$_POST['email'];
  $pass=$_POST['password'];
  $select=mysqli_query($conn, "update users set password='$pass' where md5(email)='$email'");
  $_SESSION['msg'] = 'Your password was successfully reset. Login with your new password below.';
  header("location:login.php");
}
else
{
	$_SESSION['msg'] = 'Something went wrong, your password failed to reset. Please try again below.';
	header("location:reset_pass.php");
}
?>