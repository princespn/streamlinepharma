<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;
class FaqController extends Controller
{
    public function index() {

        $faqList = DB::table('faq')
		                   ->where('account_id',Session::get('user')->id)
						   ->get(); 
        return view('admin/pages/faq/index',compact('faqList'));
    }

    public function create($id='') {
        if($id!=''){
			$faqList = DB::table('faq')
		                   ->where('account_id',Session::get('user')->id)
		                   ->where('id',$id)
						   ->first(); 
			return view('admin/pages/faq/add')->with('faqList',$faqList);
		}else{
            return view('admin/pages/faq/add');
		}
    }

    public function store(Request $request) {
		if(isset($request->id)){
			DB::table('faq')
			->where('id', $request->id)
			->update([
			  'title' => $request->title,
			  'description' => $request->description,
			]);

		}else{
			DB::table('faq')->insert([
			  'title' => $request->title,
			  'description' => $request->description,
			  'account_id' => Session::get('user')->id,
			]);
		}
        return redirect('/admin/faq');

    }

    public function show(SocialMedia $socialMedia) {
        //
    }

    public function edit(SocialMedia $socialMedia) {
      
        return view('admin/pages/socialMedia/edit',compact('socialMedia'));
    }

    public function update(Request $request, SocialMedia $socialMedia) {
        
        $input = $request->all();
        $input['account_id'] = Session::get('user')->id;

        $rules = [
            'facebook' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);
            unset($input['_method']);

            $socialMedia = SocialMedia::where('id',$socialMedia->id)->update($input);
            if($socialMedia)
            {
                return redirect('/admin/socialMedia');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }

    }

    public function destroy(SocialMedia $socialMedia) {
        
        $result = $socialMedia->delete();
        if($result == 1) {

            return redirect('/admin/socialMedia');

        } else  {

            return back()->withErrors(['failed to delete']);
        }

    }
}
