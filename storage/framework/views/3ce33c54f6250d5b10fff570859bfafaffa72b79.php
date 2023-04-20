<?php $__env->startSection('pageTitle'); ?>



    <h4 class="page-title"> <i class="dripicons-checklist"></i> My selling income</h4>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('contentData'); ?>



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

				<?php
					$todayDate = date('Y-m-d');
				?>

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
							<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							  <tr>
							    <td><?php echo e($row->created_at); ?></td>
							    <td><?php echo e($row->order->account->domain); ?> - Order - <?php echo e($row->reference_id); ?> <strong><?php echo ($row->sub_reference_id ? '-'. $row->product->title : ''); ?></strong></td>
								<td><?php echo e($row->term); ?></td>
							    <td><?php echo e($aff_amount_status[$row->status]); ?></td>
							    <td><?php echo e($row->amount); ?></td>
							    <td></td>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/affiliate/mySelling/index.blade.php ENDPATH**/ ?>