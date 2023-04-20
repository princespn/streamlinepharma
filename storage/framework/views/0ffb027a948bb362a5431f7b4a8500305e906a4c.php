

<?php $__env->startSection('pageTitle'); ?>
<div class="float-right">
    <a href="<?php echo e(route('category.create')); ?>" class="btn btn-outline-light">
        Add category
    </a>
</div>
<h4 class="page-title"> <i class="dripicons-wallet"></i> Category listing</h4>

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
                                <th>No</th>
                                <th>Website</th>
                                <th>Mobile</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>

                                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($category->id); ?>" title="Delete this data"></i>

                                        <div class="modal fade deletePopup<?php echo e($category->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0"><?php echo e($category->name); ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure want to delete this?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php echo e(Form::open(array('url' => 'admin/category/' . $category->id))); ?>

                                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                                            <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                        <?php echo e(Form::close()); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Edit Icon-->
                                        <a href="<?php echo e(URL::to('admin/category/' . $category->id . '/edit')); ?>">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><img src="<?php echo e(URL::asset($category->website_url_image)); ?>" class="d-flex align-self-end" height="20"></td>
                                    <td><img src="<?php echo e(URL::asset($category->mobile_url_image)); ?>" class="d-flex align-self-end" height="20"></td>
                                    <?php if($category->parentCategory && $category->parentCategory->parentCategory): ?>
                                        <td><?php echo e($category->parentCategory->parentCategory->name); ?> -> <?php echo e($category->parentCategory->name); ?>  -> <?php echo e($category->name); ?> </td>
                                    <?php elseif($category->parentCategory): ?>
                                        <td><?php echo e($category->parentCategory->name); ?> -> <?php echo e($category->name); ?></td>
                                    <?php else: ?>
                                         <td><?php echo e($category->name); ?></td>
                                    <?php endif; ?>
                                    <td>
                                        <?php switch($category->status):

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/product/category/index.blade.php ENDPATH**/ ?>