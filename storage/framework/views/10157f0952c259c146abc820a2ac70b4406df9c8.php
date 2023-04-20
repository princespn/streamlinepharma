

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
  
  
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>All Orders</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        
		<div class="card m-b-20">
		    
            <div class="card-body">
			<div class='row'>
			  
			  <?php echo Form::open(['url' => 'admin/advance_order','class'=>'form-inline','method'=>'get']); ?>

			  <div class='col-md-12'>
				 <input type='text' name='mobile' class='form-control' placeholder='Mobile'>
				 <input type='text' name='order_n' class='form-control' placeholder='Order N'>
				 <input type='text' name='aff_id' class='form-control' placeholder='Aff ID'>
				 From : <input type='date' name='date_from' class='form-control' placeholder='From'>
				 To : <input type='date' name='date_to' class='form-control' placeholder='To'>
				 <input type='submit' value='Search' class='btn btn-primary'>
			  </div>
			  <br>
			  <br>
			  <?php echo Form::close(); ?>

              <br>
			  <br>
              <?php echo Form::open(['url' => 'admin/delivery_pick_up_request','class'=>'form-inline','method'=>'get' , 'style'=>"margin: 20px 0px;"]); ?>

			  <div class='col-md-12'>
				 <input type='datetime-local' name='datetime' class='form-control' placeholder='Time' required>
				 <input type='number' name='expected_package_count' class='form-control' placeholder='Expected Package Count' required>
				
				 <input type='submit' value='Make Delivery Pick Up Request' class='btn btn-primary'>
			  </div>
			  <br>
			  <br>
			  <?php echo Form::close(); ?>


			  <div class='col-md-12'>
			  <ul class="nav nav-tabs">
				<li class="nav-item">
				   <a class="nav-link"  href="<?php echo e(url('admin/advance_order')); ?>">All</a>
				</li>
				<li class="nav-item">
				   <a class="nav-link"  href="<?php echo e(url('admin/advance_order?status=0')); ?>">Order Placed</a>
				</li>
				<li class="nav-item">
				   <a class="nav-link"  href="<?php echo e(url('admin/advance_order?status=1')); ?>">Payment</a>
				</li>
				<li class="nav-item">
				   <a class="nav-link"  href="<?php echo e(url('admin/advance_order?status=2')); ?>">Rejected</a>
				</li>
				<li class="nav-item">
				   <a class="nav-link"  href="<?php echo e(url('admin/advance_order?status=3')); ?>">Accepted</a>
				</li>
				<li class="nav-item">
				   <a class="nav-link"  href="<?php echo e(url('admin/advance_order?status=4')); ?>">Shipped</a>
				</li>
				<li class="nav-item">
				   <a class="nav-link"  href="<?php echo e(url('admin/advance_order?status=5')); ?>">Shipping Cancelled</a>
				</li>
				<li class="nav-item">
				   <a class="nav-link"  href="<?php echo e(url('admin/advance_order?status=6')); ?>">Order Cancelled</a>
				</li>
				<li class="nav-item">
				   <a class="nav-link"  href="<?php echo e(url('admin/advance_order?status=7')); ?>">Delivered</a>
				</li>
			</ul>
			</div>
			<br>
			  <br>
			  </div>
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>Address</th>
				      <th>Detail</th>
				      <th>Total</th>
				      <th>Product</th>
				   </tr>
				</thead>
				<tbody>
			    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				  <tr>
				    <td><?php echo e($key+1); ?></td>
				    <td>
					   <?php echo e($row->name); ?><br>
					   <?php echo e($row->phone); ?><br>
					   <?php echo e($row->email); ?><br>
					   <?php echo e($row->address); ?><br>
					   <?php echo e($row->landmark); ?><br>
					   <?php echo e($row->cityId); ?>, <?php echo e($row->stateId); ?>, <?php echo e($row->zipCode); ?>, <br>

					  
					</td>
				    <td>
					<?php if($row->affiliates): ?>
					  <div class='affiliate_div'>
						<strong> Affiliate : </strong><?php echo e($row->affiliates->code); ?><br>
						<strong> Amount : </strong><?php echo e($row->aff_amount); ?>

					  </div>
					<?php endif; ?>
					
					<strong> Order : </strong><?php echo e($row->order_id); ?><br>
					<strong> Date : </strong><?php echo e($row->created_at); ?><br>
					   <strong> Status : </strong><?php echo e($constant_order_status[$row->status]); ?><br>
					   
					   <?php if($row->transactionType!=1): ?>
						   <strong> Payment Method : </strong><?php echo e($payment_gateway[$row->transactionType]); ?><br>
						   <strong> Transaction ID : </strong><?php echo e($row->transactionId); ?><br>
					   <?php endif; ?>
					   
					   <?php if($row->status==4): ?>
						<strong> From : </strong><?php echo e($shipping_gateway[$row->shipping_gateway]); ?><br>
					     
					   <?php endif; ?>
					  <?php if($row->status==0): ?>
					   <br>
					   <a href="<?php echo e(url('admin/advance_order_status/'.$row->id.'/3')); ?>" onclick='return confirm("Are you sure want to Accept ?");'>Accept</a>
					   <br>
					   <a href="<?php echo e(url('admin/advance_order_status/'.$row->id.'/2')); ?>"  onclick='return confirm("Are you sure want to Reject ?");'>Reject</a>
					  <?php elseif($row->status==3): ?>
					  
					  <br>
					  <a href="#" data-toggle="modal" data-target="#shippingModal" onclick="$('#order_id').val(<?php echo e($row->id); ?>)">Genrate Order</a>
					  <?php elseif($row->status==4): ?>
					    <br>
						<?php try{ ?>
						<?php if($row->shipping_gateway==1): ?>
						  <a href="<?php echo e(url('admin/cancel_shipping/'.$row->id)); ?>" class='btn btn-danger btn-sm' onclick='return confirm("Are you sure want to Cancel The Shipping ?");'>Cancel Shipping</a>
					  
					      <br>
					      <a href="<?php echo e(json_decode($row->shipyaariOrderResponse,true)['shipment_label']); ?>">Print Label</a>
					    <?php elseif($row->shipping_gateway==2): ?>
						 <?php if($row->shiprocketPickUpRequest==Null): ?>
						  <a href="<?php echo e(url('admin/shiprocketPickUpRequest/'.$row->id)); ?>" >Make PickUp Request</a><br>
					     <?php endif; ?>
						 <?php if($row->shiprocketPickUpRequest!=Null&&isset(json_decode($row->shiprocketPickUpRequest,true)['message'])): ?>
							<strong>Pick Up Response : </strong> <span  style='color:red'><?php echo e(json_decode($row->shiprocketPickUpRequest,true)['message']); ?>  </span><br>
						    <a href="<?php echo e(url('admin/shiprocketPickUpRequest/'.$row->id)); ?>" >Make PickUp Request</a><br>
						 <?php endif; ?>
						 <?php if($row->shiprocketManifests): ?>
						      <?php $manifest = json_decode($row->shiprocketManifests,true); ?>
						      <br>
							  <?php if(array_key_exists('message',$manifest)): ?>
                                <span style='color:red'><strong>Manifest Response :</strong> <?php echo e($manifest['message']); ?></span><br>
							  <?php else: ?>
					             <a href="<?php echo e($manifest['manifest_url']); ?>">Print Manifest</a><br>
							  <?php endif; ?>
					     <?php endif; ?>
						  <a href="#" >Print Label</a>
						
						<?php elseif($row->shipping_gateway==3): ?>
						   <a href="<?php echo e(url('admin/print_delhivery_packing_slip/'.$row->id)); ?>" target='_blank'>Print Packing Slip</a>
						   <?php if($row->delhiVeryPickUpResponse==Null): ?>
						      <!--a href="<?php echo e(url('admin/delivery_pick_up_request/'.$row->id)); ?>" >Make Pick Up Request</a-->
						   <?php endif; ?>
						<?php endif; ?>
					    <?php }catch(Exception $e) { ?>
					 	  NA
					    <?php } ?>
						<br>
					    <a target='_blank' href="<?php echo e(url('admin/orderPrint/'.$row->id)); ?>">Print PDF</a>
					  <?php endif; ?>
					  
					  <?php if($row->shipyaariOrderResponse!=Null&& array_key_exists('status',json_decode($row->shipyaariOrderResponse,true))): ?>
						  <p style='color:red'><strong>Shipyaari Status : </strong> <?php echo e(json_decode($row->shipyaariOrderResponse,true)['status']); ?></p>
					  <?php endif; ?>
					  
					  <br><strong>Shipping : </strong><br>
					  <?php try{ ?>
					    Shipyaari Charge : <?php echo e(json_decode($row->shipyaariAvailability,true)[0]['total']); ?><br>
					  <?php }catch(Exception $e) { ?>
					 	NA
					  <?php } ?>
					  
					  <?php try{ ?>
					    Shiprocket Charge : <?php echo e(json_decode($row->shipRocketAvailability,true)['data']['available_courier_companies'][0]['rate']); ?><br>
					  <?php }catch(Exception $e) { ?>
					 	NA
					  <?php } ?>
					  
					  <?php if($row->shirocketWebHook!=Null): ?>
						 <?php $ship = json_decode($row->shirocketWebHook,true); ?>
                         <strong>Current Status : </strong><?php echo e($ship['current_status']); ?> <button data-toggle="modal" data-target="#trackModal" class='btn btn-primary btn-sm btn-xs' onclick='getTrackingDetail(<?php echo e($row->id); ?>)'>Track Package</button>					 
					  <?php endif; ?>
					</td>
				    <td>
						 <?php echo ($row->discount_coupon_amount==0 ? "<strong>Grand Total : </strong>".$row->grand_total : "<strong>Total : </strong>".$row->grand_total."<br><strong>Discount : </strong>".$row->discount_coupon_amount."<br><strong>Grand Total : </strong>".($row->grand_total-$row->discount_coupon_amount)); ?>

						 <?php if($row->do_to_wallet>0): ?>
                             <br><strong>Paid By Wallet : </strong><?php echo e($row->do_to_wallet); ?>

						 <?php endif; ?>
					</td>
				    <td>
					  <table style="width: 100%;">
					  <?php $__currentLoopData = $row->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					   <tbody>
						  <tr>
							 <td style="width:50px;border-right: 0px;border-top: 0px;">
								<img src="<?php echo e($product->thumbnail); ?>" style="height: 100px;">
							 </td>
							 <td style="border-top: 0px;">
								<?php echo e($product->title); ?><br>
								PRICE : ₹. <?php echo e($product->product_price); ?> <br>
								
								<?php if($product->referral_id): ?>
								  <div class='affiliate_div'>
									<strong> <?php echo e(@$product->ReferralScheme->scheme_name); ?></strong> 
								  </div>
								  <strong><?php echo e($product->special_charges_label); ?> : </strong><?php echo e($product->special_charges); ?><br>
								<?php endif; ?>
								
								SKU :  <?php echo e($product->product->sku); ?> <br>
								
							
                               <?php if($product->aff_id): ?>
							  <div class='affiliate_div'>
								<strong> Affiliate : </strong><?php echo e($product->aff_amount); ?>

							  </div>
							   <?php endif; ?>
                               <?php if($product->offerDescription): ?>
									<span class='offer'><strong>Offer Applied - </strong><?php echo e($product->offerDescription); ?></span>
								<?php endif; ?>
								<?php if($row->discount_coupon_amount > 0): ?>
								<span class='offer'>C.D. : ₹ <?php echo e($row->discount_coupon_amount); ?></span>
								<?php endif; ?>

							
								
								
							 </td>
							 <td style="border-top: 0px;width: 40%;">
							 <?php if($product->offerDescription): ?>
								 ₹. <span style='text-decoration: line-through;'><?php echo e($product->selling_price); ?></span> 
							 <?php else: ?>
								Price :  
								₹. <?php echo e($product->selling_price); ?>

							 <?php endif; ?>
								<br>
								Qty : <?php echo e($product->qty); ?><br>
							<?php if($row->do_to_wallet > 0): ?>	
								W.Pay : ₹ <?php echo e($row->do_to_wallet); ?> <br/>
							<?php endif; ?>
							 <?php if($product->offerDescription): ?>
								Sub Total : ₹. <span style='text-decoration: line-through;'><?php echo e($product->total); ?></span> 
							 <?php else: ?>
								Sub Total : ₹. <?php echo e($product->total - ($row->discount_coupon_amount + ($row->do_to_wallet ? $row->do_to_wallet:0))); ?>

							 <?php endif; ?>
							<br>
								Tax (0 %) : ₹. <?php echo e($product->product_tax); ?><br>
								Shipping : ₹. <?php echo e(($product->shipping_charges ? $product->shipping_charges:0)); ?><br>
							 </td>
						  </tr>
					   </tbody>
					   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
					</td>
				  </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			  </table>
			  <?php echo e($data->links()); ?>

			</div>
		</div>
	</div>
