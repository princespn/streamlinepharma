<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\SliderApproval;
use Illuminate\Http\Request;

class SliderApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderList = Slider::with('account')->where('status',1)->where('qc',1)->get();

        return view('supperAdmin/sliderApproval/index',compact('sliderList'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SliderApproval  $sliderApproval
     * @return \Illuminate\Http\Response
     */
    public function show(SliderApproval $sliderApproval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SliderApproval  $sliderApproval
     * @return \Illuminate\Http\Response
     */
    public function edit(SliderApproval $sliderApproval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SliderApproval  $sliderApproval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SliderApproval $sliderApproval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SliderApproval  $sliderApproval
     * @return \Illuminate\Http\Response
     */
    public function destroy(SliderApproval $sliderApproval)
    {
        //
    }

    public function sliderApprovalConfirm(Request $request,$sliderId)
    {
        $approval = Slider::find($sliderId);
        if($approval) {

            $approval->qc = 0;
            $approval->save();
            return redirect('/admin/sliderApproval');

        } else {
            return back()->withErrors(['Slider not found.']);
        }
    }
}
