<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Validator;
use Redirect;
use App\Models\HomeBanner;
use App\Models\imageUpload;
use App\Models\Account;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=HomeBanner::where('register_id',Session::get('user')->id)->get();
        return view('admin/banner/index')->with('data',$data);
    }
    public function banner(){
        return view('admin/banner/homeBanner');
    }
    public function store_banner(Request $request){
        $validated = $request->validate([
            'title'=>'required',
            'home_banner'=>'required|mimes:jpeg,jpg,png',
            'button_test'=>'required'
            
        ]);
        if($request->hasFile("home_banner")){
            $home_banner=$request->file("home_banner");
            $ext=$home_banner->extension();
            $image_new=time().'.'.$ext;
            $home_banner->storeAs('/public/banner',$image_new); 
        }
        $data = array(
           'lmage_banner'=>$image_new,
           'title'=>$request->title,
           'button_test'=>$request->button_test,
           'button_url'=>'',
           'register_id'=>Session::get('user')->id
        );
        $status=HomeBanner::insert($data);
        if($status){
            return Redirect::back()->with('status','Send Coupons Successfully.');
        }else{
            return Redirect::back()->with('error','Error!  please select an user.');
        }

    }
    public function edit($id){
        $edit=HomeBanner::where('id',$id)->where('register_id',Session::get('user')->id)->first();
        return view('admin/banner/homeBanner')->with('edit',$edit);
    }
    public function update_banner(Request $request, $id){
        $validated = $request->validate([
            'title'=>'required',
            'home_banner'=>'mimes:jpeg,jpg,png',
            'button_test'=>'required'
          
        ]);
        if($request->hasFile("home_banner")){
            $home_banner=$request->file("home_banner");
            $ext=$home_banner->extension();
            $image_new=time().'.'.$ext;
            $home_banner->storeAs('/public/banner',$image_new); 
        }else{
            $image_new=$request->lmage_banner;
        }
        $data = array(
          
           'title'=>$request->title,
           'button_test'=>$request->button_test,
           'button_url'=>'',
           'register_id'=>Session::get('user')->id,
           'lmage_banner'=>$image_new,
        );
       
       
        $status=HomeBanner::where('id',$id)->update($data);
        if($status){
            return Redirect::back()->with('status','Update Successfully.');
        }else{
            return Redirect::back()->with('error','Error!  .');
        }

    }
    public function delbanner (Request $request, $id){
        $status=HomeBanner::where('id',$id)->where('register_id',Session::get('user')->id)->delete();
        if($status){
            return Redirect::back()->with('status','Delete Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
	
	/*************New Code*************/
   public function homePageSlider(Request $request){
	   $account = Account::where('id',Session::get('user')->id)->first();
	   $ref_id = null;
	   $imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
	   $data = DB::table('banner_home_page_slider')
	           ->where('account_id',Session::get('user')->id);
	    if($account->home_page==1){
		  $type = 'Home1';
		}elseif($account->home_page==2){
		  if($request->sub_type=='Right'){	
		    $type = 'Home2';
		  }else if($request->sub_type=='Left'){
			$type = 'Home2'; 
		  }
		}else{
			$type = 'Home'.$account->home_page;
		}
		$data = $data
		        ->where('type',$type)
				->get();
	   return view('admin.banner.home1.home-page-slider')->with('imageUploadList',$imageUploadList)->with('data',$data)->with('type',$type);
   }
   public function homePageSliderPost(Request $request){
	   DB::table('banner_home_page_slider')
	   ->insert([
	      'account_id' => Session::get('user')->id,
	      'type' => $request->type,
	      'link' => $request->link,
	      'title1' => $request->title1,
	      'title2' => $request->title2,
	      'sub_title' => $request->sub_title,
	      'image' => url($request->image),
	   ]);
	   return Redirect::back()->with('status','Added.');
   } 
   public function categoryHomePageBanner($sType=''){
	   $account = Account::where('id',Session::get('user')->id)->first();
	   $ref_id = null;
	   $imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
	   $data = DB::table('banner_category_home_page_banner')
	           ->where('account_id',Session::get('user')->id);
	   if($account->home_page==1){
		  $type = 'Home1';
		}elseif($account->home_page==2){
		  $type = 'Home2';
		}else{
			if($sType==''){
				$type = 'Home'.$account->home_page;
			}else{
			    $type = 'Home5-subCategory';
			}
		}
		$data = $data
		        ->where('type',$type)
				->get();
	   return view('admin.banner.home1.category-home-page-banner')->with('imageUploadList',$imageUploadList)->with('data',$data)->with('type',$type);
   }
   
   public function categoryHomePageBannerPost(Request $request){
	   DB::table('banner_category_home_page_banner')
	   ->insert([
	      'account_id' => Session::get('user')->id,
	      'type' => $request->type,
	      'title1' => $request->title1,
	      'title2' => $request->title2,
	      'title3' => $request->title3,
	      'button_text' => $request->button_text,
	      'button_url' => $request->button_url,
	      'image' => url($request->image),
	   ]);
	   return Redirect::back()->with('status','Added.');
   }
   
   public function dailyBestSellBanner($sub=''){
	   $account = Account::where('id',Session::get('user')->id)->first();
	   $ref_id = null;
	   $imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
	   $data = DB::table('banner_daily_best_sell_banner')
	           ->where('account_id',Session::get('user')->id);
	    if($sub!=''){
		  if($sub=='Right'){
		    $type = 'Home2-Right';
		  }else if($sub=='RightUpper'){
		    $type = 'Home5-RightUpper';
		  }else if($sub=='RightBottom'){
		    $type = 'Home5-RightBottom';
		  }
		}elseif($account->home_page==1){
		  $type = 'Home1';
		}elseif($account->home_page==2){
		  $type = 'Home2';
		}else{
			$type = 'Home'.$account->home_page;
		}
		$data = $data
		        ->where('type',$type)
				->get();
	   return view('admin.banner.home1.daily-best-sell-banner')->with('imageUploadList',$imageUploadList)->with('data',$data)->with('type',$type);
   }
   public function dailyBestSellBannerPost(Request $request){
	   DB::table('banner_daily_best_sell_banner')
	   ->insert([
	      'account_id' => Session::get('user')->id,
	      'title' => $request->title,
	      'type' => $request->type,
	      'button_text' => $request->button_text,
	      'button_url' => $request->button_url,
	      'image' => url($request->image),
	   ]);
	   return Redirect::back()->with('status','Added.');
   }
   
   public function homePageLowerSlide(){
	   $account = Account::where('id',Session::get('user')->id)->first();
	   $ref_id = null;
	   $imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
	   $data = DB::table('banner_home_page_lower_slide')
	           ->where('account_id',Session::get('user')->id);
	   if($account->home_page==1){
		  $type = 'Home1';
		}elseif($account->home_page==2){
		  $type = 'Home2';
		}else{
			$type = 'Home'.$account->home_page;
		}
		$data = $data
		        ->where('type',$type)
				->get();
	   return view('admin.banner.home1.home-page-lower-slide')->with('imageUploadList',$imageUploadList)->with('data',$data)->with('type',$type);
   }
   public function homePageLowerSlidePost(Request $request){
	   DB::table('banner_home_page_lower_slide')
	   ->insert([
	      'account_id' => Session::get('user')->id,
	      'type' => $request->type,
	      'title1' => $request->title1,
	      'title2' => $request->title2,
	      'sub_title' => $request->sub_title,
	      'link' => $request->link,
	      'image' => url($request->image),
	   ]);
	   return Redirect::back()->with('status','Added.');
   }
   
   public function dealsOfTheDay(){
	   $account = Account::where('id',Session::get('user')->id)->first();
	   $ref_id = null;
	   $imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
	   $data = DB::table('banner_deals_of_the_day')
	           ->where('account_id',Session::get('user')->id);
	   if($account->home_page==1){
		  $type = 'Home1';
		}elseif($account->home_page==2){
		  $type = 'Home2';
		}else{
			$type = 'Home'.$account->home_page;
		}
		$data = $data
		        ->where('type',$type)
				->get();
	   return view('admin.banner.home1.deals-of-the-day')->with('imageUploadList',$imageUploadList)->with('data',$data)->with('type',$type);
   }
   public function dealsOfTheDayPost(Request $request){
	   DB::table('banner_deals_of_the_day')
	   ->insert([
	      'account_id' => Session::get('user')->id,
	      'type' => $request->type,
	      'date' => $request->date,
	      'sku' => $request->sku,
	      'image' => url($request->image),
	   ]);
	   return Redirect::back()->with('status','Added.');
   }
   public function homeBannerAction(Request $request){
	   $banner = [
	                '1' => 'banner_home_page_slider',
	                '2' => 'banner_category_home_page_banner',
	                '3' => 'banner_daily_best_sell_banner',
	                '4' => 'banner_deals_of_the_day',
	                '5' => 'banner_home_page_lower_slide',
	                '6' => 'banner_category_icon',
	                '7' => 'banner_footer_slide',
	             ];
	   DB::table($banner[$request->banner_type])
	       ->where('account_id',Session::get('user')->id)
		   ->where('id',$request->delete_button)
		   ->delete();
	   return Redirect::back()->with('status','Deleted.');
   }
   public function categoryIcon(){
	   $account = Account::where('id',Session::get('user')->id)->first();
	   $ref_id = null;
	   $imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
	    $data = DB::table('banner_category_icon')
	            ->where('account_id',Session::get('user')->id)
			    ->get();
	   return view('admin.banner.home1.category-icon')->with('imageUploadList',$imageUploadList)->with('data',$data);
   }
   public function categoryIconPost(Request $request){
	   DB::table('banner_category_icon')
	   ->insert([
	      'account_id' => Session::get('user')->id,
	      'link' => $request->link,
	      'title' => $request->title,
	      'icon' => url($request->icon),
	   ]);
	   return Redirect::back()->with('status','Added.');
   } 
   public function footerSlide(){
	   $account = Account::where('id',Session::get('user')->id)->first();
	   $ref_id = null;
	   $imageUploadList = imageUpload ::where('account_id',$account->id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
	    $data = DB::table('banner_footer_slide')
	            ->where('account_id',Session::get('user')->id)
			    ->get();
	   return view('admin.banner.home1.footer-slide')->with('imageUploadList',$imageUploadList)->with('data',$data);
   }
   public function footerSlidePost(Request $request){
	   $account = Account::where('id',Session::get('user')->id)->first();
	   DB::table('banner_footer_slide')
	   ->insert([
	      'account_id' => Session::get('user')->id,
	      'type' => "Home".$account->home_page,
	      'title' => $request->title,
	      'subtitle' => $request->subtitle,
	      'link' => $request->link,
	      'icon' => url($request->icon),
	   ]);
	   return Redirect::back()->with('status','Added.');
   } 
}
