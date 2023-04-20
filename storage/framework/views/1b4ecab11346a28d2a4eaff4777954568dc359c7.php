



<?php $__env->startSection('pageTitle'); ?>



    



    <h4 class="page-title"> <i class="dripicons-tags"></i> Reviews</h4>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('contentData'); ?>



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

                    

                <table class='table table-bordered table-striped' style='margin-top:30px'>
				  <thead>
				    <tr>
					   <th>#</th>
					   <th>Product</th>
					   <th>User</th>
					   <th>Rating</th>
					   <th>Headline</th>
					   <th>Review</th>
					   <th>Photo</th>
					   <th>Reviewed at</th>
					   <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				    <?php if(count($data)): ?>
					  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <tr>
					     <td><?php echo e($key+1); ?></td>
					     <td><a href="<?php echo e(url('product-detail/'.$row->product->sku)); ?>" target='_blank'><?php echo e($row->product->title); ?></a></td>
					     <td><?php echo e($row->register->name); ?></td>
					     <td><?php echo e($row->rating); ?></td>
					     <td><?php echo e($row->headline); ?></td>
					     <td><?php echo e($row->review); ?></td>
					     <td><a href="<?php echo e(url('review/'.$row->photo)); ?>" target='_blank'>View Media</a></td>
						 <td><?php echo e($row->created_at); ?></td>
						 <td>
						   <?php if($row->status==0): ?>
							   <a href="<?php echo e(url('admin/review_status/'.$row->id.'/2')); ?>" class='btn btn-danger btn-sm btn-xs'>Reject</a>
							   <a href="<?php echo e(url('admin/review_status/'.$row->id.'/1')); ?>" class='btn btn-primary btn-sm btn-xs'>Approve</a>
						   <?php else: ?>
						   <?php echo e($constant_review_status[$row->status]); ?>

						   <?php endif; ?>
						 </td>
					   </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				  
					<?php else: ?>
						<tr>
					       <td colspan='8'>No Data Found.</td>
					    </tr>
					<?php endif; ?>
				  </tbody>
				</table>

                </div>

            </div>

        </div>

    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/reviews/index.blade.php ENDPATH**/ ?>