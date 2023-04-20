

<?php $__env->startSection('pageTitle'); ?>

    <?php if(count($socialMediaList) == 0): ?>
        <div class="float-right">
            <a href="<?php echo e(route('socialMedia.create')); ?>" class="btn btn-outline-light">
                Add social media
            </a>
        </div>
    <?php endif; ?>
    <h4 class="page-title"> <i class="dripicons-network-2"></i> Social Media listing</h4>

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
                                <th>Facebook</th>
                                <th>Twitter</th>
                                <th>Google Plus</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $socialMediaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$socialMedia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <!--Edit Icon-->
                                        <a href="<?php echo e(URL::to('admin/socialMedia/' . $socialMedia->id . '/edit')); ?>">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td><?php echo e($socialMedia->facebook); ?></td>
                                    <td><?php echo e($socialMedia->twitter); ?></td>
                                    <td><?php echo e($socialMedia->googleplus); ?></td>
                                    <td>
                                        <?php switch($socialMedia->status):

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/pages/socialMedia/index.blade.php ENDPATH**/ ?>