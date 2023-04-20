

<?php $__env->startSection('pageTitle'); ?>

    <div class="float-right">
        <a href="<?php echo e(route('returning.index')); ?>" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-list"></i> Add return policy</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <?php echo Form::open(['route' => 'returning.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

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
                                    <input type="text" name="heading" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="summernote" required></textarea>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/pages/returning/add.blade.php ENDPATH**/ ?>