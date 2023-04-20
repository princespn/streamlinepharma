<?php $__env->startSection('pageTitle'); ?>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Bank Detail Management</div>
            <div class="card-body">
			<?php if(session('status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('status')); ?>

			</div>
		        <?php endif; ?>
                        <?php if($errors->any()): ?>
                        <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
                                <?php endif; ?>
			<?php echo Form::open(['url' => 'admin/bank-detail']); ?>

            <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" placeholder="Enter Name" id="name" name='name' <?php if(isset($data)): ?> value="<?php echo e($data['contact']['name']); ?>" <?php endif; ?>>
            </div>
            <div class="form-group">
                    <label for="name">Mobile:</label>
                    <input type="text" class="form-control" placeholder="Enter Mobile" id="mobile" name='mobile'  <?php if(isset($data)): ?> value="<?php echo e(substr($data['contact']['contact'],2)); ?>" <?php endif; ?>>
            </div>
            <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" placeholder="Enter Email" id="email" name='email'  <?php if(isset($data)): ?> value="<?php echo e($data['contact']['email']); ?> <?php endif; ?>">
            </div>
            <div class="form-group">
                    <label for="ifsc">IFSC:</label>
                    <input type="text" class="form-control" placeholder="Enter IFSC" id="ifsc" name='ifsc'  <?php if(isset($data)): ?> value="<?php echo e($data['funds']['bank_account']['ifsc']); ?>" <?php endif; ?>>
            </div>
            <div class="form-group">
                    <label for="account_number">Account Number:</label>
                    <input type="text" class="form-control" placeholder="Enter Account Number" id="account_number" name='account_number'  <?php if(isset($data)): ?> value="<?php echo e($data['funds']['bank_account']['account_number']); ?>" <?php endif; ?>>
            </div>
            <?php if(!isset($data)): ?>
            <button type="submit" class="btn btn-primary">Submit</button>
			<?php echo Form::close(); ?>

			</div>
	    </div>
            <?php endif; ?>
		
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/affiliate/bank/index.blade.php ENDPATH**/ ?>