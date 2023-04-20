<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator; 

class AboutController extends Controller
{
 
    public function index() {

        $account_id = Session::get('user')->id;
        $aboutList = About ::where('account_id',$account_id)->get();
        return view('admin/pages/aboutus/index',compact('aboutList'));
    }

    public function create() {

        return view('admin/pages/aboutus/add');
    }

    public function store(Request $request) {

        $input = $request->all();

        $rules = [
            'heading' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);

            $about = About::insert($input);
            if($about)
            {
                return redirect('/admin/about');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function show(About $about) {
        //
    }

    public function edit(About $about) {

        return view('admin/pages/aboutus/edit',compact('about'));
    }

    public function update(Request $request, About $about) {

        $input = $request->all();

        $rules = [
            'heading' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);
            unset($input['_method']);

            $about = About::where('id',$about->id)->where('account_id',Session::get('user')->id)->update($input);
            if($about)
            {
                return redirect('/admin/about');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function destroy(About $about) {
        
        $result = $about->delete();
        if($result == 1) {

            return redirect('/admin/about');

        } else  {

            return back()->withErrors(['failed to delete']);

        }
    }
}
