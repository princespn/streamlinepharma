<?php
require_once("vendor/paytm/paytmchecksum/PaytmChecksum.php");

$paytmParams = array();

$paytmParams["subwalletGuid"]      = "contact@kheewa.in";
$paytmParams["orderId"]            = 'KH'.time();
$paytmParams["beneficiaryAccount"] = "918008484891";
$paytmParams["beneficiaryIFSC"]    = "PYTM0123456";
$paytmParams["amount"]             = "1.00";
$paytmParams["purpose"]            = "SALARY_DISBURSEMENT";
$paytmParams["date"]               = "2022-12-01";
$paytmParams["transferMode"]       = "IMPS";

$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/*
* Generate checksum by parameters we have in body
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$checksum = PaytmChecksum::generateSignature($post_data, "dMO6fkL_Y#eIn%Xw");

$x_mid      = "QzMJYt82314251876177";
$x_checksum = $checksum;

/* for Staging */
$url = "https://staging-dashboard.paytm.com/bpay/api/v1/disburse/order/bank";

/* for Production */
//$url = "https://dashboard.paytm.com/bpay/api/v1/disburse/order/bank";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "x-mid: " . $x_mid, "x-checksum: " . $x_checksum)); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$response = curl_exec($ch);
print_r($response);