<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class TermController extends Controller
{
    
    public function index()  {

        $account_id = Session::get('user')->id;
        $termList = Term ::where('account_id',$account_id)->get();
        return view('admin/pages/term/index',compact('termList'));
    }

    public function create() {

        return view('admin/pages/term/add');
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

            $term = Term::insert($input);
            if($term)
            {
                return redirect('/admin/term');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function show(Term $term) {

        //
    }
    
    public function edit(Term $term) {

        return view('admin/pages/term/edit',compact('term'));
    }
    
    public function update(Request $request, Term $term) {

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

            $term = Term::where('id',$term->id)->where('account_id',Session::get('user')->id)->update($input);
            if($term)
            {
                return redirect('/admin/term');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function destroy(Term $term) {

        $result = $term->delete();
        if($result == 1) {

            return redirect('/admin/term');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
