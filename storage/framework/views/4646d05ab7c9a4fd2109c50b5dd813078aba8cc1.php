<?php $__env->startSection('pageTitle'); ?>



    <h4 class="page-title"> <i class="dripicons-list"></i> Product Inquiry listing</h4>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('contentData'); ?>



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

                    <table id="datatable" class="table table-bordered">

                        <thead>

                            <tr>

                                <th>Product</th>

                                <th>Title</th>

                                <th>Description</th>

                                <th>Name</th>

                                <th>Phone</th>

                                <th>Email</th>

                                <th>Inquiry Type</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $__currentLoopData = $inquiryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>

                                    <td><?php echo e($inquiry->productvariations[0]->productName); ?> - <?php echo e($inquiry->productvariations[0]->sku); ?></td>

                                    <td><?php echo e($inquiry->title); ?></td>

                                    <td><?php echo e($inquiry->description); ?></td>

                                    <td><?php echo e($inquiry->name); ?></td>

                                    <td><?php echo e($inquiry->phone); ?></td>

                                    <td><?php echo e($inquiry->email); ?></td>

                                    <td><?php echo e($inquiry->affiliate_id == null ? 'General' : 'Affiliate'); ?></td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>

                    </table>



                </div>

            </div>

        </div>

    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/income/productInquiry/index.blade.php ENDPATH**/ ?>