<?php include  "check_user.php"; ?>
<?php include  "../include/db.php"; ?>
<?php 

    $paypalInfo = $_POST; 
    //$item_name = $paypalInfo['item_number'];
	$email = $paypalInfo['email'];
    $custom = mysqli_fetch_assoc(mysqli_query($conn,"select id from users where email = '".$email."'")); 
     
    if(!empty($custom)){
        $check = mysqli_fetch_assoc(mysqli_query($conn,"select * from users where id = '".$custom['id']."'"));
        //$plan  = mysqli_fetch_assoc(mysqli_query($conn,"select * from subscription_plan where id = '".$item_name."'"));
		//$renewal = "N";
		$chkdate = date('Y-m-d',strtotime("+1 Month"));
        if($check['plan_id']==''||$check['plan_id']==Null||$check['plan_expiry']>$chkdate){
			$planexp = date('F j, Y', strtotime($check['plan_expiry']));
			$chkmsg = "This subscriber's plan doesn't expire until $planexp. Are you sure they've already paid to renew it?\r\nClick 'OK' to enter this payment and extend their subscription; or you can 'Cancel'.";
			//$chkmsg = "This subscriber's plan doesn't expire until Monday. Are you sure they already renewed again?";
			echo $chkmsg;
			exit;
		}else{
			echo "User registered successfully.";
			exit;
		}		
		/**mysqli_query($conn,"update users set plan_id = '".$plan['id']."', plan_expiry = '".$date."' where id = '".$custom."'");
		mysqli_query($conn,"update users set plan_id = '".$plan['amount']."', plan_expiry = '".$date."', plan_history_id = '".$plan['plan_name']."' where id = '".$custom['id']."'");
		mysqli_query($conn,"update subscription_plan set amount = 25000 where plan_name = '".$plan['plan_name']."'");
		mysqli_query($conn,"update subscription_plan set validity = 12 where plan_name = '".$plan['plan_name']."'");
        mysqli_query($conn,"INSERT INTO `transactions`(`item_name`, `payment_amount`, `payment_currency`, `txn_id`, `receiver_email`, `payer_email`, `payment_status`, `custom`, `renewal`, `pay_months`) VALUES ('".$plan['plan_name']."',FORMAT(".$plan['amount'].",2),'USD','NA','NA','".$email."','Completed','".$custom['id']."','".$renewal."','".$plan['validity']."')");
		$_SESSION['msg'] = 'Subscription payment was successfully entered.';
		echo "User registered successfully.";
		exit;**/
    }else{
		//$_SESSION['xmsg'] = 'Email address was not found in the customer records. Please try again.';
		echo 'Email address was not found in the customer records. Please try again.';
		exit;
	}
//header("location:paid_plan.php");
exit;