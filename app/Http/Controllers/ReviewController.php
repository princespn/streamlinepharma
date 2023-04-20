<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews; 
use DB;
use Redirect;
use Illuminate\Support\Facades\Session;
class ReviewController extends Controller
{
    public function reviews(){
		$data = Reviews::where('account_id',Session::get('user')->id)
		        ->get();
		return view('admin.reviews.index')->with('data',$data);
	}
	public function review_status($id,$status){

		Reviews::where('account_id',Session::get('user')->id)
		         ->where('id',$id)
				 ->update(['status'=>$status]);
		return Redirect::back()->with('status','Updated Successfully');
	}
}
