

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
  
  <a class="btn btn-outline-light" href="<?php echo e(url('admin/view_advance_product')); ?>">View Added Product</a>
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Brand Management</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Brand Management</div>
            <div class="card-body">
			<?php if(session('status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('status')); ?>

			</div>
		    <?php endif; ?>
			<?php echo Form::open(['url' => 'admin/brand','class'=>'form-inline']); ?>

			      <label for="brand" class="mr-sm-2">Brand:</label>
				  <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter Brand Name" id="brand" name="brand">
				  <label for="image" class="mr-sm-2">Image:</label>
				  <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter Image Link" id="image" name="image">
				  <button type="submit" class="btn btn-primary">Add</button>
			<?php echo Form::close(); ?>

			</div>
		</div>
		<div class="card m-b-20">
		    <div class="card-header">Added</div>
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>Name</th>
				      <th>Image</th>
				   </tr>
				</thead>
				<tbody>
			    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				   <tr>
				      <td><?php echo e($key+1); ?></td>
				      <td><?php echo e($row->name); ?></td>
				      <td><img src='<?php echo e($row->image); ?>' width='70'></td>
				   </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/brand/brand.blade.php ENDPATH**/ ?>