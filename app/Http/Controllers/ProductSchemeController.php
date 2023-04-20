<?php

namespace App\Http\Controllers;

use App\Models\imageUpload;
use App\Models\Productscheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class ProductSchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $offerList = Productscheme::where('account_id',$account_id)->get();
        return view('admin/offers/scheme/index', compact('offerList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account_id = Session::get('user')->id;
        $imageUploadList = imageUpload ::where('account_id',$account_id)->orderBy('mediaType', 'ASC')->get();
        return view('admin/offers/scheme/add', compact('imageUploadList'));
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
            'schemes' => 'required',
            'schemes_file' => 'required',
        ];
        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            $account_id = Session::get('user')->id;
            Productscheme::create([
                'account_id' => $account_id,
                'title' => $input['schemes'],
                'image_file' => $input['schemes_file']
            ]);
            return redirect('admin/schemes');
        }
        $errors = $validation->errors();
        return back()->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Productscheme  $productscheme
     * @return \Illuminate\Http\Response
     */
    public function show(Productscheme $productscheme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Productscheme  $productscheme
     * @return \Illuminate\Http\Response
     */
    public function edit(Productscheme $productscheme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Productscheme  $productscheme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productscheme $productscheme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Productscheme  $productscheme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productscheme $productscheme)
    {
        //
    }
}
