<?php

namespace App\Http\Controllers;

use App\Models\ExtraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class ExtraServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $extraServiceList = ExtraService ::where('account_id',$account_id)->get();
        return view('admin/pages/extraService/index',compact('extraServiceList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/pages/extraService/add');
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
            'delivery' => 'required',
            'deliveryTitle' => 'required',
            'moneyBack' => 'required',
            'moneyBackTitle' => 'required',
            'support' => 'required',
            'supportTitle' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);

            $extraService = ExtraService::insert($input);
            if($extraService)
            {
                return redirect('/admin/extraService');

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
     * @param  \App\Models\ExtraService  $extraService
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraService $extraService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExtraService  $extraService
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtraService $extraService)
    {
        return view('admin/pages/extraService/edit',compact('extraService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExtraService  $extraService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExtraService $extraService)
    {
        $input = $request->all();

        $rules = [
            'delivery' => 'required',
            'deliveryTitle' => 'required',
            'moneyBack' => 'required',
            'moneyBackTitle' => 'required',
            'support' => 'required',
            'supportTitle' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);
            unset($input['_method']);

            $extraService = ExtraService::where('id',$extraService->id)->where('account_id',Session::get('user')->id)->update($input);
            if($extraService)
            {
                return redirect('/admin/extraService');

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
     * @param  \App\Models\ExtraService  $extraService
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtraService $extraService)
    {
        $result = $extraService->delete();
        if($result == 1) {

            return redirect('/admin/extraService');

        } else  {

            return back()->withErrors(['failed to delete']);

        }
    }
}
