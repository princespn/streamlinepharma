<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class LabelController extends Controller
{
    
    public function index() {

        $accountId = Session::get('user')->id;
        $labelList = Label::whereHas('tag' , function($query) use($accountId){
            $query->where('account_id', $accountId);
        })->get();
        return view('admin/tagLabel/label/index',compact('labelList'));
    }
    
    public function create() {

		$accountId = Session::get('user')->id;
        $tagList = Tag ::where('account_id', $accountId)->get();
        return view('admin/tagLabel/label/add',compact('tagList'));
    }
    
    public function store(Request $request) {

        $input = $request->all();

        $rules = [
            'tag_id' => 'required',
            'label' => 'required'
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);
            
            $label = Label::insert($input);
            if($label)
            {
                return redirect('/admin/label');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function show(Label $label) {
        //
    }
    
    public function edit(Label $label) {
        
        $tagList = Tag :: get();
        return view('admin/tagLabel/label/edit',compact('label','tagList'));
    }
    
    public function update(Request $request, Label $label) {

        $input = $request->all();
        
        $input['highlight'] = $request->input('highlight') ? true : false;
        $input['filter'] = $request->input('filter') ? true : false;
        $input['option'] = $request->input('option') ? true : false;
        
        $rules = [
            'tag_id' => 'required',
            'label' => 'required'
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);
            unset($input['_method']);

            $label = Label ::where('id',$label->id)->update($input);
            if($label)
            {
                return redirect('/admin/label');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function destroy(Label $label) {

        $result = $label->delete();
        if($result == 1) {

            return redirect('/admin/label');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
