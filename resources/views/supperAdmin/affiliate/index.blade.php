@extends('layouts.app')

@section('pageTitle')
    @if(Session::get('userType')==1)
        @if(Session::get('user')->id == 1)  
            <div class="float-right">            
                <a href="{{route('affiliate.create')}}" class="btn btn-outline-light">
                    Add affiliate
                </a>            
            </div>
        @endif
    @elseif(Session::get('userType')==3)
        @php
            $restrictionArray = Session::get('restrictions');
            $add = 0;   
            $edit = 0;          
            foreach($restrictionArray as $key => $value)
            {
                $action_id = $value["action_id"];
                if($action_id == 2){
                    $add = 1;
                }  
                if($action_id == 3){
                    $edit = 1;
                }                                          
            } 
        @endphp
        @if($add == 1)
            <div class="float-right">                        
                <a href="{{route('affiliate.create')}}" class="btn btn-outline-light">
                    Add affiliate
                </a>
            </div>
        @endif
    @endif
    <h4 class="page-title"> <i class="dripicons-user-group"></i> Affiliate listing</h4>

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
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Commission</th>
                                        <th>Status</th>
                                    @endif
                                @elseif(Session::get('userType')==3)
                                   
                                    @if($edit == 1)
                                        <th>#</th>
                                    @endif                                                                          
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Commission</th>
                                    <th>Status</th>
                                @endif           
                            </tr>
                        </thead>
                        <tbody>
                            @if(Session::get('userType')==1)
                                @if(Session::get('user')->id == 1)  
                                    @foreach ($affiliateList as $key=>$affiliate)
                                        <tr>
                                            <td>                                    
                                                <!--Edit Icon-->
                                                <a href="{{ URL::to('admin/affiliate/'. $affiliate->id.'/edit') }}">
                                                    <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                                </a>
                                            </td>
                                            <td>{{$affiliate->code}}</td>
                                            <td>{{$affiliate->name}}</td>
                                            <td>{{$affiliate->phone}}</td>
                                            <td>{{$affiliate->email}}</td>
                                            <td>{{$affiliate->address}}</td>
                                            <td>{{$affiliate->commission}}</td>
                                            <td>
                                                @switch($affiliate->status)
                                                    @case(1)                                                        
                                                        <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active
                                                    @break
                                                    @default                                                    
                                                        <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive
                                                @endswitch
                                            </td>                                            
                                        </tr>
                                    @endforeach
                                @endif
                            @elseif(Session::get('userType')==3)                             
                                @foreach ($affiliateList as $key=>$affiliate)
                                    <tr>
                                        @if($edit == 1)
                                            <td>                                    
                                                <!--Edit Icon-->
                                                @if($edit == 1)
                                                    <a href="{{ URL::to('admin/affiliate/'. $affiliate->id.'/edit') }}">
                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                                    </a>
                                                @endif
                                            </td> 
                                        @endif                                      
                                        <td>{{$affiliate->code}}</td>
                                        <td>{{$affiliate->name}}</td>
                                        <td>{{$affiliate->phone}}</td>
                                        <td>{{$affiliate->email}}</td>
                                        <td>{{$affiliate->address}}</td>
                                        <td>{{$affiliate->commission}}</td>
                                        <td>
                                            @switch($affiliate->status)
                                                @case(1)                                                    
                                                    <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active
                                                @break
                                                @default                                                
                                                    <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive
                                            @endswitch
                                        </td>                                       
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