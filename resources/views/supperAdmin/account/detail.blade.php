@extends('layouts.app')  

@section('pageTitle')
    

    <h4 class="page-title"> <i class="dripicons-user-group"></i> Account Detail</h4>

@endsection

@section('contentData')

    <div class="row" style='margin-top:50px'>

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">
                      <strong>{{ $account->title }}  </strong><a href='{{ url("admin/account/".$account->id."/edit") }}'><i class="mdi mdi-pencil" title="Edit this data"></i></a><br>
                      <strong>Mobile : </strong>{{ $account->phone }}<br>
                      <strong>Email : </strong>{{ $account->email }}<br>
                      <strong>Domain : </strong>{{ $account->domain }}<br>
                     
                </div>
				
				               @if($errors->any())

                                    <div class="alert bg-danger text-white msgPopup" role="alert">

                                    {{$errors->first()}}

                                    </div>

                                @endif
				
				
				<ul class="nav nav-tabs">
					<li class="nav-item">
					  <a class="nav-link active" data-toggle="tab" href="#detail">Details</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" data-toggle="tab" href="#ledger">Ledger</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" data-toggle="tab" href="#order">Order List</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" data-toggle="tab" href="#user">User List</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" data-toggle="tab" href="#gateways">Gateways</a>
					</li>
				  </ul>
				  <div class="tab-content">
					<div id="detail" style='max-width: 100%;min-height: 600px;' class="container tab-pane active"><br>
					     <table  class="table table-bordered">
						   <thead>
							  <tr>
								 <th>Email</th>
								 <td>{{$account->email}}</td>
							  </tr>
							  <tr>
								 <th>Domain Name</th>
								 <td>{{$account->domain}}</td>
							  </tr>
							  <tr>
								 <th>WhatsApp Number</th>
								 <td>{{$account->whatsApp}}</td>
							  </tr>
							  <tr>
								 <th>Address</th>
								 <td>{{$account->address}}</td>
							  </tr>
							  <tr>
								 <th>Default Currency</th>
								 <td>
									{{ ($account->currency ? $account->currency->title : '')
									}}
								 </td>
							  </tr>
							  <tr>
								 <th>Website Type</th>
								 <td>
									@switch($account->type)
									@case(1)
									E-Commerce
									@break
									@case(2)
									Hybrid
									@break
									@default
									Inquiry
									@endswitch
								 </td>
							  </tr>
							  <tr>
								 <th>Theme Number</th>
								 <td>
									@switch($account->theme)
									@case(1)
									Theme 1
									@break
									@case(2)
									Theme 2
									@break
									@default
									Theme 3
									@endswitch    
								 </td>
							  </tr>
							  <tr>
								 <th>Theme Color</th>
								 <td>{{$account->color}}</td>
							  </tr>
							  <tr>
								 <th>Charge in %</th>
								 <td>{{$account->charge}}</td>
							  </tr>
							  <tr>
							     <th>Password</th>
							     <td>
								 {{ Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
								  <div class="input-group">
									 <input type="text" class="form-control col-md-6" placeholder="type password or genrate" id='password' name='password' required>
									   <div class="input-group-prepend">
										<button class='input-group-text' onclick='generatePassword()' type='button'>Generate</button>
									  </div>
									  <input type='hidden' name='actionType' value='passwordUpdate'>
									  <button style='margin-left:20px'  class='btn btn-primary'>Update Password</button>
									</div>
									{!! Form::close() !!}
								  </td>
							  </tr>
                              <tr>
							     <th>Chat Enable</th>
							     <td>
								 {{ Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
								  <div class="input-group">
									 <input type="checkbox"id='chat_enable' name='chat_enable' {{$account->chat_enable=='1' ? 'checked':''}}  required>
									  
									  <input type='hidden' name='actionType' value='chatEnable'>
									  <button style='margin-left:20px'  class='btn btn-primary'>Chat Enable</button>
									</div>
									{!! Form::close() !!}
								  </td>
							  </tr>
						   </thead>
						</table>
					</div>
					<div id="ledger" style='max-width: 100%;' class="container tab-pane fade"><br>
					  
					  <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Order No</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Balence</th>
                            </tr>
                        </thead>

                        
                        @php

                            $totalLeader = 0;
            
                        @endphp

                        @foreach ($rechargeList as $key => $recharge)
                            @php
                                $totalLeader += $recharge->amount;
                            @endphp
                            
                            @if(count($rechargeList) == 1)
                                @php

    
                                $orderDebitedAffiliation = App\Models\order::with(['orderDetails' => function($query){
                                                        $query->whereNotNull('affiliate_id');
                                                    }])->where('account_id',$account->id)->get();
                                @endphp

                            @else
                                @php
                                    $nextOrderIndex = $key + 1;
                                    if($nextOrderIndex < count($rechargeList)){

                                        $nextRecharge = $rechargeList[$nextOrderIndex];
                                        $orderDebitedAffiliation = App\Models\order::with(['orderDetails' => function($query){
                                                            $query->whereNotNull('affiliate_id');
                                                        }])->where('account_id',$account_id)->whereBetween('created_at',[$recharge->created_at , $nextRecharge->created_at])->get();
                                    } else {

                                        $orderDebitedAffiliation = App\Models\order::with(['orderDetails' => function($query){
                                                            $query->whereNotNull('affiliate_id');
                                                        }])->where('account_id',$account_id)->whereDate('created_at', '>=' ,$recharge->created_at)->get();
                                    }
                                    
                                @endphp
                            @endif
                           

                            <tbody>
                                <tr>
                                    <td> {{$recharge->created_at}} </td>
                                    <td> - </td>
                                    <td>{{$recharge->amount}}</td>
                                    <td> - </td>
                                    <td> {{$totalLeader}} </td>
                                </tr>
                            </tbody>
                            
                           

                            @foreach ($orderDebitedAffiliation as $order)
                                @if (count($order->orderDetails) > 0)
                                    @foreach ($order->orderDetails as $orderItem)
                                        <tbody>
                                            <tr>
                                                <td> {{$order->created_at}} </td>
                                                <td>{{$order->orderNo}}</td>
                                                <td> - </td>
                                                <td>{{$orderItem->affiliate_Amt}}</td>
                                                @php
                                                    $totalLeader -= $orderItem->affiliate_Amt;
                                                @endphp
                                                <td> {{$totalLeader}} </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                @endif  
                            @endforeach
                        @endforeach

                    
                    </table>
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
					<div id="user" style='max-width: 100%;' class="container tab-pane "><br>
					     <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Phone</th>
								<th>Last Order Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registerList as $key=>$register)
                                <tr>
                                    <td onclick="custPopup('{{route('customerDetail',$register->id)}}')">{{$register->phone}}</td>
									<td>{{$register->latestOrder()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
					</div>
					<div id="gateways" style='max-width: 100%;' class="container tab-pane"><br>
					<!-------------------------------------------------->
					 <ul class="nav nav-tabs">
						<li class="nav-item">
						  <a class="nav-link active" data-toggle="tab" href="#gateways_shipping">Shipping</a>
						</li>
						<li class="nav-item">
						  <a class="nav-link" data-toggle="tab" href="#gateways_payment">Payment</a>
						</li>
						<li class="nav-item">
						  <a class="nav-link" data-toggle="tab" href="#gateways_sms">SMS</a>
						</li>
					  </ul>
					  <div class="tab-content">
						<div id="gateways_shipping" class="container tab-pane active"><br>
						  <h3>Shipping Gateway</h3>
						  <!-------------------------------------------->
						  <div id="accordion">
							<div class="card">
							  <div class="card-header">
								<a class="card-link" data-toggle="collapse" href="#shipyaari_gateways_shipping">
								  Shipyaari 
								</a>
							  </div>
							  <div id="shipyaari_gateways_shipping" class="collapse show" data-parent="#accordion">
								<div class="card-body">
								   <!------------------------------------>
								   {{ Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}

                                   {{ csrf_field() }}
								   <div class="col-sm-6 col-md-4 col-lg-4 form-check">
										<label class="form-check-label">
                                             <input type="checkbox"  name="shipyaariStatus" class="form-check-input" @if($account->shipyaariStatus==1) checked  @endif />Shipyaari Status
										</label>
									</div>
									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<label>Shipyaari User Name</label>

											<input type="text" value="{{$account->shipyaariUserName}}" name="shipyaariUserName" class="form-control" required/>

										</div>

									</div>

									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<label>Shipyaari Client Code</label>

											<input type="number" name="shipyaariClientCode" class="form-control" value="{{$account->shipyaariClientCode}}"  required/>

										</div>

									</div>

									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<label>Shipyaari Parent Code</label>

											<input type="number" name="shipyaariParentCode" class="form-control" required value="{{$account->shipyaariParentCode}}" />

										</div>

									</div>
									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											
                                            <input type='hidden' name='actionType'  value='shipyaariUpdate'>
											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									</div>
									{!! Form::close() !!}
								   <!------------------------------------>
								</div>
							  </div>
							</div>
							<div class="card">
							  <div class="card-header">
								<a class="collapsed card-link" data-toggle="collapse" href="#shiprocket_gateways_shipping">
								Shiprocket 
							  </a>
							  </div>
							  <div id="shiprocket_gateways_shipping" class="collapse" data-parent="#accordion">
									<div class="card-body">
									  <!----------------------------------->
									  {{ Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}

									  {{ csrf_field() }}
									  <div class='row'>
									    <div class="col-md-6">
											<label class="form-check-label">
												 <input type="checkbox"  name="shiprocketStatus" class="form-check-input" @if($account->shiprocketStatus==1) checked  @endif />Shiprocket Status
											</label>
									  
										<div class="form-group">

											<label>Shiprocket API Email</label>

											<input type="email" name="shiprocketEmail"  value="{{$account->shiprocketEmail}}" class="form-control"  />

										</div>

									
										<div class="form-group">

											<label>Shiprocket API Password</label>

											<input type="password" name="shiprocketPassword" class="form-control" value="{{$account->shiprocketPassword}}"  />

										</div>
	 
									
										<div class="form-group">

											<label>Shiprocket Pickup Location <small>(eg, Primary )</small></label>

											<input type='text' readonly  name="shiprocketPickupLocation" class="form-control" value="{{$account->shiprocketPickupLocation}}"   value='{{$account->shiprocketPickupLocation}}' />

										</div>
	 
									
										<div class="form-group">

											<input type='hidden' name='actionType' value='shiprocketUpdate'>

											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									  </div>
									  <div class="col-md-6">
									    <small style='color:red'>Please update Shiprocket API Email and Shiprocket API Password before click on Get Pickup Location </small>
									    <button type='button' class='btn' onclick='getShipRocketPickUpLocation({{ $account->id }})'>Get Pickup Location</button>
										<div class='pickup_location'>
										
										</div>
									  </div>
									</div>
								{!! Form::close() !!}
								  <!----------------------------------->
								</div>
							  </div>
							</div>
							<!------------------------>
							<div class="card">
							  <div class="card-header">
								<a class="card-link" data-toggle="collapse" href="#delhivehry_gateways_shipping">
								  Delhivehry 
								</a>
							  </div>
							  <div id="delhivehry_gateways_shipping" class="collapse" data-parent="#accordion">
								<div class="card-body">
								   <!------------------------------------>
								   {{ Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}

                                   {{ csrf_field() }}
								   <div class="col-sm-6 col-md-4 col-lg-4 form-check">
										<label class="form-check-label">
                                             <input type="checkbox"  name="delhivehryStatus" value='1' class="form-check-input" @if($account->delhivehryStatus==1) checked  @endif />Delhivehry Status
										</label>
									</div>
									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<label>Token</label>

											<input type="text" value="{{$account->delhivehry_token}}" name="delhivehry_token" class="form-control" required/>

										</div>

									</div>

									
									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<input type='hidden' name='actionType' value='delhiveryUpdate'>
                                            <input type='hidden' name='actionType'  value='shipyaariUpdate'>
											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									</div>
									{!! Form::close() !!}
								   <!------------------------------------>
								</div>
							  </div>
							</div>
							<!------------------------>
						  </div>
						  <!-------------------------------------------->
						</div>
						<div id="gateways_payment" class="container tab-pane fade"><br>
						  <h3>Payment Gateway</h3>
						  <!--------------------------------->
						  {{ Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}

                                  {{ csrf_field() }}
								  <div class="col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">

										<label>Instamojo Api Key</label>

										<input type="text" name="instamojoApiKey" class="form-control" value="{{$account->instamojoApiKey}}" required/>

									</div>

								</div>
								<div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">

                                    <label>Instamojo Auth Token</label>

                                    <input type="text" name="instamojoAuthToken" class="form-control" value="{{$account->instamojoAuthToken}}" required/>

                                </div>

                            </div>
								   <div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<input type='hidden' name='actionType' value='instaMojoUpdate'>

											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									</div>
									{!! Form::close() !!}						  
						  <!--------------------------------->
						  <h3>Razorpay  Gateway</h3>
						  <!--------------------------------->
						  {{ Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}

                                  {{ csrf_field() }}
								  <div class="col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">

										<label>Display Name</label>

										<input type="text"  class="form-control" name='razorPayDisplayName' value="{{$account->razorPayDisplayName}}"  required/>

									</div>

								</div>
								<div class="col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">

										<label>Api Key</label>

										<input type="text"  class="form-control" name='razorPayApiKey'  required value="{{$account->razorPayApiKey}}" />

									</div>

								</div>
								<div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">

                                    <label>API Secret</label>

                                    <input type="text" name='razorPayApiSecret'  class="form-control" value="{{$account->razorPayApiSecret}}"  required/>

                                </div>

                            </div>
								   <div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<input type='hidden' name='actionType' value='razorPayUpdate'>

											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									</div>
									{!! Form::close() !!}						  
						  <!--------------------------------->
						</div>
						<div id="gateways_sms" class="container tab-pane fade"><br>
						  <h3>SMS Gateway</h3>
						  <!----------------------------------->
								  {{ Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}

                                  {{ csrf_field() }}
								  <div class="col-sm-6 col-md-4 col-lg-4">

                                <div class="form-group">

                                    <label>SMS User Name</label>

                                    <input type="text" name="SMSUserName" class="form-control" value="{{$account->SMSUserName}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-4">

                                <div class="form-group">

                                    <label>SMS User Password</label>

                                    <input type="password" name="SMSUserPassword" class="form-control" value="{{$account->SMSUserPassword}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-4">

                                <div class="form-group">

                                    <label>SMS Sender Id</label>

                                    <input type="text" name="SMSUserSenderId" class="form-control" value="{{$account->SMSUserSenderId}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="form-group">

                                    <label>SMS Link</label>
                                    <input type="text" name="SMSApi" class="form-control" value="{{$account->SMSApi}}" required/>
                                    <span class="font-13 text-muted">
                                        1. http://nimbusit.co.in/api/swsendSingle.asp?username=setUsername&password=setPassword&sender=setSenderId&sendto=setPhone&message=setMessage&TemplateID=setTEMPLATEID
                                    </span> <br>
                                    <span class="font-13 text-muted">
                                        2. http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=setUsername&Password=setPassword&SenderID=setSenderId&Phno=setPhone&Msg=setMessage&TemplateID=setTEMPLATEID
                                    </span>

                                </div>

                            </div>
								   <div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<input type='hidden' name='actionType' value='smsUpdate'>

											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									</div>
									
									<span>Please save credentials before testing.</span><br>
									<span style='color:red'>We will send Users Login OTP, make sure it is set in admin.</span>
									<div class="col-sm-6 col-md-4 col-lg-4"> 
									   <button class='btn btn-primary' type='button' onclick="checkSmsSetting({{$account->id}})">Test SMS</button>
									   <br>
									   <span id="nimbus_rsponce" style='color:red'></span>
									   <br>
									   <br>
									</div>
									{!! Form::close() !!}
								  <!----------------------------------->
						</div>
					  </div>
					<!-------------------------------------------------->
					</div>
				  </div>
            </div>
        </div>
    </div>
	<script>
	   function generatePassword() {
			var length = 8,
				charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
				retVal = "";
			for (var i = 0, n = charset.length; i < length; ++i) {
				retVal += charset.charAt(Math.floor(Math.random() * n));
			}
			$('#password').val(retVal);
		}
	</script>
@endsection
