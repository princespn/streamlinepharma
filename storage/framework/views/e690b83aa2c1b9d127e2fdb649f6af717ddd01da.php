<?php $__env->startSection('pageTitle'); ?>
<div class="float-right">
  
  <a class="btn btn-outline-light" href="<?php echo e(url('admin/create_employee')); ?>">Add</a>
    
</div>
<h4 class="page-title"> <i class="dripicons-list"></i>Referral Scheme</h4>

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
		<div class="table-responsive">
			<table class='table table-bordered table-striped'>
			<thead>
		    <tr>
			  <th>#</th>
			  <th>Name</th>
			  <th>Phone</th>
			  <th>Email</th>
              <!--<th>Description</th> -->
              <th>Action</th>
			</tr>
		  </thead>
		  <tbody>
              <?php $__currentLoopData = $emp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($k+1); ?></td>
                <td><?php echo e($emp->title); ?></td>
                <td><?php echo e($emp->phone); ?></td>
                <td><?php echo e($emp->email); ?></td>
                
                <td>
                
                <a href="#" class="btn btn-danger btn-sm"> Delete</a>
                <a href="<?php echo e('edit_employee/'.$emp->id); ?>" class="btn btn-outline-info btn-sm"> Edit</a>
                <?php if($emp->status =='1'): ?>
                <a href="<?php echo e('status_update/deactive/'.$emp->id); ?>" class="btn btn-warning btn-sm"> Deactive</a>
                <?php else: ?>
                <a href="<?php echo e('status_update/Active/'.$emp->id); ?>" class="btn btn-success btn-sm"> Active</a>
                <?php endif; ?>
                
               <!-- <a href="<?php echo e('given_permission/'.$emp->id); ?>" class="btn btn-primary btn-sm"> Given Permission</a> -->
                
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  </tbody>
			</table>
         </div>
</div>
      </div>
   </div>
</div>

<!----------------------------------------------------->
<div class="modal" id="user_list">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Share to</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <table class='table table-bordered table-striped'>
		  <thead>
		    <tr>
			  <th>#</th>
			  <th>Name</th>
			  <th>Phone</th>
			  <th>Email</th>
              <th>Description</th>
              <th>Action</th>
			</tr>
		  </thead>
		  <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
		  </tbody>
		</table>
		
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" form='referral_scheme_shared_with' class="btn btn-primary" >Share with Selected User</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!----------------------------------------------------->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
.share_container a{
	display: inline-block;
    margin: 5px;
    border: 1px solid black;
    text-align: center;
    padding: 5px 10px;
    border-radius: 50%;
}
</style>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/employee/view_employee.blade.php ENDPATH**/ ?>