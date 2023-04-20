@extends('layouts.app')

@section('pageTitle')


<h4 class="page-title"> <i class="dripicons-user-group"></i>Affiliation payment listing</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
				
					@if($errors->any())

						<div class="alert bg-danger text-white">

						{{$errors->first()}}

						</div>

					@endif

					@php
						$todayDate = date('Y-m-d');
					@endphp

                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Domain</th>
                                <th>Order No</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Selling Budget</th>
                                <th>Affiliate</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($mySellingList as $key=>$mySelling)
								<tr>
									<td>{{$key+1}}</td>
									<td>{{$mySelling->order->account->domain}}</td>
									<td>{{$mySelling->order->orderNo}}</td>
									<td>{{$mySelling->productName}}</td>
									<td>{{$mySelling->inventory_price->sprice}}</td>
									<td>{{$mySelling->inventory_price->sellingAffiliationCharge}}</td>
									<td>
										<i class="mdi mdi-eye btn btn-outline-primary" data-toggle="modal" data-target=".affiliatePopup{{$mySelling->id}}" title="Affiliate Details"></i>
										<div class="modal fade affiliatePopup{{$mySelling->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

											<div class="modal-dialog modal-dialog-centered">

												<div class="modal-content">

													<div class="modal-header">

														<h5 class="modal-title mt-0">
															{{$mySelling->order->account->domain}} : Order {{$mySelling->order->orderNo}}
														</h5>

														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

													</div>

													<div class="modal-body">
														<p>Email : {{$mySelling->affiliate->code}}</p>
														<p>Name : {{$mySelling->affiliate->name}}</p>
														<p>Phone : {{$mySelling->affiliate->phone}}</p>
														<p>Email : {{$mySelling->affiliate->email}}</p>
														<p>Address : {{$mySelling->affiliate->address}}</p>
													</div>
												</div>

											</div>

										</div>
									</td>
									<td>
										@if($mySelling->affiliate_transaction_id!= NULL)	

											Paid ({{$mySelling->affiliate_transaction_id}})
										
										@else

											@if(($todayDate <=  date('Y-m-d', strtotime($mySelling->order->created_at->addDays($mySelling->inventoryPackaging->replacementOrderDays) ) ) ) )
										
												In replcament Period
												
											@else 

												<i class="mdi mdi-eye btn btn-outline-success" data-toggle="modal" data-target=".payPopup{{$mySelling->id}}" title="Pay this order"></i>

											@endif
											
										@endif
										
										<div class="modal fade payPopup{{$mySelling->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

											<div class="modal-dialog modal-dialog-centered">

												<div class="modal-content">

													
													{!! Form::open(['route' => 'AffiliatePaymentSubmit.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
													{{ csrf_field() }}
													
													
													<div class="modal-header">

														<h5 class="modal-title mt-0">
														{{$mySelling->order->account->domain}} : 
														Order {{$mySelling->order->orderNo}}
														</h5>

														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

													</div>

													<div class="modal-body">

														<div class="form-group">

															<label>Transaction Id</label>

															<input type="hidden" name="orderDetailId" class="form-control" value="{{$mySelling->id}}"/>
															
															<input type="text" name="transactionId" class="form-control" required/>

														</div>

													</div>
													
													<div class="modal-footer">
														<button type="submit" class="btn btn-outline-danger">Submit</button>
													</div>
													
													{{ Form::close() }}
												</div>

											</div>

										</div>
									</td>
								</tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection