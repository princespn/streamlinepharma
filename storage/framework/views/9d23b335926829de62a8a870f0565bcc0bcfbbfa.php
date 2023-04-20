<?php $__env->startSection('pageTitle'); ?>



    <h4 class="page-title"> <i class="dripicons-checklist"></i> My affiliation listing</h4>



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
                                <th>Domain</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Selling Budget</th>
                                <th>Link</th>
                                <th>QR</th>
                            </tr>

                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $myLinkList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$myLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <tr>
							     <td><?php echo e($key+1); ?></td>
							     <td><?php echo e($myLink->account->domain); ?></td>
							     <td><?php echo e($myLink->title); ?></td>
							     <td><?php echo e($myLink->selling_price); ?></td>
							     <td><?php echo e($myLink->affiliation_price); ?></td>
								 <td><a href="https://<?php echo e($myLink->account->domain); ?>/product-detail/<?php echo e($myLink->sku); ?>?aff=<?php echo e($code); ?>" rel="noopener noreferrer" target="_blank">
                                                            <i class="mdi mdi-eye btn btn-outline-primary" title="View Link"></i>
                                                        </a><br><br>
                                      <a href="<?php echo e(url('admin/download_qr_aff/'.$myLink->sku.'/'.$code)); ?>" rel="noopener noreferrer" target="_blank">
                                                            <i class="mdi mdi-download btn btn-outline-primary" title="View Link"></i>
                                                        </a>
                                </td>
                                 <td>
                                     <?php echo QrCode::size(150)->generate('https://'.$myLink->account->domain.'/product-detail/'.$myLink->sku.'?aff='.$code); ?>

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/affiliate/myLink/index.blade.php ENDPATH**/ ?>