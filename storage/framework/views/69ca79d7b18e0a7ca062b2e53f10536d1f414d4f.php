
<?php $__env->startSection('pageTitle'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h4 class="page-title"> <i class="dripicons-list"></i>View Advance Product Template</h4>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentData'); ?>
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-body">
		 <?php if(session('status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('status')); ?>

			</div>
		<?php endif; ?>
		
            <table class='table table-bordered table-striped'>
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
			   <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			     <tr>
				   <td><?php echo e($key+1); ?></td>
				   <td><?php echo e($row->name); ?></td>
				   <td>
				     <a class='btn btn-sm btn-primary' href="<?php echo e(url('admin/advance_product_template/'.$row->id)); ?>">Edit</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/advance_product/view_advance_product_template.blade.php ENDPATH**/ ?>