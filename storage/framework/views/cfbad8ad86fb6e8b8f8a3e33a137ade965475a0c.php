<?php $__env->startSection('pageTitle'); ?>

    <div class="float-right">
        <a href="<?php echo e(route('userReason.index')); ?>" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-toggles"></i> Edit User Reason</h4>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <?php echo e(Form::model($userReason, array('route' => array('userReason.update', $userReason->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>

                    <?php echo e(csrf_field()); ?>

                
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <?php if($errors->any()): ?>
                                    <div class="alert bg-danger text-white msgPopup" role="alert">
                                    <?php echo e($errors->first()); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Select Type</label>
                                    <select name="type" class="form-control select2" required>
                                        <option value="1" <?php echo e($userReason->type == 1 ? 'selected' : ''); ?>>Cancel</option>
                                        <option value="2" <?php echo e($userReason->type == 2 ? 'selected' : ''); ?>>Return</option>
                                        <option value="3" <?php echo e($userReason->type == 3 ? 'selected' : ''); ?>>Replacement</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo e($userReason->title); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" class="form-control select2" value="<?php echo e($userReason->status); ?>" required>
                                        <option value="0" <?php echo e($userReason->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                                        <option value="1" <?php echo e($userReason->status == 1 ? 'selected' : ''); ?>>Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                
                                <button type="submit" class="btn btn-outline-primary">
                                    Submit
                                </button>

                            </div>
                        </div>

                    <?php echo Form::close(); ?> 

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/product/userReason/edit.blade.php ENDPATH**/ ?>