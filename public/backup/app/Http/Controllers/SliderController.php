<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\imageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class SliderController extends Controller
{

    public function index() {

        $account_id = Session::get('user')->id;
        $sliderList = Slider ::where('account_id',$account_id)->get();
        return view('admin/product/slider/index',compact('sliderList'));
    }

    public function create() {

        $account_id = Session::get('user')->id;

        $ref_id = null;
        $imageUploadList = imageUpload ::where('account_id',$account_id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
        return view('admin/product/slider/add',compact('imageUploadList'));
    }
    
    public function store(Request $request) {
        
        $input = $request->all();

        $rules = [
            'title' => 'required',
            'imageURL' => 'required',
            'linkURL' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);

            $checkSlider = Slider ::where('account_id',Session::get('user')->id)->where('qc',1)->get();
            if(count($checkSlider)<5)
            {
                $slider = Slider::insert($input);
                if($slider)
                {
                    return redirect('/admin/slider');

                } else {

                    return back()->withErrors(['Something went wrong']);
                }
                
            } else {

                return back()->withErrors(['You can not add more than 5 sliders']);
            }
            

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function show(Slider $slider) {
        //
    }

    public function edit(Slider $slider) {

        $account_id = Session::get('user')->id;

        $ref_id = null;
        $imageUploadList = imageUpload ::where('account_id',$account_id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
       
        return view('admin/product/slider/edit',compact('slider','imageUploadList'));
    }

    public function update(Request $request, Slider $slider) {

        $input = $request->all();
		//dd(Session::get('user')->id);
		
        $rules = [
            'title' => 'required',
            'imageURL' => 'required',
            'linkURL' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);
            unset($input['_method']);

            $slider = Slider::where('id',$slider->id)->update($input); //->where('accounte_id',Session::get('user')->id)
            if($slider)
            {
                return redirect('/admin/slider');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function destroy(Slider $slider) {

        $result = $slider->delete();
        if($result == 1) {

            return redirect('/admin/slider');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}