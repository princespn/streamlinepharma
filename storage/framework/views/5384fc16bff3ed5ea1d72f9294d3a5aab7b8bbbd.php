  

<?php $__env->startSection('pageTitle'); ?>
    

    <h4 class="page-title"> <i class="dripicons-user-group"></i> Account Detail</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row" style='margin-top:50px'>

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">
                      <strong><?php echo e($account->title); ?>  </strong><a href='<?php echo e(url("admin/account/".$account->id."/edit")); ?>'><i class="mdi mdi-pencil" title="Edit this data"></i></a><br>
                      <strong>Mobile : </strong><?php echo e($account->phone); ?><br>
                      <strong>Email : </strong><?php echo e($account->email); ?><br>
                      <strong>Domain : </strong><?php echo e($account->domain); ?><br>
                     
                </div>
				
				               <?php if($errors->any()): ?>

                                    <div class="alert bg-danger text-white msgPopup" role="alert">

                                    <?php echo e($errors->first()); ?>


                                    </div>

                                <?php endif; ?>
				
				
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
								 <td><?php echo e($account->email); ?></td>
							  </tr>
							  <tr>
								 <th>Domain Name</th>
								 <td><?php echo e($account->domain); ?></td>
							  </tr>
							  <tr>
								 <th>WhatsApp Number</th>
								 <td><?php echo e($account->whatsApp); ?></td>
							  </tr>
							  <tr>
								 <th>Address</th>
								 <td><?php echo e($account->address); ?></td>
							  </tr>
							  <tr>
								 <th>Default Currency</th>
								 <td>
									<?php echo e(($account->currency ? $account->currency->title : '')); ?>

								 </td>
							  </tr>
							  <tr>
								 <th>Website Type</th>
								 <td>
									<?php switch($account->type):
									case (1): ?>
									E-Commerce
									<?php break; ?>
									<?php case (2): ?>
									Hybrid
									<?php break; ?>
									<?php default: ?>
									Inquiry
									<?php endswitch; ?>
								 </td>
							  </tr>
							  <tr>
								 <th>Theme Number</th>
								 <td>
									<?php switch($account->theme):
									case (1): ?>
									Theme 1
									<?php break; ?>
									<?php case (2): ?>
									Theme 2
									<?php break; ?>
									<?php default: ?>
									Theme 3
									<?php endswitch; ?>    
								 </td>
							  </tr>
							  <tr>
								 <th>Theme Color</th>
								 <td><?php echo e($account->color); ?></td>
							  </tr>
							  <tr>
								 <th>Charge in %</th>
								 <td><?php echo e($account->charge); ?></td>
							  </tr>
							  <tr>
							     <th>Password</th>
							     <td>
								 <?php echo e(Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>

								  <div class="input-group">
									 <input type="text" class="form-control col-md-6" placeholder="type password or genrate" id='password' name='password' required>
									   <div class="input-group-prepend">
										<button class='input-group-text' onclick='generatePassword()' type='button'>Generate</button>
									  </div>
									  <input type='hidden' name='actionType' value='passwordUpdate'>
									  <button style='margin-left:20px'  class='btn btn-primary'>Update Password</button>
									</div>
									<?php echo Form::close(); ?>

								  </td>
							  </tr>
                              <tr>
							     <th>Chat Enable</th>
							     <td>
								 <?php echo e(Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>

								  <div class="input-group">
									 <input type="checkbox"id='chat_enable' name='chat_enable' <?php echo e($account->chat_enable=='1' ? 'checked':''); ?>  required>
									  
									  <input type='hidden' name='actionType' value='chatEnable'>
									  <button style='margin-left:20px'  class='btn btn-primary'>Chat Enable</button>
									</div>
									<?php echo Form::close(); ?>

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

                        
                        <?php

                            $totalLeader = 0;
            
                        ?>

                        <?php $__currentLoopData = $rechargeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $recharge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $totalLeader += $recharge->amount;
                            ?>
                            
                            <?php if(count($rechargeList) == 1): ?>
                                <?php

    
                                $orderDebitedAffiliation = App\Models\order::with(['orderDetails' => function($query){
                                                        $query->whereNotNull('affiliate_id');
                                                    }])->where('account_id',$account->id)->get();
                                ?>

                            <?php else: ?>
                                <?php
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
                                    
                                ?>
                            <?php endif; ?>
                           

                            <tbody>
                                <tr>
                                    <td> <?php echo e($recharge->created_at); ?> </td>
                                    <td> - </td>
                                    <td><?php echo e($recharge->amount); ?></td>
                                    <td> - </td>
                                    <td> <?php echo e($totalLeader); ?> </td>
                                </tr>
                            </tbody>
                            
                           

                            <?php $__currentLoopData = $orderDebitedAffiliation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($order->orderDetails) > 0): ?>
                                    <?php $__currentLoopData = $order->orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tbody>
                                            <tr>
                                                <td> <?php echo e($order->created_at); ?> </td>
                                                <td><?php echo e($order->orderNo); ?></td>
                                                <td> - </td>
                                                <td><?php echo e($orderItem->affiliate_Amt); ?></td>
                                                <?php
                                                    $totalLeader -= $orderItem->affiliate_Amt;
                                                ?>
                                                <td> <?php echo e($totalLeader); ?> </td>
                                            </tr>
                                        </tbody>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>  
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
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
                        <?php $__currentLoopData = $orderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="width: 100%;">
                                            <?php 
                                                $grandTotal = 0;
                                            ?>

                                            <?php $__currentLoopData = $order->orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php 
                                                $totalAmt = 0; 
                                                $totalTax = 0;
                                                $totalShipping = 0;
                                            ?>
                                                <tbody>
                                                    <tr>
                                                        <td style="width:50px;border-right: 0px;border-top: 0px;">
														<?php if($orderDetail->imageURL0): ?>
                                                            <img src="<?php echo e(URL::asset( $orderDetail->imageURL0)); ?>" style="height: 100px;">
															<?php endif; ?>
                                                        </td>
                                                        <td style="border-top: 0px;">
                                                            <?php echo e($orderDetail->productName); ?> <br>
                                                            <?php echo e($orderDetail->sku); ?> <br>
                                                            
                                                            <?php if($orderDetail->affiliate_id): ?>
                                                            
                                                                Affiliation Order <br>
                                                            
                                                            <?php endif; ?>
                                                            
                                                            <?php if($orderDetail->variation0): ?>
                                                            
                                                                <?php echo e($orderDetail->variation0); ?> <br>
                                                            
                                                            <?php endif; ?>
                                                            
                                                            <?php if($orderDetail->variation1): ?>
                                                            
                                                                <?php echo e($orderDetail->variation1); ?> <br>
                                                            
                                                            <?php endif; ?>
                                                            
                                                            <?php if($orderDetail->variation2): ?>
                                                            
                                                                <?php echo e($orderDetail->variation2); ?> <br>
                                                            
                                                            <?php endif; ?>
                                                            
                                                            <?php if($orderDetail->variation3): ?>
                                                            
                                                                <?php echo e($orderDetail->variation3); ?> <br>
                                                            
                                                            <?php endif; ?>
                                                            
                                                            <?php if($orderDetail->variation4): ?>
                                                            
                                                                <?php echo e($orderDetail->variation4); ?>

                                                            
                                                            <?php endif; ?>
                                                        </td>

                                                        <td style="border-top: 0px;width: 40%;">
                                                            <?php 

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
                                                            ?>

                                                            Price :  
                                                                <?php if($orderDetail->orderOffers): ?>
                                                                    Rs. <?php echo e(number_format($basePrice,2)); ?>

                                                                        <sub><del><?php echo e(number_format($orderDetail->price,2)); ?></del></sub>
                                                                <?php else: ?>
                                                                    Rs. <?php echo e(number_format($orderDetail->price,2)); ?>

                                                                <?php endif; ?>
                                                            <br>

                                                            Qty : <?php echo e($orderDetail->qty); ?><br>
                                                            Sub Total : Rs. <?php echo e($totalAmt); ?><br>
                                                            Tax (<?php echo e($orderDetail->tax); ?> %) : Rs. <?php echo e($totalTax); ?><br>
                                                            Shipping : Rs. <?php echo e($totalShipping); ?><br>
                                                            Net Total: Rs. <?php echo e($totalAmt + $totalTax + $totalShipping); ?>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <tfoot>
											<?php if($order->coupon_code): ?>
                                        <tr>
                                            <td style="border-top: 0px;" colspan="2"></td>
                                            <td>
                                            <div>Coupon Code: <?php echo e($order->coupon_code); ?></div>
                                                <div>Discount: Rs.<?php echo e($order->coupon_amount); ?></div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                                <tr>
                                                    <td style="border-top: 0px;" colspan="2"></td>
                                                    <td>Grand Total : <?php echo e($grandTotal-($order->coupon_amount?$order->coupon_amount:0)); ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                    <td>
                                        <?php echo e($order->orderNo); ?>

                                        <br>
                                        <?php echo e($order->transactionId); ?> <br>
                                        <?php echo e(date('d-m-Y h:m a', strtotime($order->created_at))); ?>

                                        <br>
                                        
                                        <?php if($order->orderAcceptance==1): ?>
                                            <?php if($order->shipyaariOrder): ?>

                                                <?php if($order->orderStatus == 1): ?>

                                                    <?php if($order->courierType == 1): ?>
                                                        <a href="https://seller.shipyaari.com/avn_ci/siteadmin/track/trackShipment/<?php echo e(json_decode($order->shipyaariOrder,true)['tracking_number']?? ''); ?>" target="_blank">
                                                            Track your order
                                                        </a>
                                                        <br>
                                                        <a href="<?php echo e(json_decode($order->shipyaariOrder,true)['shipment_label']?? ''); ?>" target="_blank">
                                                            Print Order
                                                        </a>
                                                    <?php else: ?>
                                                    
                                                        <?php 
                                                            $courier = explode('#@#',$order->shipyaariOrder);
                                                        ?>
                                                        
                                                        <?php if(sizeof($courier) > 0): ?>
                                                            <a href="#!">Traking Number :- <?php echo e((isset($courier[1])?$courier[1]:'')); ?></a><br>
                                                            <a href="<?php echo e((isset($courier[0])?$courier[0]:'')); ?>" target="_blank">
                                                                Track your order
                                                            </a>
                                                        <?php endif; ?>
                                                        
                                                        <br>
                                                        <a href="<?php echo e(url("admin/updateOrderStatus/".$order->orderNo)); ?>">
                                                            Is order delivered?
                                                        </a>
                                                        
                                                    <?php endif; ?>

                                                <?php endif; ?>

                                                <?php if($order->orderStatus == 4): ?> 
                                                    <a href="#!">Order delivered</a>
                                                <?php endif; ?>

                                                <?php if($order->orderStatus == 18): ?> 
                                                    <a href="#!">Order canceled</a>
                                                <?php endif; ?>

                                                <?php if($order->orderStatus == 9): ?> 
                                                    <a href="#!">Order returned</a>
                                                <?php endif; ?>

                                                <?php if($order->orderStatus == 19): ?> 
                                                    <a href="#!">Order replaced</a>
                                                <?php endif; ?>

                                                <br>
                                                <a href="<?php echo e(url("admin/orderPrint/".$order->orderNo)); ?>">
                                                    Print PDF
                                                </a>

                                            <?php else: ?>                                        
                                            <a href="#!" data-toggle="modal" data-target=".generateOrder<?php echo e($order->orderNo); ?>">
                                                Generate Order
                                            </a>
                                            
                                            <div class="modal fade generateOrder<?php echo e($order->orderNo); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                <div class="modal-dialog modal-dialog-centered">
                                        
                                                    <div class="modal-content">
                                        
                                                        <div class="modal-header">
                                        
                                                            <h5 class="modal-title mt-0">Order Details</h5>
                                        
                                                            <button type="button" id="createFolder" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        
                                                        </div>

                                                        <?php echo Form::open(['route' => 'updateCourierDetails','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

                                                        <?php echo e(csrf_field()); ?>


                                                        <div class="modal-body">
                                        
                                                            <div class="form-group">
                                                                <select name="courierType" class="form-control" onchange="courierTypes(this.value,<?php echo e($order->orderNo); ?>)">
                                                                    <option value="">Courier Type</option>
                                                                    <option value="1">Shipyaari</option>
                                                                    <option value="2">Others</option>
                                                                </select>
                                                            </div>
                                        
                                                            <span id="courierData<?php echo e($order->orderNo); ?>" style="display: none;">
                                                                <div class="form-group">
                                                                    <input type="text" name="courierLink" class="form-control" placeholder="Courier link"/>
                                                                </div>
                                            
                                                                <div class="form-group">
                                                                    <input type="text" name="courierTracking" class="form-control" placeholder="Courier tracking number"/>
                                                                </div>
                                                            </span>
                                                            
                                                        </div>
                                        
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="orderNo" class="form-control" value="<?php echo e($order->orderNo); ?>"/>
                                                            <button type="submit" class="btn btn-outline-danger">Submit</button>
                                                        </div>
                                                        <?php echo Form::close(); ?> 
                                                    </div>
                                        
                                                </div>
                                        
                                            </div>
                                            <?php endif; ?>

                                        <?php elseif($order->orderAcceptance==0): ?>
                                            <a href="<?php echo e(url("admin/orderAcceptance/".$order->orderNo)); ?>">
                                                Accept order
                                            </a>
                                            <br>
                                            <a href="<?php echo e(url("admin/orderReject/".$order->orderNo)); ?>">
                                                Reject order
                                            </a>
                                        <?php elseif($order->orderAcceptance==2): ?>
                                            <a href="#!">
                                                Order Rejected
                                            </a>
                                        <?php endif; ?>
                                        
                                    </td>
                                    <td style="width: 25%;">
                                        <?php echo e($order->name); ?> <br>
                                        <?php echo e($order->phone); ?> <br>
                                        <?php echo e($order->email); ?> <br>
                                        <?php echo e($order->landmark); ?> <br>
                                        <?php echo e($order->address); ?> <br>
                                        <?php echo e($order->zipCode); ?>

                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <?php $__currentLoopData = $registerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$register): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td onclick="custPopup('<?php echo e(route('customerDetail',$register->id)); ?>')"><?php echo e($register->phone); ?></td>
									<td><?php echo e($register->latestOrder()); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
								   <?php echo e(Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>


                                   <?php echo e(csrf_field()); ?>

								   <div class="col-sm-6 col-md-4 col-lg-4 form-check">
										<label class="form-check-label">
                                             <input type="checkbox"  name="shipyaariStatus" class="form-check-input" <?php if($account->shipyaariStatus==1): ?> checked  <?php endif; ?> />Shipyaari Status
										</label>
									</div>
									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<label>Shipyaari User Name</label>

											<input type="text" value="<?php echo e($account->shipyaariUserName); ?>" name="shipyaariUserName" class="form-control" required/>

										</div>

									</div>

									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<label>Shipyaari Client Code</label>

											<input type="number" name="shipyaariClientCode" class="form-control" value="<?php echo e($account->shipyaariClientCode); ?>"  required/>

										</div>

									</div>

									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<label>Shipyaari Parent Code</label>

											<input type="number" name="shipyaariParentCode" class="form-control" required value="<?php echo e($account->shipyaariParentCode); ?>" />

										</div>

									</div>
									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											
                                            <input type='hidden' name='actionType'  value='shipyaariUpdate'>
											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									</div>
									<?php echo Form::close(); ?>

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
									  <?php echo e(Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>


									  <?php echo e(csrf_field()); ?>

									  <div class='row'>
									    <div class="col-md-6">
											<label class="form-check-label">
												 <input type="checkbox"  name="shiprocketStatus" class="form-check-input" <?php if($account->shiprocketStatus==1): ?> checked  <?php endif; ?> />Shiprocket Status
											</label>
									  
										<div class="form-group">

											<label>Shiprocket API Email</label>

											<input type="email" name="shiprocketEmail"  value="<?php echo e($account->shiprocketEmail); ?>" class="form-control"  />

										</div>

									
										<div class="form-group">

											<label>Shiprocket API Password</label>

											<input type="password" name="shiprocketPassword" class="form-control" value="<?php echo e($account->shiprocketPassword); ?>"  />

										</div>
	 
									
										<div class="form-group">

											<label>Shiprocket Pickup Location <small>(eg, Primary )</small></label>

											<input type='text' readonly  name="shiprocketPickupLocation" class="form-control" value="<?php echo e($account->shiprocketPickupLocation); ?>"   value='<?php echo e($account->shiprocketPickupLocation); ?>' />

										</div>
	 
									
										<div class="form-group">

											<input type='hidden' name='actionType' value='shiprocketUpdate'>

											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									  </div>
									  <div class="col-md-6">
									    <small style='color:red'>Please update Shiprocket API Email and Shiprocket API Password before click on Get Pickup Location </small>
									    <button type='button' class='btn' onclick='getShipRocketPickUpLocation(<?php echo e($account->id); ?>)'>Get Pickup Location</button>
										<div class='pickup_location'>
										
										</div>
									  </div>
									</div>
								<?php echo Form::close(); ?>

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
								   <?php echo e(Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>


                                   <?php echo e(csrf_field()); ?>

								   <div class="col-sm-6 col-md-4 col-lg-4 form-check">
										<label class="form-check-label">
                                             <input type="checkbox"  name="delhivehryStatus" value='1' class="form-check-input" <?php if($account->delhivehryStatus==1): ?> checked  <?php endif; ?> />Delhivehry Status
										</label>
									</div>
									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<label>Token</label>

											<input type="text" value="<?php echo e($account->delhivehry_token); ?>" name="delhivehry_token" class="form-control" required/>

										</div>

									</div>

									
									<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<input type='hidden' name='actionType' value='delhiveryUpdate'>
                                            <input type='hidden' name='actionType'  value='shipyaariUpdate'>
											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									</div>
									<?php echo Form::close(); ?>

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
						  <?php echo e(Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>


                                  <?php echo e(csrf_field()); ?>

								  <div class="col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">

										<label>Instamojo Api Key</label>

										<input type="text" name="instamojoApiKey" class="form-control" value="<?php echo e($account->instamojoApiKey); ?>" required/>

									</div>

								</div>
								<div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">

                                    <label>Instamojo Auth Token</label>

                                    <input type="text" name="instamojoAuthToken" class="form-control" value="<?php echo e($account->instamojoAuthToken); ?>" required/>

                                </div>

                            </div>
								   <div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<input type='hidden' name='actionType' value='instaMojoUpdate'>

											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									</div>
									<?php echo Form::close(); ?>						  
						  <!--------------------------------->
						  <h3>Razorpay  Gateway</h3>
						  <!--------------------------------->
						  <?php echo e(Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>


                                  <?php echo e(csrf_field()); ?>

								  <div class="col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">

										<label>Display Name</label>

										<input type="text"  class="form-control" name='razorPayDisplayName' value="<?php echo e($account->razorPayDisplayName); ?>"  required/>

									</div>

								</div>
								<div class="col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">

										<label>Api Key</label>

										<input type="text"  class="form-control" name='razorPayApiKey'  required value="<?php echo e($account->razorPayApiKey); ?>" />

									</div>

								</div>
								<div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">

                                    <label>API Secret</label>

                                    <input type="text" name='razorPayApiSecret'  class="form-control" value="<?php echo e($account->razorPayApiSecret); ?>"  required/>

                                </div>

                            </div>
								   <div class="col-sm-6 col-md-4 col-lg-4">
										<div class="form-group">

											<input type='hidden' name='actionType' value='razorPayUpdate'>

											<input type="submit"  class="btn btn-outline-primary" value='Update' />

										</div>

									</div>
									<?php echo Form::close(); ?>						  
						  <!--------------------------------->
						</div>
						<div id="gateways_sms" class="container tab-pane fade"><br>
						  <h3>SMS Gateway</h3>
						  <!----------------------------------->
								  <?php echo e(Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>


                                  <?php echo e(csrf_field()); ?>

								  <div class="col-sm-6 col-md-4 col-lg-4">

                                <div class="form-group">

                                    <label>SMS User Name</label>

                                    <input type="text" name="SMSUserName" class="form-control" value="<?php echo e($account->SMSUserName); ?>" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-4">

                                <div class="form-group">

                                    <label>SMS User Password</label>

                                    <input type="password" name="SMSUserPassword" class="form-control" value="<?php echo e($account->SMSUserPassword); ?>" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-4">

                                <div class="form-group">

                                    <label>SMS Sender Id</label>

                                    <input type="text" name="SMSUserSenderId" class="form-control" value="<?php echo e($account->SMSUserSenderId); ?>" required/>

                                </div>

                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="form-group">

                                    <label>SMS Link</label>
                                    <input type="text" name="SMSApi" class="form-control" value="<?php echo e($account->SMSApi); ?>" required/>
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
									   <button class='btn btn-primary' type='button' onclick="checkSmsSetting(<?php echo e($account->id); ?>)">Test SMS</button>
									   <br>
									   <span id="nimbus_rsponce" style='color:red'></span>
									   <br>
									   <br>
									</div>
									<?php echo Form::close(); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/account/detail.blade.php ENDPATH**/ ?>