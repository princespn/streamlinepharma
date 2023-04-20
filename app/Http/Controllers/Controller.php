<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Account;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function shipRocketToken($account_id){
		$account = Account::where('id', $account_id)->with(['currency'])->first();
		if($account->shiprocketToken==''||date('Y-m-d H:i:s',strtotime('-9 Days'))>$account->shiprocketTokenGenrationTime){
		      $curl = curl_init();
              curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>'{
				"email": "'.$account->shiprocketEmail.'",
				"password": "'.$account->shiprocketPassword.'"
			}',
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			  ),
			));

			$response = json_decode(curl_exec($curl),true);
            curl_close($curl);
			$token = $response['token'];
			$account = Account::where('id',$account->id)->update([
			   'shiprocketToken'=>$token,
			   'shiprocketTokenGenrationTime'=>date('Y-m-d H:i:s')
			]);
			return $token;
		}else{
			return $account->shiprocketToken;
		}
	}
	public function all_color(){
		return ['black','silver','gray','white','maroon','red','purple','fuchsia','green','lime','olive','yellow','navy','blue','teal','aqua'];
	}
	public function activeDomain(){
		$domainName = url('/');
        $domainName = str_replace("https://", "", $domainName);
        $domainName = str_replace("http://", "", $domainName);
        $domainName = str_replace("www.", "", $domainName);
        /*$domainName = 'beditraders.com';
        $domainName = 'mountmiller.com';
        $domainName = 'naveenstores.co.in';*/
		return $domainName;
	}
	
}
