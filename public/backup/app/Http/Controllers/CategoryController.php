<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\imageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class CategoryController extends Controller
{
    
    public function index() {

        $account_id = Session::get('user')->id;
        $categoryList = Category ::where('account_id',$account_id)->with(['parentCategory'=> function($query){
            $query->with('parentCategory');
        }])
        ->get();
        return view('admin/product/category/index',compact('categoryList'));
    }

    public function create() {

        $account_id = Session::get('user')->id;
        $categoryList = Category ::where('account_id',$account_id)->with(['parentCategory'=> function($query){
            $query->with('parentCategory');
        }])
        ->get();

        $ref_id = null;
        $imageUploadList = imageUpload ::where('account_id',$account_id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
        return view('admin/product/category/add',compact('categoryList','imageUploadList'));
    }

    public function store(Request $request) {

        $input = $request->all();

        $rules = [
            'name' => 'required',
            'website_url_image' => 'required',
            'mobile_url_image' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $categoryGet = Category :: where('id',$input['ref_id'])->first();
            $level = isset($categoryGet->level) ? $categoryGet->level+1 : 1;

            if($level<4) {

                $input['account_id'] = Session::get('user')->id;
                $input['level'] = $level;
                unset($input['_token']);

                $category = Category::insert($input);
                if($category)
                {
                    return redirect('/admin/category');

                } else {

                    return back()->withErrors(['Something went wrong']);
                }

            } else {

                return back()->withErrors(['You can select max 3rd level of category']);

            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function show(Category $category) {
        //
    }

    public function edit(Category $category) {

        $account_id = Session::get('user')->id;
        $categoryList = Category ::where('account_id',$account_id)->with(['parentCategory'=> function($query){
            $query->with('parentCategory');
        }])
        // ->where('level','<', $category->level)
        ->get();

        $ref_id = null;
        $imageUploadList = imageUpload ::where('account_id',$account_id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();

        return view('admin/product/category/edit',compact('category','categoryList','imageUploadList'));
    }

    public function update(Request $request, Category $category) {

        $input = $request->all();

         $rules = [
            'name' => 'required',
            'website_url_image' => 'required',
            'mobile_url_image' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
           
            $categoryGet = Category :: where('id',$input['ref_id'])->first();
            $level = isset($categoryGet->level) ? $categoryGet->level+1 : 1;
            
            if($level<4) {

                $input['level'] = $level;
                $input['account_id'] = Session::get('user')->id;

                unset($input['_token']);
                unset($input['_method']);

                $category = Category::where('id',$category->id)->update($input);
                if($category)
                {
                    return redirect('/admin/category');

                } else {

                    return back()->withErrors(['Something went wrong']);
                }

            } else {
                
                return back()->withErrors(['You can select max 3rd level of category']);

            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function destroy(Category $category) {

        $result = $category->delete();
        if($result == 1) {

            return redirect('/admin/category');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
