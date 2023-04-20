<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/settings/company/pickup',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE0MDE3NTksImlzcyI6Imh0dHBzOi8vYXBpdjIuc2hpcHJvY2tldC5pbi92MS9leHRlcm5hbC9hdXRoL2xvZ2luIiwiaWF0IjoxNjIyMDI1MTM0LCJleHAiOjE2MjI4ODkxMzQsIm5iZiI6MTYyMjAyNTEzNCwianRpIjoicEw3dDl1VmJXdlVIYjIwZCJ9.B1C3UlwIJrAmazdwub-IZVoxViHq4jAVauxdSbc9394'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
print_r(json_decode($response,true));