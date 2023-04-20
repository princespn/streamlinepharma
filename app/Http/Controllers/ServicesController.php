<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Services;
class ServicesController extends Controller
{
    public function index(){
		$data = Services::get();
		return view('supperAdmin.services.index')->with('data',$data);
	}
	public function servicesTagMaster(){
		return view('supperAdmin.services.services-tag-master');
	}
	public function servicesVariant($id=''){
		$return = view('supperAdmin.services.services-variant');
		if($id!=''){
			$variant = Services::where('id',$id)->first();
			$return = $return->with('variant',$variant)->with('id',$id);
		}
		$data = Services::get();
		return $return->with('data',$data);
	}
	public function servicesPost(Request $request){
		Services::insert([
		  'account_id'=>Session::get('user')->id,
		  'service'=>$request->service,
		  'service_field'=>implode(',',$request->service_field),
		]);
		return Redirect::back()->with('status','Created Successfully.');
	}
}
