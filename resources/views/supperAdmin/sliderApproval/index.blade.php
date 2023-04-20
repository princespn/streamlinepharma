@extends('layouts.app')
@section('pageTitle')
    <h4 class="page-title"> <i class="dripicons-list"></i> Slider listing</h4>
@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Domain</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliderList as $key=>$slider)
                                <tr>
                                    <td><img src="{{URL::asset($slider->imageURL)}}" class="d-flex align-self-end" height="30" width="50"></td>
                                    <td>{{$slider->account->domain}}</td>
                                    <td>
                                        <a href="{{url("admin/sliderApprovalConfirm/".$slider->id)}}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Regect Slider"></i>
                                        </a>                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection@extends('layouts.app')
@section('pageTitle')
    <h4 class="page-title"> <i class="dripicons-list"></i> Slider listing</h4>
@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                @if(Session::get('userType')==1)
                                    @if(Session::get('user')->id == 1)
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Domain</th>
                                    @endif
                                @elseif(Session::get('userType')==3)
                                    @php
                                        $restrictionArray = Session::get('restrictions');
                                        $rejectSlider = 0; 
                                        foreach($restrictionArray as $key => $value)
                                        {
                                            $action_id = $value["action_id"];
                                            
                                            if($action_id == 7){
                                                $rejectSlider = 1;
                                            }                                    
                                        }                                      
                                    @endphp
                                    @if($rejectSlider == 1)
                                        <th>#</th>
                                    @endif
                                    <th>Image</th>
                                    <th>Domain</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if(Session::get('userType')==1)
                                @if(Session::get('user')->id == 1)  
                                    @foreach ($sliderList as $key=>$slider)
                                        <tr>
                                            <td>
                                                <a href="{{url("admin/sliderApprovalConfirm/".$slider->id)}}">
                                                    <i class="mdi mdi-pencil btn btn-outline-primary" title="Regect Slider"></i>
                                                </a>                              
                                            </td>
                                            <td><img src="{{URL::asset($slider->imageURL)}}" class="d-flex align-self-end" height="30" width="50"></td>
                                            <td>{{$slider->account->domain}}</td>                                            
                                        </tr>
                                    @endforeach
                                @endif                                  
                            @elseif(Session::get('userType')==3)
                                {{-- @php
                                    $restrictionArray = Session::get('restrictions');
                                    $rejectSlider = 0; 
                                    foreach($restrictionArray as $key => $value)
                                    {
                                        $action_id = $value["action_id"];
                                        
                                        if($action_id == 7){
                                            $rejectSlider = 1;
                                        }                                    
                                    } 
                                @endphp --}}
                                @foreach ($sliderList as $key=>$slider)
                                    <tr>
                                        @if($rejectSlider == 1)
                                            <td>
                                                @if($rejectSlider == 1)
                                                    <a href="{{url("admin/sliderApprovalConfirm/".$slider->id)}}">
                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Regect Slider"></i>
                                                    </a>
                                                @endif                         
                                            </td>
                                        @endif
                                        <td><img src="{{URL::asset($slider->imageURL)}}" class="d-flex align-self-end" height="30" width="50"></td>
                                        <td>{{$slider->account->domain}}</td>                                        
                                    </tr>
                                @endforeach           
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection