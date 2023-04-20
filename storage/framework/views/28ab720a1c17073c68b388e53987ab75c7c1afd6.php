  

<?php $__env->startSection('pageTitle'); ?>
    

    <h4 class="page-title"> <i class="dripicons-user-group"></i>Customer Account Detail</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>
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
                      <strong><?php echo e($account->title); ?>  </strong><br>
                      <strong>Mobile : </strong><?php echo e($account->phone); ?><br>
                      <?php if($account->email): ?>
                      <strong>Email : </strong><?php echo e($account->email); ?><br>
                      <?php endif; ?>
                      <?php if($account->name): ?>
                      <strong>Name : </strong><?php echo e($account->name); ?><br>
                      <?php endif; ?>
                     
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
                    <?php if(isset($address) && $address->count()>0): ?>
                    <ul class="cust-address" id="oldAddress">
                        <?php $__currentLoopData = $address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li id="<?php echo e($add->id); ?>">
                            <?php echo e($add->name); ?> ,<br /><?php echo e($add->phone); ?> ,<br /><?php echo e($add->landmark); ?> ,<br /><?php echo e($add->address); ?>,<br /> <?php echo e($add->zipCode); ?><br/>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php endif; ?>
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
                    <div id="offer" style='max-width: 100%;' class="container tab-pane">

                 <ul class="nav nav-tabs">
                    <li class="nav-item">
					  <a class="nav-link active" data-toggle="tab" href="#SaleX">SaleX</a>
					</li>
				  </ul>
                  <div id="SaleX" style='max-width: 100%;' class="container tab-pane">
				<?php if($coupon): ?>  
                <?php $json = json_decode($coupon->template_array,true); ?>
                <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Scheme Name</th>
                    <th>Set Number </th>

                    <?php $__currentLoopData = $json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$json_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($otherdata->template($json_view['template'])); ?>  </th>
                    <th> Referral Benefits  </th>
                    <th> Referee Benefits  </th>
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                   
                   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td><?php echo e($coupon->scheme_name); ?></td>
                    <td><?php echo e($coupon->number_of_set); ?></td>
                  
                    <?php $__currentLoopData = $json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$json_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $coupon=explode(',',$json_view['coupon_code'][$no]);
                            $cdata=$otherdata->findCuopan($coupon);
                        ?>

                        <td>
                        <?php $__currentLoopData = $cdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $coupon_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
                        <span class="badge badge-secondary">

                                                <?php if($otherdata->usettime($coupon_data->coupon) > 0): ?>
                                                      <del><?php echo e($coupon_data->coupon); ?> </del>
                                                <?php else: ?>
                                                      <?php echo e($coupon_data->coupon); ?>

                                                <?php endif; ?> 
                        </span>
                      
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        
                        <td><?php echo e($json_view['refferal_benifit']); ?></td>
                        <td><?php echo e($json_view['refree_benifit']); ?></td>
                      
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                 
                </tbody>
                </table>
				<?php endif; ?>
                    </div>
                    </div>
				  </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/users/register/detail.blade.php ENDPATH**/ ?>