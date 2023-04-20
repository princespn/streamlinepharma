

<?php $__env->startSection('pageTitle'); ?>

    <?php if(count($privacyList) == 0): ?>
        <div class="float-right">
            <a href="<?php echo e(route('privacy.create')); ?>" class="btn btn-outline-light">
                Add privacy policy
            </a>
        </div>
    <?php endif; ?>

    <h4 class="page-title"> <i class="dripicons-list"></i> Privacy Policy listing</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Heading</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $privacyList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$privacy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>                                    
                                        <!--Edit Icon-->
                                        <a href="<?php echo e(URL::to('admin/privacy/'. $privacy->id.'/edit')); ?>">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td><?php echo e($privacy->heading); ?></td>
                                    <td>
                                        <?php switch($privacy->status):

                                            case (1): ?>
                                                
                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active
                                            <?php break; ?>

                                            <?php default: ?>
                                            
                                                <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive
                                        <?php endswitch; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/pages/privacy/index.blade.php ENDPATH**/ ?>