</div>

<!---------------------------------------------------------------->
<div class="modal" id="shippingModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Shipping</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php echo e(Form::open(array('url' => url('admin/updateCourierDetails'),'id'=>'courier_form'))); ?>

		<div class="form-group">
		  <label for="courierType">Courier Type:</label>
		  <select class="form-control" name='courierType'  id="courierType">
		      <option value='1'>Shipyaari</option>
		      <option value='2'>ShipRocket</option>
		      <option value='3'>Delhivery</option>
		  </select>
	     </div>
		 <input type='hidden' name='order_id'  form='courier_form' id='order_id'>
		<?php echo e(Form::close()); ?>


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" form='courier_form'>Update</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!---------------------------------------------------------------->
<div class="modal" id="trackModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tracking</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!---------------------------------------------------------------->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<style>
	.affiliate_div{
		background: #ac3248;
		color: #fff;
		padding: 3px 5px;
		border-radius: 5px;
		min-width: 190px;
	}
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
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
	color:#fff !important;
}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	<?php if(isset($_GET['status'])): ?>
	   $("[href='<?php echo e(url('admin/advance_order?status='.$_GET['status'])); ?>']").addClass('active');
	<?php else: ?>
	   $("[href='<?php echo e(url('admin/advance_order')); ?>']").addClass('active');
	<?php endif; ?>
$('.searchable_class').select2({
	 width: 'resolve'
});
function getSubCategory(value){
	$('#sub_category').html("<option value=''></option>");
	if(value!=''){
		$.ajax({
		  url: "<?php echo e(url('admin/getSubCategory')); ?>/"+value,
		  cache: false,
		  success: function(data){
			if(data.length){
				for(var i = 0;i<data.length;i++){
					$('#sub_category').append($("<option></option>").attr("value", data[i].id).text(data[i].name)); 
				}
			}
		  }
		});
	}else{
		$('#sub_category').html("<option value=''></option>");
	}
}
function getTrackingDetail(id){
	    $('#trackModal .modal-body').html('Getting detail...');
		$.ajax({
		  url: "<?php echo e(url('admin/getTrackingDetail')); ?>/"+id,
		  cache: false,
		  success: function(data){
			$('#trackModal .modal-body').html(data);
			
		  }
		});
	
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/advance_product/advance_order.blade.php ENDPATH**/ ?>