

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
    <a href="<?php echo e(route('schemes.index')); ?>" class="btn btn-outline-light">
        Back
    </a>
</div>

<input type="hidden" value="1" id="position">
<h4 class="page-title"> <i class="dripicons-calendar"></i>Add Scheme</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <?php echo Form::open(['route' => 'schemes.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <?php if($errors->any()): ?>
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            <?php echo e($errors->first()); ?>

                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label>Scheme Name</label>
                                    <input type="text" placeholder="Enter schemes name" name="schemes" class="form-control" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label onclick="openImagePopup('schemes')">Scheme Banner File</label>
                                    <input type="text" id="imageschemes" onclick="openImagePopup('schemes')" placeholder="Choose image file" value="" name="schemes_file" class="form-control " required />
                                </div>
                            </div>
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

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Choose Image</h5>
                <button type="button" id="closeButton" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="mb-2 text-center card-body text-muted">
                        <ul class="new_friend_list list-unstyled row" id="replceFolderImage">
                            <?php $__currentLoopData = $imageUploadList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($image->mediaType == 1): ?>
                            <li class="col-lg-3 col-md-4 col-sm-6" onclick="openFolder('<?php echo e($image->id); ?>')">
                                <img src="http://ecommerce.uniqueandcommon.com/assets/images/folder.png" class="img-thumbnail">
                                <h6 class="users_name"><?php echo e($image->name); ?></h6>
                            </li>
                            <?php else: ?>
                            <li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl('<?php echo e($image->name); ?>')">
                                <img src="<?php echo e(URL::asset($image->name)); ?>" class="img-thumbnail">
                                <h6 class="users_name"><?php echo e($image->title); ?></h6>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/offers/scheme/add.blade.php ENDPATH**/ ?>