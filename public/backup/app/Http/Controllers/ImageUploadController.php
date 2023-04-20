<?php

namespace App\Http\Controllers;

use App\Models\imageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use File;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $account_id = Session::get('user')->id;
       
        $ref_id = $request->get('ref_id');
        if($ref_id == 0) {
            
            $ref_id = null;
        }
        
        $imageUploadList = imageUpload ::where('account_id',$account_id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
        return view('admin/product/imageUpload/index',compact('imageUploadList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account_id = Session::get('user')->id;
        $input = $request->all();
        $ref_id = $input['ref_id'];

        $image_extension = $request->file('image')->getClientOriginalExtension();
        $image_name = uniqid() . '.' . $image_extension;

        if($ref_id == 0)
        {
            $ref_id = null;
            $image_path = public_path('assets/images/manageImages/'.$account_id);
            $imagePath = 'assets/images/manageImages/'.$account_id.'/'.$image_name;

        } else {

            $folder = imageUpload ::where('account_id',$account_id)->where('id',$ref_id)->first();
            $folderName = $folder->name;
            $image_path = public_path('assets/images/manageImages/'.$account_id.'/'.$folderName);
            $imagePath = 'assets/images/manageImages/'.$account_id.'/'.$folderName.'/'.$image_name;
        }

        $imageUploaded = $input['image']->move($image_path, $image_name);
        $resultResponse = imageUpload::insert(['account_id' => $account_id,'mediaType'=> 2,'ref_id' => $ref_id, 'name' =>  $imagePath]);
        return 1;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\imageUpload  $imageUpload
     * @return \Illuminate\Http\Response
     */
    public function show(imageUpload $imageUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\imageUpload  $imageUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(imageUpload $imageUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\imageUpload  $imageUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, imageUpload $imageUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\imageUpload  $imageUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(imageUpload $imageUpload)
    {
        //
    }

    public function createFolder(Request $request)
    {
        $input = $request->input();
        $newFolder = $input['data']['folderName'];
        $ref_id = $input['data']['ref_id'];
        if($ref_id == 0)
        {
            $ref_id = null;
        }
        $account_id = Session::get('user')->id;
        $basePath = public_path('assets/images/manageImages/').$account_id;
        
        if(!File::isDirectory($basePath)) {

            $result = File::makeDirectory($basePath);
        }

        $newFolderPath = $basePath.'/'.$newFolder;

        if(!File::isDirectory($newFolderPath)) {

            $result = File::makeDirectory($newFolderPath);
            
            $resultResponse = imageUpload::insert(['account_id' => $account_id,'mediaType'=> 1,'ref_id' => $ref_id, 'name' =>  $newFolder]);

            return 1;

        } else {

            return 0;
        }
        
    }

    public function folderImage(Request $request)
    {
        $account_id = Session::get('user')->id;
       
        $ref_id = $request->get('ref_id');
        if($ref_id == 0)
        {
            $ref_id = null;
            $imageUploadList = imageUpload ::where('account_id',$account_id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();

        } else {

            $imageUploadList = imageUpload ::where('account_id',$account_id)->where('ref_id',$ref_id)->where('mediaType',2)->orderBy('id', 'DESC')->get();
        }
        
        return response()->json($imageUploadList, 200);
    }
    
}
