

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
  
  <a class="btn btn-outline-light" href="<?php echo e(url('admin/dynamic_menu')); ?>">My Subscription</a>
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>All Advance Product </h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class='col-12'> 
      <div class='card m-b-20'>
      <div class='card-body'>
	  <div class='row'>
	  <?php echo Form::open(['url' => 'admin/view_advance_product','class'=>'form-inline','method'=>'get']); ?>

	  <div class='col-md-12'>
	     <select class='form-control' name='qc'>
		   <option value=''>All</option>
		   <option value='0'>Awaiting Review</option>
		   <option value='1'>Approved</option>
		   <option value='2'>Declined</option>
		 </select>
		 <input type="text" class="form-control" placeholder='SKU' name='sku'>
		 <input type="text" class="form-control" placeholder='Keyword' name='keyword'>
		 <input type="text" class="form-control" placeholder='Title' name='title'>
		 <select class="form-control" placeholder='Affiliate' name='affiliate'>
              <option value=''>Affiliate</option>
			  <option>Yes</option>
			  <option>No</option>
         </select>
		 <input type="text" class="form-control" placeholder='Scheme' name='scheme'>
		 <input type='submit' value='Search' class='btn btn-primary'>
	  </div>
	  <br>
	  <br>
	  <?php echo Form::close(); ?>

	  </div>
      <table class='table table-striped table-bordered'>
	    <thead>
		  <tr>
		    <th>#</th>
		    <th>Product</th>
		    <th>Thumbnail</th>
		    <th>Price</th>
		    <th>Unit</th>
		    <th>Status</th>
			<?php if(Session::get('user')->id==1): ?>
			<th>Account</th>
			<?php endif; ?>
		    <th>Catalogue</th>
		    <th>Action</th>
		  </tr>
		</thead>
	    <tbody>
      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr>
		     <td><?php echo e(($key+1)); ?></td>
		     <td><?php echo e($row->title); ?></td>
		     <td><img style='height:70px;width:auto;' class="card-img-top" src="<?php echo e($row->thumbnail); ?>" alt="<?php echo e($row->title); ?>"></td>
		     <td><span style="text-decoration: line-through;"><?php echo e($row->product_price); ?></span> <?php echo e($row->selling_price); ?>

			 <br>
			 Tax : <?php echo e($row->product_tax); ?> <?php echo e($row->tax_method); ?>

			 </td>
			 <td><?php echo e($row->unit_quanitity); ?> <?php echo e($row->unit); ?></td>
		     <td><span style='padding: 3px 10px;background-color:<?php echo e($qc_color[$row->qc]); ?>'><?php echo e($qc[$row->qc]); ?></span>
			 <?php if($row->qc==2&&$row->decline_remarks!=Null): ?>
				 <br>
			    <strong>Reason : </strong><?php echo nl2br($row->decline_remarks); ?>

			 <?php endif; ?>
			 </td>
			 <?php if(Session::get('user')->id==1): ?>
			 <td><?php echo e($row->account->title); ?></td>
			 <?php endif; ?>
			 <td>
			   <a href="<?php echo e(url('admin/advance_product_catalogue/'.$row->id)); ?>" class='btn btn-sm btn-xs btn-primary'>View or Add</a>
			 </td>
		     <td>
			 <?php if(Session::get('user')->id==1): ?>
				<a href="https://<?php echo e($row->account->domain); ?>/detail/<?php echo e($row->sku); ?>" class="card-link" target='_blank'>View</a>
			   <?php if($row->qc==0): ?>
				<br>
			    <button type='button' class='btn btn-sm btn-primary' data-toggle="modal" data-target="#updateQcModal" onclick='$("#advance_product_qc_id").val(<?php echo e($row->id); ?>);'>Update Status</button> 
			   <?php endif; ?>
				   
			   
			 <?php else: ?>
			    <a href="<?php echo e(url('admin/add_advance_product/'.$row->dynamic_menu.'/'.$row->id)); ?>" class="card-link">Edit</a>
			    <a href="<?php echo e(url('admin/add_advance_product/'.$row->setting_id.'/'.$row->id)); ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateProductModal" onclick='setProductData("<?php echo e($row->id); ?>","<?php echo e($row->selling_price); ?>","<?php echo e($row->product_price); ?>","<?php echo e($row->unit_quanitity); ?>","<?php echo e($row->product_tax); ?>","<?php echo e($row->tax_method); ?>",<?php echo e($row->dynamic_selling_price); ?>,"<?php echo e($row->shipping_method); ?>","<?php echo e($row->is_affiliation); ?>","<?php echo e($row->affiliation_price); ?>","<?php echo e($row->affiliation_payment_release_online); ?>","<?php echo e($row->affiliation_payment_release_cod); ?>","<?php echo e($row->is_return); ?>")'>Update</a>
			 <?php endif; ?>
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
<!------------------------------------------------>

