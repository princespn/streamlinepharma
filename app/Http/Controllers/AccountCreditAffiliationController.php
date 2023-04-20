<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AffiliatePaymentHistory;
use App\Models\AccountCreditAffiliation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class AccountCreditAffiliationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('user')->id == 1) {
            
            $affiliationAmtList = AccountCreditAffiliation::with('account')->get();

        } else {
            
            $affiliationAmtList = AccountCreditAffiliation::with('account')->where('account_id',Session::get('user')->id)->get();
        }
        
        return view('supperAdmin/affiliationAmt/index',compact('affiliationAmtList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountList = Account :: where('id', '!=' ,1)->get();
        return view('supperAdmin/affiliationAmt/add',compact('accountList'));
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
            'account_id' => 'required',
            'amount' => 'required',
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {

            unset($input['_token']);
			$check = AccountCreditAffiliation::where('account_id',$input['account_id'])->first();
			$remaining_amount = 0;
			if($check){
				$creditAffiliation = AccountCreditAffiliation::where('account_id',$input['account_id'])->update(['amount'=>($input['amount']+$check->amount)]);
				$remaining_amount = $input['amount']+$check->amount;
			}else{
				$creditAffiliation = AccountCreditAffiliation::create($input);
				$remaining_amount  = $input['amount'];
			}
            
			
			AffiliatePaymentHistory::insert([
				   'account_id'=>$input['account_id'],
				   'user_type'=>'seller',
				   'affiliate_id'=>Null,
				   'reference_id'=>Null,
				   'type'=>'Wallet Reload',
				   'amount'=>$input['amount'],
				   'remaining_amount'=>$remaining_amount,
				 ]);
			
            if($creditAffiliation)
            {
                return redirect('/admin/affiliationCreditAmt');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountCreditAffiliation  $accountCreditAffiliation
     * @return \Illuminate\Http\Response
     */
    public function show(AccountCreditAffiliation $accountCreditAffiliation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountCreditAffiliation  $accountCreditAffiliation
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountCreditAffiliation $accountCreditAffiliation)
    {
        $accountList = Account :: get();
        return view('supperAdmin/account/edit',compact('accountList','accountCreditAffiliation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountCreditAffiliation  $accountCreditAffiliation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountCreditAffiliation $accountCreditAffiliation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountCreditAffiliation  $accountCreditAffiliation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accountCreditAffiliation = AccountCreditAffiliation::find($id);
        if($accountCreditAffiliation){
            $result = $accountCreditAffiliation->delete();
            if($result == 1) {
    
                return redirect('/admin/affiliationCreditAmt');
    
            } else  {
    
                return back()->withErrors(['failed to delete']);
            }
        } else{

            return back()->withErrors(['Credit Affiliation not found.']);
        }
        
    }
}
