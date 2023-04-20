<?php
$data =http_build_query(
   json_decode('{
    "account_number": "2323230087000816",
    "fund_account_id": "fa_KnkqU851raw505",
    "amount": '.$_REQUEST['price'].',
    "currency": "INR",
    "mode": "IMPS",
    "purpose": "refund",
    "queue_if_low_balance": true,
    "reference_id": "Acme Transaction ID 12345",
    "narration": "Acme Corp Fund Transfer",
    "notes": {
      "notes_key_1":"Tea, Earl Grey, Hot",
      "notes_key_2":"Tea, Earl Grey… decaf."
    }
  }',true)
 );
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL,"https://api.razorpay.com/v1/payouts");
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_uybWRysNpUHSqy:CiKSedrXsC8cFEXCu7aVI4Mx');
 curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $server_output = curl_exec($ch);
 
 var_dump($server_output);exit;
 curl_close ($ch);