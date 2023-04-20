<?php
/*
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://track.delhivery.com/waybill/api/bulk/json/?token=34a20527fc1f62f083fc8e192c6ab5b4dd33457d&count=1&client_name=Ganga",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

exit;*/
$order_id = time();
$array = [
    "shipments"=>[
                     [
                      "add" => "B60 Parijat Enclave",
                      "phone" => "9872577500",
                      "payment_mode" => "Prepaid",
                      "name" => "Ganga Ram",
                      "pin" => "226029",
                      "order" => $order_id,
                      "shipping_mode" => "Express",
                      "weight"=>"100",
                      "shipment_height"=>"10",
                      "shipment_width"=>"10",
                      "shipment_length"=>"10",
                      "state"=>"UP",
                      "total_amount"=>"120",
                      "city"=>'Lucknow',
                      "products_desc"=>"STREAMLINE EYEFIT DRY EYE DROPS",
                      "order_date"=>"2022-01-23 12:00:00",
                      "quantity"=>"1",
                      "country"=>"India"
                     ],
                     [
                      "add" => "B60 Parijat Enclave",
                      "phone" => "9872577500",
                      "payment_mode" => "Prepaid",
                      "name" => "Ganga Ram",
                      "pin" => "226029",
                      "order" => $order_id,
                      "shipping_mode" => "Express",
                      "weight"=>"100",
                      "shipment_height"=>"10",
                      "shipment_width"=>"10",
                      "shipment_length"=>"10",
                      "state"=>"UP",
                      "total_amount"=>"120",
                      "city"=>'Lucknow',
                      "products_desc"=>"STREAMLINE EYEFIT WET EYE DROPS",
                      "order_date"=>"2022-01-23 12:00:00",
                      "quantity"=>"1",
                      "country"=>"India"
                      ]
                 ],
    "pickup_location"=>[
      "name"=> "Streamline Pharma Pvt Ltd"
    ]
];
$data = "format=json&data=".json_encode($array);
$data = "format=json&data=".json_encode($array);
//echo $data;exit;
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://track.delhivery.com/api/cmu/create.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => [
    "Authorization: Token 34a20527fc1f62f083fc8e192c6ab5b4dd33457d",
    "Content-Type: application/json",
    "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}