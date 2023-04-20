

<?php $__env->startSection('pageTitle'); ?>



<h4 class="page-title"> <i class="dripicons-calendar"></i>Services Tag Master</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Services Tag Master</div>
            <div class="card-body">
			<?php if(session('status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('status')); ?>

			</div>
		    <?php endif; ?>
			<?php echo Form::open(['url' => '#']); ?>

			    <div class="control-group">
				    <label class="control-label" for='title'>Select Service</label>
					<div class="controls">
						<select type='text' name='brand' class='form-control'  ></select>
					</div>
				</div>
				<div class="control-group">
				    <label class="control-label" for='title'>Service Tag</label>
					<div class="controls">
						<textarea type='text' name='brand' class='form-control'  ></textarea>
					</div>
				</div>
                <div class="form-actions" style='text-align:center;margin-top:40px'>
					<input type="submit" class="btn btn-outline-success" value="Update">
				</div>				
			<?php echo Form::close(); ?>

			</div>
		</div>
		
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/services/services-tag-master.blade.php ENDPATH**/ ?>