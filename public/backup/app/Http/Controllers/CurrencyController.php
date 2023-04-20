<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Validator;

class CurrencyController extends Controller
{
    
    public function index() {

        $currencyList = Currency :: get();
        return view('supperAdmin/currency/index',compact('currencyList'));
    }

    public function create() {

        return view('supperAdmin/currency/add');
    }

    public function store(Request $request) {
        
        $input = $request->all();

        $rules = [
            'title' => 'required|max:50',
            'code' => 'required|unique:currencies',
            'symbolSide' => 'required',
            'symbol' => 'required',
            'value' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);

            $currency = Currency::insert($input);
            if($currency)
            {
                return redirect('/admin/currency');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }

    }

    public function show(Currency $currency) {
        //
    }

    public function edit(Currency $currency) {
        
        return view('supperAdmin/currency/edit',compact('currency'));
    }

    public function update(Request $request, Currency $currency) {
        
        $input = $request->all();

        $rules = [
            'title' => 'required|max:50',
            'code' => 'required',
            'symbolSide' => 'required',
            'symbol' => 'required',
            'value' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);
            unset($input['_method']);

            $currency = Currency::where('id',$currency->id)->update($input);
            if($currency)
            {
                return redirect('/admin/currency');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function destroy(Currency $currency) {
        
        $result = $currency->delete();
        if($result == 1) {

            return redirect('/admin/currency');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }    
}
