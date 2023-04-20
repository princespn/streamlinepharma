<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Illuminate\Support\Facades\Session;
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
use App\Models\DynamicMenu;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class AdvanceProductController extends Controller
{
    public function advance_product_template($id=''){
		$return = view('supperAdmin.advance_product.advance_product_template');
		if($id!=''){
			$data = AdvanceProductSetting::where('id',$id)->first();
			$optional = explode(',',$data->isOptional);
			$grouping = explode(',',$data->grouping);
			$additional_attribute = json_decode($data->additional_attribute,true);
			$return = $return->with('data',$data);
			$return = $return->with('optional',$optional);
			$return = $return->with('grouping',$grouping);
			$return = $return->with('additional_attribute',$additional_attribute);
			
			$check = DB::table('advance_product_setting_hint')->where('setting_id',$id)->first();
			if($check){
				$return = $return->with('hints',$check);
			}
		}
		return $return;
	}
	public function advance_product_template_post(Request $request){
		
		$check_pre = AdvanceProductSetting::where('name',$request->name);
		if(isset($request->id)){
			$check_pre = $check_pre->where('id','!=',$request->id)->count();
		}else{
			$check_pre = $check_pre->count();
		}
		if($check_pre>0){
			return Redirect::back()->with('error','Template Already Exist.');
			exit;
		}
		if(isset($_POST['additional_attribute'])&&count($_POST['additional_attribute'])){
		$json = json_encode(
		          array($_POST['additional_attribute'],$_POST['additional_attribute_option'],$_POST['additional_attribute_value'])
		        );
		}else{
			$json = Null;
		}
		
		$array = [
		 'name' => $request->name,
		 'menu' => '0',
		 'sub_menu' => '0',
		 'company_id' => '',
		 'title_check' => (isset($request->title_check) ? 1 : 0),
		 'video_check' => (isset($request->video_check) ? 1 : 0),
		 'view_360_file_check' => (isset($request->view_360_file_check) ? 1 : 0),
		 'brand_check' => (isset($request->brand_check) ? 1 : 0),
		 'search_key_words_check' => (isset($request->search_key_words_check) ? 1 : 0),
		 'hsn_code_check' => (isset($request->hsn_code_check) ? 1 : 0),
		 'thumbnail_check' => (isset($request->thumbnail_check) ? 1 : 0),
		 'image1_check' => (isset($request->image1_check) ? 1 : 0),
		 'image2_check' => (isset($request->image2_check) ? 1 : 0),
		 'image3_check' => (isset($request->image3_check) ? 1 : 0),
		 'image4_check' => (isset($request->image4_check) ? 1 : 0),
		 'image5_check' => (isset($request->image5_check) ? 1 : 0),
		 'image6_check' => (isset($request->image6_check) ? 1 : 0),
		 'image7_check' => (isset($request->image6_check) ? 1 : 0),
		 'sku_check' => (isset($request->sku_check) ? 1 : 0),
		 'product_code_check' => (isset($request->product_code_check) ? 1 : 0),
		 'unit_type_check' => (isset($request->unit_type_check) ? 1 : 0),
		 'unit_type_check_value_multi' => $request->unit_type_check_value_multi,
		 'product_price_check' => (isset($request->product_price_check) ? 1 : 0),
		 'product_tax_check' => (isset($request->product_tax_check) ? 1 : 0),
		 'cess_check' => (isset($request->cess_check) ? 1 : 0),
		 'selling_price_check' => (isset($request->selling_price_check) ? 1 : 0),
		 'moq_check' => (isset($request->moq_check) ? 1 : 0),
		 //'product_tax_check_value' => $request->product_tax_check_value,
		 //'cess_check_value' => $request->cess_check_value,
		 'selling_price_label' => $request->selling_price_label,
		 'tax_method_check' => (isset($request->tax_method_check) ? 1 : 0),
		 'description_check' => (isset($request->description_check) ? 1 : 0),
		 'status_check' => (isset($request->status_check) ? 1 : 0),
		 'color_check' => (isset($request->color_check) ? 1 : 0),
		 'color_check_value' => $request->color_check_value,
		 'dimension_check' => (isset($request->dimension_check) ? 1 : 0),
		 'size_check' => (isset($request->size_check) ? 1 : 0),
		 'size_check_value' => $request->size_check_value,
		 'size_check_value_option' => $request->size_check_value_option,
		 'weight_check' => (isset($request->weight_check) ? 1 : 0),
		 'additional_attribute' => $json,
		 'brand_filter' => (isset($request->brand_filter) ? 1 : 0),
		 'category_filter' => (isset($request->category_filter) ? 1 : 0),
		 'sub_category_filter' => (isset($request->sub_category_filter) ? 1 : 0),
		 'selling_price_filter' => (isset($request->selling_price_filter) ? 1 : 0),
		 'moq_filter' => (isset($request->moq_filter) ? 1 : 0),
		 'status_filter' => (isset($request->status_filter) ? 1 : 0),
		 'color_filter' => (isset($request->color_filter) ? 1 : 0),
		 'isOptional' => (isset($request->isOptional) ? implode(',',$request->isOptional) : ''),
		 'grouping' => (isset($request->grouping) ? implode(',',$request->grouping) : ''),
		 'dimension_filter' => (isset($request->dimension_filter) ? 1 : 0),
		 'size_filter' => (isset($request->size_filter) ? 1 : 0),
		 'weight_filter' => (isset($request->weight_filter) ? 1 : 0),
		 'search_key_words_filter' => (isset($request->search_key_words_filter) ? 1 : 0)
		];
		if(isset($request->id)){
			$message = 'Updated Successfully.';
			AdvanceProductSetting::where('id',$request->id)->update($array);
			$last_id = $request->id;
		}else{
			$message = 'Added Successfully.';
		    $last_id = AdvanceProductSetting::insertGetId($array);
			
		}
		
		
		/***********************************/
		$check = DB::table('advance_product_setting_hint')->where('setting_id',$last_id)->first();
			$array = [];
			$array['setting_id'] = $last_id;
			$array['name_hint'] = $request->name_hint;
			$array['title_hint'] = $request->title_hint;
			$array['video_hint'] = $request->video_hint;
			$array['view_360_file_hint'] = $request->view_360_file_hint;
			$array['brand_hint'] = $request->brand_hint;
			$array['thumbnail_hint'] = $request->thumbnail_hint;
			for($i=1;$i<8;$i++){
				$h = 'image'.$i.'_hint';
				$array['image'.$i.'_hint'] = $request->$h;
			}
			$array['sku_hint'] = $request->sku_hint;
			$array['product_code_hint'] = $request->product_code_hint;
			$array['unit_hint'] = $request->unit_hint;
			$array['hsn_code_hint'] = $request->hsn_code_hint;
			$array['product_price_hint'] = $request->product_price_hint;
			$array['selling_price_hint'] = $request->selling_price_hint;
			$array['moq_hint'] = $request->moq_hint;
			$array['product_tax_hint'] = $request->product_tax_hint;
			$array['tax_method_hint'] = $request->tax_method_hint;
			$array['cess_hint'] = $request->cess_hint;
			$array['description_hint'] = $request->description_hint;
			$array['status_hint'] = $request->status_hint;
			$array['color_hint'] = $request->color_hint;
			$array['dimension_hint'] = $request->dimension_hint;
			$array['size_hint'] = $request->size_hint;
			$array['weight_hint'] = $request->weight_hint;
			$array['search_key_words_hint'] = $request->search_key_words_hint;
			if($check){
				DB::table('advance_product_setting_hint')->where('setting_id',$last_id)
				->update($array);
			}else{
				DB::table('advance_product_setting_hint')->insert($array);
			}
		/***********************************/
		
		
		return Redirect::back()->with('status',$message);
	}
	public function view_advance_product_template(){
		$data = DB::table('advance_product_setting')->get();
		return view('supperAdmin.advance_product.view_advance_product_template')->with('data',$data);
	}
	
	public function advance_product_subscription(){
		$account = Account::where('id',Session::get('user')->id)->first();
		$subscribedTemplate    = $account->subscribedTemplate;
		$available = AdvanceProductSetting::whereNotIn('id',explode(',',$subscribedTemplate))->get();
		
		$subscribed = AdvanceProductSetting::select('advance_product_setting.id','advance_product_setting.grouping','advance_product_setting.name','categories.name as categories_name','sub_categories.name as sub_categories_name',
		'advance_product_category.id as cat_id',
		'advance_product_category.grouping_name',
		'advance_product_category.is_return',
		'advance_product_category.banner',
		'advance_product_category.return_days',
		'advance_product_category.return_terms',
		'advance_product_category.is_replace',
		'advance_product_category.replace_days',
		'advance_product_category.replace_terms',
		'advance_product_category.cancel_reason',
		DB::Raw("( select count(id) from uc_advance_product where uc_advance_product.setting_id = uc_advance_product_setting.id  and uc_advance_product.account_id = '".Session::get('user')->id."' ) as added_product"))
		             ->leftJoin('advance_product_category', function ($join) use ($account) {
                           $join->on('advance_product_setting.id','=','advance_product_category.setting_id');
                           $join->on(DB::raw('uc_advance_product_category.account_id'), DB::raw('='),DB::raw("'".$account->id."'"));
                        })
		             ->leftJoin('categories','advance_product_category.category','=','categories.id')
		             ->leftJoin('categories as sub_categories','advance_product_category.sub_category','=','sub_categories.id')
		             ->whereIn('advance_product_setting.id',explode(',',$subscribedTemplate))
					 ->get();
		$advance_product_tmp = DB::table('advance_product')
		                       ->select(DB::Raw("group_concat(setting_id) as tmp_id"))
		                       ->whereNotIn('advance_product.setting_id',explode(',',$subscribedTemplate))
							   ->where('account_id',Session::get('user')->id)
							   ->first();
		if($advance_product_tmp){
			$advance_product_tmp = explode(',',$advance_product_tmp->tmp_id);
		}else{
			$advance_product_tmp = [];
		}
		$un_subscribed = AdvanceProductSetting::select('advance_product_setting.id','advance_product_setting.grouping','advance_product_setting.name','categories.name as categories_name','sub_categories.name as sub_categories_name','advance_product_category.grouping_name','advance_product_category.banner',DB::Raw("( select count(id) from uc_advance_product where uc_advance_product.setting_id = uc_advance_product_setting.id  and uc_advance_product.account_id = '".Session::get('user')->id."' ) as added_product"))
		             ->leftJoin('advance_product_category', function ($join) use ($account) {
                           $join->on('advance_product_setting.id','=','advance_product_category.setting_id');
                           $join->on(DB::raw('uc_advance_product_category.account_id'), DB::raw('='),DB::raw("'".$account->id."'"));
                        })
		             ->leftJoin('categories','advance_product_category.category','=','categories.id')
		             ->leftJoin('categories as sub_categories','advance_product_category.sub_category','=','sub_categories.id')
		             ->whereNotIn('advance_product_setting.id',explode(',',$subscribedTemplate))
		             ->whereIn('advance_product_setting.id',$advance_product_tmp)
					 ->get();
					 //dd($subscribed);exit;
		$category = Category::whereNull('ref_id')
		            ->where('account_id',Session::get('user')->id)
		            ->where('status','1')
					->get();
		$brand = Brand::where('account_id',Session::get('user')->id)->get();
		$ref_id = null;
	    $imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
		return view('admin.advance_product.advance_product_subscription')->with('available',$available)->with('subscribed',$subscribed)->with('category',$category)->with('brand',$brand)->with('un_subscribed',$un_subscribed)->with('imageUploadList',$imageUploadList); 
	}
	public function advance_product_unsubscribe($id){
		$account = Account::where('id',Session::get('user')->id)->first();
		$subscribedTemplate    = $account->subscribedTemplate;
		$subscribedTemplate = explode(',',$subscribedTemplate);
		$key = array_search($id, $subscribedTemplate);
		unset($subscribedTemplate[$key]);
		//var_dump($subscribedTemplate);
		Account::where('id',Session::get('user')->id)->update(['subscribedTemplate'=>implode(',',$subscribedTemplate)]);
		return Redirect::back()->with('status','UnSubscribed Successfully.');
	}
	public function advance_product_subscription_post(Request $request){
		$account = Account::where('id',Session::get('user')->id)->first();
		$subscribedTemplate    = $account->subscribedTemplate;
		if($subscribedTemplate!=Null){
			$request->subscribed = array_merge($request->subscribed,explode(',',$subscribedTemplate));
		}
		Account::where('id',Session::get('user')->id)
		->update(['subscribedTemplate'=>implode(',',$request->subscribed)]);
		return Redirect::back()->with('status','Subscribed Successfully.');
	}
	public function add_advance_product($id,$pre=''){
		$menu = DynamicMenu::where('id',$id)->first();
		$account = Account::where('id',Session::get('user')->id)->first();
		$data = DB::table('advance_product_setting')
		        ->select('advance_product_setting.*','categories.name as categories_name','categories.id as categories_id','sub_categories.name as sub_categories_name','sub_categories.id as sub_categories_id','advance_product_category.grouping_name','advance_product_category.brands')
		        ->leftJoin('advance_product_category','advance_product_category.setting_id','=','advance_product_setting.id')
		        ->leftJoin('categories','categories.id','=','advance_product_category.category')    
		        ->leftJoin('categories as sub_categories','sub_categories.id','=','advance_product_category.sub_category')
		        ->where('advance_product_setting.id',$menu->setting)
		        //->where('advance_product_category.account_id',$account->id)
				->first();
		
		$brand = Brand::where('account_id',$account->id)
		                ->whereIn('id',explode(',',$menu->brands))->get();
			
		$ref_id = null;
		$imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
		$all_color = $this->all_color();
		$return = view('admin.advance_product.add_advance_product')->with('data',$data)->with('brand',$brand)->with('imageUploadList',$imageUploadList)->with('all_color',$all_color)->with('menu',$menu);
		$optional = explode(',',$data->isOptional);
		if($pre!=''){
			$pre_data  = AdvanceProduct::where('id',$pre)->first();
			$pre_data->json = json_decode($pre_data->additional_attribute,true);
			//var_dump($pre_data->json);exit; 
			$return = $return->with('pre_data',$pre_data);
		}
		//echo count($pre_data->json[0]).'/'.count(json_decode($data->additional_attribute)[0]);exit;
		return $return->with('optional',$optional);
	}
	public function insert_advance_product(Request $request){
		if(isset($_POST['attribute'])&&count($_POST['attribute'])){
		$json = json_encode(
		          array($_POST['attribute'],$_POST['attribute_option'],$_POST['attribute_value'])
		        );
				
		}else{
			$json = Null;
		}
		
		
		if($request->tax_method=='Inclusive'){
			$product_tax_value = $request->selling_price - (100*$request->selling_price)/(100+$request->product_tax);
		}else{
			$product_tax_value =  ($request->selling_price*$request->product_tax)/100; 
		}
		$insertArray = [
		 'setting_id' => $request->product_id,
		 'title' => $request->title,
		 'video' => $request->video,
		 'brand' => $request->brand,
		 'search_key_words' => $request->search_key_words,
		 'thumbnail' => url($request->thumbnail),
		 'image1' => ( isset($request->image1) ? url($request->image1) : '' ),
		 'image2' => ( isset($request->image2) ? url($request->image2) : '' ),
		 'image3' => ( isset($request->image3) ? url($request->image3) : '' ),
		 'image4' => ( isset($request->image4) ? url($request->image4) : '' ),
		 'image5' => ( isset($request->image5) ? url($request->image5) : '' ),
		 'image6' => ( isset($request->image6) ? url($request->image6) : '' ),
		 'image7' => ( isset($request->image7) ? url($request->image7) : '' ),
		 'name' => $request->name,
		 'sku' => $request->sku,
		 'product_code' => $request->product_code,
		 'category' => $request->category,
		 'sub_category' => $request->sub_category,
		 'dynamic_menu' => $request->dynamic_menu,
		 'unit_quanitity' => $request->unit_quanitity,
		 'unit' => $request->unit,
		 'cess' => $request->cess,
		 'hsn_code' => $request->hsn_code,
		 'product_price' => $request->product_price,
		 'product_tax' => $request->product_tax,
		 'tax_method' => $request->tax_method,
		 'product_tax_value' => $product_tax_value,
		 'description' => $request->description,
		 'selling_price' => $request->selling_price,
		 'selling_price_label' => $request->selling_price_label,
		 'moq' => $request->moq,
		 'status' => $request->status,
		 'color' => $request->color,
		 'height' => $request->height,
		 'width' => $request->width,  
		 'length' => $request->length,
		 'dimension_unit' => $request->dimension_unit,
		 'size' => $request->size,
		 'weight' => $request->weight,
		 'weight_unit' => $request->weight_unit,
		 'weight_unit' => $request->weight_unit,
		 'search_key_words' => (count($request->search_key_words) ? implode(',',$request->search_key_words) : Null),
		 'is_return' => $request->is_return,
		 'return_days' => ( $request->is_return=='Yes'  ? $request->return_days : ''),
		 'return_terms' => ( $request->is_return=='Yes'  ? $request->return_terms : ''),
		 'is_replace' => $request->is_replace,
		 'replace_days' => ( $request->is_replace=='Yes'  ? $request->replace_days : ''),
		 'replace_terms' => ( $request->is_replace=='Yes'  ? $request->replace_terms : ''),
		 'shipping_charges' => '',
		 'shipping_method' => $request->shipping_method,
		 'is_affiliation' => $request->is_affiliation,
		 'is_cod_available' => $request->is_cod_available,
		 'affiliation_price' => ( $request->is_affiliation=='Yes'  ? $request->affiliation_price : ''),
		 'affiliation_payment_release_online' => ( $request->is_affiliation=='Yes'  ? $request->affiliation_payment_release_online : ''),
		 'affiliation_payment_release_cod' => ( $request->is_affiliation=='Yes'  ? $request->affiliation_payment_release_cod : ''),
		 'grouping_name' => ( isset($request->grouping_name) ? implode(',',$request->grouping_name) : '' ),
		 'account_id' => Session::get('user')->id,
		 'additional_attribute' => $json,
		];
		if($request->hasFile('view_360_file')){ 
            $view_360_file = $request->file('view_360_file');
			$ext  = $view_360_file->getClientOriginalExtension();
			$new  = time().'.'.$ext;
			if(in_array($ext,['glb'])){
                $destinationPath = '360_files';
			    $view_360_file->move($destinationPath,$new);
				$insertArray['view_360_file'] = '360_files/'.$new;
			}else{
				echo 'Invalid file';
				exit;
			}
		}
		//var_dump($insertArray);exit;
		/**********************************/
		
		if(isset($request->pre_product_id)){
		   $last_id = $request->pre_product_id;
					   AdvanceProduct::where('id',$request->pre_product_id)
					   ->update($insertArray);
		               AdvanceProductAttribute::where('advance_product_id', $request->pre_product_id)
					   ->delete();
		   $message = 'Updated Successfully.';
		}else{
		   $last_id = AdvanceProduct::insertGetId($insertArray);
		   $message = 'Added Successfully.';
		}
		$attr_array = [];
		if(isset($_POST['attribute'])&&count($_POST['attribute'])){
		
				foreach($_POST['attribute'] as $key=>$row){
					$attr_array[] = [
					                 'advance_product_setting_id'=>$request->product_id,
									 'advance_product_id'=>$last_id,
									 'attribute'=>$_POST['attribute'][$key],
									 'value'=>$_POST['attribute_value'][$key],
									];
				}
		}
		AdvanceProductAttribute::insert($attr_array);
		return Redirect::back()->with('status',$message);
	}
	public function view_advance_product(Request $request){
		$account = Account::where('id',Session::get('user')->id)->first();
		$account_id = $account->id;
		$advance_product = AdvanceProduct::where('account_id',$account_id)->where('status','Active')->whereIn('setting_id',explode(',',$account->subscribedTemplate));
		$data = AdvanceProduct::orderBy('id','desc');
		if(Session::get('user')->id!=1){
			$data = $data->where('account_id',Session::get('user')->id)->whereIn('setting_id',explode(',',$account->subscribedTemplate));
		}
		if(isset($request->qc)){
			$data = $data->where('qc',$request->qc);
		}
		if(isset($request->keyword)){
			$data = $data->where('search_key_words','like','%'.$request->keyword.'%');
		}
		if(isset($request->title)){
			$data = $data->where('title','like','%'.$request->title.'%');
		}
		if(isset($request->affiliate)){
			$data = $data->where('is_affiliation',$request->affiliate);
		}
		if(isset($request->scheme)){
			
		}
		
		$data = $data->paginate(30);
		return view('admin.advance_product.view_advance_product')->with('data',$data);
	}
	public function getSubCategory($id){
		$data = Category::where('ref_id',$id)
		        ->where('account_id',Session::get('user')->id)
		        ->where('status','1')
				->get();
		return $data;
	}
	public function save_subscription_category(Request $request){
		$array = [
		           'setting_id'=>$request->setting_id,
		           'category'=>$request->category,
		           'sub_category'=>$request->sub_category,
		           'account_id'=>Session::get('user')->id,
		         ];
		$check = AdvanceProductCategory::where('setting_id',$request->setting_id)->where('account_id',Session::get('user')->id)->count();
		if($check<1){
			AdvanceProductCategory::insert($array);
		}else{
			AdvanceProductCategory::where('setting_id',$request->setting_id)
			->where('account_id',Session::get('user')->id)
			->update($array);
		}
		return Redirect::back()->with('status','Subscribed Successfully.');
	}
	public function save_grouping_name(Request $request){
		$array = [
		           'grouping_name'=>json_encode([$request->label,$request->value]),
		           'account_id'=>Session::get('user')->id
		         ];
		$check = DynamicMenu::where('id',$request->grouping_setting_id)->where('account_id',Session::get('user')->id)->count();
		if($check<1){
			DynamicMenu::insert($array);
		}else{
			DynamicMenu::where('id',$request->grouping_setting_id)
			->where('account_id',Session::get('user')->id)
			->update($array);
		}
		return Redirect::back()->with('status','Subscribed Successfully.');
	}
	public function save_brand_for_template(Request $request){
		$array = [
		           'id'=>$request->brand_setting_id,
		           'account_id'=>Session::get('user')->id,
		           'brands'=>implode(',',$request->brands)
		         ];
		$check = DynamicMenu::where('id',$request->brand_setting_id)->where('account_id',Session::get('user')->id)->count();
		if($check<1){
			DynamicMenu::insert($array);
		}else{ 
			DynamicMenu::where('id',$request->brand_setting_id)
			->where('account_id',Session::get('user')->id)
			->update($array);
		}
		return Redirect::back()->with('status','Updated Successfully.');
	}
	public function checkSKU(Request $request){
		$count = AdvanceProduct::where('sku',$request->value)
		         ->where('account_id',Session::get('user')->id)
				 ->count();
		if($count>0){
			return array('message'=>'Not Avilable');exit;
		}else{
			return array('message'=>'Avilable');exit;
		}
	}
	
	public function advance_order(Request $request){
        /*$data = DB::table('advance_product_orders')
		        ->where('account_id',31)
				->whereNotNull('shirocketWebHook')
				->get();
		foreach($data as $row){
		   $st = json_decode($row->shirocketWebHook,true);
		   if($st['shipment_status']=='DELIVERED'){
			   DB::table('advance_product_orders')->where('id',$row->id)
			   ->update(['status'=>7]);
		   }
           echo $row->id.'-'.$row->status.'-'.$st['shipment_status'].'<br>';
		}
		exit;*/
		$data = AdvanceProductOrder::orderBy('id','desc');
		if(Session::get('user')->id!=1){
		    $data = $data->where('account_id',Session::get('user')->id)->orderBy('id','desc');
		}
		if(isset($request->status)){
			$data = $data->where('status',$request->status);
		}
		if(isset($request->mobile)){
			$data = $data->where('phone','like','%'.$request->mobile.'%');
		}
		if(isset($request->order_n)){
			$data = $data->where('order_id','like','%'.$request->order_n.'%');
		}
		if(isset($request->aff_id)){
			$data = $data->where('aff_id','like','%'.$request->aff_id.'%');
		}
		if(isset($request->date_from)){
			$data = $data->where('created_at','>=',$request->date_from);
		}
		if(isset($request->date_to)){
			$data = $data->where('created_at','<=',$request->date_to);
		}
		$data = $data->paginate(15);
		
		return view('admin.advance_product.advance_order')->with('data',$data);
	}
	public function advance_order_status($id,$status){
		$data = AdvanceProductOrder::where('account_id',Session::get('user')->id)
		        ->where('id',$id)->first();
		AdvanceProductOrder::where('account_id',Session::get('user')->id)
		                     ->where('id',$id)
							 ->update(['status'=>$status]);
		if($status==3){
			$found = Msgnotify::where('account_id', Session::get('user')->id)->where('msg_type', '2')->first();
		}else if($status==2){
			$found = Msgnotify::where('account_id', Session::get('user')->id)->where('msg_type', '3')->first();
		}
		$account = Session::get('user');
		if($found){
            $message = $found->messages;
            $message = str_replace('[Order_Number]',$data->order_id,$message);
            $message = str_replace('[Product_Name]',$data->products[0]->title,$message);
            $message = str_replace('[CUSTOMER_NAME]',$data->name,$message);
            $message = str_replace('[Order_Amount]',$data->grand_total,$message);
            $message = str_replace('[GRAND_TOTAL]',$data->grand_total,$message);
            
            $message = urlencode($message);
                
            $replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
            $replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
            $replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
            $replace3 = str_replace('setPhone', $data->phone, $replace2);
            $replace4 = str_replace('setMessage', $message, $replace3);
			$replace5 = str_replace('setTEMPLATEID', $found->template_id,$replace4);
            $url = $replace5;
            $post = curl_init();
            curl_setopt($post, CURLOPT_URL, $url);
            curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
            $response = curl_exec($post);
            curl_close($post);
            $result = json_decode($response, true);
		}
		return Redirect::back()->with('status','Updated Successfully.');
	}
	public function cancel_shipping($id){
		$data = AdvanceProductOrder::where('account_id',Session::get('user')->id)
		                     ->where('id',$id)
							 ->first();
		$account = Account::where('id',Session::get('user')->id)->first();
		if($data->shipping_gateway==1){
			$res = json_decode($data->shipyaariOrderResponse,true);
			echo $res['avn_shipping_id'];exit;
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://seller.shipyaari.com/avn_ci/siteadmin/cancel_consignment/',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>'{"avn_key":"'.$account->shipyaariClientCode."@".$account->shipyaariParentCode.'","ids":["'.$res['avn_shipping_id'].'"]}',
			));
            $response = curl_exec($curl);
			curl_close($curl);
			AdvanceProductOrder::where('account_id',Session::get('user')->id)
		                     ->where('id',$id)
							 ->update(['status'=>5,'shipyaariCancelResponse'=>$response]);
		}
		return Redirect::back()->with('status','Updated Successfully.');
	}
	
	public function advance_product_search(Request $request){
		
		if(isset($request->searchTerm)){
		$search = $request->searchTerm;
		$data = AdvanceProduct::where('account_id',Session::get('user')->id)
				->where('status','Active')
				->where(function($query) use ($search) {
                $query->where('title','like','%'.$search.'%')
                      ->orWhere('search_key_words','like','%'.$search.'%')
                      ->orWhere('sku','like','%'.$search.'%');
                })
				->get()->toArray();
			return $data;
		}else{
			return [];
		}
	}
	public function in_cart(){
		$data = AdvanceProductCart::
		        where('account_id',Session::get('user')->id)
				->whereNotNull('register_user_id')
				->groupBy('register_user_id')
				->get();
		return view('admin.advance_product.in_cart')->with('data',$data);
	}
	
	public function advance_product_excel_download($id){
		$account = Account::where('id',Session::get('user')->id)->first();
		$setting = DB::table('advance_product_setting')
		        ->select('advance_product_setting.*','categories.name as categories_name','categories.id as categories_id','sub_categories.name as sub_categories_name','sub_categories.id as sub_categories_id','advance_product_category.grouping_name','advance_product_category.brands')
		        ->leftJoin('advance_product_category','advance_product_category.setting_id','=','advance_product_setting.id')
		        ->leftJoin('categories','categories.id','=','advance_product_category.category')    
		        ->leftJoin('categories as sub_categories','sub_categories.id','=','advance_product_category.sub_category')
		        ->where('advance_product_setting.id',$id)
				->where('advance_product_category.account_id',$account->id)
				->first();
		$hint = DB::table('advance_product_setting_hint')->where('setting_id',$id)->first();
		$optional = explode(',',$setting->isOptional);
		$array = [];
		 
		$char = 'A';
		$re_char = 'A';
		$re_char_array = [];
		$hint_array = [];
		$spreadsheet = new Spreadsheet();
		$spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(1);
		$sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->setTitle('Variable');
		if($setting->thumbnail_check){
			$array[] = 'Thumbnail';
			if($hint){
				$hint_array[] = $hint->thumbnail_hint;
			}
			$re_char_array[] = $re_char.'1';
			$re_char++;
		}
		
		if($setting->grouping!=''&&$setting->grouping!=Null){
			foreach(explode(',',$setting->grouping) as $gr_loop){
			$array[] = 'Grouping';
			if($hint){
				$hint_array[] = 'One value in 1 Coloumn';
			}
			//$re_char_array[] = $re_char.'1';
			$re_char++;
			$sheet->setCellValue($char.'1', 'Grouping');
			foreach(explode(',',$setting->grouping) as $key=>$group){
				$sheet->setCellValue($char.($key+2), $group);
			}
			$char++;
			}
		}
		
		for($i=1;$i<=7;$i++){
			$var   = 'image'.$i.'_check';
			$pre_f = 'image'.$i;
			if($setting->$var){
				$array[] = 'Image '.$i;
				if($hint){
				  $img_hint = $pre_f.'_hint';	
				  $hint_array[] = $hint->$img_hint;
			    }
			}
			if(!in_array('image'.$i,$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		
		if($setting->title_check){
			$array[] = 'Title';
			if($hint){
				$hint_array[] = $hint->title_hint;
			}
			if(!in_array('title',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->brand_check){
			$array[] = 'Brand Name';
			if($hint){
				$hint_array[] = $hint->brand_hint;
			}
			$brand = Brand::
			         where('account_id',$account->id)
		             ->whereIn('id',explode(',',$setting->brands))
					 ->get();
			$sheet->setCellValue($char.'1', 'Brands');
			foreach($brand as $key=>$row_brand){
				$sheet->setCellValue($char.($key+2), $row_brand->name);
				
			}
			$char++;
			if(!in_array('brand',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->sku_check){
			$array[] = 'SKU';
			if($hint){
				$hint_array[] = $hint->sku_hint;
			}
			if(!in_array('sku',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->product_code_check){
			$array[] = 'Product Code';
			if($hint){
				$hint_array[] = $hint->product_code_hint;
			}
			if(!in_array('product_code',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->unit_type_check){
			$array[] = 'Unit Value';
			$array[] = 'Unit';
			if($hint){
				$hint_array[] = '';
				$hint_array[] = $hint->unit_hint;
			}
			$sheet->setCellValue($char.'1', 'Unit');
			$key = 0;
			foreach( explode(',',$setting->unit_type_check_value_multi) as $un ){
				$sheet->setCellValue($char.($key+2), $un);
				$key++;
			}
			$char++;
			if(!in_array('unit',$optional)){
				$re_char_array[] = $re_char.'1';
				$re_char++;
				$re_char_array[] = $re_char.'1';
			    $re_char++;
			}else{
			  $re_char++;
			  $re_char++;
			}
		}
		if($setting->hsn_code_check){
			$array[] = 'HSN Code';
			if($hint){
				$hint_array[] = $hint->hsn_code_hint;
			}
			if(!in_array('hsn_code',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->product_price_check){
			$array[] = 'Product Price';
			if($hint){
				$hint_array[] = $hint->product_price_hint;
			}
			if(!in_array('product_price',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->selling_price_check){
			$array[] = $setting->selling_price_label;
			if($hint){
				$hint_array[] = $hint->selling_price_hint;
			}
			if(!in_array('selling_price',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->moq_check){
			$array[] = 'MOQ';
			if($hint){
				$hint_array[] = $hint->moq_hint;
			}
			if(!in_array('moq',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->product_tax_check){
			$array[] = 'Product Tax';
			if($hint){
				$hint_array[] = $hint->product_tax_hint;
			}
			/*$sheet->setCellValue($char.'1', 'Product Tax %');
			$key = 0;
			foreach(explode(',',$setting->product_tax_check_value) as $un ){
				$sheet->setCellValue($char.($key+2), $un);
				$key++;
			}
			$char++;*/
			if(!in_array('product_tax',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->tax_method_check){
			$array[] = 'Tax Method';
			if($hint){
				$hint_array[] = $hint->tax_method_hint;
			}
			$sheet->setCellValue($char.'1', 'Tax Method');
			$key = 0;
			$method = ['Inclusive','Exclusive'];
			foreach($method as $un ){
				$sheet->setCellValue($char.($key+2), $un);
				$key++;
			}
			$char++;
			if(!in_array('tax_method',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->cess_check){
			$array[] = 'Cess';
			if($hint){
				$hint_array[] = $hint->cess_hint;
			}
			$sheet->setCellValue($char.'1', 'Cess %');
			$key = 0;
			foreach(explode(',',$setting->cess_check_value) as $un ){
				$sheet->setCellValue($char.($key+2), $un);
				$key++;
			}
			$char++;
			if(!in_array('cess',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->description_check){
			$array[] = 'Description';
			if($hint){
				$hint_array[] = $hint->description_hint;
			}
			if(!in_array('description',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		
		    $key = 0;
			$sheet->setCellValue($char.'1', 'Shipping Method');
			$method = ['Inclusive','Exclusive'];
			foreach($method as $un ){
				$sheet->setCellValue($char.($key+2), $un);
				$key++;
			}
		    $char++;
		
		if($setting->status_check){
			$array[] = 'Status';
			if($hint){
				$hint_array[] = $hint->status_hint;
			}
			$sheet->setCellValue($char.'1', 'Status');
			$key = 0;
			$method = ['Active','Inactive'];
			foreach($method as $un ){
				$sheet->setCellValue($char.($key+2), $un);
				$key++;
			}
			$char++;
			if(!in_array('status',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->color_check){
			$array[] = 'Color';
			if($hint){
				$hint_array[] = $hint->color_hint;
			}
			$sheet->setCellValue($char.'1', 'Color');
			$key = 0;
			$all_color = $this->all_color();
			foreach($all_color as $color){
				$sheet->setCellValue($char.($key+2), $color);
				$key++;
			}
			$char++;
			if(!in_array('color',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->dimension_check){
			$array[] = 'Height';
			$array[] = 'Width';
			$array[] = 'Length';
			$array[] = 'Dimension Unit';
			if($hint){
				$hint_array[] = '';
				$hint_array[] = '';
				$hint_array[] = '';
				$hint_array[] = $hint->dimension_hint;
			}
			if(!in_array('height',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
			if(!in_array('width',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
			if(!in_array('length',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
			$re_char_array[] = $re_char.'1';
			$re_char++;
			
			/*******************/
			$sheet->setCellValue($char.'1', 'Dimension Unit');
			$sheet->setCellValue($char.'2', 'CM');
			$char++;
			/*******************/
			
		}
		if($setting->size_check){
			$array[] = 'Size';
			if($hint){
				$hint_array[] = $hint->size_hint;
			}
			$sheet->setCellValue($char.'1', 'Size');
			$key = 0;
			foreach(explode(',',$setting->size_check_value_option) as $un ){
				$sheet->setCellValue($char.($key+2), $un);
				$key++;
			}
			$char++;
			if(!in_array('size',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
		}
		if($setting->weight_check){
			$array[] = 'Weight';
			$array[] = 'Weight Unit';
			if($hint){
				$hint_array[] = '';
				$hint_array[] = $hint->weight_hint;
			}
			if(!in_array('weight',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			$re_char++;
			if(!in_array('weight',$optional)){
				$re_char_array[] = $re_char.'1';
			    
			}
			/*******************/
			$sheet->setCellValue($char.'1', 'Weight Unit');
			$sheet->setCellValue($char.'2', 'KG');
			$char++;
			/*******************/
			$re_char++;
		}
		if($setting->search_key_words_check){
			$array[] = 'Search Key Words 1';
			$array[] = 'Search Key Words 2';
			$array[] = 'Search Key Words 3';
			$array[] = 'Search Key Words 4';
			$array[] = 'Search Key Words 5';
			if($hint){
				$hint_array[] = $hint->search_key_words_hint;
				$hint_array[] = '';
				$hint_array[] = '';
				$hint_array[] = '';
				$hint_array[] = '';
			}
			for($tmp_for=1;$tmp_for<6;$tmp_for++){
				if(!in_array('search_key_words_check',$optional)){
					$re_char_array[] = $re_char.'1';
					
				}
				$re_char++;
			}
		}
		$array[] = 'Return';
		$array[] = 'Return Days';
		$array[] = 'Return T&C';
		$array[] = 'Replace';
		$array[] = 'Replace Days';
		$array[] = 'Replace T&C';
		$array[] = 'Shipping Method';
		$array[] = 'Affiliation';
		$array[] = 'Affiliation Price';
		$array[] = 'COD Available';
		
		/*******************/
		$sheet->setCellValue($char.'1', 'Return');
		$sheet->setCellValue($char.'2', 'Yes');
		$sheet->setCellValue($char.'3', 'No');
		$char++;
		
		$sheet->setCellValue($char.'1', 'Replace');
		$sheet->setCellValue($char.'2', 'Yes');
		$sheet->setCellValue($char.'3', 'No');
		$char++;
		
		$sheet->setCellValue($char.'1', 'Shipping Method');
		$sheet->setCellValue($char.'2', 'Inclusive');
		$sheet->setCellValue($char.'3', 'Exclusive');
		$char++;
		
		$sheet->setCellValue($char.'1', 'Affiliation');
		$sheet->setCellValue($char.'2', 'Yes');
		$sheet->setCellValue($char.'3', 'No');
		$char++;
		
		$sheet->setCellValue($char.'1', 'COD Available');
		$sheet->setCellValue($char.'2', 'Yes');
		$sheet->setCellValue($char.'3', 'No');
		$char++;
		/*******************/    
		
		for($cus_num = 0;$cus_num<10;$cus_num++){
			$re_char_array[] = $re_char.'1';
			$re_char++;
		}
		if($setting->additional_attribute!=Null&&count(json_decode($setting->additional_attribute))){
			$i=1;
			
			foreach( json_decode($setting->additional_attribute)[0] as $key=>$row){
				$array[] = $row;
				$sheet->setCellValue($char.'1', $row);
				if(json_decode($setting->additional_attribute)[1][$key]=='Checkboxes'){
					foreach(explode(',',json_decode($setting->additional_attribute)[2][$key]) as $opt_key=>$opt){
						if($opt!=''){
						$sheet->setCellValue($char.($opt_key+2), $opt);
						}
						
				$key++;
				        
						
					}
					if(!in_array('addiotioanl'.$i,$optional)){
							$re_char_array[] = $re_char.'1';
			        }
				}else{
					foreach(explode(',',json_decode($data->additional_attribute)[2][$key]) as $opt_key=>$opt){
						if($opt!=''){
						$sheet->setCellValue($char.($opt_key+2), $opt);
						}
					}
					if(!in_array('addiotioanl'.$i,$optional)){
						$re_char_array[] = $re_char.'1';
					}
					
				}
				//echo $re_char.'-addiotioanl'.$i.'<br>';
				$char++;
				$re_char++;
				$i++;
			}
		}
		//var_dump($re_char_array);
		//exit;
		$char--;
		$spreadsheet->getActiveSheet()->getStyle('A1:'.$char.'1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$fileName = $setting->name.'.xlsx';
		
		
		
		$cells = 'A1';
        $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();
		
		foreach($re_char_array as $cell){
			$spreadsheet->getActiveSheet()->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');
		}
		
		

		
		$header = [$array];
		$sheet->fromArray($header, NULL, 'A1');
		//echo count($hint_array);exit;
		$sheet->fromArray($hint_array, NULL, 'A2');

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
	}
	
	public function upload_advance_product(Request $request){
		/***************************************/
		$account = Account::where('id',Session::get('user')->id)->first();
		$setting = DB::table('advance_product_setting')
		        ->select('advance_product_setting.*','categories.name as categories_name','categories.id as categories_id','sub_categories.name as sub_categories_name','sub_categories.id as sub_categories_id','advance_product_category.grouping_name','advance_product_category.brands')
		        ->leftJoin('advance_product_category','advance_product_category.setting_id','=','advance_product_setting.id')
		        ->leftJoin('categories','categories.id','=','advance_product_category.category')    
		        ->leftJoin('categories as sub_categories','sub_categories.id','=','advance_product_category.sub_category')
		        ->where('advance_product_setting.id',$request->id)
				->where('advance_product_category.account_id',$account->id)
				->first();
		$hint = DB::table('advance_product_setting_hint')->where('setting_id',$request->id)->first();
		$optional = explode(',',$setting->isOptional);
		$array = [];
		$char = 'A';
		$re_char = 0;
		$re_char_array = [];
		$spreadsheet = new Spreadsheet();
		$spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(1);
		$sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->setTitle('Variable');
		
		if($setting->thumbnail_check){
			$array[] = ['Thumbnail',[],1,'thumbnail'];
		}
		
		if($setting->grouping!=''&&$setting->grouping!=Null){
			foreach(explode(',',$setting->grouping) as $gr_loop){
			$array[] = ['Grouping',explode(',',$setting->grouping),1,'grouping_name'];
			}
		}
		
		for($i=1;$i<=7;$i++){
			$var   = 'image'.$i.'_check';
			$pre_f = 'image'.$i;
			$opt = 1;
			if(!in_array('image'.$i,$optional)){
			    $opt = 0;
			}
			//echo $opt.'image'.$i.'<br>';
			$array[] = [$pre_f,[],$opt,$pre_f];
			$re_char++;
		}
		//exit;
		if($setting->title_check){
			
			$opt = 1;
			if(!in_array('title'.$i,$optional)){
				$re_char_array[] = $re_char.'1';
				$opt = 0;
			}
			$array[] = ['Title',[],$opt,'title'];
		}
		if($setting->brand_check){
			$data = [];
			$brand = Brand::
			         where('account_id',$account->id)
		             ->whereIn('id',explode(',',$setting->brands))
					 ->get();
			
			foreach($brand as $key=>$row_brand){
				$data[] = $row_brand->name;
				
			}
			$opt = 1;
			if(!in_array('brand'.$i,$optional)){
				$re_char_array[] = $re_char.'1';
			    $opt = 0;
			}
			$array[] = ['Brand Name',$data,$opt,'brand'];
		}
		if($setting->sku_check){
			$opt = 1;
			if(!in_array('sku'.$i,$optional)){
				$opt = 0;
			    
			}
			$array[] = ['SKU',[],$opt,'sku'];
		}
		if($setting->product_code_check){
			$opt = 1;
			if(!in_array('product_code'.$i,$optional)){
				$opt = 0;
			    
			}
			$array[] = ['Product Code',[],$opt,'product_code'];
		}
		if($setting->unit_type_check){
			$data = [];
			foreach( explode(',',$setting->unit_type_check_value_multi) as $un ){
				$data[] = $un;
			}
			$opt = 1;
			if(!in_array('unit'.$i,$optional)){
				$opt = 0;
			    
			}
			$array[] = ['Unit Value ',[],$opt,'unit_quanitity'];
			$array[] = ['Unit',$data,$opt,'unit'];
		}
		if($setting->hsn_code_check){
			$opt = 1;
			if(!in_array('hsn_code'.$i,$optional)){
				$opt = 0;
			}
			$array[] = ['HSN Code',[],$opt,'hsn_code'];
		}
		if($setting->product_price_check){
			$opt = 1;
			if(!in_array('product_price'.$i,$optional)){
				$opt = 0;
			    
			}
			$array[] = ['Product Price',[],$opt,'product_price'];
		}
		if($setting->selling_price_check){
			$opt = 1;
			if(!in_array('selling_price',$optional)){
				$opt = 0;
			}
			$array[] = [$setting->selling_price_label,[],$opt,'selling_price'];
		}
		if($setting->moq_check){
			$opt = 1;
			if(!in_array('moq',$optional)){
				$opt = 0;
			}
			$array[] = ['moq',[],$opt,'moq'];
		}
		if($setting->product_tax_check){
			
			$opt = 1;
			if(!in_array('product_tax',$optional)){
				$opt = 0;
			}
			$array[] = ['product_tax',[],$opt,'product_tax'];
		}
		if($setting->tax_method_check){
			
			$method = ['Inclusive','Exclusive'];
			$opt = 1;
			if(!in_array('tax_method',$optional)){
				$opt = 0;
			}
			$array[] = ['Tax Method',$method,$opt,'tax_method'];
		}
		if($setting->cess_check){
			$opt = 1;
			if(!in_array('cess',$optional)){
				$opt = 0;
			}
			$array[] = ['Cess',[],$opt,'cess'];
		}
		if($setting->description_check){
			$opt = 1;
			if(!in_array('description'.$i,$optional)){
				$opt = 0;
			}
			$array[] = ['Description',[],$opt,'description'];
		}
		if($setting->status_check){
			$opt = 1;
			$method = ['Active','Inactive'];
			if(!in_array('status',$optional)){
				$opt = 0;
			}
			$array[] = ['Status',$method,$opt,'status'];
		}
		if($setting->color_check){
			$data = [];
			$all_color = $this->all_color();
			foreach($all_color as $color){
				$data[] = $color;
			}
			$opt = 1;
			if(!in_array('color',$optional)){
				$re_char_array[] = $re_char.'1';
			    $opt = 0;
			}
			$array[] = ['Color',$data,$opt,'color'];
		}
		if($setting->dimension_check){
			
			$opt = 1;
			if(!in_array('height',$optional)){
				$opt = 0;
			    
			}
			$opt = 1;
			$array[] = ['Height',[],$opt,'height'];
			if(!in_array('width',$optional)){
				$opt = 0;
			}
			$array[] = ['Width',[],$opt,'width'];
			$opt = 1;
			if(!in_array('length'.$i,$optional)){
				$opt = 0;
			}
			$array[] = ['Length',[],$opt,'length'];
			$array[] = ['Dimension Unit',['CM'],0,'dimension_unit'];
		}
		if($setting->size_check){
			$data = [];
			
			foreach(explode(',',$setting->size_check_value_option) as $un ){
				$data[] = $un;
			}
			$opt = 1;
			if(!in_array('size_check_value_option',$optional)){
				$opt = 0;
			}
			$array[] = ['Size',$data,$opt,'size'];
		}
		if($setting->weight_check){
			
			$opt = 1;
			if(!in_array('weight'.$i,$optional)){
				$opt = 0;
			}
			$array[] = ['Weight',[],$opt,'weight'];
			$opt = 1;
			if(!in_array('weight'.$i,$optional)){
				$opt = 0;
			}
			$array[] = ['Weight Unit',['KG'],$opt,'weight_unit'];
		}
		if($setting->search_key_words_check){
			for($tmp_for=1;$tmp_for<6;$tmp_for++){
				$array[] = ['Search Key Words Comma Seprated',[],0,'search_key_words'];
			}
			
		}
		
		$array[] = ['Return',['Yes','No'],1,'is_return'];
		$array[] = ['Return Days',[],1,'return_days'];
		$array[] = ['Return T&C',[],1,'return_terms'];
		$array[] = ['Replace',['Yes','No'],1,'is_replace'];
		$array[] = ['Replace Days',[],1,'replace_days'];
		$array[] = ['Replace T&C',[],1,'replace_terms'];
		$array[] = ['Shipping Method',['Inclusive','Exclusive'],1,'shipping_method'];
		$array[] = ['Affiliation',['Yes','No'],1,'is_affiliation'];
		$array[] = ['Affiliation Price',[],1,'affiliation_price'];
		$array[] = ['COD Available',['Yes','No'],1,'is_cod_available'];
		$attribute = [];
		$attribute_option = [];
		$attribute_value = [];
		if($setting->additional_attribute!=Null&&count(json_decode($setting->additional_attribute))){
			$i=1;
			
			foreach( json_decode($setting->additional_attribute)[0] as $key=>$row){
				
				$data = [];
				$c_opt = 1;
				if(json_decode($setting->additional_attribute)[1][$key]=='Checkboxes'){
					foreach(explode(',',json_decode($setting->additional_attribute)[2][$key]) as $opt_key=>$opt){
						if($opt!=''){
						$data[] = $opt;
						}
						
				//$key++;
				        
				        if(!in_array('addiotioanl'.$i,$optional)){
							$c_opt = 0;
			            }
						
					}
				}else{
					foreach(explode(',',json_decode($data->additional_attribute)[2][$key]) as $opt_key=>$opt){
						if($opt!=''){
						 $data[] = $opt;
						}
					}
					if(!in_array('addiotioanl'.$i,$optional)){
						$c_opt = 0;
					}
					
				}
				
				$attribute[] = $row;
		        $attribute_option[] = json_decode($setting->additional_attribute)[1][$key];
		        
				$char++;
				$re_char++;
				$i++;
				//echo $char.'-'.$re_char.'-'.$i;exit;
				$array[] = [$row,$data,$c_opt,''];
			}
		}
		/***************************************/
		$file = $request->file('advance_product_file');
		$ext  = $file->getClientOriginalExtension();
		$new  = time().'.'.$ext;
		if(in_array($ext,['xlsx'])){
			$destinationPath = 'advance_product';
			$file->move($destinationPath,$new);
			$full_name = $destinationPath.'/'.$new;
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet = $reader->load($full_name);
			$d=$spreadsheet->getSheet(0)->toArray();
            //echo count($d);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			$sheetDataTemp = $sheetData;
            $i=1;
			unset($sheetData[0]);
			if($hint){
				unset($sheetData[1]);
			}
			//echo count($array);
			//var_dump($array);exit;
			
		    array_unshift($sheetDataTemp[0],"Reason");
			array_unshift($sheetDataTemp[0],"Status");
			$tmp_num_er = 0;
		    if($hint){
				array_unshift($sheetDataTemp[1],"");
			    array_unshift($sheetDataTemp[1],"");
				$tmp_num_er = 1;
			}
			foreach ($sheetData as $key=>$t) {
				$error = '';
				$temp = [];
				//var_dump($t);
			   for($i=0;$i<count($t);$i++){
				   if(count($array[$i][1])&&$t[$i]&&$t[$i]!=''){
					   if(!in_array($t[$i],$array[$i][1])){
						  $error =  $array[$i][0]." should be in ".implode(',',$array[$i][1]); 
					   }
				   }
				   
				   if($array[$i][2]==0&&$t[$i]==''){
					  $error =  $array[$i][0]." is mandotory.";  
				   }
				   
				   if($array[$i][3]!=''){
					  if($array[$i][3]=='sku'){
						  $check = DB::table('advance_product')->where('sku',$t[$i])->count();
						  if($check){
							 $error =  $t[$i]." is duplicate sku";
                            							 
						  }
					  }
					  $search_ar = [];
					  $group_ar = [];
					  if($array[$i][3]=='search_key_words'){
						  $search_ar[] = $t[$i];
					  }else if($array[$i][3]=='grouping_name'){
						  $group_ar[] = $t[$i];
					  }else{
				          $temp[$array[$i][3]] = $t[$i];
					  }
				   }else{
					  $attribute_value[] = $t[$i];
				   }
				   
			   }
			   if(count($group_ar)!=0){
				   $temp['grouping'] = implode(',',$group_ar);
			   }
			   if(count($search_ar)!=0){
				   $temp['search_key_words'] = implode(',',$search_ar);
			   }
			   $temp['setting_id'] = $request->id;
			   $temp['account_id'] = Session::get('user')->id;
			   $temp['qc'] = 0;
			   $json = Null;
			   if(count($attribute_value)){
				  $json = json_encode(
		          array($attribute,$attribute_option,$attribute_value)
		          ); 
				  $temp['additional_attribute'] = $json; 
			   }
			   if($error==''){
			     DB::table('advance_product')->insert($temp);
				   array_unshift($sheetDataTemp[$key],"Uploaded");
			       array_unshift($sheetDataTemp[$key],'Approved');
			   }else{
				   array_unshift($sheetDataTemp[$key],$error);
			       array_unshift($sheetDataTemp[$key],"Declined");
			   }
			   
			} 
			   /***********************************/
			    
			    $spreadsheet = new Spreadsheet();
				$spreadsheet->createSheet();
				$spreadsheet->setActiveSheetIndex(0);
				$sheet = $spreadsheet->getActiveSheet();
				$sheet->fromArray($sheetDataTemp, NULL, 'A1');
				$cusChar = 'A';
				for($i=1;$i<=count($sheetDataTemp[0]);$i++){
				 $spreadsheet->getActiveSheet()->getStyle($cusChar.'1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');
				 $cusChar++;
				}
				
				
				$writer = new Xlsx($spreadsheet);
				$fileName = $setting->name.'.xlsx';
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
				$writer->save('php://output');
				exit;
			   /***********************************/
			return Redirect::back()->with('status','Added Successfully.');
		}else{
			echo 'Unsupported File';
		}
	}
	public function advance_product_qc(Request $request){
		AdvanceProduct::where('id',$request->advance_product_qc_id)
		->update([
		'qc'=>$request->qc_status,
		'decline_remarks'=>$request->decline_remarks,
		]);
		return Redirect::back()->with('status','Updated Successfully');
	}
	
	public function updateProductForm(Request $request){
		AdvanceProduct::where('id',$request->id)
		->update([
		  'selling_price'=>$request->selling_price,
		  'product_price'=>$request->product_price,
		  'unit_quanitity'=>$request->unit_quanitity,
		  'product_tax'=>$request->product_tax,
		  'tax_method'=>$request->tax_method,
		  'dynamic_selling_price'=>$request->dynamic_selling_price,
		  'shipping_method'=>$request->shipping_method,
		  'is_affiliation'=>$request->is_affiliation,
		  'affiliation_price'=>$request->affiliation_price,
		  'affiliation_payment_release_online'=>$request->affiliation_payment_release_online,
		  'affiliation_payment_release_cod'=>$request->affiliation_payment_release_cod,
		]);
		return Redirect::back()->with('status','Updated Successfully');
	}
	public function advance_product_category_action($id){
		$data = AdvanceProductCategory::select(
		'advance_product_category.id as cat_id',
		'advance_product_category.grouping_name',
		'advance_product_category.is_return',
		'advance_product_category.return_days',
		'advance_product_category.return_terms',
		'advance_product_category.is_replace',
		'advance_product_category.replace_days',
		'advance_product_category.replace_terms',
		'advance_product_category.cancel_reason'
		)
		->where('account_id',Session::get('user')->id)
		->where('id',$id)
		->first();
		$return = view('admin.advance_product.advance_product_category_action');
		return $return->with('data',$data);
	}
	public function advance_product_category_action_post(Request $request){
		AdvanceProductCategory::where('id',$request->id)
		->update([
		   'is_return' => $request->is_return,
		   'return_days' => ( $request->is_return=='Yes' ? $request->return_days : Null ),
		   'return_terms' => $request->return_terms,
		   'is_replace' => $request->is_replace,
		   'replace_days' => ( $request->is_replace=='Yes' ? $request->replace_days : Null ),
		   'replace_terms' => $request->replace_terms,
		   'cancel_reason' => $request->cancel_reason,
		]);
		return redirect('admin/advance_product_subscription');
	}
	public function advance_product_catalogue($id,$pre_id=''){
		$account = Account::where('id',Session::get('user')->id)->first();
	    $ref_id = null;
	    $imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
		$data = DB::table('advance_product_catalogue')
		        ->where('account_id',Session::get('user')->id)
				->where('product_id',$id)
				->orderBy('order','desc')
				->get();
		$return = view('admin.advance_product.advance_product_catalogue')->with('id',$id)->with('imageUploadList',$imageUploadList)->with('data',$data);
		if($pre_id!=''){
			$pre = DB::table('advance_product_catalogue')
					->where('account_id',Session::get('user')->id)
					->where('product_id',$id)
					->where('id',$pre_id)
					->orderBy('order','desc')
					->first();
			$return = $return->with('pre',$pre);
		}
		return $return;
	}
	public function advance_product_catalogue_save(Request $request){
		if(isset($request->pre_id)){
			DB::table('advance_product_catalogue')
			->where('id',$request->pre_id)
			->where('account_id',Session::get('user')->id)
			->update([
			  'account_id' => Session::get('user')->id,
			  'product_id' => $request->product_id,
			  'title' => $request->title,
			  'description' => $request->description,
			  'image' => $request->image,
			  'order' => $request->order,
			]);
		}else{
			DB::table('advance_product_catalogue')
			->insert([
			  'account_id' => Session::get('user')->id,
			  'product_id' => $request->product_id,
			  'title' => $request->title,
			  'description' => $request->description,
			  'image' => $request->image,
			  'order' => $request->order,
			]);
		}
		return Redirect::back()->with('status','Updated Successfully');
	}
	public function advance_product_catalogue_delete($id){
		DB::table('advance_product_catalogue')
		 ->where('id',$id)
		 ->where('account_id',Session::get('user')->id)
		 ->delete();
		 return Redirect::back()->with('status','Deleted Successfully');
	}
	public function save_category_banner(Request $request){
		AdvanceProductCategory::where('account_id',Session::get('user')->id)
		        ->where('id',$request->category_banner_id)
				->update([
				   'banner'=>$request->category_banner_url
				]);
		return Redirect::back()->with('status','Updated Successfully');
	}
	public function dynamic_menu(){
		$account = Account::where('id',Session::get('user')->id)->first();
		$subscribedTemplate    = $account->subscribedTemplate;
		$subscribed = AdvanceProductSetting
		              ::whereIn('advance_product_setting.id',explode(',',$subscribedTemplate))
					  ->get();
		$category = Category::whereNull('ref_id')
		            ->where('account_id',Session::get('user')->id)
		            ->where('status','1')
					->get();
		$sub_category = Category::whereNotNull('ref_id')
		            ->where('account_id',Session::get('user')->id)
		            ->where('status','1')
					->get();
		$data = DynamicMenu::where('account_id',Session::get('user')->id)->get();
		$brand = Brand::where('account_id',Session::get('user')->id)->get();
		$ref_id = null;
	    $imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
		$return = view('admin.advance_product.dynamic_menu');
		return $return->with('subscribed',$subscribed)->with('category',$category)->with('sub_category',$sub_category)->with('data',$data)->with('imageUploadList',$imageUploadList)->with('brand',$brand);
	}
	public function dynamic_menu_post(Request $request){
		DynamicMenu::insert([
		    'account_id'=>Session::get('user')->id,
		    'category'=>$request->category,
		    'sub_category'=>$request->sub_category,
		    'setting'=>$request->setting,
		]);
		return Redirect::back()->with('status','Added Successfully');
	}
	public function delete_dynamic_menu($id){
		DynamicMenu::where('account_id',Session::get('user')->id)
		             ->where('id',$id)
					 ->delete();
		return Redirect::back()->with('status','Deleted Successfully');
	}
	public function getLastPrice($id){
		$data = AdvanceProduct::where('setting_id',$id)->where('account_id',Session::get('user')->id)->OrderBy('selling_price','asc')->limit(3)->get();
	    if(count($data)){
           foreach($data as $row){
              echo $row->title.' - <strong>'.$row->selling_price.'</strong><br>';
		   }
		}
	}
}
