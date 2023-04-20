<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB; 
use Redirect; 
use App\Models\AdvanceProductSetting;
use App\Models\Account;
use App\Models\AdvanceProduct;
use App\Models\AdvanceProductAttribute;
use App\Models\Category;
use App\Models\AdvanceProductCategory;
use App\Models\Brand;
use App\Models\imageUpload;
use App\Models\AdvanceProductOrder;
use App\Models\AdvanceProductCart;
use App\Models\Msgnotify;
use App\Models\ForeSaleX;
use App\Models\Coupon;
use App\Models\Register;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ForeSaleXController extends Controller
{
    public function index(){
		$account = Account::where('id',Session::get('user')->id)->first();
		$subscribedTemplate    = $account->subscribedTemplate;
		$available = AdvanceProductSetting::whereIn('id',explode(',',$subscribedTemplate))->get();
		return view('admin/offers/foresalex/index')->with('available',$available);
	}
	public function generateRandomString($length = 5){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function coupon_code1($n){
        $rand='';
        for($i=0; $i<$n; $i++){
            $rand .= $this->generateRandomString();
            if($n != $i+1){ $rand.= ",";}  
        }
        return $rand;
	}
	public function coupon_code($n,$noOfSet,$scheme_name,$template,$refferal_benifit,$refree_benifit,$validity_date,$user_type='All'){
		$time=time();
		
		$findid='';
        for($t=1; $t<=$noOfSet; $t++){
            for($i=1; $i<=$n; $i++){
               	 $set =$t; 
              	 $rand = $this->generateRandomString();
            	 $findid.=DB::table('coupons')->insertGetId(['no_set'=>$set,'coupon'=>$rand,'scheme_name'=>$scheme_name,'template'=>$template,'time'=>$time,'added_by'=>Session::get('user')->id,'refferal_benifit'=>$refferal_benifit,'refree_benifit'=>$refree_benifit,'validity_date'=>$validity_date,'user_type'=>$user_type]);
                 if($n != $i){$findid.= ",";}  
            }
            if($t != $noOfSet){$findid.= "/";}   
        }
		return explode('/',$findid);
        //return json_encode(explode('/',$findid));
		

	}	
	public function template($id){
		return AdvanceProductSetting::where('id',$id)->first()->name;
	}
	public function store(Request $request){

		$list=[];
		for($i=0; $i < count($request->template); $i++){
			$template_array[$i] = array(
				'template'=>$request->template[$i],
				'number_of_coupon'=>$request->number_of_coupon[$i],
				'coupon_code'=>$this->coupon_code($request->number_of_coupon[$i],$request->number_of_set,$request->scheme_name,$request->template[$i],$request->refferal_benifit[$i],$request->refree_benifit[$i],$request->validity_date,$request->user_type),
				'refferal_benifit'=>$request->refferal_benifit[$i],
				'refree_benifit'=>$request->refree_benifit[$i]
			);
			
		}
		$merged = array_merge($list, $template_array);
		$array_data = array(
			'scheme_name'=>$request->scheme_name,
			'user_type'=>$request->user_type,
			'template_array'=>json_encode($merged),
			'number_of_set'=>$request->number_of_set,
			'added_by'=>Session::get('user')->id,
			'validity_date'=>$request->validity_date
		);

		//print_r($array_data);exit;
		ForeSaleX::insert($array_data);
		#update coupon in forsale table ;
		//DB::table('coupons')->whereIn('id',explode(',',$))
		return Redirect::back()->with('status','Subscribed Successfully.');
	}
	public function findCuopan($data){
		return DB::table('coupons')
		->select('coupon')
		->whereIn('id',$data)->get();

	}
	public function findAllCuopan($data){
		
		$coupons_data = DB::table('coupons')
		->select('coupon')
		->whereIn('id',$data)
        ->get()->toArray();
		 $props = array_map(function($obj){ return $obj->coupon; }, $coupons_data);
		 return implode(',',$props);
		
	}
	public function coup_name($id){
		$coupon= DB::table('coupons')->where('id',$id)->first();
		return $coupon;

	}

	public function couponsAssigned($coupons){
		return DB::table('coupons')->where('coupon',$coupons)->where('send_to','!=','')->count();
	}
	public function usettime($coupons){
		return DB::table('coupons')->where('coupon',$coupons)->whereNotNull('uesttime')->count();
	}
	public function couponUser($coupon){
		$coupon = coupon::with('register')->where('coupon',$coupon)->first();
		return ($coupon->toArray()['register']);
		
	}
	public function view_fore_sale_x(Request $request){
		//$data=ForeSaleX::where('status','1')->get();
		$data=ForeSaleX::where('status','1')
		->where('added_by',Session::get('user')->id);
		if(isset($request->scheme_name)){$data=$data->where('scheme_name', 'like', '%' . $request->scheme_name . '%');}
		$data=$data->paginate(10);
		$data->appends($request->all());
		$userList = DB::table('registers')->where('account_id',Session::get('user')->id)->get();
		//print_r($data);exit;
		
		return view('admin/offers/foresalex/viewSaleX')->with('data',$data)->with('otherdata',$this)->with('userList',$userList);
	}

	public function ExsalCoupons($id,$coupon,$refferal_benifit,$refree_benifit){
		#This code is not active...
		$data=ForeSaleX::where('id',$id)->first();
		$table='<table border="1"><thead><tr><th>#</th><th>Scheme Name</th><th>Set Number </th><th>Template Name - Code</th><th> Referral Benefits </th><th> Referee Benefits  </th></tr> </thead>';
		$table.='<tbody><tr><th scope="row">1</th><td>'.$data->scheme_name.'</td><td>'.$data->number_of_set.'</td><td>'.$coupon.'</td><td>'.$refferal_benifit.'</td><td>'.$refree_benifit.'</td></tr></tbody></table>';
	
		//header info for browser
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
		header("Content-Disposition: attachment; filename=results.xls");
		header("Cache-Control: max-age=0");
		
		echo $table;
	}
	public function assignUser($id){
		return DB::table('coupons')->where('send_to',$id)->count();
	}

	public function SingleTemplate($id,$row){
		$data=ForeSaleX::where('id',$id)->first();
		$userList = DB::table('registers')->where('account_id',Session::get('user')->id)->get();
		return view('admin/offers/foresalex/single_template')->with('data',$data)->with('no',$row)->with('otherdata',$this)->with('userList',$userList)->with('sale_x_id',$id);
	}
	public function testExcel($id,$row){
		
		$data=ForeSaleX::where('id',$id)->first();
		$json = json_decode($data->template_array,true);
		$cusChar = 'C';
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Scheme Name');
		$sheet->setCellValue('B1', 'Set Number');
		$cusChar='C';
		foreach($json as $key=>$json_view){
		$k=$key+1;$coupon=explode(',',$json_view['coupon_code'][$row]);
			foreach($coupon as $coupon_id){
				$sheet->setCellValue($cusChar++.'1', $this->template($json_view['template']));
			}
			
			$sheet->setCellValue($cusChar++.'1', 'Referral Benefits');
			$sheet->setCellValue($cusChar++.'1', 'Referee Benefits');
	
		}
		$sheet->setCellValue('A2', $data->scheme_name);
		$sheet->setCellValue('B2', $data->number_of_set);
		$re_char='C';
		foreach($json as $key=>$json_view){
		$k=$key+1;$coupon=explode(',',$json_view['coupon_code'][$row]);
			foreach($coupon as $coupon_id){
				$sheet->setCellValue($re_char++.'2', $this->coup_name($coupon_id)->coupon);
			}

			$sheet->setCellValue($re_char++.'2', $json_view['refferal_benifit']);
			$sheet->setCellValue($re_char++.'2', $json_view['refree_benifit']);
	
		}
	
		$writer = new Xlsx($spreadsheet);

		$string = $data->scheme_name;
		$s = ucfirst($string);
		$bar = ucwords(strtolower($s));
		$fileName = preg_replace('/\s+/', '', $bar);
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="'. urlencode($fileName).'.xlsx"');
				$writer->save('php://output');
		//$writer->save('hello world.xlsx');
	}
	public function view_sale_x(){

		
		$user = register::with('coupons')->where('id','397')->first();
		echo "<pre>";
		
		print_r($user->toArray());
		exit;
		$coupon = coupon::with('register')->where('coupon','c3wgxlJI')->first();
		echo "<pre>";
		
		print_r($coupon->toArray()['register']);
		exit;
		//$data=ForeSaleX::where('status','1')->get();
		$data=ForeSaleX::where('status','1')->where('added_by',Session::get('user')->id)->get();
		
		//print_r($data);exit;
		
		return view('admin/offers/foresalex/viewSaleX')->with('data',$data)->with('otherdata',$this);
	}


	public function cuopan_set_shared_with(Request $request){

		$coupon=$request->coupon;
		$userName=$request->userName;
		$set=$request->set;
		if($userName !=''){
		DB::table('coupons')->where('no_set',$set)->where('added_by',Session::get('user')->id)->whereIn('coupon',$coupon)->update(['send_to'=>$userName]);
		DB::table('coupon_assign')->insert(['sale_x_id'=>$request->sale_x_id,'set_no'=>$set,'send_to'=>$userName,'send_from'=>Session::get('user')->id]);
		return Redirect::back()->with('status','Send Coupons Successfully.');
		}else{
			return Redirect::back()->with('error','Error!  please select an user.');
		}
		
	}
	public function UsedCoupon($id,$i){
		$data=ForeSaleX::where('id',$id)->first();
		$json = json_decode($data->template_array,true);
		$find='';
		foreach($json as $k=>$jsonvalue){
			$find.= ($jsonvalue['coupon_code'][$i]);
			$find.=',';
		}
		  $array = explode(",",$find); unset($array[count($array)-1]);
		  $datarow=DB::table('coupons')
		  ->select('coupons.*','advance_product.title','advance_product.selling_price','registers.name as username','registers.phone')
		  ->leftJoin('advance_product','coupons.product_id','=','advance_product.id')
		  ->leftJoin('registers','coupons.used_to','=','registers.id')
		  ->whereIn('coupons.id',$array)
		  ->whereNotNull('coupons.uesttime')->get();
	
		   $table ='<table class="table table-bordered"><thead><tr><th>Used by</th><th>Coupon</th><th>Used Time</th><th>Product Name</th><th>Price</th><th colspan="2">Refferal Benifit / Refree Benifit</th></tr></thead><tbody>';
		   foreach($datarow as $datavalue){ 
				$table.='<tr><td>'.$datavalue->username.' <strong>Mobile : </strong>'.$datavalue->phone.'</td><td>'.$datavalue->coupon.'</td><td>'.$datavalue->uesttime.'</td><td>'.$datavalue->title.'</td><td>Rs.'.($datavalue->selling_price-$datavalue->refferal_benifit).'</td><td>Rs.'.$datavalue->refferal_benifit.'</td><td>Rs.'.$datavalue->refree_benifit.'</td></tr>';
				}
				if(count($datarow)=='0'){
				$table.='<tr><td colspan="7">No Record found...</td></tr>';	
			}
		   return $table.='</tbody></table>';
		 

		  

	}
	

}
