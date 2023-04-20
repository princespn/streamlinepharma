

<?php $__env->startSection('pageTitle'); ?>

    <div class="float-right">
        <a href="<?php echo e(route('affiliate.index')); ?>" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-user-group"></i> Edit affiliate</h4>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <?php echo e(Form::model($affiliate, array('route' => array('affiliate.update', $affiliate->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>

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
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo e($affiliate->name); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" class="form-control" value="<?php echo e($affiliate->phone); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo e($affiliate->email); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="<?php echo e($affiliate->address); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Commission in %</label>
                                    <input type="text" name="commission" class="form-control" value="<?php echo e($affiliate->commission); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" class="form-control select2" value="<?php echo e($affiliate->status); ?>" required>
                                        <option value="0" <?php echo e($affiliate->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                                        <option value="1" <?php echo e($affiliate->status == 1 ? 'selected' : ''); ?>>Active</option>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/affiliate/edit.blade.php ENDPATH**/ ?>