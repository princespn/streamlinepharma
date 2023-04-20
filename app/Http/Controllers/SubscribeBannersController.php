<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Validator;
use Redirect;
use App\Models\SubscribeBanner;

class SubscribeBannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=SubscribeBanner::where('register_id',Session::get('user')->id)->get();
        return view('admin/banner/showsubsBanner')->with('data',$data);
    }
    public function banner(){

        return view('admin/banner/subsBanner');
    }

    public function subs_banner(Request $request){
        $validated = $request->validate([
            'test'=>'required',
            'images'=>'required|mimes:jpeg,jpg,png,svg',
            'url'=>'required',
        ]);
        if($request->hasFile("images")){
            $home_banner=$request->file("images");
            $ext=$home_banner->extension();
            $image_new=time().'.'.$ext;
            $home_banner->storeAs('/public/subscribebanner',$image_new); 
        }
        $data = array(
           'images'=>$image_new,
           'test'=>$request->test,
           'description'=>$request->url,
           'register_id'=>Session::get('user')->id
        );
        $status=SubscribeBanner::insert($data);
        if($status){
            return Redirect::back()->with('status','update Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
    public function edit($id){
        $edit=SubscribeBanner::where('id',$id)->where('register_id',Session::get('user')->id)->first();
        return view('admin/banner/subsBanner')->with('edit',$edit);

    }
    public function updatesubsbanner(Request $request, $id){
        $validated = $request->validate([
            'test'=>'required',
            'images'=>'mimes:jpeg,jpg,png,svg',
            'url'=>'required',
        ]);
        if($request->hasFile("images")){
            $home_banner=$request->file("images");
            $ext=$home_banner->extension();
            $image_new=time().'.'.$ext;
            $home_banner->storeAs('/public/subscribebanner',$image_new); 
        }else{
          $image_new=$request->icon;  
        }
        $data = array(
           'images'=>$image_new,
           'test'=>$request->test,
           'description'=>$request->url,
           'register_id'=>Session::get('user')->id
        );
        $status=SubscribeBanner::where('id',$id)->where('register_id',Session::get('user')->id)->update($data);
        if($status){
            return Redirect::back()->with('status','update Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
    public function delsubsbanner (Request $request, $id){
        $status=SubscribeBanner::where('id',$id)->where('register_id',Session::get('user')->id)->delete();
        if($status){
            return Redirect::back()->with('status','Delete Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
   

}
