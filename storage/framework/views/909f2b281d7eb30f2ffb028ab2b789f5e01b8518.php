<?php $__env->startSection('pageTitle'); ?>

    <h4 class="page-title"> <i class="dripicons-tags"></i> Affiliate Ledger</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Term</th>
                                <th>Status</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Balance</th>
                            </tr>
                        </thead>

                        
                        <tbody>
                          <?php $__currentLoopData = $rechargeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						    <tr>
							  <td><?php echo e($row->created_at); ?></td>
							  <td>
							    <?php if($row->type=='Order'): ?>
							      Payment to Affiliate <strong> <?php echo e($row->affiliate->code); ?></strong>  - Order - <?php echo e($row->reference_id); ?> <strong><?php echo ($row->sub_reference_id ? '-'. $row->product->title : ''); ?>

							    <?php else: ?>
								 <?php echo e($row->type); ?>

								<?php endif; ?>
							  </td>
                              <td><?php echo e($row->term); ?></td>
							  <td><?php if($row->type=='Order'): ?> <?php echo e($aff_amount_status[$row->status]); ?> <?php endif; ?></td>
							  <td><?php if($row->type=='Wallet Reload'): ?> <?php echo e($row->amount); ?>  <?php endif; ?></td>
							  <td><?php if($row->type=='Order'): ?> <?php echo e($row->amount); ?>  <?php endif; ?></td>
							  <td><?php echo e($row->remaining_amount); ?></td>
							</tr>
						  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>

                    
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/income/affiliateLedger/index.blade.php ENDPATH**/ ?>