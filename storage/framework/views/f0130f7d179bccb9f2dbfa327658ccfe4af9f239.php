

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
  
  
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>In Cart Products</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        
		<div class="card m-b-20">
		    
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>User</th>
				      <th>Mobile</th>
				      <th>Products</th>
				   </tr>
				</thead>
				<tbody>
				<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				   <tr>
				     <td><?php echo e($key+1); ?></td>
					 <td><?php echo e($row->register->name); ?></td>
					 <td><?php echo e($row->register->phone); ?></td>
					 <td>
					   <table style="width: 100%;" class='table table-striped'>
					   <tbody>
						<?php $__currentLoopData = $row->register->inCart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						  <tr>
							<td><img src='<?php echo e($pr->product->thumbnail); ?>' width='30'></td>
							<td><?php echo e($pr->product->title); ?></td>
							<td><?php echo e($pr->product->sku); ?></td>
							<td>Rs. <?php echo e($pr->product->selling_price); ?> </td>
							<td><?php echo e($pr->qty); ?></td>
						  </tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					   </tbody>
					   </table>
					 </td>
				   </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			  </table>
			  
			</div>
		</div>
	</div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/advance_product/in_cart.blade.php ENDPATH**/ ?>