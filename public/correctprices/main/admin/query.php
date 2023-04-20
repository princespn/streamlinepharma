<?php
include  "../include/db.php";
session_start();
if($_REQUEST['type']=='login'){
	$check = mysqli_num_rows(mysqli_query($conn,"select * from users where email = '".$_POST['email']."' and password = '".$_POST['password']."' and type='admin'"));
	if($check){
		$data = mysqli_fetch_assoc(mysqli_query($conn,"select * from users where email = '".$_POST['email']."' and password = '".$_POST['password']."' and type='admin'"));
		$_SESSION['id'] = $data['id'];
		$_SESSION['type'] = 'admin';
		$_SESSION['name'] = $data['name'];
		echo "Logged In!";
		exit;
	}else{
		echo "Email or password is incorrect.";
		exit;
	}
}
if($_REQUEST['type']=='subscription_plan'){
	if(isset($_POST['id'])){
		mysqli_query($conn,"update  `subscription_plan` set  plan_name = '".$_POST['plan_name']."' , amount = '".$_POST['amount']."', validity = '".$_POST['validity']."' where id = '".$_POST['id']."'");
		$_SESSION['msg'] = 'Subscription Plan Updated Successfully.';

	}else{
		mysqli_query($conn,"INSERT INTO `subscription_plan`(`plan_name`, `amount`, `validity`) VALUES ('".$_POST['plan_name']."','".$_POST['amount']."','".$_POST['validity']."')");
		$_SESSION['msg'] = 'Subscription Plan Created Successfully.';
	}
	header("location:subscription_plan.php");
}
if($_REQUEST['type']=='del_sb_pl'){
    mysqli_query($conn,"DELETE FROM `subscription_plan` WHERE  id = '".$_REQUEST['id']."'");
	$_SESSION['msg'] = 'Subscription Plan Deleted Successfully.';
	header("location:subscription_plan.php");
}
if($_REQUEST['type']=='contact_us_email'){
    mysqli_query($conn,"update users set  admin_email = '".$_POST['admin_email']."' WHERE  id = '1'");
	$_SESSION['msg'] = 'Updated Successfully.';
	header("location:email.php");
}