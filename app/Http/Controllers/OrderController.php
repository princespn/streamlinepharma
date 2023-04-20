<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Account;
use App\Models\AdvanceProductOrder;
use DB;
use PDF;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }

    public function updateCourierDetails(Request $request)
    {
        $account_id = Session::get('user')->id;
        $input = $request->all();
        $order_id = $input['order_id'];
        $courierType = $input['courierType'];
        
        $lastOrder = AdvanceProductOrder::where('id', $order_id)->first();
        $shipyaariData = json_decode($lastOrder->shipyaariPayLoad, true);
		
        if($courierType == 1)
        {
            
            //dd($shipyaariData);
 
            $payLoad =  json_encode($shipyaariData);
            $request_url = "https://seller.shipyaari.com/logistic/webservice/create_consignment_api.php";
            $post = curl_init();
            curl_setopt($post, CURLOPT_URL, $request_url);
            curl_setopt($post, CURLOPT_POST, TRUE);
            curl_setopt($post, CURLOPT_POSTFIELDS, $payLoad);
            curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($post, CURLOPT_HTTPHEADER, array('Accept:application/json' , 'Content-Type:application/json'));
            $response = curl_exec($post);
            //dd($response);

            curl_close($post);

            if($response){
                
                AdvanceProductOrder::where('id', $order_id)->update(['status'=>4,'shipyaariOrderResponse'=>$response,'shipping_gateway'=>1]);
            }
        }else if($courierType == 2){
			//echo $lastOrder->payLoadShipRocket;exit;
			$ship_rocket_token = $this->shipRocketToken($account_id);
			$account = Account::where('id', $account_id)->with(['currency'])->first();
			if(isset($request->shiprocketAllPrices)){
				$tmp_payLoadShipRocket = json_decode($lastOrder->payLoadShipRocket,true);
				$tmp_payLoadShipRocket['pickup_location'] = $request->shiprocketAllPrices;
				$lastOrder->payLoadShipRocket = json_encode($tmp_payLoadShipRocket);
			}
			
			/****************************************/
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>$lastOrder->shipRocketPayLoad,
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Bearer '.$ship_rocket_token
			  ),
			));
            $response = curl_exec($curl);
            curl_close($curl);
			AdvanceProductOrder::where('id', $order_id)->where('account_id',$account_id)->update(['status'=>4,'shipRocketOrderResponse' => $response,'shipping_gateway'=>2]);
			/****************************************/
		}else if($courierType == 3){
			    $data = json_decode($lastOrder->delhiVeryPayload,true);
			    $data['shipments'][0]['total_amount'] = $lastOrder->grand_total;
				if($lastOrder->transactionType==1){
				   $data['shipments'][0]['cod_amount'] = $lastOrder->grand_total;
		        }
				unset($data['shipments'][0]['products_desc']);
				//print_r($data);exit;
				$data = "format=json&data=".json_encode($data);
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
				//var_dump($response);exit;
				AdvanceProductOrder::where('id', $order_id)->where('account_id',$account_id)->update(['status'=>4,'delhiVeryOrderResponse' => $response,'shipping_gateway'=>3]);
        } else {

            $shipyaariOrder = $courierLink.'#@#'.$courierTracking;
            order::where('orderNo', $orderNo)->where('account_id',$account_id)->update(['courierType' => $courierType,'shipyaariOrder' => $shipyaariOrder]);
        }

        return redirect('/admin/advance_order');
    }

    public function updateOrderStatus(Request $request,$orderNo)
    {
        $account_id = Session::get('user')->id;
        order::where('orderNo', $orderNo)->where('account_id',$account_id)->update(['orderStatus' => 4]);
        return redirect('/admin/productOrder');
    }
    
    public function orderPrint(Request $request,$orderNo)
    {
        $account = Session::get('user');
        $account_id = $account->id;

        $orderList = AdvanceProductOrder::where('id',$orderNo)->where('account_id',$account_id)->orderBy('id', 'desc')->first();
        
        //dd($orderList);
		$data = [
            'orderList' => $orderList,
            'account' => $account
        ];
          
        $pdf = PDF::loadView('admin/income/productOrder/orderPrint', $data);
    
        return $pdf->download('invoice-'.$orderList->order_id.'.pdf');
        //return view('admin/income/productOrder/orderPrint',compact('account','orderList'));
    }

    public function orderAcceptance(Request $request,$orderNo)
    {
        $account_id = Session::get('user')->id;
        order::where('orderNo', $orderNo)->where('account_id',$account_id)->update(['orderAcceptance' => 1]);
        return redirect('/admin/productOrder');
    }

    public function orderReject(Request $request,$orderNo)
    {
        $account_id = Session::get('user')->id;
        order::where('orderNo', $orderNo)->where('account_id',$account_id)->update(['orderAcceptance' => 2]);
        return redirect('/admin/productOrder');
    }
	public function getShipRocketlabel($id){
		$account_id = Session::get('user')->id;
		$data = AdvanceProductOrder::where('id',$id)
				->where('account_id',$account_id)
				->first();
		if($data->shipRocketOrderResponse){
		  if(!$data->shiprocketLabel){
			$data = json_decode($data->shipRocketOrderResponse,true);
			if(isset($data['message'])){
				echo $data['message'];
				exit;
			}
			    $ship_rocket_token = $this->shipRocketToken($account_id);
				
				/*********************************/
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/manifests/generate',
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'POST',
				  CURLOPT_POSTFIELDS =>'{
					"shipment_id": ["'.$data['shipment_id'].'"]
				}',
				  CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json',
					'Authorization: Bearer '.$ship_rocket_token
				  ),
				));
                $response = curl_exec($curl);
				curl_close($curl);
				$response = json_decode($response,true);
				AdvanceProductOrder::where('id',$id)
						->where('account_id',$account_id)
					    ->update(['shiprocketManifests' => $response]);
				/*********************************/
				
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/generate/label',
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'POST',
				  CURLOPT_POSTFIELDS =>'{
					"shipment_id": ["'.$data['shipment_id'].'"]
				}',
				  CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json',
					'Authorization: Bearer '.$ship_rocket_token
				  ),
				));
                $response = curl_exec($curl);
				curl_close($curl);
				$response = json_decode($response,true);
				if($response['label_created']!=1){
					echo $response['response'];
					exit;
				}else{
					AdvanceProductOrder::where('id',$id)
						->where('account_id',$account_id)
					    ->update(['shiprocketLabel' => $response['label_url']]);
						header('location:'.$response['label_url']);
			            exit;
				}
				exit;
		  }else{
			  header('location:'.$data->shiprocketLabel);
			  exit;
		  }
		}
	}
	public function shiprocketPickUpRequest($id){
		$account_id = Session::get('user')->id;
		$ship_rocket_token = $this->shipRocketToken($account_id);
		$data = AdvanceProductOrder::where('id',$id)
				->where('account_id',$account_id)
				->first();
		$data = json_decode($data->shipRocketOrderResponse,true);
			if(isset($data['message'])){
				echo $data['message'];
				exit;
			}
			/************************for awb***************************/
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/assign/awb',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>'{
				"shipment_id": "'.$data['shipment_id'].'"
			}',
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Bearer '.$ship_rocket_token
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			AdvanceProductOrder::where('id',$id)
						->where('account_id',$account_id)
					    ->update(['shiprocketAWB' => $response]);
			
			/************************for pickup***************************/
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/generate/pickup',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"shipment_id": ['.$data['shipment_id'].']
			
		}',
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Authorization: Bearer '.$ship_rocket_token
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		AdvanceProductOrder::where('id',$id)
						->where('account_id',$account_id)
					    ->update(['shiprocketPickUpRequest' => $response]);
		return redirect('/admin/advance_order');
	}
	public function shiprocketTrack($id){
		$account_id = Session::get('user')->id;
		$ship_rocket_token = $this->shipRocketToken($account_id);
		$data = DB::table('orders')
		        ->where('orderNo',$id)
				->where('account_id',$account_id)
				->first();
		$data = json_decode($data->shiprocketAWB,true);
			if(isset($data['message'])){
				echo $data['message'];
				exit;
			}

			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/track/awb/'.$data['response']['data']['awb_code'],
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Bearer '.$ship_rocket_token
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			$response = json_decode($response,true);
			if($response['tracking_data']['track_status']!=1){
				echo $response['tracking_data']['error'];
				exit;
			}
			header('location:'.$response['tracking_data']['track_url']);
			exit;
	}
	public function calculatePriceForAllPin($id){
		$data = AdvanceProductOrder::where(id,$id)->first();
		$curl = curl_init();
        curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://seller.shipyaari.com/logistic/webservice/SearchAvailability_new.php',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => 'pickup_pincode=440022&delivery_pincode=110084&weight=0.5&paymentmode=cod&invoicevalue=100&avnkey=5934%405181&service_type=normal&service=Standard&length=27&width=23&height=3&weight=1',
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
		exit;
		$shiprocketAllPrices = array();
		$account_id = Session::get('user')->id;
		$shiprocketPickupLocationAll = json_decode(Session::get('user')->shiprocketPickupLocationAll,true);
		$ship_rocket_token = $this->shipRocketToken($account_id);
		$data = DB::table('orders')
		        ->where('orderNo',$id)
				->where('account_id',$account_id)
				->first();
		$payload = $data->shiprocketAvailabilityPayLoad;
		$payload = explode('&',$payload);
		foreach($shiprocketPickupLocationAll as $row){
			$payload[0] = "pickup_postcode=".$row['pin_code'];
			$tmp_payload = implode('&',$payload);
			$curl = curl_init();
					curl_setopt_array($curl, array(
					CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/serviceability/?'.$tmp_payload,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET',
					CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json',
					'Authorization: Bearer '.$ship_rocket_token
					  ),
					));
					$response = curl_exec($curl);
					curl_close($curl);
					$shiprocket_result = json_decode($response,true);
					$shiprocketAllPrices[] = ['data'=>'From <strong>'.$row['pickup_location']."</strong> : ".$shiprocket_result['data']['available_courier_companies'][0]['rate'].'<br>','pickup_location'=>$row['pickup_location']];
					
		}
		 DB::table('orders')
		        ->where('orderNo',$id)
		        ->update(['shiprocketAllPrices'=>json_encode($shiprocketAllPrices)]);
		 return redirect('/admin/productOrder');
		
	}
	public function getTrackingDetail($id){
		$data = AdvanceProductOrder::where('account_id',Session::get('user')->id)->where('id',$id)->first();
		$message = '';
		$data = json_decode($data->shirocketWebHook,true);
		foreach($data['scans'] as $row){
			$message .= '<tr><td class="track_dot"><span class="track_line"></span></td><td>'.$row['location'].'</td><td>'.$row['activity'].'</td><td>'.$row['date'].'</td></tr>';
		}
		$message = '<table class="table table-bordered table-striped track_tbl"><thead><tr><th></th><th>location</th><th>Satus</th><th>Date</th></tr></thead><tbody>'.$message.'</tbody></table>';
		return $message;
	}
	public function print_delhivery_packing_slip($id){
		$data = AdvanceProductOrder::where('account_id',Session::get('user')->id)->where('id',$id)->first();
		if($data){
			//print_r($data->delhiVeryOrderResponse);exit;
          $json = json_decode($data->delhiVeryOrderResponse,true);
		  $awb = $json['packages'][0]['waybill'];
		    $curl = curl_init();
			curl_setopt_array($curl, [
			CURLOPT_URL => "https://track.delhivery.com/api/p/packing_slip?wbns=".$awb,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => [
				"Authorization: Token 34a20527fc1f62f083fc8e192c6ab5b4dd33457d",
				"accept: application/json"
			],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);
            curl_close($curl);
			$data = json_decode($response,true)['packages'][0];
			//print_r($data);exit;
			return view('admin.advance_product.delhivery_slip')->with('data',$data);

		}else{
           echo 'Inavlid data.';
		   exit;
		}
	}
	public function delivery_pick_up_request(Request $request){
		$date =  str_replace('T',' ',$request->datetime);
		$time = date("H:i:s",strtotime($date));
		$date = date("Y-m-d",strtotime($date));
		
		$array = [
			 "pickup_time"=>$time,
			 "pickup_date"=>$date,
			 "pickup_location"=>"Streamline Pharma Pvt Ltd",
			 "expected_package_count"=>$request->expected_package_count
		];
		  $curl = curl_init();
		  curl_setopt_array($curl, [
			CURLOPT_URL => "https://staging-express.delhivery.com/fm/request/new/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($array),
			CURLOPT_HTTPHEADER => [
			  "Authorization: 34a20527fc1f62f083fc8e192c6ab5b4dd33457d",
			  "Content-Type: application/json",
			  "accept: application/json"
			],
		  ]);
		  $response = curl_exec($curl);
		  $err = curl_error($curl);
		  curl_close($curl);
         
		  return redirect('/admin/advance_order');
		
	}
}
