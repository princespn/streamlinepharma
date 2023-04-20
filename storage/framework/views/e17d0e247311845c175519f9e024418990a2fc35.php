

<?php $__env->startSection('pageTitle'); ?>

    <div class="float-right">
        <a href="<?php echo e(route('socialMedia.index')); ?>" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="network-2"></i> Edit social media</h4>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <?php echo e(Form::model($socialMedia, array('route' => array('socialMedia.update', $socialMedia->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>

                    <?php echo e(csrf_field()); ?>

                
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <?php if($errors->any()): ?>
                                    <div class="alert bg-danger text-white msgPopup" role="alert">
                                    <?php echo e($errors->first()); ?>

                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="facebook" class="form-control" value="<?php echo e($socialMedia->facebook); ?>" />
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" name="twitter" class="form-control" value="<?php echo e($socialMedia->twitter); ?>"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Google Plus</label>
                                    <input type="text" name="googleplus" class="form-control" value="<?php echo e($socialMedia->googleplus); ?>"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" name="instagram" class="form-control" value="<?php echo e($socialMedia->instagram); ?>"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Pinterest</label>
                                    <input type="text" name="pinterest" class="form-control" value="<?php echo e($socialMedia->pinterest); ?>"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Dribble</label>
                                    <input type="text" name="dribble" class="form-control" value="<?php echo e($socialMedia->dribble); ?>"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Vimeo</label>
                                    <input type="text" name="vimeo" class="form-control" value="<?php echo e($socialMedia->vimeo); ?>"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Youtube</label>
                                    <input type="text" name="youtube" class="form-control" value="<?php echo e($socialMedia->youtube); ?>"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" class="form-control" value="<?php echo e($socialMedia->latitude); ?>"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" class="form-control" value="<?php echo e($socialMedia->longitude); ?>"/>
                                </div>
                            </div>
							
							<div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Linkedin</label>
                                    <input type="text" name="linkedin" class="form-control" value="<?php echo e($socialMedia->linkedin); ?>"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" class="form-control select2" value="<?php echo e($socialMedia->status); ?>">
                                        <option value="0" <?php echo e($socialMedia->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                                        <option value="1" <?php echo e($socialMedia->status == 1 ? 'selected' : ''); ?>>Active</option>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/pages/socialMedia/edit.blade.php ENDPATH**/ ?>