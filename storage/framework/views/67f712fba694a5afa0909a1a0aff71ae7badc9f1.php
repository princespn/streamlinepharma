
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-content'); ?>
<?php $order_menu = 'orders'; ?>
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="<?php echo e(url('/')); ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> Orders
         </div>
      </div>
   </div>
   <div class="page-content pt-150 pb-150">
      <div class="container">
         <div class="row">
            <div class="col-lg-10 m-auto">
               <div class="row">
                  <div class="col-md-3">
                     <div class="dashboard-menu">
                        <?php echo $__env->make('FrontEndTheme.Nest.layout.dashboard_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="account dashboard-content pl-50">
                        <div class="card">
                           <div class="card-header">
                              <h3 class="mb-0">My Orders</h3>
                           </div>
                           <div class="card-body">
                              <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							  
                              <table class="table table-mini-cart">
                                 <thead>
								     <tr>
                                       <th style="width:65%">
                                          <span style="display:block"><?php echo e($order->name); ?></span>
                                          <span style="display:block"><?php echo e($order->phone); ?></span>
                                          <span style="display:block"><?php echo e($order->email); ?></span>
                                          <span style="display:block"><?php echo e($order->landmark); ?>,<?php echo e($order->address); ?>,<?php echo e($order->zipCode); ?></span>
                                          <span style="display:block"><?php echo e($order->variation4); ?></span> 
                                       </th>
                                       <th>
                                          <span style="display:block">
                                          <?php echo e($order->order_id); ?>

                                          </span>
                                          <span style="display:block"><?php echo e($order->transactionId); ?></span>
                                          <span style="display:block"><?php echo e(date('d-m-Y h:m a', strtotime($order->created_at))); ?></span>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                       <td class='product-col'>
                                          <img src="<?php echo e($product->thumbnail); ?>" style="height: 100px;">
                                          <div>
                                            
                                                <?php echo e($product->title); ?>

                                             
                                             
                                          </div>
                                       </td>
                                       <td class='price-col'>
                                          <span class="product-title">Price : Rs. <?php echo e($product->selling_price); ?></span><br>
                                          <span class="product-qty">Qty : <?php echo e($product->qty); ?></span><br>
                                          <span class="product-qty">Sub Total : Rs. <?php echo e($product->selling_price); ?></span><br>
                                          <span class="product-qty">Tax (0 %) : Rs. <?php echo e($product->product_tax); ?></span><br>
                                          <span class="product-qty">Shipping : Rs. <?php echo e($product->shipping_charges); ?></span>
                                       </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </tbody>
                                 <tfoot>
								    <tr>
									  <th>Total</th>
									  <th><?php echo e($order->grand_total); ?></th>
									</tr>
									<?php if($order->coupon): ?>
									<tr>
									  <th>Coupon Discount</th>
									  <th><?php echo e($order->discount_coupon_amount); ?> (<?php echo e($order->coupon); ?>)</th>
									</tr>
									<tr>
									  <th>Grand Total</th>
									  <th><?php echo e($order->grand_total-$order->discount_coupon_amount); ?></th>
									</tr>
                           
									<?php endif; ?>
                           <?php if($order->do_to_wallet>0): ?>
                           <tr>
									  <th>Paid By Wallet</th>
									  <th><?php echo e($order->do_to_wallet); ?></th>
									</tr>
                           <?php endif; ?>
                                    <tr>
                                       <th colspan='2' class='text-center alert alert-success'>Order Status : <?php echo e($constant_order_status[$order->status]); ?></th>
                                    </tr>
									
							        <tr>
								       <th colspan='2' class='text-center'>
									   <?php if($order->status==4): ?>
									     <a href="<?php echo e(url('invoice/'.$order->order_id)); ?>" class='btn-sm btn-xs btn-success'>Invoice</a>
									   <?php endif; ?>
										 <?php if($order->status==4): ?>
										 <button type='button' class='btn btn-sm btn-xs btn-primary'>Track Order</button>
									     <?php endif; ?>
										 <?php if($order->status<2): ?>
										 <a href="<?php echo e(url('userOrderCancel/'.$order->order_id)); ?>" class='btn-danger btn-xs btn-sm'>Cancel Order</a>
										 <?php endif; ?>
									   </th>
								    </tr>			
									
                                    <?php if($order->shirocketWebHook!=Null): ?>
									<tr>
								     <td colspan='2'>
									 <?php $ship = json_decode($order->shirocketWebHook,true); ?>
									 <strong>Current Status : </strong><?php echo e($ship['current_status']); ?> <button data-bs-toggle="modal" data-bs-target="#trackModal" class='btn btn-primary btn-sm btn-xs' onclick='getTrackingDetail(<?php echo e($order->id); ?>)'>Track Package</button>
									 </td>
                                    </tr>									
								  <?php endif; ?>
                                 </tfoot>
                              </table>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<!---------------------------------------------------------------->
<div class="modal" id="trackModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tracking</h4>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!---------------------------------------------------------------->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 <style>   
	.track_tbl td.track_dot {
    width: 50px;
    position: relative;
    padding: 0;
    text-align: center;
}
.track_tbl td.track_dot:after {
    content: "\f111";
    font-family: FontAwesome;
    position: absolute;
    margin-left: -5px;
    top: 14px;
}
.track_tbl td.track_dot span.track_line {
    background: #000;
    width: 3px;
    min-height: 50px;
    position: absolute;
    height: 101%;
}
.track_tbl tbody tr:first-child td.track_dot span.track_line {
    top: 30px;
    min-height: 25px;
}
.track_tbl tbody tr:last-child td.track_dot span.track_line {
    top: 0;
    min-height: 25px;
    height: 10%;
}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
<script>   
function getTrackingDetail(id){
	    $('#trackModal .modal-body').html('Getting detail...');
		$.ajax({
		  url: "<?php echo e(url('getTrackingDetail')); ?>/"+id,
		  cache: false,
		  success: function(data){
			$('#trackModal .modal-body').html(data);
			
		  }
		});
	
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/account/orders.blade.php ENDPATH**/ ?>