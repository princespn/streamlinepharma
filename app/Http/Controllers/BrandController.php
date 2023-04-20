<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Models\Brand;
use Illuminate\Support\Facades\Session;
class BrandController extends Controller
{
    public function brand(){
		$data = Brand::where('account_id',Session::get('user')->id)->get();
		return view('admin.brand.brand')->with('data',$data);
	}
	public function brand_post(Request $request){
		Brand::insert([
		                'account_id'=>Session::get('user')->id,
		                'name'=>$request->brand,
		                'image'=>$request->image,
		             ]);
		return Redirect::back()->with('status','Subscribed Successfully.');
	}
}
