

<?php $__env->startSection('pageTitle'); ?>

    <div class="float-right">
        <a href="<?php echo e(route('about.index')); ?>" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-list"></i> Edit aboutus</h4>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <?php echo e(Form::model($about, array('route' => array('about.update', $about->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>

                    <?php echo e(csrf_field()); ?>

                
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <?php if($errors->any()): ?>
                                    <div class="alert bg-danger text-white msgPopup" role="alert">
                                    <?php echo e($errors->first()); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" name="heading" class="form-control" value="<?php echo e($about->heading); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="summernote"><?php echo e($about->description); ?></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" class="form-control select2" value="<?php echo e($about->status); ?>" required>
                                        <option value="0" <?php echo e($about->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                                        <option value="1" <?php echo e($about->status == 1 ? 'selected' : ''); ?>>Active</option>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/pages/aboutus/edit.blade.php ENDPATH**/ ?>