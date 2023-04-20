<?php $__env->startSection('pageTitle'); ?>

    <h4 class="page-title"> <i class="dripicons-list"></i> Product Order listing</h4>

<?php $__env->stopSection(); ?>
<?php
$shippingMethodArray = array(
    '',
    'Shipyaari',
    'Others',
    'Shiprocket'
);
?>
<?php $__env->startSection('contentData'); ?>
<?php echo Form::open(['id'=>'formFilter','method'=>'GET']); ?>

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
<?php echo Form::close(); ?>

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
                                                    <?php if($orderDetail->offerDescription): ?>
                                                    <span class='offer'><strong>Offer Applied - </strong><?php echo e($orderDetail->offerDescription); ?></span><br>
                                                    <?php endif; ?>
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
                                    <strong>Shipped By </strong><?php echo e(( $order->courierType!='' ? $shippingMethodArray[$order->courierType] : 'Not Shipped' )); ?><br>
                                        <?php echo e($order->orderNo); ?>

                                        <br>
                                        <?php echo e($order->transactionId); ?> <br>
                                        <?php echo e(date('d-m-Y h:m a', strtotime($order->created_at))); ?>

                                        <br>
                                        
                                        <?php if($order->orderAcceptance==1): ?>
                                            <?php if($order->shipyaariOrder): ?>

                                                <?php if($order->orderStatus == 1): ?>

                                                    <?php if($order->courierType == 1): ?>
                                                        <strong>Shipyaari Status : </strong><?php echo e(json_decode($order->shipyaariOrder,true)['status']?? ''); ?><br>
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
                                            <?php elseif($order->shipRocketOrder): ?>
                                            <a href='<?php echo e(url("admin/shiprocketTrack/".$order->orderNo)); ?>' target='_blank'>Track your order</a><br>
                                              <?php if($order->shiprocketPickUpRequest==Null): ?>
											   <a href='<?php echo e(url("admin/shiprocketPickUpRequest/".$order->orderNo)); ?>' >Request Pick Up</a>   
											  <?php else: ?>
                                               <a href='<?php echo e(url("admin/getShipRocketlabel/".$order->orderNo)); ?>' target='_blank'>Print Label</a>
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
                                        <?php if($order->shipyaariAvailability!=''&& isset(json_decode($order->shipyaariAvailability,true)[0]['total']) ): ?>
                                        Shipyaari Charge : <?php echo e(json_decode($order->shipyaariAvailability,true)[0]['total']); ?><br>
                                        <?php endif; ?>
										
										
									  <?php if($order->shiprocketAvailability!=''&&$order->shiprocketAllPrices==Null): ?>
										  <?php try{ ?>
                                        Shiprocket Charge : <?php echo e(json_decode($order->shiprocketAvailability,true)['data']['available_courier_companies'][0]['rate']); ?><br>
										<?php if(count(json_decode(Session::get('user')->shiprocketPickupLocationAll))>1&&$order->shiprocketAvailabilityPayLoad!=Null): ?>
											<br>
											<a href='<?php echo e(url("admin/calculatePriceForAllPin/".$order->orderNo)); ?>' type='button' class='btn btn-sm btn btn-outline-success'>Calculate Price for Other Location</a>
											<br>
											<?php endif; ?>
											<?php }catch(Exception $e){ echo 'Something went wrong'; } ?>	
										
									
									<br>
                                        <?php endif; ?>
                                                            <div class="form-group">
                                                                <select name="courierType" class="form-control" onchange="courierTypes(this.value,<?php echo e($order->orderNo); ?>)">
                                                                    <option value="">Courier Type</option>
                                                                    <option value="1">Shipyaari</option>
                                                                    <option value="3">Shiprocket </option>
                                                                    <option value="2">Others</option>
                                                                </select>
                                                            </div>
                                        <?php if($order->shiprocketAllPrices!=Null): ?>
										
									  
										<div class="form-group" class='shiprocketAllPrices' id='shiprocketAllPrices<?php echo e($order->orderNo); ?>' style='display:none'>
										Shiprocket Charge :<br>
                                                                <select name="shiprocketAllPrices" class="form-control" >
                                                                    <?php $__currentLoopData = json_decode($order->shiprocketAllPrices,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ship_prices): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo $ship_prices['data']; ?>

                                                                    <option value="<?php echo e($ship_prices['pickup_location']); ?>"><?php echo $ship_prices['data']; ?></option>
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
                                                                </select>
                                                            </div>
															<?php endif; ?>
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
                                          <?php if($order->transactionType==2): ?>
                                            <br>
                                            <button type='button'  class='btn btn-xs btn-primary' data-toggle="modal" data-target="#initiatePaymentModal" onclick='refundInitiate(<?php echo e($grandTotal-($order->coupon_amount?$order->coupon_amount:0)); ?>,"<?php echo e($order->transactionId); ?>","<?php echo e($order->id); ?>")' id='refund_btn_<?php echo e($order->id); ?>' <?php if($order->refund_status==1): ?> disabled <?php endif; ?> >
                                            <?php if($order->refund_status==1): ?>
                                                Refund Initiated
                                            <?php else: ?>
                                                Refund Amount - <?php echo e($grandTotal-($order->coupon_amount?$order->coupon_amount:0)); ?>

                                            </button>
                                            <?php endif; ?>
                                            <?php endif; ?>
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
                <input id='csrf_token' value='<?php echo e(csrf_token()); ?>' type='hidden'>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/income/productOrder/index.blade.php ENDPATH**/ ?>