<?php 
// Include configuration file 
include_once 'include/db.php';
define('PAYPAL_ID', 'service@correctprices.com'); 
define('PAYPAL_SANDBOX', false); //TRUE or FALSE 
define('PAYPAL_RETURN_URL', 'https://correctprices.com/success.php'); 
define('PAYPAL_CANCEL_URL', 'https://correctprices.com/failed.php'); 
define('PAYPAL_NOTIFY_URL', 'https://correctprices.com/responce.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/":"https://www.paypal.com/cgi-bin/webscr");


$raw_post_data = file_get_contents('php://input'); 
$raw_post_array = explode('&', $raw_post_data); 
$myPost = array(); 
foreach ($raw_post_array as $keyval) { 
    $keyval = explode ('=', $keyval); 
    if (count($keyval) == 2) 
        $myPost[$keyval[0]] = urldecode($keyval[1]); 
} 
 
// Read the post from PayPal system and add 'cmd' 
$req = 'cmd=_notify-validate'; 
if(function_exists('get_magic_quotes_gpc')) { 
    $get_magic_quotes_exists = true; 
} 
foreach ($myPost as $key => $value) { 
    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
    } else { 
        $value = urlencode($value); 
    } 
    $req .= "&$key=$value"; 
} 
 
/* 
 * Post IPN data back to PayPal to validate the IPN data is genuine 
 * Without this step anyone can fake IPN data 
 */ 
$paypalURL = PAYPAL_URL; 
$ch = curl_init($paypalURL); 
if ($ch == FALSE) { 
    return FALSE; 
} 
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $req); 
curl_setopt($ch, CURLOPT_SSLVERSION, 6); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1); 
 
// Set TCP timeout to 30 seconds 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name')); 
$res = curl_exec($ch); 
 
/* 
 * Inspect IPN validation result and act accordingly 
 * Split response headers and payload, a better way for strcmp 
 */  
$tokens = explode("\r\n\r\n", trim($res)); 
$res = trim(end($tokens)); 
if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) { 
     
    // Retrieve transaction data from PayPal 
    $paypalInfo = $_POST; 
    $subscr_id = $paypalInfo['subscr_id']; 
    $payer_email = $paypalInfo['payer_email']; 
    $item_name = $paypalInfo['item_name']; 
    $item_number = $paypalInfo['item_number']; 
    $txn_id = !empty($paypalInfo['txn_id'])?$paypalInfo['txn_id']:''; 
    $payment_gross =  !empty($paypalInfo['mc_gross'])?$paypalInfo['mc_gross']:0; 
    $currency_code = $paypalInfo['mc_currency']; 
    $subscr_period = !empty($paypalInfo['period3'])?$paypalInfo['period3']:floor($payment_gross/$itemPrice); 
    $payment_status = !empty($paypalInfo['payment_status'])?$paypalInfo['payment_status']:''; 
    $custom = $paypalInfo['custom']; 
    $subscr_date = !empty($paypalInfo['subscr_date'])?$paypalInfo['subscr_date']:date("Y-m-d H:i:s"); 
    $dt = new DateTime($subscr_date); 
    $subscr_date = $dt->format("Y-m-d H:i:s"); 
    $subscr_date_valid_to = date("Y-m-d H:i:s", strtotime(" + $subscr_period month", strtotime($subscr_date))); 
     
    if(!empty($txn_id)){
        $check = mysqli_fetch_assoc(mysqli_query($conn,"select * from users where id = '".$custom."'"));
        $plan  = mysqli_fetch_assoc(mysqli_query($conn,"select * from subscription_plan where plan_name = '".$item_name."'"));
		$renewal = "N";
        if($check['plan_id']==''||$check['plan_id']==Null||$check['plan_expiry']<date('Y-m-d H:i:s')){
			$date = date('Y-m-d H:i:s',strtotime("+".$plan['validity']." Month"));
		}else{
			$date = date('Y-m-d H:i:s',strtotime("+".$plan['validity']." Month ".$check['plan_expiry']));
			$renewal = "Y";
		}		
		//mysqli_query($conn,"update users set plan_id = '".$plan['id']."', plan_expiry = '".$date."' where id = '".$custom."'");
		mysqli_query($conn,"update users set plan_id = '".$payment_gross."', plan_expiry = '".$date."', plan_history_id = '".$plan['plan_name']."' where id = '".$custom."'");
		mysqli_query($conn,"update subscription_plan set amount = 25000 where plan_name = '".$plan['plan_name']."'");
		mysqli_query($conn,"update subscription_plan set validity = 12 where plan_name = '".$plan['plan_name']."'");
        mysqli_query($conn,"INSERT INTO `transactions`(`item_name`, `payment_amount`, `payment_currency`, `txn_id`, `receiver_email`, `payer_email`, `payment_status`, `custom`, `renewal`, `pay_months`) VALUES ('".$item_name."','".$payment_gross."','".$currency_code."','".$txn_id."','".$subscr_id."','".$payer_email."','".$payment_status."','".$custom."','".$renewal."','".$plan['validity']."')");
    } 
} 
die;