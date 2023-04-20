

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
  
 
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Member's List</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        
		<div class="card m-b-20">
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>Name</th>
				      <th>Mobile</th>
				      <th>Membership Amount</th>
				   </tr>
				</thead>
				<tbody>
			    <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				  <tr>
				    <td><?php echo e($key+1); ?></td>
				    <td><?php echo e($row->name); ?></td>
				    <td><?php echo e($row->phone); ?></td>
				    <td><?php echo e($row->charges); ?> ₹ <?php echo e($row->charge_recurring); ?></td>
				  </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/users/memeber_list.blade.php ENDPATH**/ ?>