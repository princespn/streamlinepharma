<?php $__env->startSection('pageTitle'); ?>



<h4 class="page-title"> <i class="dripicons-calendar"></i>Register Users listing Coloumn</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Register Users listing Coloumn</div>
            <div class="card-body">
			<?php if(session('status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('status')); ?>

			</div>
		    <?php endif; ?>
			<?php echo Form::open(['url' => url('admin/register_users_listing_coloumn'),'class'=>'form-group']); ?>

            <div class="form-group form-check">
                <label class="form-check-label"><input class="form-check-input" type="checkbox"  name="users_listing_coloumn[]" required <?php if(in_array('Last Order',$array)): ?> checked <?php endif; ?> value='Last Order'>Last Order</label>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="users_listing_coloumn[]" required <?php if(in_array('Referral',$array)): ?> checked <?php endif; ?> value='Referral'>Referral</label>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="users_listing_coloumn[]" required <?php if(in_array('Membership and Scheme',$array)): ?> checked <?php endif; ?> value='Membership and Scheme'>Membership and Scheme</label>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="users_listing_coloumn[]" required <?php if(in_array('Last Login',$array)): ?> checked <?php endif; ?> value='Last Login'>Last Login </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
			<?php echo Form::close(); ?>

			</div>
		</div>
		
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/users/register_users_listing_coloumn.blade.php ENDPATH**/ ?>