<div class="modal" id="updateProductModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Product Update</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php echo Form::open(['url' => 'admin/updateProductForm', 'id' => 'updateProductForm']); ?>

		  <div class="form-group">
			<label for="product_price">MRP:</label>
			<input type="text" class="form-control" placeholder="" name="product_price">
		  </div>
		  
		  <div class="form-group">
			<label for="selling_price">Selling Price:</label>
			<input type="text" class="form-control" placeholder="" name="selling_price">
		  </div>
		  
		  <div class="form-group">
			<label for="dynamic_selling_price">Dynamic Selling Price:</label>
			<input type="text" class="form-control" placeholder="" name="dynamic_selling_price">
		  </div>
		  
		  
		  <div class="form-group">
			<label for="unit_quanitity">Unit:</label>
			<input type="text" class="form-control" placeholder="" name="unit_quanitity">
		  </div>
		  
		  <div class="form-group">
			<label for="selling_price">Tax:</label>
			
		  </div>
		  
		  
		  <div class="input-group mb-3">
			<input type="text" class="form-control" placeholder="" name='product_tax'>
			<div class="input-group-append">
			  
			    <select class='form-control' name='tax_method'>
				  <option>Inclusive</option>
				  <option>Exclusive</option>
				</select>
			  
			</div>
		  </div>
		  <div class="form-group">
			<label for="shipping_method">Shipping Method:</label>
			<select class='form-control' name='shipping_method'>
				  <option>Inclusive</option>
				  <option>Exclusive</option>
		    </select>
		  </div>
		  <div class="form-group">
			<label for="shipping_method">Affiliation:</label>
			<select class='form-control' name='is_affiliation' onchange="if(this.value=='Yes'){$('.affiliation_price_div').show();}else{$('.affiliation_price_div').hide();}">
				  <option>No</option>
				  <option>Yes</option>
		    </select>
		  </div>
		  <div class="form-group affiliation_div">
			<label for="affiliation_price">Affiliation Price:</label>
			<input type="text" class="form-control" placeholder="" name="affiliation_price">
		  </div>
		  <div class="control-group affiliation_div">
										<label class="control-label">Affiliate Payment release on Online Payment</label>
										<div class="controls">
										<select type="text" class="form-control aff_payment_term"   name="affiliation_payment_release_online" id="affiliation_payment_release_online" >
										        <option>On Order recieved</option>
												<option>On Order Delivered</option>
												<option>On Payment Received</option>
												<option>On Return period complition</option>
												<option>On Return pick up</option> 
												<option>On Return good recieved</option>
												<option>On Return good audit</option>
											</select>
										</div>
			</div>

			<div class="control-group affiliation_div">
										<label class="control-label">Affiliate Payment release on For COD </label>
										<div class="controls">
										<select type="text" class="form-control  aff_payment_term"   name="affiliation_payment_release_cod" id="affiliation_payment_release_cod" >
										        <option>On Order recieved</option>
												<option>On Order Delivered</option>
												<option>On Payment Received</option>
												<option>On Return period complition</option>
												<option>On Return pick up</option> 
												<option>On Return good recieved</option>
												<option>On Return good audit</option>
											</select>
										</div>
			</div>		  
		  <input type='hidden' name='id' >
		<?php echo Form::close(); ?>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" form='updateProductForm' class="btn btn-success">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!------------------------------------------------>
<!------------------------------------------------>
<?php if(Session::get('user')->id==1): ?>
<div class="modal" id="updateQcModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Product Update</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php echo Form::open(['url' => 'admin/advance_product_qc', 'id' => 'advance_product_qc']); ?>

		  <div class="form-group">
			<label for="qc_status">Status:</label>
			<select class="form-control" placeholder="Enter email" id="qc_status" name="qc_status" onchange='if(this.value==2){$(".decline_remarks_div").show();}else{$(".decline_remarks_div").hide();}'>
			   <option value=''></option>
			   <option value='1'>Approve</option>
			   <option value='2'>Decline</option>
			</select>
		  </div>
		  <div class="form-group decline_remarks_div" style='display:none'>
			<label for="decline_remarks">Decline Reason:</label>
			<textarea class="form-control" placeholder="Decline Remarks" name="decline_remarks" id="decline_remarks"></textarea>
		  </div>
		  
		  <input type='hidden' name='advance_product_qc_id' id='advance_product_qc_id'>
		<?php echo Form::close(); ?>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" form='advance_product_qc' class="btn btn-success">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php endif; ?>
<!------------------------------------------------>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$('.searchable_class').select2({
	 width: 'resolve'
});
function setProductData(id,selling_price,product_price,unit_quanitity,product_tax,tax_method,dynamic_selling_price,shipping_method,is_affiliation,affiliation_price,affiliation_payment_release_online,affiliation_payment_release_cod,is_return){
	var option_html = '<option>On Order recieved</option><option>On Order Delivered</option><option>On Payment Received</option><option>On Return period complition</option><option>On Return pick up</option><option>On Return good recieved</option><option>On Return good audit</option>';
	if(is_return=='No'){
		option_html = '<option>On Order recieved</option><option>On Payment Received</option><option>On Order Delivered</option>';
	}
	$('.aff_payment_term').html(option_html);
	$('#updateProductForm input[name=id]').val(id);
	$('#updateProductForm input[name=selling_price]').val(selling_price);
	$('#updateProductForm input[name=product_price]').val(product_price);
	$('#updateProductForm input[name=unit_quanitity]').val(unit_quanitity);
	$('#updateProductForm input[name=product_tax]').val(product_tax);
	$('#updateProductForm [name=tax_method]').val(tax_method);
	$('#updateProductForm input[name=dynamic_selling_price]').val(dynamic_selling_price);
	$('#updateProductForm [name=shipping_method]').val(shipping_method);
	$('#updateProductForm [name=is_affiliation]').val(is_affiliation);
	$('#updateProductForm input[name=affiliation_price]').val(affiliation_price);
	$('#updateProductForm [name=affiliation_payment_release_online]').val(affiliation_payment_release_online);
	$('#updateProductForm [name=affiliation_payment_release_cod]').val(affiliation_payment_release_cod);
	if(is_affiliation=='Yes'){
		$('.affiliation_div').show();
	}else{
		$('.affiliation_div').hide();
	}
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/advance_product/view_advance_product.blade.php ENDPATH**/ ?>