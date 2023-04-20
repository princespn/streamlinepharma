<?php

namespace App\Http\Controllers;

use App\Models\Msgnotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class MsgnotifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $msg = Msgnotify::where('account_id', $account_id)->get();
        return view('admin/msg/index', compact('msg'));
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
        $msgType = $request->input('msg_type');
        $found = Msgnotify::where('account_id', $account_id)->where('msg_type', $msgType)->count();
        if ($found) {
            Msgnotify::where('account_id', $account_id)->where('msg_type', $msgType)->update([
                'messages' => $request->input('messages'),
                'template_id' => $request->input('template_id'),
                'status' => $request->input('status')
            ]);
        } else {

            Msgnotify::create([
                'account_id' => $account_id,
                'messages' => $request->input('messages'),
                'msg_type' => $request->input('msg_type'),
                'template_id' => $request->input('template_id'),
                'status' => 1
            ]);
        }

        return back()->with(['message' => 'MSG Notification Created']);
    }

    public function msginfo(Request $request){
        $account_id = Session::get('user')->id;
        $msgType = $request->input('data');
        // var_dump($msgType['type']);
        $found =null;
        if(isset($msgType['type'])){
            $found = Msgnotify::where('account_id', $account_id)->where('msg_type', $msgType['type'])->first();
        }
        if($found){
            return response()->json(['status'=>'success','msg'=>$found->messages,'msgStatus'=>$found->status,'template_id'=>$found->template_id]);
        }else{
            return response()->json(['status'=>'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Msgnotify  $msgnotify
     * @return \Illuminate\Http\Response
     */
    public function show(Msgnotify $msgnotify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Msgnotify  $msgnotify
     * @return \Illuminate\Http\Response
     */
    public function edit(Msgnotify $msgnotify)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Msgnotify  $msgnotify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Msgnotify $msgnotify)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Msgnotify  $msgnotify
     * @return \Illuminate\Http\Response
     */
    public function destroy(Msgnotify $msgnotify)
    {
        //
    }
}
