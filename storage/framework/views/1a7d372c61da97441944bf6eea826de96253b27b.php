<?php $__env->startSection('pageTitle'); ?>

<h4 class="page-title"> <i class="dripicons-checklist"></i>Review Affiliate Keyword listing</h4>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

<?php if(session('message')): ?>
<div class="">
    <div class="alert alert-success">
        <?php echo e(session('message')); ?>

    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Keyword</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $affiliateKeywordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$affiliateKeyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <!--Delete Popup-->
                                <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($affiliateKeyword->id); ?>" title="Delete this data"></i>

                                <div class="modal fade deletePopup<?php echo e($affiliateKeyword->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0"><?php echo e($affiliateKeyword->keyword); ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure want to delete this?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <?php echo e(Form::open(array('url' => 'admin/affiliateKeyword/' . $affiliateKeyword->id))); ?>

                                                <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                                <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                <?php echo e(Form::close()); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <i class="mdi mdi-check btn btn-outline-primary" data-toggle="modal" data-target=".approvePopup<?php echo e($affiliateKeyword->id); ?>" title="Approve this data"></i>

                                <div class="modal fade approvePopup<?php echo e($affiliateKeyword->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0"><?php echo e($affiliateKeyword->keyword); ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure want to Approve this?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <?php echo e(Form::open(array('url' => 'admin/affiliateKeyword/approve/' . $affiliateKeyword->id))); ?>

                                                <?php echo e(Form::hidden('_method', 'POST')); ?>

                                                <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                <?php echo e(Form::close()); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo e($affiliateKeyword->keyword); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/affiliateKeyword/reviewkey.blade.php ENDPATH**/ ?>