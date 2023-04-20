<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Validator;
use Redirect;
use App\Models\Productlistingpagebanner;


class ProductlistingpagebannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=Productlistingpagebanner::where('register_id',Session::get('user')->id)->get();
     
        return view('admin/banner/showProductlistingpagebanner')->with('data',$data);
    }
    public function show(){

        return view('admin/banner/Productlistingpagebanner');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'test'=>'required',
            'images'=>'required|mimes:jpeg,jpg,png,svg', 
        ]);

        if($request->hasFile("images")){
            $images=$request->file("images");
            $ext=$images->extension();
            $image_new=time().'.'.$ext;
            $images->storeAs('/public/Productlistingpagebanner',$image_new); 
        }
        $data = array(
           'images'=>$image_new,
           'test'=>$request->test,
           'register_id'=>Session::get('user')->id
        );
        $status=Productlistingpagebanner::insert($data);
        if($status){
            return Redirect::back()->with('status','update Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
    public function edit($id){
        $edit=Productlistingpagebanner::where('id',$id)->where('register_id',Session::get('user')->id)->first();
        return view('admin/banner/Productlistingpagebanner')->with('edit',$edit);

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
            $imgeas->storeAs('/public/Productlistingpagebanner',$image_new); 
        }else{
          $image_new=$request->icon;  
        }
        $data = array(
           'images'=>$image_new,
           'test'=>$request->test,
           'register_id'=>Session::get('user')->id
        );
        $status=Productlistingpagebanner::where('id',$id)->where('register_id',Session::get('user')->id)->update($data);
        if($status){
            return Redirect::back()->with('status','update Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
    public function deleted (Request $request, $id){
       
        $status=Productlistingpagebanner::where('id',$id)->where('register_id',Session::get('user')->id)->delete();
        if($status){
            return Redirect::back()->with('status','Delete Successfully.');
        }else{
            return Redirect::back()->with('error','Error! .');
        }
    }
   
    
}
