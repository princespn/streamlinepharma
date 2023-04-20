

<?php $__env->startSection('pageTitle'); ?>

    <div class="float-right">
        <a href="<?php echo e(route('myKeyword.index')); ?>" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-checklist"></i> Add my keyword</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <?php echo Form::open(['route' => 'myKeyword.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

                    <?php echo e(csrf_field()); ?>

                    
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <?php if($errors->any()): ?>
                                    <div class="alert bg-danger text-white msgPopup" role="alert">
                                    <?php echo e($errors->first()); ?>

                                    </div>
                                <?php endif; ?>
								<?php if(session('status')): ?>
									<div class="alert alert-success">
										<?php echo e(session('status')); ?>

									</div>
								<?php endif; ?>
                            </div>

                            <?php $__currentLoopData = $affiliateKeywordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$affiliateKeyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-4 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="keyword_id[]" value="<?php echo e($affiliateKeyword->id); ?>" id="affiliation<?php echo e($affiliateKeyword->id); ?>"
											<?php if(in_array($affiliateKeyword->id,$subscribed)): ?>
											checked
										    <?php endif; ?>
											>
                                            <label class="custom-control-label" for="affiliation<?php echo e($affiliateKeyword->id); ?>"><?php echo e($affiliateKeyword->name); ?></label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/affiliate/myKeyword/add.blade.php ENDPATH**/ ?>