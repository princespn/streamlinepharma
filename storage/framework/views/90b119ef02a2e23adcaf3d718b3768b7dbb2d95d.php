<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">

    <a href="<?php echo e(route('offerNormal.create')); ?>" class="btn btn-outline-light">

        Add normal offer

    </a>

</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i> Normal Offer listing</h4>



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

                                <th>Start Date</th>

                                <th>End Date</th>

                                <th>Coupon Code</th>

                                <th>SKU Min. Value</th>

                                <th>Discount</th>

                                <th>No Of Users</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $__currentLoopData = $offerNormalList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$offerNormal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>

                                    <td>



                                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($offerNormal->id); ?>" title="Delete this data"></i>



                                        <div class="modal fade deletePopup<?php echo e($offerNormal->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-dialog-centered">

                                                <div class="modal-content">

                                                    <div class="modal-header">

                                                        <h5 class="modal-title mt-0"><?php echo e($offerNormal->couponCode); ?></h5>

                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                    </div>

                                                    <div class="modal-body">

                                                        <p>Are you sure want to delete this?</p>

                                                    </div>

                                                    <div class="modal-footer">

                                                        <?php echo e(Form::open(array('url' => 'admin/offerNormal/' . $offerNormal->id))); ?>


                                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                                            <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                        <?php echo e(Form::close()); ?>


                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                        <!--Edit Icon-->

                                        <a href="<?php echo e(URL::to('admin/offerNormal/' . $offerNormal->id . '/edit')); ?>">

                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>

                                        </a>

                                    </td>

                                    <td><?php echo e($key+1); ?></td>

                                    <td><img src="<?php echo e(URL::asset($offerNormal->website_url_image)); ?>" class="d-flex align-self-end" height="20"></td>

                                    <td><img src="<?php echo e(URL::asset($offerNormal->mobile_url_image)); ?>" class="d-flex align-self-end" height="20"></td>

                                    <td><?php echo e($offerNormal->startDate); ?></td>

                                    <td><?php echo e($offerNormal->endDate); ?></td>

                                    <td><?php echo e($offerNormal->couponCode); ?></td>

                                    <td><?php echo e($offerNormal->cartMinValue); ?></td>

                                    <td><?php echo e($offerNormal->discount); ?> %</td>

                                    <td><?php echo e($offerNormal->noOfUsers); ?></td>

                                    <td>

                                        <?php switch($offerNormal->status):



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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/offers/offerNormal/index.blade.php ENDPATH**/ ?>