<?php

namespace App\Http\Controllers;

use App\Models\Productscheme;
use App\Models\Purchaseoffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;

class PurchaseofferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $offerList = Purchaseoffer::where('account_id',$account_id)->get();
        return view('admin/offers/purchase/index', compact('offerList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id='')
    {
        $account_id = Session::get('user')->id;
        $schemeList = Productscheme::where('account_id',$account_id)->get();
		$return = view('admin/offers/purchase/add', compact('schemeList'));
		if($id!=''){
			$offerList = Purchaseoffer::where('id',$id)->first();
			$return = $return->with('offerList',$offerList);
		}
        return $return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'product_sku' => 'required',
            'product_qty' => 'required|numeric',
            'get_product_sku' => 'required',
            'get_qty' => 'required|numeric',
            'startDate' => 'required',
            'endDate' => 'required',
            'terms_and_conditions' => 'required',
        ];
        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            $account_id = Session::get('user')->id;
			if(!isset($input['id'])){
				Purchaseoffer::create([
					'account_id' => $account_id,
					'product_sku' => $input['product_sku'],
					'scheme' => $input['scheme'],
					'qty' => $input['product_qty'],
					'get_prod_sku' => $input['get_product_sku'],
					'get_qty' => $input['get_qty'],
					'startDate' => $input['startDate'],
					'endDate' => $input['endDate'],
					'terms_and_conditions' => $input['terms_and_conditions']
				]);
			}else{
				Purchaseoffer::where('id',$input['id'])->update([
					'account_id' => $account_id,
					'product_sku' => $input['product_sku'],
					'scheme' => $input['scheme'],
					'qty' => $input['product_qty'],
					'get_prod_sku' => $input['get_product_sku'],
					'get_qty' => $input['get_qty'],
					'startDate' => $input['startDate'],
					'endDate' => $input['endDate'],
					'terms_and_conditions' => $input['terms_and_conditions']
				]);

			}
            return redirect('admin/offers');
        }
        $errors = $validation->errors();
        return back()->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchaseoffer  $purchaseoffer
     * @return \Illuminate\Http\Response
     */
    public function show(Purchaseoffer $purchaseoffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchaseoffer  $purchaseoffer
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchaseoffer $purchaseoffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchaseoffer  $purchaseoffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchaseoffer $purchaseoffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchaseoffer  $purchaseoffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchaseoffer $purchaseoffer,$id)
    {
        $result = null;
        $found=$purchaseoffer::findorfail($id);
        if($found){
            $result =$found->delete();
        }
        if ($result == 1) {
            return redirect('/admin/offers');
        } else {
            return back()->withErrors(['failed to delete']);
        }
    }
	public function page_detail(Request $request){
		$account_id = Session::get('user')->id;
		$data = DB::table('accounts')
		->where('id',$account_id)
		->first();
		return view('admin/offers/purchase/page_detail')->with('data',$data);
	}
	public function page_detail_post(Request $request){
		$account_id = Session::get('user')->id;
		DB::table('accounts')
		->where('id',$account_id)
		->update([
		     'offer_page_title'=>$request->offer_page_title,
			 'memebership_title'=>$request->memebership_title,
			 'membership_background_image'=>$request->membership_background_image,
			 'membership_product_page_text'=>$request->membership_product_page_text,
			 'isMembership'=>( isset($request->isMembership) ? 1 : 0 ),
			 ]);
		return back();
	}
}
