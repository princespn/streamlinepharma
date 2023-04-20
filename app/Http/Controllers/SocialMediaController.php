<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class SocialMediaController extends Controller
{
    public function index() {

        $socialMediaList = SocialMedia ::where('account_id',Session::get('user')->id)-> get();
        return view('admin/pages/socialMedia/index',compact('socialMediaList'));
    }

    public function create() {

        return view('admin/pages/socialMedia/add');
    }

    public function store(Request $request) {
        
        $input = $request->all();
        $input['account_id'] = Session::get('user')->id;

        

        
       
                
            unset($input['_token']);

            $socialMedia = SocialMedia::insert($input);
            if($socialMedia)
            {
                return redirect('/admin/socialMedia');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        

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

        

        
                
            unset($input['_token']);
            unset($input['_method']);

            $socialMedia = SocialMedia::where('id',$socialMedia->id)->update($input);
            if($socialMedia)
            {
                return redirect('/admin/socialMedia');

            } else {

                return back()->withErrors(['Something went wrong']);
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
