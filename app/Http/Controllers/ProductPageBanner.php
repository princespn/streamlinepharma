<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Validator;
use Redirect;
use App\Models\ProductPageBanner;



class ProductPageBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=OfferBanner::where('register_id',Session::get('user')->id)->get();
        return view('admin/banner/showOfferBanner')->with('data',$data);
    }
    public function banner(){

        
        return view('admin/banner/offerBanner');
    }

    public function offer_banner(Request $request){
      
        $validated = $request->validate([
            'test'=>'required',
            'offer_banner'=>'required|mimes:jpeg,jpg,png,svg',
            'sub_test'=>'required',
        ]);
        if($request->hasFile("offer_banner")){
            $home_banner=$request->file("offer_banner");
            $ext=$home_banner->extension();
            $image_new=time().'.'.$ext;
            $home_banner->storeAs('/public/offerbanner',$image_new); 
        }
        $data = array(
           'icon'=>$image_new,
           'test'=>$request->test,
           'sub_test'=>$request->sub_test,
           'register_id'=>Session::get('user')->id
        );
        $status=OfferBanner::insert($data);
        if($status){
            return Redirect::back()->with('status','update Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
    public function edit($id){
        $edit=OfferBanner::where('id',$id)->where('register_id',Session::get('user')->id)->first();
        return view('admin/banner/offerBanner')->with('edit',$edit);

    }
    public function updateofferbanner(Request $request, $id){
        $validated = $request->validate([
            'test'=>'required',
            'offer_banner'=>'mimes:jpeg,jpg,png,svg',
            'sub_test'=>'required',
        ]);
        if($request->hasFile("offer_banner")){
            $home_banner=$request->file("offer_banner");
            $ext=$home_banner->extension();
            $image_new=time().'.'.$ext;
            $home_banner->storeAs('/public/offerbanner',$image_new); 
        }else{
          $image_new=$request->icon;  
        }
        $data = array(
           'icon'=>$image_new,
           'test'=>$request->test,
           'sub_test'=>$request->sub_test,
           'register_id'=>Session::get('user')->id
        );
        $status=OfferBanner::where('id',$id)->where('register_id',Session::get('user')->id)->update($data);
        if($status){
            return Redirect::back()->with('status','update Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
    public function delofferbanner (Request $request, $id){
        $status=OfferBanner::where('id',$id)->where('register_id',Session::get('user')->id)->delete();
        if($status){
            return Redirect::back()->with('status','Delete Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
   
    
}
