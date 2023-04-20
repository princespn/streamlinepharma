<?php

namespace App\Http\Controllers;

use App\Models\AffiliateKeyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Validator;

class AffiliateKeywordController extends Controller
{
    
    public function index() {

        $affiliateKeywordList = AffiliateKeyword :: get();
        return view('supperAdmin/affiliateKeyword/index',compact('affiliateKeywordList'));
    }
    
    public function create() {

        return view('supperAdmin/affiliateKeyword/add');
    }
    
    public function store(Request $request) {

        $input = $request->all();

        $rules = [
            'keyword' => 'required|unique:affiliate_keywords',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);

            $affiliateKeyword = AffiliateKeyword::insert($input);
            if($affiliateKeyword)
            {
                return redirect('/admin/affiliateKeyword');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function show(AffiliateKeyword $affiliateKeyword) {
        //
    }
    
    public function edit(AffiliateKeyword $affiliateKeyword) {

        return view('supperAdmin/affiliateKeyword/edit',compact('affiliateKeyword'));
    }

    public function update(Request $request, AffiliateKeyword $affiliateKeyword) {

        $input = $request->all();

        $rules = [
            'keyword' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);
            unset($input['_method']);

            $affiliateKeyword = AffiliateKeyword::where('id',$affiliateKeyword->id)->update($input);
            if($affiliateKeyword)
            {
                return redirect('/admin/affiliateKeyword');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function destroy(AffiliateKeyword $affiliateKeyword) {

        $result = $affiliateKeyword->delete();
        if($result == 1) {

            return redirect('/admin/affiliateKeyword');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
