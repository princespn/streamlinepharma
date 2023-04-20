<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;


class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actionList = Action :: get();
        return view('supperAdmin/option/action/index',compact('actionList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supperAdmin/option/action/add');
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
            'name' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            unset($input['_token']);

            $action = Action::insert($input);
           
            if($action)
            {
                return redirect('/admin/action');

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
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function edit(Action $action)
    {
        return view('supperAdmin/option/action/edit',compact('action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Action $action)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
           
            unset($input['_token']);
            unset($input['_method']);

            $action = Action::where('id',$action->id)->update($input);
            if($action)
            {
                return redirect('/admin/action');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function destroy(Action $action)
    {
        $result = $action->delete();
        if($result == 1) {

            return redirect('/admin/action');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
