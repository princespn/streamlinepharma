@extends('layouts.app')

@section('pageTitle')

    <h4 class="page-title"> <i class="dripicons-list"></i> Product Order listing</h4>

@endsection
<?php
$shippingMethodArray = array(
    '',
    'Shipyaari',
    'Others',
    'Shiprocket'
);
?>
@section('contentData')
{!! Form::open(['id'=>'formFilter','method'=>'GET']) !!}
<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-4 form-group">
        <select class="form-control" name="status">
            <option value="">Select Status</option>
            <!-- <option value="1">Ordered</option> -->
            <option value="4">Delivered</option>
            <option value="18">Cancel</option>
            <option value="9">Reverse</option>
            <option value="19">Replcament</option>
            <option value="1">Fresh Acceptance</option>
            <option value="2">Generate Order</option>
        </select>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-4 form-group">
    <button type="submit" id="" class="btn btn-primary" >Filter</button>
    </div>
</div>
{!! Form::close() !!}
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                
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
                                                    @if($orderDetail->offerDescription)
                                                    <span class='offer'><strong>Offer Applied - </strong>{{ $orderDetail->offerDescription }}</span><br>
                                                    @endif
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
                                    <strong>Shipped By </strong>{{ ( $order->courierType!='' ? $shippingMethodArray[$order->courierType] : 'Not Shipped' ) }}<br>
                                        {{$order->orderNo}}
                                        <br>
                                        {{$order->transactionId}} <br>
                                        {{ date('d-m-Y h:m a', strtotime($order->created_at)) }}
                                        <br>
                                        
                                        @if($order->orderAcceptance==1)
                                            @if($order->shipyaariOrder)

                                                @if($order->orderStatus == 1)

                                                    @if($order->courierType == 1)
                                                        <strong>Shipyaari Status : </strong>{{json_decode($order->shipyaariOrder,true)['status']?? '' }}<br>
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
                                            @elseif($order->shipRocketOrder)
                                            <a href='{{ url("admin/shiprocketTrack/".$order->orderNo) }}' target='_blank'>Track your order</a><br>
                                              @if($order->shiprocketPickUpRequest==Null)
											   <a href='{{ url("admin/shiprocketPickUpRequest/".$order->orderNo) }}' >Request Pick Up</a>   
											  @else
                                               <a href='{{ url("admin/getShipRocketlabel/".$order->orderNo) }}' target='_blank'>Print Label</a>
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
                                        @if($order->shipyaariAvailability!=''&& isset(json_decode($order->shipyaariAvailability,true)[0]['total']) )
                                        Shipyaari Charge : {{ json_decode($order->shipyaariAvailability,true)[0]['total'] }}<br>
                                        @endif
										
										
									  @if($order->shiprocketAvailability!=''&&$order->shiprocketAllPrices==Null)
										  @php try{ @endphp
                                        Shiprocket Charge : {{ json_decode($order->shiprocketAvailability,true)['data']['available_courier_companies'][0]['rate'] }}<br>
										@if(count(json_decode(Session::get('user')->shiprocketPickupLocationAll))>1&&$order->shiprocketAvailabilityPayLoad!=Null)
											<br>
											<a href='{{ url("admin/calculatePriceForAllPin/".$order->orderNo) }}' type='button' class='btn btn-sm btn btn-outline-success'>Calculate Price for Other Location</a>
											<br>
											@endif
											@php }catch(Exception $e){ echo 'Something went wrong'; } @endphp	
										
									
									<br>
                                        @endif
                                                            <div class="form-group">
                                                                <select name="courierType" class="form-control" onchange="courierTypes(this.value,{{$order->orderNo}})">
                                                                    <option value="">Courier Type</option>
                                                                    <option value="1">Shipyaari</option>
                                                                    <option value="3">Shiprocket </option>
                                                                    <option value="2">Others</option>
                                                                </select>
                                                            </div>
                                        @if($order->shiprocketAllPrices!=Null)
										
									  
										<div class="form-group" class='shiprocketAllPrices' id='shiprocketAllPrices{{$order->orderNo}}' style='display:none'>
										Shiprocket Charge :<br>
                                                                <select name="shiprocketAllPrices" class="form-control" >
                                                                    @foreach(json_decode($order->shiprocketAllPrices,true) as $ship_prices)
                                        {!! $ship_prices['data'] !!}
                                                                    <option value="{{ $ship_prices['pickup_location'] }}">{!! $ship_prices['data'] !!}</option>
																	@endforeach
 
                                                                </select>
                                                            </div>
															@endif
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
                                          @if($order->transactionType==2)
                                            <br>
                                            <button type='button'  class='btn btn-xs btn-primary' data-toggle="modal" data-target="#initiatePaymentModal" onclick='refundInitiate({{$grandTotal-($order->coupon_amount?$order->coupon_amount:0)}},"{{ $order->transactionId }}","{{ $order->id }}")' id='refund_btn_{{ $order->id }}' @if($order->refund_status==1) disabled @endif >
                                            @if($order->refund_status==1)
                                                Refund Initiated
                                            @else
                                                Refund Amount - {{$grandTotal-($order->coupon_amount?$order->coupon_amount:0)}}
                                            </button>
                                            @endif
                                            @endif
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
            </div>
        </div>
    </div>
    <!------------------------------------------>
    <div class="modal" id="initiatePaymentModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Refund Form</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group">
                <label for="email">Refund Reason:</label>
                <select class="form-control" id='refund_reason'>
                   <option value='RFD'>Duplicate/delayed payment</option>
                   <option value='TNR'>Product/service no longer available</option>
                   <option value='QFL'>Customer not satisfied</option>
                   <option value='QNR'>Product lost/damaged</option>
                   <option value='EWN'>Digital download issue</option>
                   <option value='TAN'>Event was canceled/changed</option>
                   <option value='PTH'>Problem not described above</option>
                </select>
            </div>
            <div class="form-group">
                <input id='refund_id' type='hidden'>
                <input id='refund_amount' type='hidden'>
                <input id='refund_pr_id' type='hidden'>
                <input id='csrf_token' value='{{ csrf_token() }}' type='hidden'>
                <button type='button' class='btn btn-primary' onclick='initiateRefund()'>Initiate Refund</button>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    <!------------------------------------------>
@endsection