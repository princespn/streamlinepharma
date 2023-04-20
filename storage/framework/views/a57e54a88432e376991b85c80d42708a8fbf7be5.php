

<?php $__env->startSection('pageTitle'); ?>

    <h4 class="page-title"> <i class="dripicons-checklist"></i> My inquiry income</h4>

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
                                <th>Site</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Inquiry Budget</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Fashion</td>
                                <td>Electronic -> Mobile -> One Plus 6</td>
                                <td>One Plus 6</td>
                                <td>500.00</td>
                                <td>5.00</td>
                                <td>5.00</td>
                                <td>25.00</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/affiliate/myInquiry/index.blade.php ENDPATH**/ ?>