@extends('layouts.app')

@section('pageTitle')
<style>
    button { padding:5px;}
</style>

<div class="float-right">
   
	<a href="{{url('admin/four_sale_x')}}" class="btn btn-outline-light">
        Add
    </a>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Sale X</h4>

@endsection

@section('contentData')

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        @if($errors->any())
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            {{$errors->first()}}
                        </div>
                        @endif
                    </div>
                </div>

                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Scheme Name </th>
                            
                            <th>Template / Number of Coupon <span class="badge badge-success">Fresh</span> <span class="badge badge-danger">Assign</span> / Refferal Benifit /  Refree Benifit</th>
                            <th>No Set</th>
                           
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        
                    @foreach ($data as $key=>$view)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$view->scheme_name}}</td>
                            <td>
                                <table class="table table-bordered">
                                <tr>
                                @foreach (json_decode($view->template_array) as $key=>$templateview) 
                                
                                        <td>
                                           <center><b>{{$otherdata->template($templateview->template)}}</b></center>
                                            @php
                                                $count=1;
                                                $coupon=explode(',',$templateview->coupon_code);
                                                $cdata=$otherdata->findCuopan($coupon);
                                            @endphp
                                         
                                            @foreach($cdata as $k=> $coupon_data) 
                                            @php $row=($k+1); $number_of_coupon=$templateview->number_of_coupon; @endphp 
                                            @if($row % $number_of_coupon =='1') 
                                            <button type="button" class="btn btn-outline-primary btn-sm" style="width:50px;">
                                            {{$count}}  
                                            </button>
                                            
                                            @endif
                                            <button type="button" class="btn btn-outline-success btn-sm" data-container="body" data-toggle="popover" data-placement="top"  {{($coupon_data->send_to != '')? 'data-content='.$coupon_data->send_to.'' : ''}} style="width:100px;">    
                                            <sapn class="badge {{($coupon_data->send_to != '')? 'badge-danger' : 'badge-success'}}"> {{$coupon_data->coupon}} </sapn>
                                            </button> 
                                            
                                            @if($row % $number_of_coupon =='0') <br/> @php $count++ @endphp  @endif
                                                        @endforeach
                                           

                                        </td>
                                @endforeach 
                                        <td width="100px"><br/>
                                        <button type="button" class="btn btn-outline-primary btn-sm" style="width:150px;margin:2px">
                                        Refferal Benifit <span class="badge badge-light">{{$templateview->refferal_benifit}}</span>
                                        </button> <br/>
                                        <button type="button" class="btn btn-outline-info btn-sm" style="width:150px;margin:2px">
                                        Refree Benifit <span class="badge badge-light">{{$templateview->refree_benifit}}</span>
                                        </button>
                                        </td>
                                </tr>    
                                </table>  
                            </td> 
                            <td>{{$view->number_of_set}}</td>
                        </tr>
                    @endforeach 
                        
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection