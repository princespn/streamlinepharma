<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Validator;
use Redirect;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    public function add_description(){
        return view('supperAdmin/setting/description/add');
    }
    public function view_description(){
        $data=DB::table('description')->get();
       // print_r($data);exit;
        return view('supperAdmin/setting/description/view')->with('data',$data);
    }
    public function set_description(Request $req){
       $data = DB::table('description')->insert(['name'=>$req->description]);
       if($data){
        return Redirect::back()->with('status','Addedd Successfully');
       }else{
        return Redirect::back()->with('status','Error');
       }

    }
    
}
