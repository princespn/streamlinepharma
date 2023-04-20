<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class TagController extends Controller
{

    public function index() {

        $account_id = Session::get('user')->id;
        $tagList = Tag ::where('account_id',$account_id)->get();
        return view('admin/tagLabel/tag/index',compact('tagList'));
    }

    public function create() {

        return view('admin/tagLabel/tag/add');
    }

    public function store(Request $request) {

        $input = $request->all();
        $input['account_id'] = Session::get('user')->id;

        $rules = [
            'tag' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);

            $tag = Tag::insert($input);
            if($tag)
            {
                return redirect('/admin/tag');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function show(Tag $tag) {
        //
    }

    public function edit(Tag $tag) {
       
        return view('admin/tagLabel/tag/edit',compact('tag'));
    }

    public function update(Request $request, Tag $tag) {
        
        $input = $request->all();
        $input['account_id'] = Session::get('user')->id;

        $rules = [
            'tag' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);
            unset($input['_method']);

            $tag = Tag ::where('id',$tag->id)->update($input);
            if($tag)
            {
                return redirect('/admin/tag');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function destroy(Tag $tag) {
        
        $result = $tag->delete();
        if($result == 1) {

            return redirect('/admin/tag');
            
        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
