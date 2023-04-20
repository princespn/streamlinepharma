<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Page;
use Validator;
use Carbon\Carbon;
use DateTime;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagesList = Page :: get();
        return view('supperAdmin/option/pages/index',compact('pagesList'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supperAdmin/option/pages/add');
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
            'url' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            unset($input['_token']);

            $pages = Page::insert($input);
           
            if($pages)
            {
                return redirect('/admin/page');

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
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('supperAdmin/option/pages/edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request, Page $page)
    {
        $input = $request->all();

        $rules = [
            'url' => 'required',
        ];
       
        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
        
            unset($input['_token']);
            unset($input['_method']);

            $pages = Page::where('id',$page->id)->update($input);

            if($pages)
            {
                return redirect('/admin/page');

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
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */

    public function destroy(Page $page)
    {
        $result = $page->delete();
        if($result == 1) {

            return redirect('/admin/page');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
