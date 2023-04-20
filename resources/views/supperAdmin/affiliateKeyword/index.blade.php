@extends('layouts.app')

@section('pageTitle')
    @if(Session::get('userType')==1)
        @if(Session::get('user')->id == 1)  
            <div class="float-right">
                <a href="{{route('affiliateKeyword.create')}}" class="btn btn-outline-light">
                    Add affiliate keyword
                </a>
				 <a href="{{route('reviewkey')}}" class="btn btn-outline-light">
                    Review affiliate keyword
                </a>
            </div>
        @endif
    @elseif(Session::get('userType')==3)
        @php
            $restrictionArray = Session::get('restrictions');
            $add = 0;
            $edit = 0;                                        
            $delete = 0;             
            foreach($restrictionArray as $key => $value)
            {
                $action_id = $value["action_id"];
                if($action_id == 2){
                    $add = 1;
                } 
                if($action_id == 3){
                    $edit = 1;
                }                                           
                if($action_id == 4){
                    $delete = 1;
                }                                           
            } 
        @endphp
        @if($add == 1)
            <div class="float-right">
                <a href="{{route('affiliateKeyword.create')}}" class="btn btn-outline-light">
                    Add affiliate keyword
                </a>
            </div>
        @endif
    @endif
    <h4 class="page-title"> <i class="dripicons-checklist"></i> Affiliate Keyword listing</h4>
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
                                        <th>Keyword</th>
                                        <th>Status</th>
                                    @endif
                                @elseif(Session::get('userType')==3)
                                    {{-- @php
                                        $restrictionArray = Session::get('restrictions');
                                        $edit = 0;                                        
                                        $delete = 0;                            
                                        foreach($restrictionArray as $key => $value)
                                        {
                                            $action_id = $value["action_id"];                                            
                                            if($action_id == 3){
                                                $edit = 1;
                                            }                                           
                                            if($action_id == 4){
                                                $delete = 1;
                                            }
                                        }                  
                                    @endphp --}}
                                    @if($edit == 1  || $delete == 1 )
                                        <th>#</th>
                                    @endif
                                    <th>Keyword</th>
                                    <th>Status</th>
                                @endif  
                            </tr>
                        </thead>
                        <tbody>
                            @if(Session::get('userType')==1)
                                @if(Session::get('user')->id == 1)  
                                    @foreach ($affiliateKeywordList as $key=>$affiliateKeyword)
                                        <tr>
                                            <td>                                                
                                                <!--Delete Popup-->
                                                <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$affiliateKeyword->id}}" title="Delete this data"></i>

                                                <div class="modal fade deletePopup{{$affiliateKeyword->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mt-0">{{$affiliateKeyword->keyword}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure want to delete this?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{ Form::open(array('url' => 'admin/affiliateKeyword/' . $affiliateKeyword->id)) }}
                                                                {{ Form::hidden('_method', 'DELETE') }}
                                                                    <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Edit Icon-->
                                                <a href="{{ URL::to('admin/affiliateKeyword/'. $affiliateKeyword->id.'/edit') }}">
                                                    <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                                </a>
                                            </td>
                                            <td>{{$affiliateKeyword->keyword}}</td>
                                            <td>
                                                @switch($affiliateKeyword->status)
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
                                @foreach ($affiliateKeywordList as $key=>$affiliateKeyword)
                                    <tr>
                                        @if($edit == 1  || $delete == 1 )
                                            <td>
                                            
                                                <!--Delete Popup-->
                                                @if($delete == 1)
                                                    <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$affiliateKeyword->id}}" title="Delete this data"></i>

                                                    <div class="modal fade deletePopup{{$affiliateKeyword->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0">{{$affiliateKeyword->keyword}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure want to delete this?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    {{ Form::open(array('url' => 'admin/affiliateKeyword/' . $affiliateKeyword->id)) }}
                                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                                        <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                                    {{ Form::close() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!--Edit Icon-->
                                                @if($edit == 1)
                                                    <a href="{{ URL::to('admin/affiliateKeyword/'. $affiliateKeyword->id.'/edit') }}">
                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        @endif
                                        <td>{{$affiliateKeyword->keyword}}</td>
                                        <td>
                                            @switch($affiliateKeyword->status)

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