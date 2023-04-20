<?php
$data =http_build_query(
   json_decode('{
      "name":"Ashish Sharma",
      "email":"ashishofficial@hotmail.com",
      "contact":"918726777887",
      "type":"employee",
      "reference_id":"Lucknow"
    }',true)
 );
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL,"https://api.razorpay.com/v1/contacts");
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_uybWRysNpUHSqy:CiKSedrXsC8cFEXCu7aVI4Mx');
 curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $server_output = curl_exec($ch);
 
 var_dump($server_output);exit;
 curl_close ($ch);



exit;
   $ch = curl_init();
    $fields = array();
    $fields["name"] = 'Ashish';
    $fields["email"] = 'Sharma';
    $fields["contact"] = '8726777887';
    $fields["reference_id"] = "customer8726777887";
    $fields["type"] = "customer";
    curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/contacts');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_USERPWD, "rzp_test_uybWRysNpUHSqy: CiKSedrXsC8cFEXCu7aVI4Mx");
    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $data = curl_exec($ch);

    var_dump($data);exit;