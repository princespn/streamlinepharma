

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
    <a href="<?php echo e(route('offers.create')); ?>" class="btn btn-outline-light">
        Add offer
    </a>
	<a href="<?php echo e(route('schemes.index')); ?>" class="btn btn-outline-light">
        Scheme List
    </a>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i> Offer listing</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <?php if($errors->any()): ?>
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            <?php echo e($errors->first()); ?>

                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product SKU</th>
                            <th>Qty</th>
                            <th>Get Product SKU</th>
                            <th>Get Prod. QTY</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $offerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($offer->id); ?>" title="Delete this data"></i>
                                <div class="modal fade deletePopup<?php echo e($offer->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0"><?php echo e($offer->product_sku); ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure want to delete this?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <?php echo e(Form::open(array('url' => 'admin/offers/' . $offer->id))); ?>


                                                <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                                <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                <?php echo e(Form::close()); ?>


                                            </div>

                                        </div>

                                    </div>

                                </div>
                             <a href="<?php echo e(url('admin/offers/create/'.$offer->id)); ?>"><i class="mdi mdi-pencil btn btn-outline-primary"></i></a>
                            </td>
                            <td><?php echo e($offer->product_sku); ?></td>
                            <td><?php echo e($offer->qty); ?></td>
                            <td><?php echo e($offer->get_prod_sku); ?></td>
                            <td><?php echo e($offer->get_qty); ?></td>
                            <td><?php echo e($offer->startDate); ?></td>
                            <td><?php echo e($offer->endDate); ?></td>
                            <!-- <td><?php echo e($offer->status); ?></td> -->
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/offers/purchase/index.blade.php ENDPATH**/ ?>