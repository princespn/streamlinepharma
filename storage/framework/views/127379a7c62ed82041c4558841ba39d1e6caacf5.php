<?php $__env->startSection('pageTitle'); ?>
<div class="float-right">
  
  <a class="btn btn-outline-light" href="<?php echo e(url('admin/view_description')); ?>">View</a>
    
</div>
<h4 class="page-title"> <i class="dripicons-list"></i>Create description</h4>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentData'); ?>
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-body">
		 <?php if(session('status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('status')); ?>

			</div>
		<?php endif; ?>
		   <?php echo Form::open(['url' => url('admin/set_description'), 'class' => '']); ?>

		      <div class="form-group">
				<label for="scheme_name">Description:</label>
				<input type="text" class="form-control" placeholder="description" id="description" name="description" required>
			  </div>
			  
			 
			  
			  <button type="submit" class="btn btn-primary">Create</button>			  
		   <?php echo Form::close(); ?>

			
         </div>
      </div>
   </div>
</div>

<!--------------------------------------------->
<!--------------------------------------------->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/setting/description/add.blade.php ENDPATH**/ ?>