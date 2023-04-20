@extends('layouts.app')
@section('pageTitle')
    <h4 class="page-title"> <i class="dripicons-list"></i> Product Approval listing</h4>
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
                                        <th>Domain</th>
                                        <th>SKU</th>
                                        <th>Product Name</th>                                
                                        <th>Image</th>
                                    @endif
                                @elseif(Session::get('userType')==3)
                                    @php
                                        $restrictionArray = Session::get('restrictions');
                                        $edit = 0;
                                        $Productapprove = 0;
                                        $sendMessage = 0;                          
                                        foreach($restrictionArray as $key => $value)
                                        {
                                            $action_id = $value["action_id"];                                            
                                            if($action_id == 3){
                                                $edit = 1;
                                            }
                                            if($action_id == 5){
                                                $Productapprove = 1;
                                            }
                                            if($action_id == 6){
                                                $sendMessage = 1;
                                            }
                                        }                  
                                    @endphp
                                    @if($edit == 1 || $Productapprove == 1 || $sendMessage == 1 )
                                        <th>#</th>
                                    @endif
                                    <th>Domain</th>
                                    <th>SKU</th>
                                    <th>Product Name</th>                                
                                    <th>Image</th>
                                @endif  
                            </tr>
                        </thead>
                        <tbody>
                            @if(Session::get('userType')==1)
                                @if(Session::get('user')->id == 1)  
                                    @foreach ($approvalList as $key=>$approval)
                                        @if($approval->product)
                                            <tr>
                                                <td>
                                                    <a href="//{{$approval->product->account->domain.'/detail?id='.$approval->id}}" target="_blank">
                                                        <i class="mdi mdi-eye btn btn-outline-success" title="Edit this data"></i>
                                                    </a>                                   
                                                
                                                    <a href="{{url("admin/productApprovalConfirm/".$approval->id)}}">
                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Approve Inventory"></i>
                                                    </a>                                    
                                                
                                                    <i class="mdi mdi-message btn btn-outline-warning" data-toggle="modal" data-target="#myModal{{$approval->id}}" title="Send Message"></i>

                                                    {!! Form::open(['route' => 'productApprovalQcMSG','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                                    {{ csrf_field() }}

                                                    <div id="myModal{{$approval->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="myModalLabel">
                                                                        {{$approval->productName}} - {{$approval->sku}}
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <input type="hidden" name="inventory_id" class="form-control" value="{{$approval->id ?? ''}}" />
                                                                    <textarea name="description" class="summernote" required></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save to draft</button>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                    {!! Form::close() !!}
                                                    
                                                </td>
                                                <td>{{$approval->product->account->domain}}</td>
                                                <td>{{$approval->sku}}</td>
                                                <td>{{$approval->productName}}</td>
                                                <td><img src="{{URL::asset($approval->imageURL0)}}" class="d-flex align-self-end" height="30" width="50"></td>                                                                                                                   
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @elseif(Session::get('userType')==3)                         

                                @foreach ($approvalList as $key=>$approval)
                                    @if($approval->product)
                                        <tr>
                                            @if($edit == 1 || $Productapprove == 1 || $sendMessage == 1 )
                                                <td>
                                                    @if($edit == 1)
                                                        <a href="//{{$approval->product->account->domain.'/detail?id='.$approval->id}}" target="_blank">
                                                            <i class="mdi mdi-eye btn btn-outline-success" title="Edit this data"></i>
                                                        </a>                                   
                                                    @endif

                                                    @if($Productapprove == 1)
                                                        <a href="{{url("admin/productApprovalConfirm/".$approval->id)}}">
                                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Approve Inventory"></i>
                                                        </a> 
                                                    @endif                                   
                                                
                                                    @if($sendMessage == 1)
                                                        <i class="mdi mdi-message btn btn-outline-warning" data-toggle="modal" data-target="#myModal{{$approval->id}}" title="Send Message"></i>

                                                        {!! Form::open(['route' => 'productApprovalQcMSG','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                                        {{ csrf_field() }}

                                                        <div id="myModal{{$approval->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title mt-0" id="myModalLabel">
                                                                            {{$approval->productName}} - {{$approval->sku}}
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <input type="hidden" name="inventory_id" class="form-control" value="{{$approval->id ?? ''}}" />
                                                                        <textarea name="description" class="summernote" required></textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save to draft</button>
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                        {!! Form::close() !!}
                                                    @endif                                                
                                                </td>   
                                            @endif 
                                            <td>{{$approval->product->account->domain}}</td>
                                            <td>{{$approval->sku}}</td>
                                            <td>{{$approval->productName}}</td>
                                            <td><img src="{{URL::asset($approval->imageURL0)}}" class="d-flex align-self-end" height="30" width="50"></td>                                                                                                               
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection