<?php $__env->startSection('pageTitle'); ?>



    <div class="float-right">

        <a href="<?php echo e(route('slider.create')); ?>" class="btn btn-outline-light">

            Add slider

        </a>

    </div>



    <h4 class="page-title"> <i class="dripicons-toggles"></i> Slider listing</h4>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('contentData'); ?>



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        <strong>Oh snap!</strong> A slider will be disabled if slider size and dimensions are not valid.
                    </div>

                    <table id="datatable" class="table table-bordered">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Image</th>

                                <th>Title</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $__currentLoopData = $sliderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>

                                    <td>

                                        

                                        <!--Delete Popup-->

                                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($slider->id); ?>" title="Delete this data"></i>



                                        <div class="modal fade deletePopup<?php echo e($slider->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-dialog-centered">

                                                <div class="modal-content">

                                                    <div class="modal-header">

                                                        <h5 class="modal-title mt-0"><?php echo e($slider->title); ?></h5>

                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                    </div>

                                                    <div class="modal-body">

                                                        <p>Are you sure want to delete this?</p>

                                                    </div>

                                                    <div class="modal-footer">

                                                        <?php echo e(Form::open(array('url' => 'admin/slider/' . $slider->id))); ?>


                                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                                            <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                        <?php echo e(Form::close()); ?>


                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                        <!--Edit Icon-->

                                        <a href="<?php echo e(URL::to('admin/slider/'. $slider->id.'/edit')); ?>">

                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>

                                        </a>

                                    </td>

                                    <td><img src="<?php echo e(URL::asset($slider->imageURL)); ?>" class="d-flex align-self-end" height="20"></td>

                                    <td><?php echo e($slider->title); ?></td>

                                    <td>

                                        <?php switch($slider->status):



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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/product/slider/index.blade.php ENDPATH**/ ?>