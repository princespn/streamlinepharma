<?php $__env->startSection('pageTitle'); ?>
    <h4 class="page-title"> <i class="dripicons-meter"></i> Dashboard</h4>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

<div class="row">

    

    <?php if($userType==1): ?>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-purple">
                        <?php echo e($orders); ?>

                    </h3>

                    Delivered Orders

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-danger">
                        <?php echo e($cancel_orders); ?>

                    </h3>

                    Cancel Orders

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-primary">
                        <?php echo e($revers_order); ?>

                    </h3>

                    Reverse Order

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-dark"><?php echo e($replace_order); ?></h3>

                    Replcament Order

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-warning"><?php echo e($aff_orders); ?></h3>

                    Affiliate Order

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-warning"><?php echo e($total_enq); ?></h3>

                    Total Inquiry

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-warning"><?php echo e($registers); ?></h3>

                    Register User

                </div>

            </div>

        </div>
    <?php else: ?> 
    <div class="col-md-6 col-xl-3">

        <div class="card text-center m-b-30">

            <div class="mb-2 card-body text-muted">

                <h3 class="text-purple">
                    ₹ <?php echo e($income_aff); ?> 
                    
                </h3>
                Affiliate
            </div>

        </div>

    </div>
	<div class="col-md-6 col-xl-3">

        <div class="card text-center m-b-30">

            <div class="mb-2 card-body text-muted">

                <h3 class="text-purple">
                    ₹ <?php echo e($income_aff_hold); ?> 
                    
                </h3>
                Affiliate ( Hold )
            </div>

        </div>

    </div>
        
    <?php endif; ?>
</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/dashboard.blade.php ENDPATH**/ ?>