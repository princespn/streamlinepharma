<?php

namespace App\Http\Controllers\WebSite;
 
use App\Http\Controllers\Controller;
use App\Http\Controllers\ForeSaleXController;
use App\Models\About;
use App\Models\ExtraService;
use App\Models\Account;
use App\Models\Category;
use App\Models\GeneralInquiry;
use App\Models\Label;
use App\Models\Privacy;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductPrice;
use App\Models\ProductInquiry;
use App\Models\ProductSearchKeyword;
use App\Models\Register;
use App\Models\RegisterAddress;
use App\Models\Returning;
use App\Models\Shipping;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\Tag;
use App\Models\Term;
use App\Models\cartTemporary;
use App\Models\Affiliate;
use App\Models\order;
use App\Models\orderDetail;
use App\Models\orderOffer;
use App\Models\Coupon;
use App\Models\changeAddress;
use App\Models\OfferNormal;
use App\Models\ProductOffer;
use App\Models\Membership;
use App\Models\MembershipPage;
use App\Models\AdvanceProductCart;
use App\Mail\WelcomeMail;
use App\Mail\ConfirmOrderMail;
use App\Mail\LoginMail;
use App\Models\AdvanceProduct;
use App\Models\AdvanceProductOrder;
use App\Models\AdvanceProductOrderDetail;
use App\Models\AdvanceProductSetting;
use App\Models\AdvanceProductAttribute;
use App\Models\Wallet;
use Hash;
use App\Models\Msgnotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use Validator;
use DB;
use App\Models\Purchaseoffer; 
use App\Models\Brand; 
use App\Models\AccountCreditAffiliation; 
use App\Models\AffiliatePaymentHistory; 
use Razorpay\Api\Api;
use Redirect;
use Cookie;
use Response;
use App\Models\ReferralScheme;
class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          
        //echo Cookie::get('aff_id');exit;
        
        $domainName = $this->activeDomain();

        $account = Account::where('domain', $domainName)->with(['currency'])->first();
		if($account->status=='0'){
			echo '<h1>Account Suspended</h1>';exit;
		}
        if ($account) {

            $sliderList = Slider::where('account_id', $account->id)->where('status', 1)->where('qc',1)->get();

            $viewPath = 'theams/theam' . $account->theme . '/index';
            Session::put('currentAccount', $account);

            $account_id = $account->id;
            $register_id = Session::getId();

            $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
            
            /*$categoryProductList = Category::where('account_id', $account->id)
            ->where('level', 1)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->with(['productlevel2' => function ($query) {

                $query->where('status', 1)->orderBy('id', 'desc')->with(['productvariations' => function ($query) {

                    $query->where('qc', 4)
                        ->where('status', 1)
                        ->orderBy('id', 'desc')
                        ->with(['inventory_price' => function ($query) {

                    }]);
                }]);
            }])
            ->get();*/
            
    
            $extraServiceList = ExtraService ::where('account_id',$account_id)->get();

            //dd($extraServiceList);
			
			 
			
			$advance_product = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status','Active')->where('account_id',$account_id)->where('qc',1)->limit(8)->orderBy('id','desc')->get();
			$discount = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id',$account_id)->where('status','Active')->where('qc',1)->limit(8)->orderBy('discount','desc')->get();
			$trending = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id',$account_id)->where('status','Active')->where('qc',1)->limit(4)->orderBy('views','desc')->get();
			$deals = Purchaseoffer::
			         where('account_id',$account_id)
					 ->where('startDate','<=',date('Y-m-d H:i:s'))
		             ->where('endDate','>=',date('Y-m-d H:i:s'))->limit(8)->get();
			$return = view($viewPath, compact('account','cartList','sliderList','extraServiceList','advance_product','discount','deals','trending'));
			if(isset($_COOKIE['recently'])){
				$recently = "'".implode("','",explode(",",$_COOKIE['recently']))."'";
				//var_dump($recently);exit;
				$viewed = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id',$account_id)->where('status','Active')->whereIn('sku',explode(",",$_COOKIE['recently']))->where('qc',1)->limit(4)->orderByRaw(DB::Raw(" FIELD(`sku`, ".$recently.")"))->get();
				//dd($viewed);
			     $return = $return->with('viewed',$viewed);
			}
            return $return;

        } else {

            return view('theams/fail');
        }

    }
	
	public function advance_product_detail($sku){
		$domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])->first();
		Session::put('currentAccount', $account);
		if(isset($_REQUEST['aff'])&&!isset($_COOKIE['aff_id'])){
			 setcookie("aff_id",$_REQUEST['aff'],time()+31556926 ,'/');
			 setcookie("aff_count",5,time()+31556926 ,'/');
		}  
		
		
		
		$account = Session::get('currentAccount');
		$advance_product = AdvanceProduct::where('sku',$sku)->first();
        if($advance_product->status!='Active'|| (!in_array($advance_product->setting_id,explode(',',$account->subscribedTemplate))) ){
           //echo $account->subscribedTemplate;
            echo 'Invalid link';
           // print_r($advance_product);
	        exit;
		}		
		$register_id = Session::getId();
        $viewPath = 'theams/theam' . $account->theme . '/advance_product/detail';
		$return = view($viewPath, compact('advance_product','account'));
		if($advance_product->setting->grouping!=Null&&$advance_product->grouping_name!=Null){
			$group = AdvanceProduct::where('sku','!=',$sku)
			                         ->where('account_id',$account->id)
			                         ->where('setting_id',$advance_product->setting_id)
			                         ->whereNotNull('grouping_name')
									 ->get();
			
			$return = $return->with('group',$group);
			
		}
		if(isset($_COOKIE['recently'])){
		  $recently = explode(',',$_COOKIE['recently']);
		  array_unshift($recently,$sku);
		  $recently = array_unique($recently);
		  array_slice($recently,0,8);
		  //var_dump($recently);exit;
		  setcookie("recently",implode(',',$recently),time()+31556926 ,'/');
		}else{
			setcookie("recently",$sku,time()+31556926 ,'/');
		}
		
		
		if(isset($_REQUEST['scheme'])){
			
			$scheme = ReferralScheme::where('account_id',$account->id)
			->where('scheme_validity','>=',date('Y-m-d'))
			->where('offering_product',$sku)
			->where('status','1')
			->where('id',urldecode(base64_decode($_REQUEST['scheme'])))
			->first();  
			if(!$scheme){
				echo 'You have entered invalid link or it is expired, Please <a href="'.url('/').'">Click here</a> to go to home page.';
				exit;
			}else{
				$return = $return->with('scheme',$scheme);
			}
		}
		
		AdvanceProduct::where('sku',$sku)->update(['views'=>($advance_product->views+1)]);
		return $return;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }  

    public function product($id='',$sub_id='',$template_id='',Request $request)
    { 
		$account = Session::get('currentAccount'); 
		$account_id = $account->id;
		$advance_product = AdvanceProduct::where('advance_product.account_id',$account_id)->where('advance_product.status','Active')->whereIn('advance_product.setting_id',explode(',',$account->subscribedTemplate))->leftJoin('advance_product_category', function ($join) use($account_id) {
                  $join->on('advance_product_category.setting_id', '=', 'advance_product.setting_id')
                  ->where('advance_product_category.account_id',$account_id);
                });
        
		$all_color = $this->all_color();
		$brand = Brand::where('account_id',$account_id)->get();
		$viewPath = 'theams/theam' . $account->theme . '/product';
		
		$pricing = AdvanceProduct::select(DB::Raw('min(uc_advance_product.selling_price) as min_price'),DB::Raw('max(uc_advance_product.selling_price) as max_price'),DB::Raw("group_concat(uc_advance_product.color) as color"))->where('advance_product.status','Active')->where('advance_product.account_id',$account_id)->whereIn('advance_product.setting_id',explode(',',$account->subscribedTemplate))
		->leftJoin('advance_product_category', function ($join) use($account_id) {
                  $join->on('advance_product_category.setting_id', '=', 'advance_product.setting_id')
                  ->where('advance_product_category.account_id',$account_id);
                });
		if($id!=''){
			$pricing = $pricing->where('advance_product_category.category',$id);
		}
		if($sub_id!=''){
			$pricing = $pricing->where('advance_product_category.sub_category',$sub_id);
		}
		$return = view($viewPath,compact('account','brand','id','sub_id','template_id'));
		if($template_id!=''){
			$pricing = $pricing->where('advance_product.setting_id',$template_id);
			$AdvanceProductSetting = AdvanceProductSetting::where('id',$template_id)->first();
			$return = $return->with('setting',$AdvanceProductSetting);
		}
		$pricing = $pricing->first();
		$all_color = array_unique(explode(',',$pricing->color));
		$return = $return->with('pricing',$pricing)->with('all_color',$all_color);
		return $return;

    }
    public function filterProduct(Request $request){
		$account = Session::get('currentAccount'); 
		$account_id = $account->id;
		$advance_product = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))
		->leftJoin('advance_product_category', function ($join) use($account_id) {
                  $join->on('advance_product_category.setting_id', '=', 'advance_product.setting_id')
                  ->where('advance_product_category.account_id',$account_id);
                })
		->where('advance_product.account_id',$account_id)
		->where('advance_product.status','Active')
		->whereIn('advance_product.setting_id',explode(',',$account->subscribedTemplate));
		if(isset($request->id)&&$request->id!=''){
			$advance_product = $advance_product->where('advance_product_category.category',$request->id);
		}
        if(isset($request->search_key)&&$request->search_key!=''){
			$advance_product = $advance_product->where('search_key_words','like','%'.$request->search_key.'%');
		}
		if(isset($request->sub_id)&&$request->sub_id!=''){
			$advance_product = $advance_product->where('advance_product_category.sub_category',$request->sub_id);
		}
		if(isset($request->template_id)&&$request->template_id!=''){
			$advance_product = $advance_product->where('advance_product.setting_id',$request->template_id);
		}
		if(isset($request->minmumAmt)){
		   $advance_product = $advance_product->where('advance_product.selling_price','>=',$request->minmumAmt);
		}
		if(isset($request->maximumAmt)){
		$advance_product = $advance_product->where('advance_product.selling_price','<=',$request->maximumAmt);
		}
		if(isset($request->brand)){
		  $advance_product = $advance_product->whereIn('advance_product.brand',$request->brand);	
		}
		if(isset($request->color)){
		  $advance_product = $advance_product->whereIn('advance_product.color',$request->color);	
		}
		
		
		if(isset($request->multi_add_filter)){
			$tmp_id = AdvanceProductAttribute::select(DB::Raw("group_concat(advance_product_id) as advance_product_id"));
			//var_dump($request->multi_add_filter);exit;
			foreach($request->multi_add_filter as $key=>$row){
				$tmp_id = $tmp_id->whereRaw(DB::Raw("value REGEXP CONCAT('(^|,)(', REPLACE('".implode(',',$row)."', ',', '|'), ')(,|$)')"));
				$tmp_id = $tmp_id->where('attribute',$key);
			}
			
			$tmp_id = $tmp_id->first();
			if($tmp_id){
				$advance_product = $advance_product->whereIn('advance_product.id',explode(',',$tmp_id->advance_product_id));
			}
		  
		}
		
		
		if(isset($request->single_add_filter)&&count($request->single_add_filter)){
			$tmp_id = AdvanceProductAttribute::select(DB::Raw("group_concat(advance_product_id) as advance_product_id"));
			//var_dump($request->multi_add_filter);exit;
			foreach($request->single_add_filter as $key=>$row){
				$tmp_id = $tmp_id->where('value',$row);
				$tmp_id = $tmp_id->where('attribute',$key);
			}
			
			$tmp_id = $tmp_id->first();
			if($tmp_id){
				//$advance_product = $advance_product->whereIn('advance_product.id',explode(',',$tmp_id->advance_product_id));
			}
		  
		}
		
		if(isset($request->sortby)){
			$advance_product = $advance_product->orderBy('advance_product.selling_price',$request->sortby);
		}
		$advance_product = $advance_product->get();
		return $advance_product;
	}
    public function filterInventory(Request $request)
    {
        $allQuery = $request->all();
        $leval = $allQuery['leval'];
        $ref_id = $allQuery['ref_id'];
        $minmumAmt = $allQuery['minmumAmt'];
        $maximumAmt = $allQuery['maximumAmt'];
        //dd($allQuery);

        $variation0 = $allQuery['variation0'] ?? NULL;
        $variation1 = $allQuery['variation1'] ?? NULL;
        $variation2 = $allQuery['variation2'] ?? NULL;
        $variation3 = $allQuery['variation3'] ?? NULL;
        $variation4 = $allQuery['variation4'] ?? NULL;

        //dd($allQuery);
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/product';

        $account_id = $account->id;

        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $productLevelString = "productlevel$leval";

        if($leval!=0) {

            $categoryProductList = Category::where('account_id', $account->id)
            ->where('level', $leval)
            ->where('id', $ref_id)
            ->with([$productLevelString => function ($query) use ($variation0,$variation1,$variation2,$variation3,$variation4,$minmumAmt,$maximumAmt) {
                $query->with(['productvariations' => function ($query) use ($variation0,$variation1,$variation2,$variation3,$variation4,$minmumAmt,$maximumAmt) {
                    $query->where('qc', 4)
                        ->where('isIdle', 1)
                        ->orderBy('id', 'desc')
                        ->with(['inventory_price' => function ($query) use($minmumAmt,$maximumAmt) {
                            $query->whereBetween('sprice', [$minmumAmt, $maximumAmt]);
                        }]);

                        if($variation0 != null){
                            $query->whereIn('variation0',$variation0);
                        }
                        if($variation1 != null){
                            $query->whereIn('variation1',$variation1);
                        }
                        if($variation2 != null){
                            $query->whereIn('variation2',$variation2);
                        }
                        if($variation3 != null){
                            $query->whereIn('variation3',$variation3);
                        }
                        if($variation4 != null){
                            $query->whereIn('variation4',$variation4);
                        }
                }]);
            }])
            ->first();

        } else {
            
            $categoryProductList = Category::where('account_id', $account->id)
            ->with([$productLevelString => function ($query) use ($variation0,$variation1,$variation2,$variation3,$variation4,$minmumAmt,$maximumAmt) {
                $query->with(['productvariations' => function ($query) use ($variation0,$variation1,$variation2,$variation3,$variation4,$minmumAmt,$maximumAmt) {
                    $query->where('qc', 4)
                        ->where('isIdle', 1)
                        ->orderBy('id', 'desc')
                        ->with(['inventory_price' => function ($query) use($minmumAmt,$maximumAmt)  {
                            $query->whereBetween('sprice', [$minmumAmt, $maximumAmt]);
                        }]);

                        if($variation0 != null){
                            $query->whereIn('variation0',$variation0);
                        }
                        if($variation1 != null){
                            $query->whereIn('variation1',$variation1);
                        }
                        if($variation2 != null){
                            $query->whereIn('variation2',$variation2);
                        }
                        if($variation3 != null){
                            $query->whereIn('variation3',$variation3);
                        }
                        if($variation4 != null){
                            $query->whereIn('variation4',$variation4);
                        }
                }]);
            }])
            ->first();
        }
        
        //dd($categoryProductList);
        
        if($categoryProductList) {
            
            $productList = array();
            if ($leval == 0) {
                $productList = $categoryProductList->productlevel0;
            } else if ($leval == 1) {
                $productList = $categoryProductList->productlevel1;
            } else if ($leval == 2) {
                $productList = $categoryProductList->productlevel2;
            } else if ($leval == 3) {
                $productList = $categoryProductList->productlevel3;
            }

            $fillters = array();
            $prices = array();

            foreach ($productList as $keys => $product) {
                
                foreach ($product->productvariations as $key => $productvariation) {

                    array_push($prices,$productvariation->inventory_price->sprice ?? 0);
                    // variation0
                    $label0 = Label::with('tag')->where('id', $productvariation->variation0)->first();
                    
                    if($label0 != null) {

                        $tagId0 = $label0->tag_id;

                        $foundedIndex0 = -1;
                        foreach ($fillters as $key => $value) {
                            
                            if($value['tagId'] == $tagId0) {
                                $foundedIndex0 = $key;
                                break;
                            }
                        }
                        
                        if($foundedIndex0 != -1){

                            $labelList = $fillters[$foundedIndex0]['labels'];
                            $labelList->push($label0);
                            $fillters[$foundedIndex0]['labels'] = $labelList->unique('id');

                        } else {

                            array_push($fillters,["labels" => collect([$label0]), "tagId"=>$tagId0 ,"tag"=>$label0->tag]);
                        }
                        
                    }

                    // variation1
                    $label1 = Label::with('tag')->where('id', $productvariation->variation1)->first();
                    
                    if($label1 != null) {

                        $tagId1 = $label1->tag_id;

                        $foundedIndex1 = -1;
                        foreach ($fillters as $key => $value) {
                            
                            if($value['tagId'] == $tagId1) {
                                $foundedIndex1 = $key;
                                break;
                            }
                        }
                        
                        if($foundedIndex1 != -1){

                            $labelList1 = $fillters[$foundedIndex1]['labels'];
                            $labelList1->push($label1);
                            $fillters[$foundedIndex1]['labels'] = $labelList1->unique('id');

                        } else {

                            array_push($fillters,["labels" => collect([$label1]), "tagId"=>$tagId1 ,"tag"=>$label1->tag]);
                        }
                        
                    }

                    // variation2
                    $label2 = Label::with('tag')->where('id', $productvariation->variation2)->first();
                    
                    if($label2 != null) {

                        $tagId2 = $label2->tag_id;

                        $foundedIndex2 = -1;
                        foreach ($fillters as $key => $value) {
                            
                            if($value['tagId'] == $tagId2) {
                                $foundedIndex2 = $key;
                                break;
                            }
                        }
                        
                        if($foundedIndex2 != -1){

                            $labelList2 = $fillters[$foundedIndex2]['labels'];
                            $labelList2->push($label2);
                            $fillters[$foundedIndex2]['labels'] = $labelList2->unique('id');

                        } else {

                            array_push($fillters,["labels" => collect([$label2]), "tagId"=>$tagId2 ,"tag"=>$label2->tag]);
                        }
                        
                    }

                    // variation3
                    $label3 = Label::with('tag')->where('id', $productvariation->variation3)->first();
                    
                    if($label3 != null) {

                        $tagId3 = $label3->tag_id;

                        $foundedIndex3 = -1;
                        foreach ($fillters as $key => $value) {
                            
                            if($value['tagId'] == $tagId3) {
                                $foundedIndex3 = $key;
                                break;
                            }
                        }
                        
                        if($foundedIndex3 != -1){

                            $labelList3 = $fillters[$foundedIndex3]['labels'];
                            $labelList3->push($label3);
                            $fillters[$foundedIndex3]['labels'] = $labelList3->unique('id');

                        } else {

                            array_push($fillters,["labels" => collect([$label3]), "tagId"=>$tagId3 ,"tag"=>$label3->tag]);
                        }
                        
                    }

                    // variation4
                    $label4 = Label::with('tag')->where('id', $productvariation->variation4)->first();
                    
                    if($label4 != null) {

                        $tagId4 = $label4->tag_id;

                        $foundedIndex4 = -1;
                        foreach ($fillters as $key => $value) {
                            
                            if($value['tagId'] == $tagId4) {
                                $foundedIndex4 = $key;
                                break;
                            }
                        }
                        
                        if($foundedIndex4 != -1){

                            $labelList4 = $fillters[$foundedIndex4]['labels'];
                            $labelList4->push($label4);
                            $fillters[$foundedIndex4]['labels'] = $labelList4->unique('id');

                        } else {

                            array_push($fillters,["labels" => collect([$label4]), "tagId"=>$tagId4 ,"tag"=>$label4->tag]);
                        }
                        
                    }

                }
            }
                        
            if (sizeof($prices) > 0)
            {
                $minPrice = min($prices);
                $maxPrice = max($prices);

            } else {
                $minPrice = 0;
                $maxPrice = 0;
            }
            
            //dd($productList);
            return view($viewPath, compact('account','cartList','productList','leval','ref_id','fillters','minPrice','maxPrice'));
            
        } else {

            return redirect('/');
        }

       
    }

    public function search(Request $request)
    {
        $input = $request->all();
        $search = $input['search'];
        
        $leval = 0;
        $ref_id = 0;
        
        if ($search) {

            $account = Session::get('currentAccount');
            $viewPath = 'theams/theam' . $account->theme . '/product';

            $account_id = $account->id;
            $register_id = Session::getId();

            $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

            $list = ProductSearchKeyword::with(['searchProduct'=> function ($query) use($account_id) {
                $query->where('account_id', $account_id)->with(['productvariations' => function ($query) {

                    $query->where('qc', 4)
                        ->where('isIdle', 1)
                        ->with(['inventory_price' => function ($query) {

                        }]);
                }]);                        

            }])
            ->where('keyword', 'like', '%' . $search . '%')
            ->orderBy('product_id', 'asc')
            ->get();

            $productList = array();
            foreach ($list as $key => $value) {
                
                if($value->searchProduct) {
                    
                    array_push($productList,$value->searchProduct);
                }
            }

            $fillters = array();
            $prices = array();

            foreach ($productList as $keys => $product) {
                
                foreach ($product->productvariations as $key => $productvariation) {

                    array_push($prices,$productvariation->inventory_price->sprice);
                    // variation0
                    $label0 = Label::with('tag')->where('id', $productvariation->variation0)->first();
                    
                    if($label0 != null) {

                        $tagId0 = $label0->tag_id;

                        $foundedIndex0 = -1;
                        foreach ($fillters as $key => $value) {
                            
                            if($value['tagId'] == $tagId0) {
                                $foundedIndex0 = $key;
                                break;
                            }
                        }
                        
                        if($foundedIndex0 != -1){

                            $labelList = $fillters[$foundedIndex0]['labels'];
                            $labelList->push($label0);
                            $fillters[$foundedIndex0]['labels'] = $labelList->unique('id');

                        } else {

                            array_push($fillters,["labels" => collect([$label0]), "tagId"=>$tagId0 ,"tag"=>$label0->tag]);
                        }
                        
                    }

                    // variation1
                    $label1 = Label::with('tag')->where('id', $productvariation->variation1)->first();
                    
                    if($label1 != null) {

                        $tagId1 = $label1->tag_id;

                        $foundedIndex1 = -1;
                        foreach ($fillters as $key => $value) {
                            
                            if($value['tagId'] == $tagId1) {
                                $foundedIndex1 = $key;
                                break;
                            }
                        }
                        
                        if($foundedIndex1 != -1){

                            $labelList1 = $fillters[$foundedIndex1]['labels'];
                            $labelList1->push($label1);
                            $fillters[$foundedIndex1]['labels'] = $labelList1->unique('id');

                        } else {

                            array_push($fillters,["labels" => collect([$label1]), "tagId"=>$tagId1 ,"tag"=>$label1->tag]);
                        }
                        
                    }

                    // variation2
                    $label2 = Label::with('tag')->where('id', $productvariation->variation2)->first();
                    
                    if($label2 != null) {

                        $tagId2 = $label2->tag_id;

                        $foundedIndex2 = -1;
                        foreach ($fillters as $key => $value) {
                            
                            if($value['tagId'] == $tagId2) {
                                $foundedIndex2 = $key;
                                break;
                            }
                        }
                        
                        if($foundedIndex2 != -1){

                            $labelList2 = $fillters[$foundedIndex2]['labels'];
                            $labelList2->push($label2);
                            $fillters[$foundedIndex2]['labels'] = $labelList2->unique('id');

                        } else {

                            array_push($fillters,["labels" => collect([$label2]), "tagId"=>$tagId2 ,"tag"=>$label2->tag]);
                        }
                        
                    }

                    // variation3
                    $label3 = Label::with('tag')->where('id', $productvariation->variation3)->first();
                    
                    if($label3 != null) {

                        $tagId3 = $label3->tag_id;

                        $foundedIndex3 = -1;
                        foreach ($fillters as $key => $value) {
                            
                            if($value['tagId'] == $tagId3) {
                                $foundedIndex3 = $key;
                                break;
                            }
                        }
                        
                        if($foundedIndex3 != -1){

                            $labelList3 = $fillters[$foundedIndex3]['labels'];
                            $labelList3->push($label3);
                            $fillters[$foundedIndex3]['labels'] = $labelList3->unique('id');

                        } else {

                            array_push($fillters,["labels" => collect([$label3]), "tagId"=>$tagId3 ,"tag"=>$label3->tag]);
                        }
                        
                    }

                    // variation4
                    $label4 = Label::with('tag')->where('id', $productvariation->variation4)->first();
                    
                    if($label4 != null) {

                        $tagId4 = $label4->tag_id;

                        $foundedIndex4 = -1;
                        foreach ($fillters as $key => $value) {
                            
                            if($value['tagId'] == $tagId4) {
                                $foundedIndex4 = $key;
                                break;
                            }
                        }
                        
                        if($foundedIndex4 != -1){

                            $labelList4 = $fillters[$foundedIndex4]['labels'];
                            $labelList4->push($label4);
                            $fillters[$foundedIndex4]['labels'] = $labelList4->unique('id');

                        } else {

                            array_push($fillters,["labels" => collect([$label4]), "tagId"=>$tagId4 ,"tag"=>$label4->tag]);
                        }
                        
                    }

                }
            }
            
            if (sizeof($prices) > 0)
            {
                $minPrice = min($prices);
                $maxPrice = max($prices);

            } else {
                $minPrice = 0;
                $maxPrice = 0;
            }
                
            return view($viewPath, compact('account','cartList','productList','leval','ref_id','fillters','minPrice','maxPrice'));

        } else {

            return redirect('/');
        }

    }

    public function detail(Request $request)
    {
        $account = Session::get('currentAccount');
        //dd($account);
        
        if($account){

            $account= $account;

        } else {
            $domainName = $this->activeDomain();

            $account = Account::where('domain', $domainName)->with(['currency'])->first();
        }
        //dd($account);

        $viewPath = 'theams/theam' . $account->theme . '/detail';

        $account_id = $account->id;
        $register_id = Session::getId();
        
        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $allQuery = $request->all();
        $inventoryId = $allQuery['id'];
        $affiliateCode = $allQuery['aff'] ?? '';
  
        if($affiliateCode) {

            $affiliateDetail = Affiliate::where('code', $affiliateCode)->first();
            if($affiliateDetail) {
                
                $affiliateId = $affiliateDetail->id;
            } else {

                $affiliateId = '';
            }

        } else {

            $affiliateId = '';
        }

        $inventoryData = ProductInventory::where('id', $inventoryId)
            ->with(['inventory_price', 'inventory_shipping', 'inventory_warranty','product_packaging' => function ($query) {}])
            ->first();
        $relatedProduct = ProductInventory::where('product_id', $inventoryData->product_id)->where('id', '!=', $inventoryId)->get();
        
        $productData = Product::with([

            'tax_detail','attributesOption' => function ($query) {
                $query->where('type', 3)->with(['label' => function ($query) {
                    $query->with('tag');
                }]);
            },
        ])
        ->where('id', $inventoryData->product_id)
        ->first();

        if (isset($productData->attributesOption)) {

            $arrayOptions = array();

            foreach ($productData->attributesOption as $key => $attributesOption) {

                $tagObject = $attributesOption->label->tag;
                if (array_key_exists($attributesOption->label->tag_id, $arrayOptions)) {

                    $optionsIds = $tagObject->optionsIds;
                    array_push($optionsIds, $attributesOption->label);
                    $tagObject->optionsIds = $optionsIds;
                    $arrayOptions[$attributesOption->label->tag_id] = $tagObject;
                } else {

                    $tagObject->optionsIds = array($attributesOption->label);
                    $arrayOptions[$attributesOption->label->tag_id] = $tagObject;
                }

            }

            $productData->optionList = $arrayOptions;
        }
		$colorOption = ProductInventory::where('product_id', $inventoryData->product_id)->get();
        //dd($productData);
        $schemeList = Purchaseoffer::where('purchaseoffers.account_id',$account_id)
		              ->select('purchaseoffers.*','productschemes.title','product_inventories.productName')
					  ->leftJoin('productschemes','productschemes.id','=','purchaseoffers.scheme')
					  ->leftJoin('product_inventories','product_inventories.sku','=','purchaseoffers.get_prod_sku')
		              ->where('purchaseoffers.startDate','<=',date('Y-m-d H:i:s'))
		              ->where('purchaseoffers.endDate','>=',date('Y-m-d H:i:s'))
		              ->where('purchaseoffers.product_sku',$inventoryData->sku)
					  ->get();  
		//dd($schemeList);exit;
		$all_membership = Membership::where('account_id',$account_id)->get();
		$return = view($viewPath, compact('account','cartList','inventoryData', 'relatedProduct', 'productData','affiliateId','colorOption','schemeList','all_membership'));
		if(Session::get('register')){
		    $membership = Membership::where('id',Session::get('register')
			              ->memebership_id)->first();
			$return = $return->with('membership',$membership);
	    }
		  
        return $return;
    }
 
    public function optionFilter(Request $request)
    {
        $input = $request->all();
        $inventoryData = ProductInventory::where('product_id',$input['productId'])->with(['inventory_price', 'inventory_shipping', 'inventory_warranty' => function ($query) {}]);

        foreach ($input['data'] as $key => $value) {

            $inventoryData->where($value['key'], $value['value']);
        }

        $inventoryData = $inventoryData->first();

        return response()->json($inventoryData, 200);

    }

    public function login()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/login';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        return view($viewPath, compact('account','cartList'));
    }
    public function check_mobile(Request $request){
		$account = Session::get('currentAccount');
		$account_id = $account->id; 
		$register = Register::where('account_id', $account_id)->where('phone', $request->mobile)->where('status', 1)->first();
		if($register){
			return array('error'=>false,'name'=>$register->name);
		}else{
			        $found = Msgnotify::where('account_id', $account_id)->where('msg_type', '4')->first();
					
					
			        $OTP = rand(1000,9999);
					$sign_up_message = $found->messages;
					$sign_up_message = str_replace('[OTP]',$OTP,$sign_up_message);
				    $message = urlencode($sign_up_message);
                     Session::put('otp', $OTP);
                //$url = "http://nimbusit.co.in/api/swsendSingle.asp?username=t1thekheewa&password=100719238&sender=KHEEWA&sendto=$phone&message=$message";
                //$url = "http://nimbusit.co.in/api/swsendSingle.asp?username=$account->SMSUserName&password=$account->SMSUserPassword&sender=$account->SMSUserSenderId&sendto=$phone&message=$message";
                $account = Session::get('currentAccount');
                $replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
                $replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
                $replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
                $replace3 = str_replace('setPhone', $request->mobile, $replace2);
                $replace4 = str_replace('setMessage', $message, $replace3);
                $replace5 = str_replace('setTEMPLATEID', $found->template_id,$replace4);

                $url = $replace5;
                //dd($url);
                $post = curl_init();
                curl_setopt($post, CURLOPT_URL, $url);
                curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
                $response = curl_exec($post);
                curl_close($post);
                $result = json_decode($response, true);
                
                //dd($response);
			return array('error'=>true,'message'=>'User Not found '.$OTP);
		}
	}
	public function ajaxSignUp(Request $request){
	   if($request->new_otp==Session::get('otp')){ 
	            $account = Session::get('currentAccount');
	            $input    = $request->all();
                $password = bcrypt($input['set_password']);
				$phone    = $input['pre_phone'];
				$register = Register::create(['account_id' => $account->id, 'name' => '', 'phone' => $phone, 'email' => '', 'password' => $password]);
				if ($register) {
                    
                    RegisterAddress::create(['register_id' => $register->id, 'name' => '', 'phone' => $phone, 'email' => '', 'password' => $password, 'landmark' => '', 'address' => '', 'zipCode' => '']);

                    $logo = $account->domain.'/'.$account->logo;
                    //Mail::to($input['email'])->send(new WelcomeMail(['input'=>$input, 'account' => $account, 'logo' => $logo]));
                    
                    Session::put('isLoggedIn', true);
                    Session::put('register', $register);
					AdvanceProductCart::where('register_id',Session::getId())
					                    ->update(['register_user_id'=>$register->id]);
                    Session::save();
                    return array('error'=>false,'message'=>'Registered.');

                } else {
                    return array('error'=>true,'message'=>'Something went wrong.');
                }
	   }else{
		   return array('error'=>true,'message'=>'Your OTP didnot match.');
	   }	
	}
	public function checkLoginDetails(Request $request){
		   $account = Session::get('currentAccount');
           $account_id = $account->id;
        
           $input = $request->all();
		   $phone = $input['phone'];
           $password = $input['password'];
		   $register = Register::where('account_id', $account_id)->where('phone', $phone)->where('status', 1)->first();
           
		  $otp = (isset($input['login_otp'])? $input['login_otp']:'');
		  $isOtpLogin=false;
			if($otp && Session::get('loginOtp') && Session::get('loginOtp')==$otp){
				$isOtpLogin=true;
			}
		
            if ($register) {
                
                if (!$isOtpLogin && !Hash::check($password, $register->password)) {
                    return array('error'=>true,'message'=>'Enter correct password');
					exit;
                } else {

                    Session::put('isLoggedIn', true);
                    Session::put('register', $register);
                    Session::save();
                    AdvanceProductCart::where('register_id',Session::getId())
					                    ->update(['register_user_id'=>$register->id]);
                    $email = $register['email'];
                    if($email)
                    {
                        $logo = $account->domain.'/'.$account->logo;
                        Mail::to($email)->send(new LoginMail(['register'=>$register, 'account' => $account, 'logo' => $logo]));
                    }

                    return array('error'=>false,'message'=>'LoggedIn');
					exit;
                }

            } else {
				    
                    return array('error'=>true,'message'=>'Mobile is Not Registered.');
					exit;
            }
	}
    public function loginSubmit(Request $request)
    {
        $account = Session::get('currentAccount');
        $account_id = $account->id;
        
        $input = $request->all();

        $rules = [
            'phone' => 'required',
             'password' => 'required_if:login_otp,"=",null',
            'login_otp' => 'required_if:password,"=",null'
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $phone = $input['phone'];
            $password = $input['password'];
			$otp = $input['login_otp'];
            $isOtpLogin=false;
            if($otp && Session::get('loginOtp')==$otp){
                $isOtpLogin=true;
            }

            unset($input['_token']);
            unset($input['phone']);
            unset($input['password']);
           
            $register = Register::where('account_id', $account_id)->where('phone', $phone)->where('status', 1)->first();
            if($isOtpLogin && $register){
                Session::put('isLoggedIn', true);
                Session::put('register', $register);
                Session::save();
                AdvanceProductCart::where('register_id',Session::getId())
					                    ->update(['register_user_id'=>$register->id]);
                $email = $register['email'];
                if ($email) {
                    $logo = $account->domain . '/' . $account->logo;
                    Mail::to($email)->send(new LoginMail(['register' => $register, 'account' => $account, 'logo' => $logo]));
                }
                return redirect('/');
            }else if ($register) {
                
                if (!Hash::check($password, $register->password)) {

                    return back()->withErrors(['Enter correct password']);

                } else {

                    Session::put('isLoggedIn', true);
                    Session::put('register', $register);
                    Session::save();
                    AdvanceProductCart::where('register_id',Session::getId())
					                    ->update(['register_user_id'=>$register->id]);
                    $email = $register['email'];
                    if($email)
                    {
                        $logo = $account->domain.'/'.$account->logo;
                        Mail::to($email)->send(new LoginMail(['register'=>$register, 'account' => $account, 'logo' => $logo]));
                    }

                    return redirect('/');
                }

            } else {

                return back()->withErrors(['You are not registered with this contact number.']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function logOutClick(Request $request)
    {

        $request->session()->flush();
        return redirect('/');

    }

    public function register()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/register';
        
        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        return view($viewPath, compact('account','cartList'));
    }

    public function registerSubmit(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'phone' => 'required|min:10|max:10',
            'email' => 'required',
            'password' => 'required',
            'landmark' => 'required',
            'address' => 'required',
            'zipCode' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $account = Session::get('currentAccount');
            $phone = $input['phone'];

            $registerCheck = Register::where('account_id', $account->id)->where('phone', $phone)->first();
            if($registerCheck) {

                return back()->withErrors(['This number is already registered.']);

            } else {

                $name = $input['name'];            
                $email = $input['email'];
                $password = bcrypt($input['password']);
                $landmark = $input['landmark'];
                $address = $input['address'];
                $zipCode = $input['zipCode'];

                // unset($input['_token']);
                // unset($input['name']);
                // unset($input['phone']);
                // unset($input['email']);
                // unset($input['password']);
                // unset($input['landmark']);
                // unset($input['address']);
                // unset($input['zipCode']);

                $register = Register::create(['account_id' => $account->id, 'name' => $name, 'phone' => $phone, 'email' => $email, 'password' => $password]);
                if ($register) {
                    
                    RegisterAddress::create(['register_id' => $register->id, 'name' => $name, 'phone' => $phone, 'email' => $email, 'password' => $password, 'landmark' => $landmark, 'address' => $address, 'zipCode' => $zipCode]);

                    $logo = $account->domain.'/'.$account->logo;
                    Mail::to($input['email'])->send(new WelcomeMail(['input'=>$input, 'account' => $account, 'logo' => $logo]));
                    
                    Session::put('isLoggedIn', true);
                    Session::put('register', $register);
                    Session::save();
                    return redirect('/');

                } else {

                    return back()->withErrors(['Something went wrong']);
                }
            }

        } else {

            $errors = $validation->errors();
            //dd($errors);
            return back()->withErrors($errors);
        }
    }

    public function forgotPassword()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/forgotPassword';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        $OTP = null;
        $phone = null;

        return view($viewPath, compact('account','cartList','OTP','phone'));
    }

    public function forgotPasswordSubmit(Request $request)
    {
        $input = $request->all();

        $rules = [
            'phone' => 'required|min:10',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $account = Session::get('currentAccount');
            //dd($account);
            $viewPath = 'theams/theam' . $account->theme . '/forgotPassword';
            $phone = $input['phone'];

            $registerCheck = Register::where('account_id', $account->id)->where('phone', $phone)->first();
            if($registerCheck) {

                $register_id = Session::getId();
                $found = Msgnotify::where('account_id', $account->id)->where('msg_type', '6')->first();
                $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account->id)->where('register_id', $register_id)->get();

                $OTP = rand(1,999999);
                $sign_up_message = $found->messages;
				$sign_up_message = str_replace('[OTP]',$OTP,$sign_up_message);
                $message = urlencode($sign_up_message);
                
                //$url = "http://nimbusit.co.in/api/swsendSingle.asp?username=t1thekheewa&password=100719238&sender=KHEEWA&sendto=$phone&message=$message";
                //$url = "http://nimbusit.co.in/api/swsendSingle.asp?username=$account->SMSUserName&password=$account->SMSUserPassword&sender=$account->SMSUserSenderId&sendto=$phone&message=$message";
                
                $replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
                $replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
                $replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
                $replace3 = str_replace('setPhone', $phone, $replace2);
                $replace4 = str_replace('setMessage', $message, $replace3);
                $replace5 = str_replace('setTEMPLATEID', $found->template_id,$replace4);
                $url = $replace5;
                //dd($url);
                $post = curl_init();
                curl_setopt($post, CURLOPT_URL, $url);
                curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
                $response = curl_exec($post);
                curl_close($post);
                $result = json_decode($response, true);
                
                //dd($response);
                
                return view($viewPath, compact('account','cartList','OTP','phone'));

            } else {
                
                return back()->withErrors(['Enter Valid Number.']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function forgotPasswordUpdate(Request $request)
    {
        $account = Session::get('currentAccount');
        $account_id = $account->id;
        
        $input = $request->all();
        $phone = $input['data']['phone'];
        $password = bcrypt($input['data']['password']);

        Register::where('account_id', $account_id)->where('phone', $phone)->update(['password' => $password]);

        return response()->json($phone, 200);
    }

    public function about()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/about';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $aboutList = About::where('account_id', $account->id)->first();

        return view($viewPath, compact('account','cartList','aboutList'));
    }

    public function privacy()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/privacy';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $privacyList = Privacy::where('account_id', $account->id)->first();
        
        return view($viewPath, compact('account','cartList', 'privacyList'));
    }

    public function shipping()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/shipping';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $shippingList = Shipping::where('account_id', $account->id)->first();

        return view($viewPath, compact('account','cartList', 'shippingList'));
    }

    function return() {

        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/return';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $returnList = Returning::where('account_id', $account->id)->first();

        return view($viewPath, compact('account','cartList', 'returnList'));
    }

    public function contact()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/contact';
        
        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        
        $socialList = SocialMedia::where('account_id', $account->id)->first();
        
        return view($viewPath, compact('account','cartList', 'socialList'));
    }

    public function contactSubmit(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $account = Session::get('currentAccount');
            //dd($account);
            $viewPath = 'theams/theam' . $account->theme . '/contact';

            $input['account_id'] = $account->id;
            unset($input['_token']);
            $logo = $account->domain.'/'.$account->logo;
            
            $contact = GeneralInquiry::create($input);
            if ($contact) {

                $register_id = Session::getId();
                $socialList = SocialMedia::where('account_id', $account->id)->first();

                $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account->id)->where('register_id', $register_id)->get();
                
                Mail::to($input['email'])->send(new WelcomeMail(['input'=>$input, 'account' => $account, 'logo' => $logo]));
                return view($viewPath, compact('account', 'socialList','cartList'));

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function inquirySubmit(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $account = Session::get('currentAccount');
            //dd($account);
            $viewPath = 'theams/theam' . $account->theme . '/contact';

            $input['account_id'] = $account->id;
            unset($input['_token']);
            $logo = $account->domain.'/'.$account->logo;
            
            $contact = ProductInquiry::create($input);
            if ($contact) {

                return redirect('/');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function term()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/term';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        
        $termList = Term::where('account_id', $account->id)->first();
        return view($viewPath, compact('account','cartList', 'termList'));
    }
    
    public function addToCart(Request $request)
    {
        //$account = Session::get('currentAccount');

        $domainName = $this->activeDomain();

        $account = Account::where('domain', $domainName)->with(['currency'])->first();
        Session::put('currentAccount', $account);
        
        $account_id = $account->id;
        $register_id = Session::getId();
        $input = $request->all();
        $inventoryId = $input['data']['inventoryId'];
        $affiliate_id = $input['data']['affiliateId'];

        $checkInventory = ProductPrice::where('inventoryId', $inventoryId)->first();

        if($checkInventory->qty) {

            $checkCart  = cartTemporary::where('account_id', $account_id)->where('register_id', $register_id)->where('inventoryId', $inventoryId)->first();
        
            if($checkCart) {

                $qty = $checkCart->qty + 1 ;
                cartTemporary::where('account_id', $account_id)->where('register_id', $register_id)->where('inventoryId', $inventoryId)->update(['qty' => $qty]);
                $cartMSG = "Qty update successfully";

            } else {

                cartTemporary::insert(['account_id'=>$account_id,'register_id'=>$register_id,'affiliate_id'=>$affiliate_id,'inventoryId'=>$inventoryId]);
                $cartMSG = "Add successfully";
            }

        } else {

            $cartMSG = "Product is out of stock";
        }
        
        return response()->json($cartMSG, 200);
    }

    

    public function cartList(Request $request)
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/cartList';
        $account_id = $account->id;
        $register_id = Session::getId();
        return view($viewPath, compact('account'));
    }

    public function removeProduct(Request $request)
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/cartList';
        $account_id = $account->id;
        $register_id = Session::getId();

        $input = $request->all();
        $inventoryId = $input['data']['inventoryId'];
        cartTemporary::where('id',$inventoryId)->where('register_id',$register_id)->delete();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        return view($viewPath, compact('account','cartList'));
    }

    public function checkOut(Request $request)
    {
		
		$account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/checkOut';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get(); 
		
		if(Session::get('register')){
        $account = Session::get('currentAccount');
        $pickupPinCode = $account->pinCode;
        //$viewPath = 'theams/theam' . $account->theme . '/checkOut';cartList
        $account_id = $account->id;
        $register_id = Session::getId();
        $register = Session::get('register');

        $amount=$this->FinalAmount($register->id);
		 $totalWeight = 0;
            $totalInvoicevalue = 0;
            $isShippingInclude = false;
            $itemID=null;
		$allAddresses = RegisterAddress::where('register_id', $register->id)->orderBy('id')->get();
		 $addresses = null;
            $deliveryPinCode = null;
		   if ($allAddresses && $allAddresses->count() == 1) {
                $addresses = $allAddresses[0];
                $deliveryPinCode = $addresses->zipCode;
                Session::put('addressCode',$deliveryPinCode);
            }
            if(Session::get('addressCode')){
                $deliveryPinCode = Session::get('addressCode');
            }
		    $addresses = null;
            $deliveryPinCode = null;
            $allAddresses = RegisterAddress::where('register_id', $register->id)->orderBy('id')->get();
			//dd($allAddresses);
            if ($allAddresses && $allAddresses->count() == 1) {
                $addresses = $allAddresses[0];
                $deliveryPinCode = $addresses->zipCode;
                Session::put('addressCode',$deliveryPinCode);
            }
            if(Session::get('addressCode')){
                $deliveryPinCode = Session::get('addressCode');
            }
            
       /* $addresses = RegisterAddress :: where('register_id', $register->id)->first();
        $deliveryPinCode = $addresses->zipCode;
        $deliveryPinCode = 226026;*/
		if ($deliveryPinCode) {
        $avnkey = $account->shipyaariClientCode."@".$account->shipyaariParentCode;
        $insurance="no"; //yes
        $service_type="normal";
        $service="economy"; //standard
        $partner="";
        $request_url ='https://seller.shipyaari.com/logistic/webservice/SearchAvailability_new.php';

        $cartList = cartTemporary::with('inventoryPrice','cartInventory','inventoryPackaging','inventoryOffer')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        $totalLengthArray = array();
        $totalWidthArray = array();
        foreach ($cartList as $key => $value) {
            //dd($value->inventoryPackaging);
            if($value->inventoryPackaging->includeShipping == 0)
            {
				$isShippingInclude = true;
                $weight = $value->inventoryPackaging->weight;
                $length = $value->inventoryPackaging->length;
                $width = $value->inventoryPackaging->width;
                $height = $value->inventoryPackaging->height;
                $total = $value->inventoryPrice->sprice;
                $qty = $value->qty;
                $invoicevalue = ($total * $qty) + ($total * ($value->cartInventory->ProductTax->includeTax == 0 ? $value->cartInventory->ProductTax->tax : 0)/100);
				array_push($totalLengthArray,$length);
                array_push($totalWidthArray,$width);
                //dd($invoicevalue);
                $codMode="COD";
				$totalWeight = $totalWeight + $weight;
				 $totalInvoicevalue = $totalInvoicevalue + $invoicevalue;
                
               
				$itemID=$value->id;
                        cartTemporary::where('id', $value->id)->update(['shipmentCOD' => null, 'shipmentOnline' => null]);
                
            } else {

               // cartTemporary::where('id', $value->id)->update(['shipmentCOD' => null,'shipmentOnline' => null]);
            }
            
        }
		
		}  
         
		
        return view($viewPath, compact('account','register','addresses', 'allAddresses','amount'));
		}else{
			return view($viewPath, compact('account'));
			
		}
    }

    public function couponCodeCodeCheck(Request $request)
    {
        $register_id = Session::getId();
        $account = Session::get('currentAccount');
        $account_id = $account->id;

        $input = $request->all();
        $couponCode = $input['data']['couponCode'];
        $currentDate = date("Y-m-d");
        
        $checkOffer = OfferNormal::where('couponCode',$couponCode)
            ->whereDate('startDate', '<=', $currentDate)
            ->whereDate('endDate', '>=', $currentDate)    
            ->first();

        if($checkOffer) {

            $offerInventories = ProductOffer::where('offerId',$checkOffer->id)->get();

            $result = 0;
            if($offerInventories) {
                foreach ($offerInventories as $key => $offerInventory) {
                    
                    $checkCart  = cartTemporary::where('account_id', $account_id)->where('register_id', $register_id)->where('inventoryId', $offerInventory->inventoryId)->get();
                    if($checkCart) {
                        cartTemporary::where('account_id', $account_id)->where('register_id', $register_id)->where('inventoryId', $offerInventory->inventoryId)->update(['offerId' => $checkOffer->id]);
                        $result += 1;
                    } else {
                        cartTemporary::where('account_id', $account_id)->where('register_id', $register_id)->update(['offerId' => null]);
                        $result += 0;
                    }
                }

            } else {
                cartTemporary::where('account_id', $account_id)->where('register_id', $register_id)->update(['offerId' => null]);
                $result = +0;
            }

        } else {
            cartTemporary::where('account_id', $account_id)->where('register_id', $register_id)->update(['offerId' => null]);
            $result = +0;
        }

        return response()->json($result, 200);
    }

    public function confirmOrder(Request $request){

        $input = $request->all();

        $rules = [
            'name' => 'required',
            'phone' => 'required|min:10',
            'email' => 'required',
            'landmark' => 'required',
            'address' => 'required',
            'zipCode' => 'required',
        ];

        $validation = Validator::make($input, $rules);
		
		 $isAddressSelected = false;
        if (isset($input['shipping_address']) && $input['shipping_address']) {
            $shipAddress = RegisterAddress::where('id', $input['shipping_address'])->first()->toArray();
            if ($shipAddress && !empty($shipAddress)) {
                $isAddressSelected = true;
                $input['name'] = $shipAddress['name'];
                $input['phone'] = $shipAddress['phone'];
                $input['email'] = $shipAddress['email'];
                $input['landmark'] = $shipAddress['landmark'];
                $input['address'] = $shipAddress['address'];
                $input['zipCode'] = $shipAddress['zipCode'];
                $input['cityId'] = $shipAddress['cityId'];
                $input['stateId'] = $shipAddress['stateId'];
            }
        } else {
            $register = Session::get('register');
            if ($register) {
                RegisterAddress::create(['register_id' => $register->id, 'name' => $input['name'], 'phone' => $input['phone'], 'email' => $input['email'], 'landmark' => $input['landmark'], 'address' => $input['address'], 'zipCode' => $input['zipCode'], 'cityId' => $input['cityId'], 'stateId' => $input['stateId']]);
            }
        }

        if ($validation->passes() || $isAddressSelected) {
			Session::put('addressCode','');
			Session::put('addressCodeID','');
            $inputData = base64_encode(json_encode($input));
            $customURL = url('/')."/confirmOrderProcess/".$inputData;
            
            if($input['transactionType'] == 1) {

                return redirect()->to($customURL);
                
            }else if($input['transactionType'] == 3){
                $api = new Api('rzp_test_MA9crdJykVQCcK', 'j9U0lJtfMywUIYP5iCn0q8ip');	
                $couponDiscountAmt=(isset($input['coupon_amount']) ? $input['coupon_amount'] : 0);
                $grandTotal = $input['grandTotal'] - $couponDiscountAmt;				
			    $order  = $api->order->create([
						  'receipt'         => $input['name'],
						  'amount'          => $grandTotal*100, 
						  'currency'        => 'INR',
						]);
				$razorpay_order_id = $order->id;
				Session::put('razorpay_order_id',$order->id);	
			    $account = Session::get('currentAccount');
				$user_data = ['name'=>$input['name'],'contact'=>$input['phone'],'email'=>$input['email']];
                $viewPath = 'theams/theam' . $account->theme . '/razorpayView';
				return view($viewPath)->with('account',$account)->with('inputData',$inputData)->with('razorpay_order_id',$razorpay_order_id)->with('user_data',$user_data);
			}else {
                
                $account = Session::get('currentAccount');
                
                $ApiKey = $account->instamojoApiKey;
                $AuthToken = $account->instamojoAuthToken;

                if($account->id<3) {

                    $url = 'https://test.instamojo.com/api/1.1/';

                } else {
                
                    $url = 'https://www.instamojo.com/api/1.1/';
                }
                
                $api = new \Instamojo\Instamojo(
                    
                    // config('services.instamojo.api_key'),
                    // config('services.instamojo.auth_token'),
                    // config('services.instamojo.url')

                    // 'dee8187d62c63d2955baf37889e35860',
                    // 'df569c61770b6a55f7dec9cc5d89ce9a',
                    $ApiKey,
                    $AuthToken,
                    $url
                );

                try {
					$couponDiscountAmt=(isset($input['coupon_amount']) ? $input['coupon_amount'] : 0);
                    $grandTotal = $input['grandTotal'] - $couponDiscountAmt;
                    $response = $api->paymentRequestCreate(array(
                        "purpose" => "Payment to $account->domain",
                        "amount" =>  $grandTotal,
                        "buyer_name" => $input['name'],
                        "send_email" => true,
                        "email" => $input['email'],
                        "phone" => $input['phone'],
                        "redirect_url" =>  $customURL,
                        ));
                        
                        header('Location: ' . $response['longurl']);
                        exit();

                } catch (\Exception $e) {
                    
                    return back()->withErrors(['Failed to pay. please try again.']);
                }
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function confirmOrderProcess(Request $request,$inputData) {

        $allValues = $request->all();
        $onlineTransactionMode = '';
        if($allValues){
            if(isset($request->onlineTransactionMode)){
			   $onlineTransactionMode = 'Razorpay';
			}else{
			   $onlineTransactionMode = 'Instamojo';
			}
            $transactionId = $allValues['payment_id'];
           
        } else {

            $transactionId = 'COD';
        }

        $account = Session::get('currentAccount');
        $pickupPinCode = $account->pinCode;
        $account_id = $account->id;
        $register_id = Session::getId();

        $register = Session::get('register');
        $registerId = $register->id;

        $lastOrder = order::where('account_id', $account_id)->orderBy('created_at', 'desc')->first();

        if (!$lastOrder) {

            $orderNo = 0;

        } else {

            $orderNo = $lastOrder->orderNo;
        }

        $orderNo = $orderNo + 1;

        $input = json_decode(base64_decode($inputData),true);
		$couponDiscountAmt=(isset($input['coupon_amount']) ? $input['coupon_amount'] : 0);
        $name = $input['name'];
        $phone = str_replace(' ', '', $input['phone']);
        $email = $input['email'];
        $landmark = $input['landmark'];
        $address = $input['address'];
        $zipCode = $input['zipCode'];
        $cityId = $input['cityId'];
        $stateId = $input['stateId'];
        $transactionType = $input['transactionType'];
        $grandTotal = $input['grandTotal'] - $couponDiscountAmt;;
        
        $orderData = ([
            'account_id'=>$account_id,
            'register_id'=>$registerId,
            'name'=>$name,
            'phone'=>$phone,
            'email'=>$email,
            'landmark'=>$landmark,
            'address'=>$address,
            'zipCode'=>$zipCode,
            'cityId'=>$cityId,
            'stateId'=>$stateId,
            'transactionType'=>$transactionType,
            'transactionId'=>$transactionId,
            'orderNo'=>$orderNo,
            'onlineTransactionMode'=>$onlineTransactionMode,
			'coupon_code' =>(isset($input['coupon']) ? $input['coupon'] : ''),
            'coupon_amount' => (isset($input['coupon_amount']) ? $input['coupon_amount'] : 0)
        ]);
        
        $order = order :: create($orderData);
        $order_id = $order->id;
        
        if($order_id) {

            $paymentmode = $transactionType == 1 ? "COD" : "Online";
            $invoicevalue=$order_id;
            $avnkey = $account->shipyaariClientCode."@".$account->shipyaariParentCode;
            $insurance="no"; //yes
            $service_type="normal";
            $partner="";
            $service="economy"; //standard

            $request_url ='https://seller.shipyaari.com/logistic/webservice/SearchAvailability_new.php';

            $cartList = cartTemporary::with([
                
                'cartInventory'=>function($query) {

                    $query->with('ProductTax');
            },
            'inventoryPrice','inventoryPackaging',
            ])->where('account_id', $account_id)->where('register_id', $register_id)->get();

            $cartConfirm = array();
            $package_details = array();
            $offerJSON = array();
            $totalWeight = 0;
            $totalLength = 0;
            $totalWidth = 0;
            $totalHeight = 0;
            $totalQty = 0;
			$totalLengthArray = array();
            $totalWidthArray = array();
            $shipRocketPrArray = [];
            foreach ($cartList as $cart => $value) {

                //dd($value->inventoryPrice->sprice);

                $weight = $value->inventoryPackaging->weight;
                $length = $value->inventoryPackaging->length;
                $width = $value->inventoryPackaging->width;
                $height = $value->inventoryPackaging->height;

                $offer_id = $value->offerId;
                $inventoryId = $value->inventoryId;

                $totalWeight += $weight;
                $totalLength += $length;
                $totalWidth += $width;
                $totalHeight += $height;
                $totalQty += $value['qty'];
                array_push($totalLengthArray,$length);
                array_push($totalWidthArray,$width);
                $shipping = $transactionType == 1 ? $value->shipmentCOD : $value->shipmentOnline;
                
                if($value->cartInventory['variation0']) {

                    $tagLabel0 = Label :: with ('tag')->where('id',$value->cartInventory['variation0'])->first();
                    $tag0 = $tagLabel0->tag->tag;
                    $label0 = $tagLabel0->label;
                    $variation0 = $tag0.' : '.$label0;
                }

                if($value->cartInventory['variation1']) {

                    $tagLabel1 = Label :: with ('tag')->where('id',$value->cartInventory['variation1'])->first();
                    $tag1 = $tagLabel1->tag->tag;
                    $label1 = $tagLabel1->label;
                    $variation1 = $tag1.' : '.$label1;

                } else {
                    $variation1 = '';
                }

                if($value->cartInventory['variation2']) {

                    $tagLabel2 = Label :: with ('tag')->where('id',$value->cartInventory['variation2'])->first();
                    $tag2 = $tagLabel2->tag->tag;
                    $label2 = $tagLabel2->label;
                    $variation2 = $tag2.' : '.$label2;

                } else {
                    $variation2 = '';
                }

                if($value->cartInventory['variation3']) { 

                    $tagLabel3 = Label :: with ('tag')->where('id',$value->cartInventory['variation3'])->first();
                    $tag3 = $tagLabel3->tag->tag;
                    $label3 = $tagLabel3->label;
                    $variation3 = $tag3.' : '.$label3;

                } else {
                    $variation3 = '';
                }

                if($value->cartInventory['variation4']) { 

                    $tagLabel4 = Label :: with ('tag')->where('id',$value->cartInventory['variation4'])->first();
                    $tag4 = $tagLabel4->tag->tag;
                    $label4 = $tagLabel4->label;
                    $variation4 = $tag4.' : '.$label4;

                } else {

                    $variation4 = '';
                }
                
                array_push($cartConfirm,[
                    'order_id'=>$order_id,
                    'affiliate_id'=>$value['affiliate_id'],
                    'affiliate_Amt'=>$value['affiliate_id'] != NULL ? $value->inventoryPrice['sellingAffiliationCharge'] : NULL,
                    'qty'=>$value['qty'],
                    'price'=>$value->inventoryPrice['sprice'],
                    'tax'=>$value->cartInventory->ProductTax['includeTax'] == 0 ? $value->cartInventory->ProductTax['tax'] : 0,
                    'shipping'=>$shipping,
                    'inventory_id'=>$value['inventoryId'],
                    'sku'=>$value->cartInventory['sku'],
                    'productName'=>$value->cartInventory['productName'],
                    'productDescription'=>$value->cartInventory['productDescription'],
                    'offerDescription'=>Null,
                    'variation0'=>$variation0,
                    'variation1'=>$variation1,
                    'variation2'=>$variation2,
                    'variation3'=>$variation3,
                    'variation4'=>$variation4,
                    'imageURL0'=>$value->cartInventory['imageURL0'],
                    'imageURL1'=>$value->cartInventory['imageURL1'],
                    'imageURL2'=>$value->cartInventory['imageURL2'],
                    'imageURL3'=>$value->cartInventory['imageURL3'],
                    'imageURL4'=>$value->cartInventory['imageURL4'],
                    'imageURL5'=>$value->cartInventory['imageURL5'],
                    'videoURL'=>$value->cartInventory['videoURL'],
                    'pdfURL'=>$value->cartInventory['pdfURL']
                ]);
                array_push($shipRocketPrArray,[
				                   "name"=>$value->cartInventory['productName'],
								   "sku"=>$value->cartInventory['sku'],
								   "units"=>$value['qty'],
								   "selling_price"=> $value->inventoryPrice['sprice'],
								   "discount"=> 0,
								   "tax"=> "",
								   "hsn"=> ""
											 ]);
                array_push($package_details,[
                    "name" => $value->cartInventory['productName'],
                    "total" => ($value->inventoryPrice['sprice'] * $value['qty']) + ($shipping) + (($value->inventoryPrice['sprice'] * $value->cartInventory->ProductTax['tax']/100) * $value['qty']),
                    "qty" => $value['qty'],
                    "sku" => $value->cartInventory['sku'],
                    "hsn" => "",
                ]);

                if($offer_id) {
                    array_push($offerJSON, ['order_detail_id' => $order_id, 'offer_type' => 1, 'offer_id' => $offer_id,'inventoryId'=>$inventoryId]);
                }
				/****************start check purchase offer*****************/
				 //dd($value->inventoryPrice->sprice);
                $schemeList = Purchaseoffer::where('purchaseoffers.account_id',$account_id)
		              ->select('purchaseoffers.*','productschemes.title','product_inventories.productName','product_inventories.variation0','product_inventories.variation1','product_inventories.variation2','product_inventories.variation3','product_inventories.variation4','product_inventories.id as product_inventories_id','product_packagings.weight','product_packagings.length','product_packagings.width','product_packagings.height','product_inventories.productDescription','product_inventories.variation1','product_inventories.variation2','product_inventories.variation3','product_inventories.variation4','product_inventories.imageURL0','product_inventories.imageURL1','product_inventories.imageURL2','product_inventories.imageURL3','product_inventories.imageURL4','product_inventories.imageURL5','product_inventories.videoURL','product_inventories.pdfURL','product_prices.sprice')
					  ->leftJoin('productschemes','productschemes.id','=','purchaseoffers.scheme')
					  ->leftJoin('product_inventories','product_inventories.sku','=','purchaseoffers.get_prod_sku')
					  ->leftJoin('product_packagings','product_packagings.inventoryId','=','product_inventories.id')
					  ->leftJoin('product_prices','product_prices.inventoryId','=','product_inventories.id')
		              ->where('purchaseoffers.startDate','<=',date('Y-m-d H:i:s'))
		              ->where('purchaseoffers.endDate','>=',date('Y-m-d H:i:s'))
		              ->where('purchaseoffers.product_sku',$value->cartInventory['sku'])
					  ->first();  
				if($schemeList&&$schemeList->startDate<=date('Y-m-d H:i:s')&&$schemeList->endDate>=date('Y-m-d H:i:s')){
				 if($schemeList->purchaseoffers_qty<=$value['qty']){
					$free_qty = intdiv($value['qty'], $schemeList->qty);
					$value['qty'] = $free_qty;
					$weight = $schemeList->weight;
					$length = $schemeList->length;
					$width  = $schemeList->width;
					$height = $schemeList->height;
         
					$offer_id = Null;
					$inventoryId = $schemeList->product_inventories_id;

					$totalWeight += $weight;
					$totalLength += $length;
					$totalWidth += $width;
					$totalHeight += $height;
					$totalQty += $value['qty'];
					array_push($totalLengthArray,$length);
					array_push($totalWidthArray,$width);
					$shipping = $transactionType == 1 ? $value->shipmentCOD : $value->shipmentOnline;
					
					if($schemeList->variation0) {

						$tagLabel0 = Label :: with ('tag')->where('id',$schemeList->variation0)->first();
						$tag0 = $tagLabel0->tag->tag;
						$label0 = $tagLabel0->label;
						$variation0 = $tag0.' : '.$label0;
					}

					if($schemeList->variation1) {

						$tagLabel1 = Label :: with ('tag')->where('id',$schemeList->variation1)->first();
						$tag1 = $tagLabel1->tag->tag;
						$label1 = $tagLabel1->label;
						$variation1 = $tag1.' : '.$label1;

					} else {
						$variation1 = '';
					}

					if($schemeList->variation2) {

						$tagLabel2 = Label :: with ('tag')->where('id',$schemeList->variation2)->first();
						$tag2 = $tagLabel2->tag->tag;
						$label2 = $tagLabel2->label;
						$variation2 = $tag2.' : '.$label2;

					} else {
						$variation2 = '';
					}

					if($schemeList->variation3) { 

						$tagLabel3 = Label :: with ('tag')->where('id',$schemeList->variation3)->first();
						$tag3 = $tagLabel3->tag->tag;
						$label3 = $tagLabel3->label;
						$variation3 = $tag3.' : '.$label3;

					} else {
						$variation3 = '';
					}

					if($schemeList->variation4) { 

						$tagLabel4 = Label :: with ('tag')->where('id',$schemeList->variation4)->first();
						$tag4 = $tagLabel4->tag->tag;
						$label4 = $tagLabel4->label;
						$variation4 = $tag4.' : '.$label4;

					} else {

						$variation4 = '';
					}
					
					array_push($cartConfirm,[
						'order_id'=>$order_id,
						'affiliate_id'=>Null,
						'affiliate_Amt'=>Null,
						'qty'=>$value['qty'],
						'price'=>0,
						'tax'=>0,
						'shipping'=>$shipping,
						'inventory_id'=>$inventoryId,
						'sku'=>$schemeList->get_prod_sku,
						'productName'=>$schemeList->productName,
						'productDescription'=>$schemeList->productDescription,
						'offerDescription'=>$schemeList->title,
						'variation0'=>$variation0,
						'variation1'=>$variation1,
						'variation2'=>$variation2,
						'variation3'=>$variation3,
						'variation4'=>$variation4,
						'imageURL0'=>$schemeList->imageURL0,
						'imageURL1'=>$schemeList->imageURL1,
						'imageURL2'=>$schemeList->imageURL2,
						'imageURL3'=>$schemeList->imageURL3,
						'imageURL4'=>$schemeList->imageURL4,
						'imageURL5'=>$schemeList->imageURL5,
						'videoURL' =>$schemeList->videoURL,
						'pdfURL'=>$schemeList->pdfURL
					]);
					array_push($shipRocketPrArray,[
									   "name"=>$schemeList->productName,
									   "sku"=>$schemeList->get_prod_sku,
									   "units"=>$value['qty'],
									   "selling_price"=> 0,
									   "discount"=> ($schemeList->sprice*$value['qty']),
									   "tax"=> "",
									   "hsn"=> ""
												 ]);
					array_push($package_details,[
						"name" => $schemeList->productName,
						"total" => 0,
						"qty" => $value['qty'],
						"sku" => $schemeList->get_prod_sku,
						"hsn" => "",
					]);

					if($offer_id) {
						array_push($offerJSON, ['order_detail_id' => $order_id, 'offer_type' => 1, 'offer_id' => $offer_id,'inventoryId'=>$inventoryId]);
					}
				 }
				}
				/****************end   check purchase offer*****************/
            }
            
            orderDetail :: insert($cartConfirm);
            orderOffer :: insert($offerJSON);
            cartTemporary::where('account_id',$account_id)->where('register_id',$register_id)->delete();

            // Shipyaari
            $order_id = $order_id;
            $from_contact_number = $account->phone;
            $from_pincode = $account->pinCode;
            $from_landmark = $account->landmark;
            $from_address = $account->address;
            $from_address2 = "";
            $to_pincode = $zipCode;
            $to_landmark = $landmark;
            $to_address = $address;
            $to_address2 = "";
            $customer_name = $name;
            $customer_email = $email;
            $customer_contact_no = $phone;
            $ship_date = date('Y-m-d');
            $no_of_packages = 1;
            $package_type = "identical";
            $total_invoice_value = $grandTotal;
            $username = $account->shipyaariUserName; //"info@warmzone.co.in";
            $created_by = $account->shipyaariClientCode;
            $avnkey = $account->shipyaariClientCode."@".$account->shipyaariParentCode;
            $payment_mode = $transactionType == 1 ? "COD": "Online";
            $payment_modeShipR = $transactionType == 1 ? "COD": "Prepaid";
            $total_price_set = $grandTotal;
            $channel = "API";
            // Shipyaari
			/*********************************************/
			    $request_url ='https://seller.shipyaari.com/logistic/webservice/SearchAvailability_new.php';
			    $post_data = "&pickup_pincode=" . $from_pincode . "&delivery_pincode=" . $zipCode . "&weight=" . $totalWeight . "&paymentmode=" . $payment_mode . "&invoicevalue=" . $total_invoice_value . "&avnkey=" . $avnkey . "&service_type=normal&partner=&service=economy&length=" . max($totalLengthArray) . "&width=" . max($totalWidthArray) . "&height=" . $totalHeight;

                $post = curl_init();
                curl_setopt($post, CURLOPT_URL, $request_url);
                curl_setopt($post, CURLOPT_POST, TRUE);
                curl_setopt($post, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
                $response = curl_exec($post);
                curl_close($post);
                $shipyari_result = $response;
			    $shiprocket_result = '';
				
				$shiprocketAvailabilityPayLoad = '';
				if($account->shiprocketStatus==1){
				$shiprocketAvailabilityPayLoad = 'pickup_postcode='.$from_pincode.'&delivery_postcode='.$zipCode.'&weight='.$totalWeight.'&length='.max($totalLengthArray).'&breadth='.max($totalWidthArray).'&height='.$totalHeight.'&declared_value='.$total_invoice_value.'&cod='.( $payment_mode=='COD' ? 1 : 0 );
			    $ship_rocket_token = $this->shipRocketToken($account_id);
				$curl = curl_init();
			    curl_setopt_array($curl, array(
			    CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/serviceability/?'.$shiprocketAvailabilityPayLoad,
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
			    $shiprocket_result = $response;
				}
			/********************************************/
            if($payment_mode=='COD'){
				
			}else{
				
			}
            $productData = [
                "package_weight" => $totalWeight,
                "package_length" => max($totalLengthArray),
                "package_width" => max($totalWidthArray),
                "package_height" => $totalHeight,
                "total" => $grandTotal,
                "total_qty" => $totalQty,
                "package_details" => $package_details,
            ];

            $shipyaariData = [
                "username" => base64_encode($username),
                "insurance" => base64_encode($insurance),
                "order_id" => base64_encode($order_id),
                "from_contact_number" => base64_encode($from_contact_number),
                "from_pincode" => base64_encode($from_pincode),
                "from_landmark" => base64_encode($from_landmark),
                "from_address" => base64_encode($from_address),
                "from_address2" => base64_encode($from_address2),
                "to_pincode" => base64_encode($to_pincode),
                "to_landmark" => base64_encode($to_landmark),
                "to_address" => base64_encode($to_address),
                "to_address2" => base64_encode($to_address2),
                "customer_name" => base64_encode($customer_name),
                "customer_email" => base64_encode($customer_email),
                "customer_contact_no" => base64_encode($customer_contact_no),
                "ship_date" => base64_encode($ship_date),
                "package_type" => base64_encode($package_type),
            
                "total_invoice_value" => base64_encode($total_invoice_value),
            
                "created_by" => base64_encode($created_by),
                "avnkey" => base64_encode($avnkey),
            
                "payment_mode" => base64_encode($payment_mode),
            
                "no_of_packages" => base64_encode($no_of_packages),
                "total_price_set" => $total_price_set,
                "channel" => $channel,
                "product_data" => [$productData]
            ];
            //dd($shipyaariData);
			/***************************************/
			$shipRocketArray = array (
								  'order_id' => $order_id,
								  'order_date' => date('Y-m-d H:i:s'),
								  'pickup_location' => $account->shiprocketPickupLocation,
								  'billing_customer_name' => $customer_name,
								  'billing_last_name' => $customer_name,
								  'billing_address' => $to_address,
								  'billing_address_2' => $to_landmark,
								  'billing_city' => $cityId,
								  'billing_pincode' => $zipCode,
								  'billing_state' => $stateId,
								  'billing_country' => 'India',
								  'billing_email' => $customer_email,
								  'billing_phone' => $customer_contact_no,
								  'shipping_is_billing' => true,
								  'shipping_customer_name' => '',
								  'shipping_last_name' => '',
								  'shipping_address' => '',
								  'shipping_address_2' => '',
								  'shipping_city' => '',
								  'shipping_pincode' => '',
								  'shipping_country' => '',
								  'shipping_state' => '',
								  'shipping_email' => '',
								  'shipping_phone' => '',
								  'order_items' => $shipRocketPrArray,
								  'payment_method' => $payment_modeShipR,
								  'shipping_charges' => 0,
								  'giftwrap_charges' => 0,
								  'transaction_charges' => 0,
								  'total_discount' => 0,
								  'sub_total' => $total_invoice_value,
								  'length' => max($totalLengthArray),
								  'breadth' => max($totalWidthArray),
								  'height' => $totalHeight,
								  'weight' => $totalWeight,
								);
			/***************************************/
			/*print_r($shipyaariData);
			print_r($shipRocketArray);exit;*/
            order::where('id', $order_id)->where('account_id',$account_id)->update(['payLoad' => $shipyaariData,'payLoadShipRocket'=>$shipRocketArray,'shipyaariAvailability'=>$shipyari_result,'shiprocketAvailability'=>$shiprocket_result,'shiprocketAvailabilityPayLoad'=>$shiprocketAvailabilityPayLoad]);
  
            $logo = $account->domain.'/'.$account->logo;
            Mail::to($email)->send(new ConfirmOrderMail(['orderData'=>$orderData,'cartConfirm'=>$cartConfirm, 'account' => $account, 'logo' => $logo]));
            $found = Msgnotify::where('account_id', $account_id)->where('msg_type', '1')->first();
            $message = $found->messages;
            $message = str_replace('[CUSTOMER_NAME]',$name,$message);
            $message = str_replace('[ORDER_NO]',$orderNo,$message);
            $message = str_replace('[Order_Number]',$orderNo,$message);
            $message = str_replace('[Order_Amount]',$grandTotal,$message);
            $message = str_replace('[GRAND_TOTAL]',$grandTotal,$message);
            $message = str_replace('[Date_of_Order]',date('Y-m-d'),$message);
            $message = str_replace('[User_Mobile_Number]',$customer_contact_no,$message);
            $message = urlencode($message);
                
            $replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
            $replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
            $replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
            $replace3 = str_replace('setPhone', $phone, $replace2);
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

            return redirect('/orderList');
            
        } else {

            return back()->withErrors(['Failed to pay. please try again.']);
        }
    }

    public function orderList(Request $request)
    {
        $account = Session::get('currentAccount');       
        $register = Session::get('register');

        if($register) {
            $register_id = $register->id;
            $viewPath = 'theams/theam' . $account->theme . '/orderList';
			$data = AdvanceProductOrder::where('register_id',$register_id)->orderBy('id','desc')->get(); 
			
            return view($viewPath, compact('account','data'));

        } else {

            $viewPath = 'theams/theam' . $account->theme . '/login';

            $account_id = $account->id;
            $register_id = Session::getId();

            $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

            return view($viewPath, compact('account','cartList'));

        }
        
    }

    public function orderCancel(Request $request)
    {
        $account = Session::get('currentAccount');

        $input = $request->all();
        $orderNo = $input['data']['orderNo'];
        $shipyaariId = $input['data']['shipyaariId']; // courierType

        if($shipyaariId != 'courierType') {

            //$avnkey="10393@5183";
            $avnkey = $account->shipyaariClientCode."@".$account->shipyaariParentCode;
                
            $request_url ='https://seller.shipyaari.com/avn_ci/siteadmin/cancel_consignment/';

            $post_data = ['avn_key' => $avnkey,'ids' =>[$shipyaariId]];

            $post = curl_init();
            curl_setopt($post, CURLOPT_URL, $request_url);
            curl_setopt($post, CURLOPT_POST,TRUE);
            curl_setopt($post, CURLOPT_POSTFIELDS, json_encode($post_data));
            curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($post, CURLOPT_HTTPHEADER, array('Accept:application/json' , 'Content-Type:application/json'));
            $response = curl_exec($post);
            curl_close($post);
            $result = json_decode($response, true);

            order::where('account_id', $account->id)->where('orderNo', $orderNo)->update(['orderStatus' =>18,'shipyaariCancel' =>$response]);

        } else {

            $response = 'Order Canceled';
            order::where('account_id', $account->id)->where('orderNo', $orderNo)->update(['orderStatus' =>18,'shipyaariCancel' =>'Order Canceled']);
        }
        
        return response()->json($response, 200);
    }

    public function orderReturn(Request $request) {
        
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/orderList';
       
        $register = Session::get('register');
        $registerId = $register->id;
        $account_id = $account->id;
        
        $input = $request->all();
        $orderNo = $input['orderNo'];

        $order = order :: with([
            'orderDetails'=>function($query) {

                $query->with(['inventory_price']);
            },
            'orderDetails'=>function($query) {

                $query->with(['inventoryPackaging']);
            },
        ])->where('orderNo',$orderNo)->where('account_id',$account_id)->where('register_id',$registerId)->first();
        
        if($order->courierType == 1)
        {
            $package_details = array();
            $totalWeight = 0;
            $totalLength = 0;
            $totalWidth = 0;
            $totalHeight = 0;
            $totalQty = 0;
            $grandTotal = 0;

            foreach ($order->orderDetails as $cart => $value) {
                
                array_push($package_details,[
                    "name" => $value->productName,
                    "total" => ($value->price * $value->qty) + ($value->shipping) + (($value->price * $value->tax/100) * $value->qty),
                    "qty" => $value->qty,
                    "sku" => $value->sku,
                    "hsn" => "",
                ]);

                $grandTotal = ($value->price * $value->qty) + ($value->shipping) + ( ($value->price * $value->qty) * $value->tax/100);
                $weight = $value->inventoryPackaging->weight;
                $length = $value->inventoryPackaging->length;
                $width = $value->inventoryPackaging->width;
                $height = $value->inventoryPackaging->height;

                $totalWeight += $weight;
                $totalLength += $length;
                $totalWidth += $width;
                $totalHeight += $height;
                $totalQty += $value['qty'];
                
                $shipping = $value->shipping;
            }

            // Shipyaari
            $insurance = "no";
            $order_id = $order->id."_reverse";
            $from_contact_number = $account->phone;
            $from_pincode = $account->pinCode;
            $from_landmark = $account->landmark;
            $from_address = $account->address;
            $from_address2 = "";
            $to_pincode = $order->zipCode;
            $to_landmark = $order->landmark;
            $to_address = $order->address;
            $to_address2 = "";
            $customer_name = $order->name;
            $customer_email = $order->email;
            $customer_contact_no = $order->phone;
            $ship_date = date('Y-m-d');
            $no_of_packages = 1;
            $package_type = "identical";
            $total_invoice_value = $grandTotal;
            $username = $account->shipyaariUserName;
            $created_by = $account->shipyaariClientCode;
            $avnkey = $account->shipyaariClientCode."@".$account->shipyaariParentCode;
            $payment_mode = "Online";
            $total_price_set = $grandTotal;
            $channel = "API";
            // Shipyaari

            $productData = [
                "package_weight" => $totalWeight,
                "package_length" => $totalLength,
                "package_width" => $totalWidth,
                "package_height" => $totalHeight,
                "total" => $grandTotal,
                "total_qty" => $totalQty,
                "package_details" => $package_details,
            ];

            $shipyaariData = [
                "username" => base64_encode($username),
                "insurance" => base64_encode($insurance),
                "order_id" => base64_encode($order_id),
                "from_contact_number" => base64_encode($from_contact_number),
                "from_pincode" => base64_encode($from_pincode),
                "from_landmark" => base64_encode($from_landmark),
                "from_address" => base64_encode($from_address),
                "from_address2" => base64_encode($from_address2),
                "to_pincode" => base64_encode($to_pincode),
                "to_landmark" => base64_encode($to_landmark),
                "to_address" => base64_encode($to_address),
                "to_address2" => base64_encode($to_address2),
                "customer_name" => base64_encode($customer_name),
                "customer_email" => base64_encode($customer_email),
                "customer_contact_no" => base64_encode($customer_contact_no),
                "ship_date" => base64_encode($ship_date),
                "package_type" => base64_encode($package_type),
            
                "total_invoice_value" => base64_encode($total_invoice_value),
            
                "created_by" => base64_encode($created_by),
                "avnkey" => base64_encode($avnkey),
            
                "payment_mode" => base64_encode($payment_mode),
                "package_name" => base64_encode("Reverse"),
            
                "no_of_packages" => base64_encode($no_of_packages),
                "total_price_set" => $total_price_set,
                "channel" => $channel,
                "product_data" => [$productData]
            ];

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

            curl_close($post);

            order::where('account_id', $account_id)->where('register_id', $registerId)->where('orderNo', $orderNo)->update(['orderStatus' =>9,'shipyaariReverse' =>$response]);
            
            
        } else {

            $response ='Order Return';
            order::where('account_id', $account_id)->where('register_id', $registerId)->where('orderNo', $orderNo)->update(['orderStatus' =>9,'shipyaariReverse' =>$response]);

        }
        return redirect('/orderList');
    }

    public function orderReplacement(Request $request) {
        
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/orderList';
       
        $register = Session::get('register');
        $registerId = $register->id;
        $account_id = $account->id;
        
        $input = $request->all();
        $orderNo = $input['orderNo'];

        $order = order :: with([
            'orderDetails'=>function($query) {

                $query->with(['inventory_price']);
            },
            'orderDetails'=>function($query) {

                $query->with(['inventoryPackaging']);
            },
        ])->where('orderNo',$orderNo)->where('account_id',$account_id)->where('register_id',$registerId)->first();
        if($order->courierType == 1)
        {
            $package_details = array();
            $totalWeight = 0;
            $totalLength = 0;
            $totalWidth = 0;
            $totalHeight = 0;
            $totalQty = 0;
            $grandTotal = 0;

            foreach ($order->orderDetails as $cart => $value) {
                
                array_push($package_details,[
                    "name" => $value->productName,
                    "total" => ($value->price * $value->qty) + ($value->shipping) + (($value->price * $value->tax/100) * $value->qty),
                    "qty" => $value->qty,
                    "sku" => $value->sku,
                    "hsn" => "",
                ]);

                $grandTotal = ($value->price * $value->qty) + ($value->shipping) + ( ($value->price * $value->qty) * $value->tax/100);
                $weight = $value->inventoryPackaging->weight;
                $length = $value->inventoryPackaging->length;
                $width = $value->inventoryPackaging->width;
                $height = $value->inventoryPackaging->height;

                $totalWeight += $weight;
                $totalLength += $length;
                $totalWidth += $width;
                $totalHeight += $height;
                $totalQty += $value['qty'];
                
                $shipping = $value->shipping;
            }

            // Shipyaari
            $insurance = "no";
            $from_contact_number = $account->phone;
            $from_pincode = $account->pinCode;
            $from_landmark = $account->landmark;
            $from_address = $account->address;
            $from_address2 = "";
            $to_pincode = $order->zipCode;
            $to_landmark = $order->landmark;
            $to_address = $order->address;
            $to_address2 = "";
            $customer_name = $order->name;
            $customer_email = $order->email;
            $customer_contact_no = $order->phone;
            $ship_date = date('Y-m-d');
            $no_of_packages = 1;
            $package_type = "identical";
            $total_invoice_value = $grandTotal;
            $username = $account->shipyaariUserName;
            $created_by = $account->shipyaariClientCode;
            $avnkey = $account->shipyaariClientCode."@".$account->shipyaariParentCode;
            
            $total_price_set = $grandTotal;
            $channel = "API";
            // Shipyaari

            $productData = [
                "package_weight" => $totalWeight,
                "package_length" => $totalLength,
                "package_width" => $totalWidth,
                "package_height" => $totalHeight,
                "total" => $grandTotal,
                "total_qty" => $totalQty,
                "package_details" => $package_details,
            ];

            /*For Order Return*/
            $order_id = $order->id."_reverse";
            $payment_mode = "Online";

            $shipyaariData = [
                "username" => base64_encode($username),
                "insurance" => base64_encode($insurance),
                "order_id" => base64_encode($order_id),
                "from_contact_number" => base64_encode($from_contact_number),
                "from_pincode" => base64_encode($from_pincode),
                "from_landmark" => base64_encode($from_landmark),
                "from_address" => base64_encode($from_address),
                "from_address2" => base64_encode($from_address2),
                "to_pincode" => base64_encode($to_pincode),
                "to_landmark" => base64_encode($to_landmark),
                "to_address" => base64_encode($to_address),
                "to_address2" => base64_encode($to_address2),
                "customer_name" => base64_encode($customer_name),
                "customer_email" => base64_encode($customer_email),
                "customer_contact_no" => base64_encode($customer_contact_no),
                "ship_date" => base64_encode($ship_date),
                "package_type" => base64_encode($package_type),
            
                "total_invoice_value" => base64_encode($total_invoice_value),
            
                "created_by" => base64_encode($created_by),
                "avnkey" => base64_encode($avnkey),
            
                "payment_mode" => base64_encode($payment_mode),
                "package_name" => base64_encode("Reverse"),
            
                "no_of_packages" => base64_encode($no_of_packages),
                "total_price_set" => $total_price_set,
                "channel" => $channel,
                "product_data" => [$productData]
            ];

            $payLoad =  json_encode($shipyaariData);
            $request_url = "https://seller.shipyaari.com/logistic/webservice/create_consignment_api.php";
            $post = curl_init();
            curl_setopt($post, CURLOPT_URL, $request_url);
            curl_setopt($post, CURLOPT_POST, TRUE);
            curl_setopt($post, CURLOPT_POSTFIELDS, $payLoad);
            curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($post, CURLOPT_HTTPHEADER, array('Accept:application/json' , 'Content-Type:application/json'));
            $response = curl_exec($post);
            curl_close($post);

            /*For Order Return*/

            /*For Order Replacement*/
            $order_id = $order->id."_replacement ";
            $payment_mode = $order->transactionType == 1 ? "COD": "Online";

            $shipyaariData = [
                "username" => base64_encode($username),
                "insurance" => base64_encode($insurance),
                "order_id" => base64_encode($order_id),
                "from_contact_number" => base64_encode($from_contact_number),
                "from_pincode" => base64_encode($from_pincode),
                "from_landmark" => base64_encode($from_landmark),
                "from_address" => base64_encode($from_address),
                "from_address2" => base64_encode($from_address2),
                "to_pincode" => base64_encode($to_pincode),
                "to_landmark" => base64_encode($to_landmark),
                "to_address" => base64_encode($to_address),
                "to_address2" => base64_encode($to_address2),
                "customer_name" => base64_encode($customer_name),
                "customer_email" => base64_encode($customer_email),
                "customer_contact_no" => base64_encode($customer_contact_no),
                "ship_date" => base64_encode($ship_date),
                "package_type" => base64_encode($package_type),
            
                "total_invoice_value" => base64_encode($total_invoice_value),
            
                "created_by" => base64_encode($created_by),
                "avnkey" => base64_encode($avnkey),
            
                "payment_mode" => base64_encode($payment_mode),
            
                "no_of_packages" => base64_encode($no_of_packages),
                "total_price_set" => $total_price_set,
                "channel" => $channel,
                "product_data" => [$productData]
            ];

            $payLoad =  json_encode($shipyaariData);
            $request_url = "https://seller.shipyaari.com/logistic/webservice/create_consignment_api.php";
            $post = curl_init();
            curl_setopt($post, CURLOPT_URL, $request_url);
            curl_setopt($post, CURLOPT_POST, TRUE);
            curl_setopt($post, CURLOPT_POSTFIELDS, $payLoad);
            curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($post, CURLOPT_HTTPHEADER, array('Accept:application/json' , 'Content-Type:application/json'));
            $response = curl_exec($post);
            curl_close($post);

            order::where('account_id', $account_id)->where('register_id', $registerId)->where('orderNo', $orderNo)->update(['orderStatus' =>19,'shipyaariReplcament' =>$response]);
            /*For Order Replacement*/
            
        } else {
            $response ='Order Replcament';
            order::where('account_id', $account_id)->where('register_id', $registerId)->where('orderNo', $orderNo)->update(['orderStatus' =>19,'shipyaariReplcament' =>$response]);
        }
        

        return redirect('/orderList');
    }

    public function zipCodeCheck(Request $request)
    {
        $account = Session::get('currentAccount');
        $pickupPinCode = $account->pinCode;

        $input = $request->all();
        $zipCode = $input['data']['zipCode'];

        $paymentmode="cod";
        $invoicevalue=100;
        //$avnkey="10393@5183";
        $avnkey = $account->shipyaariClientCode."@".$account->shipyaariParentCode;
        $insurance="no"; //yes
        $service_type="normal";
        $partner="";
        $service="economy"; //standard
        $request_url ='https://seller.shipyaari.com/logistic/webservice/SearchAvailability_new.php';

        $post_data="&pickup_pincode=".$pickupPinCode."&delivery_pincode=".$zipCode."&weight=1.00&paymentmode=".$paymentmode."&invoicevalue=".$invoicevalue."&avnkey=".$avnkey."&service_type=".$service_type."&partner=".$partner."&service=".$service."&length=1.00&width=1.00&height=1.00";
        
        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $request_url);
        curl_setopt($post, CURLOPT_POST,TRUE);
        curl_setopt($post, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($post);
        //print_r($response);
        curl_close($post);
        $result = json_decode($response, true);

        return response()->json($result, 200);
    }

    public function updateRegister(Request $request)
    {
        $input = $request->all();
        $name = $input['data']['name'];
        $phone = $input['data']['phone'];
        $email = $input['data']['email'];
        $landmark = $input['data']['landmark'];
        $address = $input['data']['address'];
        $zipCode = $input['data']['zipCode'];
        $cityId = $input['data']['cityId'];
        $stateId = $input['data']['stateId'];
        $zipCode = $input['data']['zipCode'];

        $register = Session::get('register');
        $register_id = $register->id;
        
	    $custAddres= RegisterAddress::create(['register_id'=> $register_id,'name' => $name, 'phone' => $phone, 'email' => $email, 'landmark' => $landmark, 'address' => $address, 'zipCode' => $zipCode, 'cityId' => $cityId, 'stateId' => $stateId]);
				
		Session::put('addressCodeID',$custAddres->id);
        Session::put('addressCode',$zipCode);

        return response()->json('success', 200);
    }

    public function changePassword()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam1/changePassword';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        $phone = null;

        return view($viewPath, compact('account','cartList','phone'));
    }
    public function FinalAmount($account_id){
        $creditAmount=DB::table('wallets')->where('account_id',$account_id)->where('status','0')->sum('credit');
        $debitAmount=DB::table('wallets')->where('account_id',$account_id)->where('status','0')->sum('debit');
       
        if(($creditAmount-$debitAmount) <= 0){
            return '0';
        }else{
            return  $creditAmount-$debitAmount;
        }
    }
	public function wallet()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam1/wallet';

        $account_id = $account->id;
        $register_id = Session::getId();

        $register = Session::get('register');
        $registerId = $register->id;
       
        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        $phone = null;
		//echo Session::get('register')->memebership_id;exit;
        $membership = Membership::where('id',Session::get('register')->memebership_id)->first();
        $amount=$this->FinalAmount($account_id);
        $wallet_amount=DB::table('wallets')->where('account_id',$registerId)->where('status','0')->get();
        $amount=$this->FinalAmount($registerId);
        return view($viewPath, compact('account','cartList','phone','membership','wallet_amount','amount'));
    }

    public function my_coupon()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/theam1/my_coupon';

        $account_id = $account->id;
        $register_id = Session::getId();

        $register = Session::get('register');
        $registerId = $register->id;
       
        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        $phone = null;
		//echo Session::get('register')->memebership_id;exit;
        $membership = Membership::where('id',Session::get('register')->memebership_id)->first();
        // Coupons 
        $currentDate = date('Y/m/d');
        $dataCoupon=DB::table('coupons')
        ->select('coupons.*','advance_product.title','advance_product.name as templatename','advance_product.selling_price','registers.name as username')
        ->leftJoin('advance_product','coupons.product_id','=','advance_product.id')
        ->leftJoin('registers','coupons.used_to','=','registers.id')
    
        ->where('coupons.send_to',$registerId)
        ->whereDate('coupons.validity_date', '>=', $currentDate)
        ->orderby('coupons.uesttime','DESC')->get();

        return view($viewPath, compact('account','cartList','phone','membership','dataCoupon'))->with('otherdata',(new ForeSaleXController));
    }



    public function changePasswordSubmit(Request $request)
    {

        $account = Session::get('currentAccount');
        $account_id = $account->id;

        $register = Session::get('register');
        $registerId = $register->id;
        
        $input = $request->all();

        $rules = [
            'password' => 'required',
            'confirmPassword' => 'required',
            'password' => 'required_with:confirmPassword|same:confirmPassword',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $password = bcrypt($input['password']);

            Register::where('account_id', $account_id)->where('id', $registerId)->update(['password' => $password]);

            $request->session()->flush();
            return redirect('/');

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function address(Request $request)
    {
        $account = Session::get('currentAccount');
        $account_id = $account->id;

        $register = Session::get('register');
        $register_id = Session::getId();

        if($register) {

            $viewPath = 'theams/theam1/address';
$allQuery = $request->all();
			$addressId = (isset($allQuery['address'])?$allQuery['address']:'');
            $allAddresses = null;
            $addresses =null;
            if($addressId){
                $addresses =  RegisterAddress::where('register_id', $register->id)->where('id',$addressId)->first();
            }else{
                $allAddresses = RegisterAddress::where('register_id', $register->id)->get();
            }
            $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

            return view($viewPath, compact('account','cartList','register','addresses','allAddresses'));

        } else {

            $viewPath = 'theams/theam' . $account->theme . '/login';

            $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

            return view($viewPath, compact('account','cartList'));

        }
    }

    public function addressSubmit(Request $request)
    {
        $register = Session::get('register');
        $input = $request->all();
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'landmark' => 'required',
            'address' => 'required',
            'zipCode' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            unset($input['_token']);

            $address =  RegisterAddress::where('register_id', $register->id)->where('id',$input['id'])->update($input);

            if($address)
            {
               
                return redirect('address')->with('message', 'Address Sucessfully Updated');
 
            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
	public function pages($id){
		$account = Session::get('currentAccount');
        $viewPath = 'theams/theam' . $account->theme . '/pages';
        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $aboutList =    DB::table('faq')
		                   ->where('account_id',$account->id)
		                   ->where('id',$id)
						   ->first();

        return view($viewPath, compact('account','cartList','aboutList'));
	}
	
	public function check_coupon(Request $request)
    {
        $account = Session::get('currentAccount'); 
        $account_id =$account->id;
        $register = Session::get('register');
        $registerId = $register->id;
        

        $discountAmount = 0;
        $currentDate = date("Y-m-d");
        $datevalidity = date('Y/m/d',strtotime('-30 days',strtotime(str_replace('/', '-', $currentDate)))) . PHP_EOL;
        $offerData = OfferNormal::where('account_id', $account_id)->where('couponCode', $request->code)
        ->whereDate('startDate', '<=', $currentDate)->whereDate('endDate', '>=', $currentDate)->where('status', 1)->first();

  
        $SaleX=Coupon::where('status', 1)->where('coupon',$request->code)->where('template',$request->setting_id)->whereDate('validity_date', '>=', $currentDate)->first();#sale x coupon 
        if ($offerData) {
            if ($request->subTotal < $offerData->cartMinValue) {
                $msg = 'Coupon only apply to minimum RS.' . $offerData->cartMinValue;
            } else {
                $discountAmount = number_format(($request->subTotal * ($offerData->discount / 100)));
                if ($discountAmount > $offerData->cartMinValue) {
                    $discountAmount = $discountAmount;
                }
                $msg = 'Coupon Found';
            }
        } else if($SaleX) {
          
            # Refferal Benifit
            if($request->clicks <=1){
                $discountAmount = number_format($SaleX->refferal_benifit);
            
                if ($discountAmount > $SaleX->refferal_benifit) {
                    $discountAmount = $discountAmount;
                    $msg = 'Coupon Found';
                }
                $msg = 'Coupon Found';
            }else{
                $msg = 'Coupon Found'; 
            }
           
            
     
        } else{
            $msg = 'Coupon not found or invalid';
        }
        $grandTotal=number_format($request->subTotal-$discountAmount,2);

        return json_encode(array('status' => ($discountAmount ? true : false),'grandtotal'=>$grandTotal, 'discountAmount' => $discountAmount, 'msg' => $msg));
    }

    public function request_otp(Request $request)
    {
        $account = Session::get('currentAccount');
        $account_id = $account->id;
        $register = Register::where('account_id', $account_id)->where('phone', $request->mobile)->where('status', 1)->first();
        if (!$register) {
            return array('status' => false, 'msg' => 'Number not found.');
        } else {
			$found = Msgnotify::where('account_id', $account_id)->where('msg_type', '5')->first();
            $OTP = rand(1000, 9999);
			$sign_up_message = $found->messages;
			$sign_up_message = str_replace('[OTP]',$OTP,$sign_up_message);
            $message = urlencode($sign_up_message);
            Session::put('loginOtp', $OTP);
            $account = Session::get('currentAccount');
            $replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
            $replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
            $replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
            $replace3 = str_replace('setPhone', $request->mobile, $replace2);
            $replace4 = str_replace('setMessage', $message, $replace3);
			$replace5 = str_replace('setTEMPLATEID', $found->template_id,$replace4);

            $url = $replace5;
            //dd($url);
            $post = curl_init();
            curl_setopt($post, CURLOPT_URL, $url);
            curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
            $response = curl_exec($post);
            curl_close($post);
            $result = json_decode($response, true);

            //dd($response);
            return array('status' => true,'data'=>$url);
        }
    }
	
	
    public function pinCodeCheck(Request $request)
    {
        $account = Session::get('currentAccount');
        $account_id = $account->id;
        $pickupPinCode = $account->pinCode;

        $input = $request->all();
        $pinCode = $input['data']['pinCode'];

        $paymentmode="online";
        $invoicevalue=rand(1,999999);
        $avnkey=$account->shipyaariClientCode.'@'.$account->shipyaariParentCode;
        $insurance="yes";
        $service_type="normal";
        $partner="";
        $service="standard";
        $request_url ='https://seller.shipyaari.com/logistic/webservice/SearchAvailability_new.php';

        $post_data="&pickup_pincode=".$pickupPinCode."&delivery_pincode=".$pinCode."&weight=1.00&paymentmode=".$paymentmode."&invoicevalue=".$invoicevalue."&avnkey=".$avnkey."&service_type=".$service_type."&partner=".$partner."&service=".$service."&length=1.00&width=1.00&height=1.00";
        $post = curl_init();

        curl_setopt($post, CURLOPT_URL, $request_url);
        curl_setopt($post, CURLOPT_POST,TRUE);
        curl_setopt($post, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($post);
        // print_r($response);
        curl_close($post);

        // $validate = $response[0];
		//return $post_data;exit;
        $result = json_decode($response, true);
        // print_r($result);exit;
        return response()->json($result, 200);
    }
	
	 public function addressCode(Request $request)
    {   
        $account = Session::get('currentAccount');
        $input = $request->all();
        $addressCode = $input['data']['pinCode'];
        $addressCodeId = $input['data']['pinCodeId'];
        if($addressCode){
            Session::put('addressCode',$addressCode);
            Session::put('addressCodeID',$addressCodeId);
        }
        return response()->json(['status'=>'success'],200);
    }
	public function offer(){
		 $account = Session::get('currentAccount');
		 $account_id = $account->id;
		 $register_id = Session::getId();
		 $deals = Purchaseoffer::
			         where('account_id',$account_id)
					 ->where('startDate','<=',date('Y-m-d H:i:s'))
		             ->where('endDate','>=',date('Y-m-d H:i:s'))->get();
		 
		 $viewPath = 'theams/theam' . $account->theme . '/offer';
		 
		return view($viewPath)->with('deals',$deals)->with('offer_page_title',$account->offer_page_title)->with('account',$account);
	}
	public function subscription($id){
		$account = Session::get('currentAccount');
		$viewPath = 'theams/theam' . $account->theme . '/subscription';
		$register = Session::get('register');
		$membership = Membership::where('account_id',$account->id)
		                          ->where('id',$id)
								  ->first(); 
		
		/********************************************/
		$razorPayApiKey    = $account->razorPayApiKey;
		$razorPayApiSecret = $account->razorPayApiSecret;
		$ch = curl_init();
		$fields = array();
		$fields["plan_id"]              = $membership->razorpay_subscription_id;
		$fields["total_count"]          = 12;
		curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/subscriptions');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $razorPayApiKey.":".$razorPayApiSecret);
		$headers = array();
		$headers[] = 'Accept: application/json';
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$data = curl_exec($ch);
		$data = json_decode($data, TRUE);
		/********************************************/
		
		
		Session::put('subscription_id', $data['id']);
		Session::put('membership_id', $membership->id);
		$array = [
		         'id'=>$id,
		         'key'=>$account->razorPayApiKey,
				 'subscription_id'=>$data['id'],
				 'name'=>$account->title,
				 'description'=>$membership->name." Payment to ". $account->domain,
				 'image'=>"https://".$account->domain.'/'.$account->logo,
				 'callback_url'=>"https://".$account->domain.'/subscriptionPlanR',
				 'prefill' =>
					 [
					   'name'=>$register->name,
					   'email'=>$register->email,
	                   'contact'=>$register->phone
					 ],
				 'theme'=>['color'=>'#F37254']
				 ];
		return $array;
	}
	public function subscription_plan(){
      $account = Session::get('currentAccount');       
      $register = Session::getId();;
	  
      
		$account = Session::get('currentAccount');
		$viewPath = 'theams/theam' . $account->theme . '/subscription_plan';
		$membership = Membership::where('account_id',$account->id)
		                          ->whereNotNull('razorpay_subscription_id')
								  ->get();
		$cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account->id)->where('register_id', $register)->get();
		$data = MembershipPage::where('account_id',$account->id)
							    ->get();;
		return view($viewPath)->with('account',$account)->with('membership',$membership)->with('cartList',$cartList)->with('data',$data);
	  
	}
	public function u_referral_scheme(){
      $account = Session::get('currentAccount');       
      $register = Session::getId();;
	  
      
		$account = Session::get('currentAccount');
		$viewPath = 'theams/theam' . $account->theme . '/u_referral_scheme';
		$membership = Membership::where('account_id',$account->id)
		                          ->whereNotNull('razorpay_subscription_id')
								  ->get();
		$cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account->id)->where('register_id', $register)->get();
		$data = MembershipPage::where('account_id',$account->id)
							    ->get();;
		return view($viewPath)->with('account',$account)->with('membership',$membership)->with('cartList',$cartList)->with('data',$data);
	  
	}
	public function subscriptionPlanR(Request $request){
	    //var_dump($_POST);
		$account = Session::get('currentAccount');
		//echo Session::get('subscription_id').'<br>'.$request->razorpay_payment_id.'<br>'.$account->razorPayApiSecret.'<br>'.$request->razorpay_signature;
		$sign = hash_hmac('SHA256',Session::get('subscription_id').'|'.$request->razorpay_payment_id,$account->razorPayApiSecret);
		//echo '<br>'.$sign.'<br>'.$request->razorpay_signature;
		/*if(hash_equals($sign,$request->razorpay_signature)){
			echo "Payment is successful!";
		}*/
		if(isset($request->razorpay_payment_id)){
			$Membership = Membership::where('razorpay_subscription_id',$request->razorpay_subscription_id)->first();
			$register = Session::getId();
			Register::where('id',Session::get('register')->id)
			          ->update(['memebership_id'=>Session::get('membership_id'),'subscription_id'=>$request->razorpay_subscription_id]);
			$register = Register::where('id',Session::get('register')->id)->first(); 
		    Session::put('register', $register);
            Session::save();
			return redirect('/');
		}
		
	}
	public function canel_subscription(){
		$account = Session::get('currentAccount');
		$razorPayApiKey    = $account->razorPayApiKey;
		$razorPayApiSecret = $account->razorPayApiSecret;
		$ch = curl_init();
		$fields = array();
		curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/subscriptions/sub_HQWFhBC5V1FopX/cancel');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $razorPayApiKey.":".$razorPayApiSecret);
		$headers = array();
		$headers[] = 'Accept: application/json';
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$data = curl_exec($ch);
        echo $data;
		
	}
	public function ap_product(){
		$account = Session::get('currentAccount');
		$account_id = $account->id;
        $register_id = Session::getId();
		$data = AdvanceProduct::get();
		$cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
		return view('theams/theam' . $account->theme . '/ap_product')->with('data',$data)->with('account',$account)->with('cartList',$cartList);
	}
	public function ap_details($id){
		
		$account = Session::get('currentAccount');
		$account_id = $account->id;
        $register_id = Session::getId();
		$data = AdvanceProduct::where('id',$id)->first();
		$cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
		return view('theams/theam' . $account->theme . '/advance/details')->with('data',$data)->with('account',$account)->with('cartList',$cartList);
	}
	public function ap_cart($id){
		
	}
	
	
	
	public function addToCartAdvance(Request $request)
    {
        //$account = Session::get('currentAccount');
        $input = $request->all();
        $sku   = $input['data']['sku'];
		
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])->first();
        Session::put('currentAccount', $account);
        $advance_product = AdvanceProduct::where('sku',$sku)->first();
        $account_id = $account->id;
        $register = Session::get('register');
        $registerId = Session::getId();
        

        $checkInventory = AdvanceProductCart::where('product_id', $advance_product->id)
		->where('account_id', $account->id)
		->where('register_id', $registerId)
		->first();

        if($checkInventory) {

            AdvanceProductCart::where('product_id', $advance_product->id)
			               ->where('account_id', $account->id)
			               ->where('register_id', $registerId)
						   ->update(['qty'=>$checkInventory->qty+1]);

        } else {

            AdvanceProductCart::insert([
			    'qty'        =>1,
				'product_id' =>$advance_product->id,
				'account_id' =>$account_id,
				'register_id'=>$registerId,
				'scheme_id'=>$input['data']['scheme_id'],
				]);
        }
        $cartMSG = 'Cart Updated';
        return response()->json($cartMSG, 200);
    }
	
	
	public function updateCart(Request $request)
    {
        $account = Session::get('currentAccount');
        $account_id = $account->id;
        $register_id = Session::getId();
		$register_user_id = Null;
        $input = $request->all();
        $id = $input['data']['id'];
        $qty = $input['data']['qty'];
        $buttonAction = $input['data']['buttonAction'];
        $action = $input['data']['action'];
		//$register_user_id = Null;
        if($buttonAction=='update'){
			if($action==0){
				if($qty!=1){
				$qty = $qty-1;
				}
			}else{
				$qty = $qty+1;
			}
			AdvanceProductCart::where('product_id', $id)
			                     ->where('account_id', $account->id)
			                     ->where('register_id', $register_id)
						         ->update(['qty'=>$qty]);
			$cartMSG = 0;
		}else if($buttonAction=='remove'){
			AdvanceProductCart::where('product_id', $id)
			                     ->where('account_id', $account->id)
								 ->where('register_id', $register_id)
						         ->delete();
			$cartMSG = 1;
		}
           

        

        return response()->json($cartMSG, 200);
    }
	
	
	public function process_order(Request $request){
        if(isset($request->pay_with_wallet)){
            $walletamount=200;
        }else{
            $walletamount=0;
        }
        # check sale coupon 
        $currentDate = date("Y-m-d");
        $SaleXfor=Coupon::where('status', 1)->where('coupon',$request->coupon)->where('template',$request->setting_id)->whereDate('validity_date', '>=', $currentDate)->first();
        if($SaleXfor){
            $xcoupondiscount=$SaleXfor->refferal_benifit;
        }else{
            $xcoupondiscount='0';
        }
        
		$account = Session::get('currentAccount');
		$account_id = $account->id;
		$register = Session::get('register');
        $registerId = $register->id;
		$address_id  = Session::get('addressCodeID');
		$address     = RegisterAddress::where('id',$address_id)->first();
		$cartList      = AdvanceProductCart::where('register_id',Session::getId())
			                 ->get();
          
                             
		$total = 0;
		$order_id = time();
		$array = [];
		$package_details = [];
		$totalQty = 0;
		$totalLengthArray = [];
		$totalWidthArray = [];
		$shipRocketPrArray = [];
		$totalWeight = 0;
		$totalHeight = 0;
		$is_aff = false;
		$total_aff_amount = 0;


		foreach($cartList as $row){
			$product_price = $row->product->product_price;
			$referral_id = Null;
			if($row->product->is_affiliation=='Yes'){
				$is_aff = true;
				$total_aff_amount += $row->product->affiliation_price;
			}
			$row_total = 0;
			$special_charges_label = $special_charges = '';
			if(!$row->scheme_id){
				if($row->product->tax_method!='Inclusive'){
					$row_total = $row->qty*($row->product->selling_price+$row->product->product_tax_value);
				}else{
					$row_total = $row->qty*($row->product->selling_price);
				}
			}else{
				$row_total = $row->ReferralScheme->special_charges + ($row->product->selling_price- $row->product->selling_price*($row->ReferralScheme->discount/100));
				$special_charges_label = $row->ReferralScheme->special_charges_label;
				$special_charges = $row->ReferralScheme->special_charges;
				$product_price = ($row->product->selling_price- $row->product->selling_price*($row->ReferralScheme->discount/100));
				$referral_id = $row->ReferralScheme->id;
			}
			$total += $row_total;
			
			$array[] = ['order_id'=>$order_id,
			            'product_id'=>$row->product->id,
			            'title'=>$row->product->title,
			            'thumbnail'=>$row->product->thumbnail,
			            'product_price'=>$product_price,
			            'shipping_charges'=>$row->product->shipping_charges,
			            'selling_price'=>$row->product->selling_price,
			            'product_tax'=>$row->product->product_tax_value,
			            'tax_method'=>$row->product->tax_method,
			            'cess'=>0,
			            'height'=>$row->product->height,
			            'width'=>$row->product->width,
			            'length'=>$row->product->length,
			            'weight'=>$row->product->weight,
			            'total'=>$row_total,
			            'qty'=>$row->qty,
						'offerDescription'=>Null,
						'is_aff' => ( isset($_COOKIE['aff_id'])&&$row->product->is_affiliation=='Yes' ? 1 : 0 ),
						'aff_id'=> ( isset($_COOKIE['aff_id'])&&$row->product->is_affiliation=='Yes' ? $_COOKIE['aff_id'] : Null ),
						'aff_amount'=> ( isset($_COOKIE['aff_id'])&&$row->product->is_affiliation=='Yes' ? $row->product->affiliation_price : Null ),
						'special_charges_label'=>$special_charges_label,
						'special_charges'=>$special_charges,
						'referral_id'=>$referral_id
			           ];
				array_push($package_details,[
				      "name"=>$row->product->title,
			          "total"=> $row->qty*$row->product->selling_price,
					  "qty"=> $row->qty,
					  "sku"=> $row->product->sku, 
					  "hsn"=> $row->product->hsn_code
				]);
				array_push($shipRocketPrArray,[
				                   "name"=>$row->product->title,
								   "sku"=>$row->product->sku,
								   "units"=>$row->qty,
								   "selling_price"=> $row->qty*$row->product->selling_price,
								   "discount"=> 0,
								   "tax"=> $row->product->product_tax_value*$row->qty,
								   "hsn"=> $row->product->hsn_code
											 ]);
				$totalQty += $row->qty;
				$totalWeight += $row->product->weight;
				$totalHeight += $row->product->height;
				array_push($totalLengthArray,$row->product->length);
				array_push($totalWidthArray,$row->product->width);
				/****************************************/
				if($row->product->purchase_product_offer&&$row->qty>=$row->product->purchase_product_offer->qty){
					$offerered_qty = intdiv($row->qty,$row->product->purchase_product_offer->qty);
			/**********************free product***************/
			         $row_total = 0;
					 if($row->product->purchase_product_offer->offerProduct->tax_method!='Inclusive'){
						$row_total = $offerered_qty*($row->product->purchase_product_offer->offerProduct->selling_price+$row->product->purchase_product_offer->offerProduct->product_tax_value);
					 }else{
						$row_total = $offerered_qty*($row->product->purchase_product_offer->offerProduct->selling_price);
					 }
					
			         $array[] = ['order_id'=>$order_id,
								'product_id'=>$row->product->purchase_product_offer->offerProduct->id,
								'title'=>$row->product->purchase_product_offer->offerProduct->title,
								'thumbnail'=>$row->product->purchase_product_offer->offerProduct->thumbnail,
								'product_price'=>$row->product->purchase_product_offer->offerProduct->product_price,
								'shipping_charges'=>$row->product->purchase_product_offer->offerProduct->shipping_charges,
								'selling_price'=>$row->product->purchase_product_offer->offerProduct->selling_price,
								'product_tax'=>$row->product->purchase_product_offer->offerProduct->product_tax_value,
								'tax_method'=>$row->product->purchase_product_offer->offerProduct->tax_method,
								'cess'=>0,
								'height'=>$row->product->purchase_product_offer->offerProduct->height,
								'width'=>$row->product->purchase_product_offer->offerProduct->width,
								'length'=>$row->product->purchase_product_offer->offerProduct->length,
								'weight'=>$row->product->purchase_product_offer->offerProduct->weight,
								'total'=>$row_total,
								'qty'=>$offerered_qty,
								'offerDescription'=>$row->product->purchase_product_offer->sceheme->title,
								'is_aff' => Null,
								'aff_id'=> Null,
								'aff_amount'=> Null,
						        'special_charges_label'=>Null,
						        'special_charges'=>Null,
						        'referral_id'=>Null
							   ];
						array_push($package_details,[
							  "name"=>$row->product->purchase_product_offer->offerProduct->title,
							  "total"=> $offerered_qty*$row->product->purchase_product_offer->offerProduct->selling_price,
							  "qty"=> $offerered_qty,
							  "sku"=> $row->product->purchase_product_offer->offerProduct->sku, 
							  "hsn"=> $row->product->purchase_product_offer->offerProduct->hsn_code
						]);
						array_push($shipRocketPrArray,[
										   "name"=>$row->product->purchase_product_offer->offerProduct->title,
										   "sku"=>$row->product->purchase_product_offer->offerProduct->sku,
										   "units"=>$offerered_qty,
										   "selling_price"=> $row->qty*$row->product->purchase_product_offer->offerProduct->selling_price,
										   "discount"=> 0,
										   "tax"=> $row->product->purchase_product_offer->offerProduct->product_tax_value*$offerered_qty,
										   "hsn"=> $row->product->purchase_product_offer->offerProduct->hsn_code
													 ]);
						$totalQty += $offerered_qty;
						$totalWeight += $row->product->purchase_product_offer->offerProduct->weight;
						$totalHeight += $row->product->purchase_product_offer->offerProduct->height;
						array_push($totalLengthArray,$row->product->purchase_product_offer->offerProduct->length);
						array_push($totalWidthArray,$row->product->purchase_product_offer->offerProduct->width);
			/**********************free product***************/
					
				}
				/****************************************/
				
		}
		
		$productData = [
                "package_weight" => $totalWeight,
                "package_length" => max($totalLengthArray),
                "package_width" => max($totalWidthArray),
                "package_height" => $totalHeight,
                "total" => $total,
                "total_qty" => $totalQty,
                "package_details" => $package_details,
            ];
		
		$shipyaariPayLoad = [
                "username" => base64_encode($account->shipyaariUserName),
                "insurance" => base64_encode('no'),
                "order_id" => base64_encode($order_id),
                "from_contact_number" => base64_encode($account->phone),
                "from_pincode" => base64_encode($account->pinCode),
                "from_landmark" => base64_encode($account->landmark),
                "from_address" => base64_encode($account->address),
                "from_address2" => base64_encode(''),
                "to_pincode" => base64_encode($address->zipCode),
                "to_landmark" => base64_encode($address->landmark),
                "to_address" => base64_encode($address->address),
                "to_address2" => base64_encode(''),
                "customer_name" => base64_encode($address->name),
                "customer_email" => base64_encode($address->email),
                "customer_contact_no" => base64_encode($address->phone),
                "ship_date" => base64_encode(date('Y-m-d')),
                "package_type" => base64_encode("identical"),
                "total_invoice_value" => base64_encode($total),
                "created_by" => base64_encode($account->shipyaariClientCode),
                "avnkey" => base64_encode($account->shipyaariClientCode."@".$account->shipyaariParentCode),
                "payment_mode" => base64_encode(( $request->transactionType==1 ? 'COD' : 'Online' )),
                "no_of_packages" => base64_encode(1),
                "total_price_set" => $total,
                "channel" => "API",
                "product_data" => [$productData]
            ];
		$shipRocketPayLoad = array (
								  'order_id' => $order_id,
								  'order_date' => date('Y-m-d H:i:s'),
								  'pickup_location' => $account->shiprocketPickupLocation,
								  'billing_customer_name' => $address->name,
								  'billing_last_name' => $address->name,
								  'billing_address' => $address->address,
								  'billing_address_2' =>$address->landmark,
								  'billing_city' => $address->cityId,
								  'billing_pincode' => $address->zipCode,
								  'billing_state' => $address->stateId,
								  'billing_country' => 'India',
								  'billing_email' => $address->email,
								  'billing_phone' => $address->phone,
								  'shipping_is_billing' => true,
								  'shipping_customer_name' => '',
								  'shipping_last_name' => '',
								  'shipping_address' => '',
								  'shipping_address_2' => '',
								  'shipping_city' => '',
								  'shipping_pincode' => '',
								  'shipping_country' => '',
								  'shipping_state' => '',
								  'shipping_email' => '',
								  'shipping_phone' => '',
								  'order_items' => $shipRocketPrArray,
								  'payment_method' =>($request->transactionType==1 ? "COD": "Prepaid"),
								  'shipping_charges' => 0,
								  'giftwrap_charges' => 0,
								  'transaction_charges' => 0,
								  'total_discount' => 0,
								  'sub_total' => $total,
								  'length' => max($totalLengthArray),
								  'breadth' => max($totalWidthArray),
								  'height' => $totalHeight,
								  'weight' => $totalWeight,
								);
		/***********************************************/
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
		  CURLOPT_POSTFIELDS => 'pickup_pincode='.$account->pinCode.'&delivery_pincode='.$address->zipCode.'&weight='.$totalWeight.'&paymentmode='.( $request->transactionType==1 ? 'COD' : 'Online' ).'&invoicevalue='.$total.'&avnkey='.$account->shipyaariClientCode."@".$account->shipyaariParentCode.'&service_type=normal&service=Standard&length='.max($totalLengthArray).'&width='.max($totalWidthArray).'&height='.$totalHeight.'&weight='.$totalWeight,
		));
		$shipyaariAvailability = curl_exec($curl);
		curl_close($curl);
		$shipRocketAvailability = '';
		if($account->shiprocketStatus==1){
				$shiprocketAvailabilityPayLoad = 'pickup_postcode='.$account->pinCode.'&delivery_postcode='.$address->zipCode.'&weight='.$totalWeight.'&length='.max($totalLengthArray).'&breadth='.max($totalWidthArray).'&height='.$totalHeight.'&declared_value='.$total.'&cod='.( $request->transactionType=='1' ? 1 : 0 );
			    $ship_rocket_token = $this->shipRocketToken($account_id);
				$curl = curl_init();
			    curl_setopt_array($curl, array(
			    CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/serviceability/?'.$shiprocketAvailabilityPayLoad,
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
			    $shipRocketAvailability = $response;
		}
		/***********************************************/
		if($request->transactionType==1){
			$return = redirect('orderList');
			$order_status = 0;
		}else if($request->transactionType==2){
          
			$order_status = 1;
			    $api = new Api($account->razorPayApiKey, $account->razorPayApiSecret);	
                $couponDiscountAmt = 0;
                $grandTotal = $total;				
			    $order  = $api->order->create([
						  'receipt'         => $address->name,
						  'amount'          => $grandTotal*100, 
						  'currency'        => 'INR',
						]);
                      
				$razorpay_order_id = $order->id;
               
				Session::put('razorpay_order_id',$order->id);	
				Session::put('account_order_id',$order_id);	
			    $account = Session::get('currentAccount');
				$user_data = ['name'=>$address->name,'contact'=>$address->phone,'email'=>$address->email];
                $viewPath = 'theams/theam' . $account->theme . '/razorpayView';
				$return = view($viewPath)->with('account',$account)->with('razorpay_order_id',$razorpay_order_id)->with('user_data',$user_data);
		}else if($request->transactionType==3){
			$order_status = 1;
			    $ApiKey = $account->instamojoApiKey;
                $AuthToken = $account->instamojoAuthToken;
				$url = 'https://test.instamojo.com/api/1.1/';
				$url = 'https://www.instamojo.com/api/1.1/';
			    $api = new \Instamojo\Instamojo(
				    $ApiKey,
                    $AuthToken,
                    $url
                );
			        $couponDiscountAmt=0;
                    $grandTotal = $total - $couponDiscountAmt;
					$customURL = url('instamojo_handler');
                    $response = $api->paymentRequestCreate(array(
                        "purpose" => "Payment to $account->domain",
                        "amount" =>  $grandTotal,
                        "buyer_name" => $address->name,
                        "send_email" => true,
                        "email" => $address->email,
                        "phone" => $address->phone,
                        "redirect_url" =>  $customURL,
                        ));	
				   Session::put('account_order_id',$order_id);    
                   $return = Redirect::to($response['longurl']);
	    } else if ($request->transactionType==4){
            $currentDate = date("Y-m-d");
            $SaleX=Coupon::where('status', 1)->where('coupon',$request->coupon)->where('template',$request->setting_id)->whereDate('validity_date', '>=', $currentDate)->first();#sale x coupon 
            if($SaleX){
                $couponDiscountAmt=$SaleX->refferal_benifit;
            }else{
                $couponDiscountAmt=0;
            }
         
            $grandTotal=$total-$couponDiscountAmt;
           
            $productData=json_encode($productData);
            $amount=($this->FinalAmount($registerId) - $grandTotal);
            $wallet_amount=DB::table('wallets')->insert(['transaction_id'=>'','account_id'=>$registerId,'debit'=>$grandTotal,'amount'=>$amount,'status'=>'0','order_id'=>$order_id,'description'=>$productData]);
            $order_status = 1; 
            $return = redirect('orderList');
			 
        }
      
        
		AdvanceProductOrder::insert([
			  'account_id' => $account->id,
			  'register_id' => $registerId,
			  'order_id' => $order_id,
			  'transactionType' => $request->transactionType,
			  'transactionId' => Null,
			  'status' => $order_status,
			  'name' => $address->name,
			  'phone' => $address->phone,
			  'email' => $address->email,
			  'landmark' => $address->landmark,
			  'address' => $address->address,
			  'zipCode' => $address->zipCode,
			  'cityId' => $address->cityId,
			  'stateId' => $address->stateId,
              'grand_total'=>$total,			  
              'shipyaariPayLoad'=>json_encode($shipyaariPayLoad),
			  'shipRocketPayLoad'=>json_encode($shipRocketPayLoad),
			  'shipyaariAvailability'=>$shipyaariAvailability,
			  'shipRocketAvailability'=>$shipRocketAvailability,
              

			  'is_aff' => ( $is_aff ? 1 : 0 ),
			  'aff_id' => ( $is_aff ? $_COOKIE['aff_id'] : Null ),

			  'aff_amount'=>$total_aff_amount,
              'coupon'=>($request->coupon ? $request->coupon : ''),
              'discount_coupon_amount'=>$xcoupondiscount
			  ]);
			if($total_aff_amount!=0){
				 $pre_aff = Affiliate::where('code',$_COOKIE['aff_id'])->first();
				 Affiliate::where('code',$_COOKIE['aff_id'])->update(['commission'=>( $pre_aff->commission +  $total_aff_amount)]);
				 $preAmount = AccountCreditAffiliation::where('account_id',$account->id)->first();
				 AccountCreditAffiliation::where('account_id',$account->id)->update(['amount'=>( $preAmount->amount -  $total_aff_amount)]);
				 AffiliatePaymentHistory::insert([
				   'account_id'=>$account->id,
				   'user_type'=>'affiliate',
				   'affiliate_id'=>$_COOKIE['aff_id'],
				   'reference_id'=>$order_id,
				   'type'=>'Order',
				   'amount'=>$total_aff_amount,
				   'remaining_amount'=>$pre_aff->commission +  $total_aff_amount,
				 ]);
				 AffiliatePaymentHistory::insert([
				   'account_id'=>$account->id,
				   'user_type'=>'seller',
				   'affiliate_id'=>$_COOKIE['aff_id'],
				   'reference_id'=>$order_id,
				   'type'=>'Order',
				   'amount'=>$total_aff_amount,
				   'remaining_amount'=>$preAmount->amount -  $total_aff_amount,
				 ]);
			}
			AdvanceProductOrderDetail::insert($array);
			AdvanceProductCart::where('register_id',Session::getId())->delete();
			if($request->transactionType==1){
				$this->confirmOrderNotification($order_id);
			}

            

           #refree_benifit
           $currentDate = date("Y-m-d");
           $register = Session::get('register');
           $registerId = $register->id;
           $SaleX=Coupon::where('status', 1)->where('coupon',$request->coupon)->where('template',$request->setting_id)->whereDate('validity_date', '>=', $currentDate)->first();#sale x coupon 
           if($SaleX){
            date_default_timezone_set("Asia/Kolkata");
            $date=date('Y/m/d h:i:s A');
            $refree_benifit=$SaleX->refree_benifit;
            #Add Benifits in Users wallets .
            $amount=($this->FinalAmount($SaleX->send_to) + $refree_benifit);
            $wallet_amount=DB::table('wallets')->insert(['transaction_id'=>'','account_id'=>$SaleX->send_to,'credit'=>$refree_benifit,'amount'=>$amount,'status'=>'0']);
            Coupon::where('id',$SaleX->id)->update(['status'=> 0,'uesttime'=>$date,'product_id'=>$request->product_id,'product_sale_price'=>'','used_to'=>$registerId]);
           }
			return $return;
	}
	public function instamojo_handler(Request $request){
		$account = Session::get('currentAccount');
		AdvanceProductOrder::where('account_id',$account->id)
		                     ->where('order_id',Session::get('account_order_id'))
				             ->update([
							   'transactionId' => $request->payment_id,
							   'status' => 0
							 ]);
		$this->confirmOrderNotification(Session::get('account_order_id'));
				Session::put('razorpay_order_id','');
				Session::put('account_order_id','');
				return redirect('orderList');
	}
	public function order_r_process(Request $request,$inputData=''){
		if (isset($request->error)){
			return Redirect('checkOut')->withErrors([$request->error['description'].' , Please try again.']);
		}else{
			$account = Session::get('currentAccount');
			
			$sign = hash_hmac('SHA256',Session::get('razorpay_order_id').'|'.$request->razorpay_payment_id,$account->razorPayApiSecret);
			
			
			if(hash_equals($sign,$request->razorpay_signature)){
				
				$account = Session::get('currentAccount');
				AdvanceProductOrder::where('account_id',$account->id)
				                     ->where('order_id',Session::get('account_order_id'))
				                     ->update([
									   'transactionId' => $request->razorpay_payment_id,
									   'status' => 0
									   ]);
				$this->confirmOrderNotification(Session::get('account_order_id'));
				Session::put('razorpay_order_id','');
				Session::put('account_order_id','');
				return redirect('orderList');
			}
		}
		
	}
	public function cancel_payment(){
		return Redirect('checkOut')->withErrors(['Payment Cancelled , Please try again.']);
	}
	public function userOrderCancel($id){
		$account = Session::get('currentAccount');
		$refund_transaction_id = time();
		$data = AdvanceProductOrder::where('account_id',$account->id)
		        ->where('order_id', $id)->first();
		if($data->transactionType==3&&$data->status==0){
		 
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/refunds/');
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER,
						array("X-Api-Key:".$account->instamojoApiKey,
							  "X-Auth-Token:".$account->instamojoAuthToken));
			$payload = Array(
				'transaction_id'=> $refund_transaction_id,
				'payment_id' => $data->transactionId,
				'type' => 'TAN',
				'body' => 'Event was canceled/changed',
				'refund_amount' => $data->grand_total
			);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
			$response = curl_exec($ch);
			curl_close($ch);
			 AdvanceProductOrder::where('account_id',$account->id)
		  ->where('order_id', $id)
          ->update(['refund_status' => 1,'refund_transaction_id'=>$refund_transaction_id,'status'=>6,'refund_responce'=>$response]);
		}else{
			AdvanceProductOrder::where('account_id',$account->id)
		    ->where('order_id', $id)
            ->update(['refund_status' => 1,'status'=>6]);
		}
			//echo $response;
			return Redirect('orderList');
	}
	
	public function confirmOrderNotification($order_id=''){
		//$order_id = '1629040049';
		$account = Session::get('currentAccount');
		$account_id = $account->id;
		$data = AdvanceProductOrder::where('account_id',$account->id)
		        ->where('order_id', $order_id)
				->first();
		    $found = Msgnotify::where('account_id', $account_id)->where('msg_type', '1')->first();
			if($found){
            $message = $found->messages;
            $message = str_replace('[CUSTOMER_NAME]',$data->name,$message);
            $message = str_replace('[ORDER_NO]',$data->order_id,$message);
            $message = str_replace('[Order_Number]',$data->order_id,$message);
            $message = str_replace('[Order_Amount]',$data->grand_total,$message);
            $message = str_replace('[GRAND_TOTAL]',$data->grand_total,$message);
            $message = str_replace('[Date_of_Order]',date('Y-m-d'),$message);
            $message = str_replace('[User_Mobile_Number]',$data->phone,$message);
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
			$email = 'webzaun@gmail.com';
			$email = $data->email;
			$logo = $account->domain.'/'.$account->logo;
			Mail::to($email)->send(new ConfirmOrderMail(['orderData'=>$data, 'account' => $account, 'logo' => $logo]));
			
	}
	public function mannual_aff_calculation(){
		echo "No Payment Found.";
	}
	public function my_schemes(){
		$account = Session::get('currentAccount');       
        $register = Session::get('register');

        if($register) {
            $register_id = $register->id;
			$scheme = ReferralScheme::where('account_id',$account->id)->where('scheme_validity','>=',date('Y-m-d'))->whereRaw('FIND_IN_SET('.$register_id.',shared_with)')->get(); 
		    return view('theams/theam1/my_schemes')->with('account',$account)->with('scheme',$scheme)->with('register_id',$register_id);
		}
	}
	
}