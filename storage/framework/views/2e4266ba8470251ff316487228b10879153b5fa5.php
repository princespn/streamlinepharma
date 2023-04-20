<?php $__env->startSection('pageTitle'); ?>

    <!--
    <div class="float-right">
        <a href="<?php echo e(route('register.create')); ?>" class="btn btn-outline-light">
            Add User
        </a>
    </div>
    -->
    
    <h4 class="page-title"> <i class="dripicons-list"></i> Register Users listing</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Phone</th>
                                <?php if(in_array('Membership and Scheme',$array)): ?>
                                    <th>Membership</th>
                                <?php endif; ?>
                                <?php if(in_array('Referral',$array)): ?>
                                <th>Referral </th>
                                <?php endif; ?>
                                <?php if(in_array('Last Order',$array)): ?>
								<th>Last Order Day</th>
                                <?php endif; ?>
                                <?php if(in_array('Last Login',$array)): ?>
								<th>Last Login</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $registerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$register): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td onclick="custPopup('<?php echo e(route('customerDetail',$register->id)); ?>')"><?php echo e($register->phone); ?></td>
                                    <?php if(in_array('Membership and Scheme',$array)): ?>
									<td></td>
                                    <?php endif; ?>
                                    <?php if(in_array('Referral',$array)): ?>
									<td></td>
                                    <?php endif; ?>
                                    <?php if(in_array('Last Order',$array)): ?>
									<td><?php echo e($register->latestOrder()); ?></td>
                                    <?php endif; ?>
                                    <?php if(in_array('Last Login',$array)): ?>
                                    <td><?php echo e($register->last_login_at); ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
<script>
    function custPopup(url) {
      var myWindow = window.open(url+"?ph=true", "_top ", "width=880,height=600");
    }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/users/register/index.blade.php ENDPATH**/ ?>