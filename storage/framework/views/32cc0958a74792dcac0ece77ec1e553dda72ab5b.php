<?php $__env->startSection('pageTitle'); ?>

    <?php if(count($extraServiceList) == 0): ?>
        <div class="float-right">
            <a href="<?php echo e(route('extraService.create')); ?>" class="btn btn-outline-light">
                Add extra service
            </a>
        </div>
    <?php endif; ?>

    <h4 class="page-title"> <i class="dripicons-list"></i> Extra service listing</h4>

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
                                <th>Delivery</th>
                                <th>Delivery Title</th>
                                <th>Money Back</th>
                                <th>Money Back Title</th>
                                <th>Support</th>
                                <th>Support Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $extraServiceList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$extraService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>                                    
                                        <!--Edit Icon-->
                                        <a href="<?php echo e(URL::to('admin/extraService/'. $extraService->id.'/edit')); ?>">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php switch($extraService->delivery):

                                            case (1): ?>
                                                
                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> On
                                            <?php break; ?>

                                            <?php default: ?>
                                            
                                                <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Off
                                        <?php endswitch; ?>
                                    </td>
                                    <td><?php echo e($extraService->deliveryTitle); ?></td>
                                    <td>
                                        <?php switch($extraService->moneyBack):

                                            case (1): ?>
                                                
                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> On
                                            <?php break; ?>

                                            <?php default: ?>
                                            
                                                <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Off
                                        <?php endswitch; ?>
                                    </td>
                                    <td><?php echo e($extraService->moneyBackTitle); ?></td>
                                    <td>
                                        <?php switch($extraService->support):

                                            case (1): ?>
                                                
                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> On
                                            <?php break; ?>

                                            <?php default: ?>
                                            
                                                <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Off
                                        <?php endswitch; ?>
                                    </td>
                                    <td><?php echo e($extraService->supportTitle); ?></td>
                                    <td>
                                        <?php switch($extraService->status):

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/pages/extraService/index.blade.php ENDPATH**/ ?>