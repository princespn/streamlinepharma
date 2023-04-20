@extends('layouts.app')  

@section('pageTitle')
    

    <h4 class="page-title"> <i class="dripicons-user-group"></i>Customer Account Detail</h4>

@endsection

@section('contentData')
<style>
    .cust-address {
        width: 100%;
        float: left;
    }

    .cust-address>li {
        width: 47%;
        float: left;
        border: 1px solid;
        border-radius: 10px;
        padding: 14px;
        margin: 5px;
        list-style: none;
    }
</style>
    <div class="row" style='margin-top:50px'>

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">
                      <strong>{{ $account->title }}  </strong><br>
                      <strong>Mobile : </strong>{{ $account->phone }}<br>
                      @if($account->email)
                      <strong>Email : </strong>{{ $account->email }}<br>
                      @endif
                      @if($account->name)
                      <strong>Name : </strong>{{ $account->name }}<br>
                      @endif
                     
                </div>
				<ul class="nav nav-tabs">
					<li class="nav-item">
					  <a class="nav-link active" data-toggle="tab" href="#detail">Address</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" data-toggle="tab" href="#order">Order List</a>
					</li>
                    <li class="nav-item">
					  <a class="nav-link" data-toggle="tab" href="#offer">Offer</a>
					</li>
					
				  </ul>
				  <div class="tab-content">
					<div id="detail" style='max-width: 100%;' class="container tab-pane active"><br>
                    @if(isset($address) && $address->count()>0)
                    <ul class="cust-address" id="oldAddress">
                        @foreach ($address as $add)
                        <li id="{{$add->id}}">
                            {{$add->name}} ,<br />{{$add->phone}} ,<br />{{$add->landmark}} ,<br />{{$add->address}},<br /> {{$add->zipCode}}<br/>
                        </li>
                        @endforeach
                    </ul>
                    @endif
					</div>
					<div id="order" style='max-width: 100%;' class="container tab-pane">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image & Order Details</th>
                                <th>Order Name & Amt.</th>
                                <th>User Details</th>
                            </tr>
                        </thead>
                        @foreach ($orderList as $order)
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="width: 100%;">
                                            @php 
                                                $grandTotal = 0;
                                            @endphp

                                            @foreach ($order->orderDetails as $orderDetail)

                                            @php 
                                                $totalAmt = 0; 
                                                $totalTax = 0;
                                                $totalShipping = 0;
                                            @endphp
                                                <tbody>
                                                    <tr>
                                                        <td style="width:50px;border-right: 0px;border-top: 0px;">
														@if($orderDetail->imageURL0)
                                                            <img src="{{URL::asset( $orderDetail->imageURL0) }}" style="height: 100px;">
															@endif
                                                        </td>
                                                        <td style="border-top: 0px;">
                                                            {{ $orderDetail->productName }} <br>
                                                            {{$orderDetail->sku}} <br>
                                                            
                                                            @if($orderDetail->affiliate_id)
                                                            
                                                                Affiliation Order <br>
                                                            
                                                            @endif
                                                            
                                                            @if($orderDetail->variation0)
                                                            
                                                                {{ $orderDetail->variation0 }} <br>
                                                            
                                                            @endif
                                                            
                                                            @if($orderDetail->variation1)
                                                            
                                                                {{$orderDetail->variation1}} <br>
                                                            
                                                            @endif
                                                            
                                                            @if($orderDetail->variation2)
                                                            
                                                                {{$orderDetail->variation2}} <br>
                                                            
                                                            @endif
                                                            
                                                            @if($orderDetail->variation3)
                                                            
                                                                {{$orderDetail->variation3}} <br>
                                                            
                                                            @endif
                                                            
                                                            @if($orderDetail->variation4)
                                                            
                                                                {{$orderDetail->variation4}}
                                                            
                                                            @endif
                                                        </td>

                                                        <td style="border-top: 0px;width: 40%;">
                                                            @php 

                                                                if($orderDetail->orderOffers) {

                                                                    if($orderDetail->price >= $orderDetail->orderOffers->offer->cartMinValue)
                                                                    {
                                                                        $basePrice = $orderDetail->price - ($orderDetail->price * $orderDetail->orderOffers->offer->discount / 100);
                                                                    } else {
                                                                        $basePrice = $orderDetail->price;
                                                                    }

                                                                } else {
                                                                    $basePrice = $orderDetail->price;
                                                                }

                                                                $totalAmt += ($orderDetail->qty) * ($basePrice);
                                                                $totalTax += ($orderDetail->qty) * ($basePrice * $orderDetail->tax /100);
                                                                $totalShipping += ($orderDetail->qty) * ($orderDetail->shipping);

                                                                $grandTotal += $totalTax + $totalAmt + $totalShipping;
                                                            @endphp

                                                            Price :  
                                                                @if($orderDetail->orderOffers)
                                                                    Rs. {{number_format($basePrice,2)}}
                                                                        <sub><del>{{number_format($orderDetail->price,2)}}</del></sub>
                                                                @else
                                                                    Rs. {{number_format($orderDetail->price,2)}}
                                                                @endif
                                                            <br>

                                                            Qty : {{$orderDetail->qty}}<br>
                                                            Sub Total : Rs. {{$totalAmt}}<br>
                                                            Tax ({{$orderDetail->tax}} %) : Rs. {{$totalTax}}<br>
                                                            Shipping : Rs. {{$totalShipping}}<br>
                                                            Net Total: Rs. {{$totalAmt + $totalTax + $totalShipping}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                            
                                            <tfoot>
											@if($order->coupon_code)
                                        <tr>
                                            <td style="border-top: 0px;" colspan="2"></td>
                                            <td>
                                            <div>Coupon Code: {{$order->coupon_code}}</div>
                                                <div>Discount: Rs.{{$order->coupon_amount}}</div>
                                            </td>
                                        </tr>
                                        @endif
                                                <tr>
                                                    <td style="border-top: 0px;" colspan="2"></td>
                                                    <td>Grand Total : {{$grandTotal-($order->coupon_amount?$order->coupon_amount:0)}}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                    <td>
                                        {{$order->orderNo}}
                                        <br>
                                        {{$order->transactionId}} <br>
                                        {{ date('d-m-Y h:m a', strtotime($order->created_at)) }}
                                        <br>
                                        
                                        @if($order->orderAcceptance==1)
                                            @if($order->shipyaariOrder)

                                                @if($order->orderStatus == 1)

                                                    @if($order->courierType == 1)
                                                        <a href="https://seller.shipyaari.com/avn_ci/siteadmin/track/trackShipment/{{json_decode($order->shipyaariOrder,true)['tracking_number']?? '' }}" target="_blank">
                                                            Track your order
                                                        </a>
                                                        <br>
                                                        <a href="{{json_decode($order->shipyaariOrder,true)['shipment_label']?? '' }}" target="_blank">
                                                            Print Order
                                                        </a>
                                                    @else
                                                    
                                                        @php 
                                                            $courier = explode('#@#',$order->shipyaariOrder);
                                                        @endphp
                                                        
                                                        @if(sizeof($courier) > 0)
                                                            <a href="#!">Traking Number :- {{(isset($courier[1])?$courier[1]:'')}}</a><br>
                                                            <a href="{{(isset($courier[0])?$courier[0]:'')}}" target="_blank">
                                                                Track your order
                                                            </a>
                                                        @endif
                                                        
                                                        <br>
                                                        <a href="{{url("admin/updateOrderStatus/".$order->orderNo)}}">
                                                            Is order delivered?
                                                        </a>
                                                        
                                                    @endif

                                                @endif

                                                @if($order->orderStatus == 4) 
                                                    <a href="#!">Order delivered</a>
                                                @endif

                                                @if($order->orderStatus == 18) 
                                                    <a href="#!">Order canceled</a>
                                                @endif

                                                @if($order->orderStatus == 9) 
                                                    <a href="#!">Order returned</a>
                                                @endif

                                                @if($order->orderStatus == 19) 
                                                    <a href="#!">Order replaced</a>
                                                @endif

                                                <br>
                                                <a href="{{url("admin/orderPrint/".$order->orderNo)}}">
                                                    Print PDF
                                                </a>

                                            @else                                        
                                            <a href="#!" data-toggle="modal" data-target=".generateOrder{{$order->orderNo}}">
                                                Generate Order
                                            </a>
                                            
                                            <div class="modal fade generateOrder{{$order->orderNo}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                <div class="modal-dialog modal-dialog-centered">
                                        
                                                    <div class="modal-content">
                                        
                                                        <div class="modal-header">
                                        
                                                            <h5 class="modal-title mt-0">Order Details</h5>
                                        
                                                            <button type="button" id="createFolder" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        
                                                        </div>

                                                        {!! Form::open(['route' => 'updateCourierDetails','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                                        {{ csrf_field() }}

                                                        <div class="modal-body">
                                        
                                                            <div class="form-group">
                                                                <select name="courierType" class="form-control" onchange="courierTypes(this.value,{{$order->orderNo}})">
                                                                    <option value="">Courier Type</option>
                                                                    <option value="1">Shipyaari</option>
                                                                    <option value="2">Others</option>
                                                                </select>
                                                            </div>
                                        
                                                            <span id="courierData{{$order->orderNo}}" style="display: none;">
                                                                <div class="form-group">
                                                                    <input type="text" name="courierLink" class="form-control" placeholder="Courier link"/>
                                                                </div>
                                            
                                                                <div class="form-group">
                                                                    <input type="text" name="courierTracking" class="form-control" placeholder="Courier tracking number"/>
                                                                </div>
                                                            </span>
                                                            
                                                        </div>
                                        
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="orderNo" class="form-control" value="{{$order->orderNo}}"/>
                                                            <button type="submit" class="btn btn-outline-danger">Submit</button>
                                                        </div>
                                                        {!! Form::close() !!} 
                                                    </div>
                                        
                                                </div>
                                        
                                            </div>
                                            @endif

                                        @elseif($order->orderAcceptance==0)
                                            <a href="{{url("admin/orderAcceptance/".$order->orderNo)}}">
                                                Accept order
                                            </a>
                                            <br>
                                            <a href="{{url("admin/orderReject/".$order->orderNo)}}">
                                                Reject order
                                            </a>
                                        @elseif($order->orderAcceptance==2)
                                            <a href="#!">
                                                Order Rejected
                                            </a>
                                        @endif
                                        
                                    </td>
                                    <td style="width: 25%;">
                                        {{$order->name}} <br>
                                        {{$order->phone}} <br>
                                        {{$order->email}} <br>
                                        {{$order->landmark}} <br>
                                        {{$order->address}} <br>
                                        {{$order->zipCode}}
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
					</div>
                    <div id="offer" style='max-width: 100%;' class="container tab-pane">

                 <ul class="nav nav-tabs">
                    <li class="nav-item">
					  <a class="nav-link active" data-toggle="tab" href="#SaleX">SaleX</a>
					</li>
				  </ul>
                  <div id="SaleX" style='max-width: 100%;' class="container tab-pane">
				@if($coupon)  
                @php $json = json_decode($coupon->template_array,true); @endphp
                <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Scheme Name</th>
                    <th>Set Number </th>

                    @foreach($json as $key=>$json_view)
                    <th>{{$otherdata->template($json_view['template'])}}  </th>
                    <th> Referral Benefits  </th>
                    <th> Referee Benefits  </th>
                    
                    @endforeach
                   
                   
                   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>{{$coupon->scheme_name}}</td>
                    <td>{{$coupon->number_of_set}}</td>
                  
                    @foreach($json as $key=>$json_view)
                        @php
                            $coupon=explode(',',$json_view['coupon_code'][$no]);
                            $cdata=$otherdata->findCuopan($coupon);
                        @endphp

                        <td>
                        @foreach($cdata as $k=> $coupon_data)
                       
                        <span class="badge badge-secondary">

                                                @if($otherdata->usettime($coupon_data->coupon) > 0)
                                                      <del>{{$coupon_data->coupon}} </del>
                                                @else
                                                      {{$coupon_data->coupon}}
                                                @endif 
                        </span>
                      
                        @endforeach
                        </td>
                        
                        <td>{{$json_view['refferal_benifit']}}</td>
                        <td>{{$json_view['refree_benifit']}}</td>
                      
                    @endforeach
                    </tr>
                 
                </tbody>
                </table>
				@endif
                    </div>
                    </div>
				  </div>
            </div>
        </div>
    </div>
@endsection