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
        
        $data=ProductPageBanner::where('register_id',Session::get('user')->id)->get();
     
        return view('admin/banner/showProductPageBanner')->with('data',$data);
    }
    public function show(){

        return view('admin/banner/ProductPageBanner');
    }

    public function SetProuctPageBanner(Request $request){

        $validated = $request->validate([
            'test'=>'required',
            'images'=>'required|mimes:jpeg,jpg,png,svg', 
        ]);

        if($request->hasFile("images")){
            $images=$request->file("images");
            $ext=$images->extension();
            $image_new=time().'.'.$ext;
            $images->storeAs('/public/productPageBanner',$image_new); 
        }
        $data = array(
           'images'=>$image_new,
           'test'=>$request->test,
           'register_id'=>Session::get('user')->id
        );
        $status=ProductPageBanner::insert($data);
        if($status){
            return Redirect::back()->with('status','update Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
    public function edit($id){
        $edit=ProductPageBanner::where('id',$id)->where('register_id',Session::get('user')->id)->first();
        return view('admin/banner/ProductPageBanner')->with('edit',$edit);

    }
    public function update(Request $request, $id){
        $validated = $request->validate([
            'test'=>'required',
            'images'=>'mimes:jpeg,jpg,png,svg',
           
        ]);
        if($request->hasFile("images")){
            $images=$request->file("images");
            $ext=$images->extension();
            $image_new=time().'.'.$ext;
            $imgeas->storeAs('/public/ProductPageBanner',$image_new); 
        }else{
          $image_new=$request->icon;  
        }
        $data = array(
           'images'=>$image_new,
           'test'=>$request->test,
           'register_id'=>Session::get('user')->id
        );
        $status=ProductPageBanner::where('id',$id)->where('register_id',Session::get('user')->id)->update($data);
        if($status){
            return Redirect::back()->with('status','update Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
    public function deleted (Request $request, $id){
        $status=ProductPageBanner::where('id',$id)->where('register_id',Session::get('user')->id)->delete();
        if($status){
            return Redirect::back()->with('status','Delete Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
   
    
}
