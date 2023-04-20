

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">

    <a class="btn btn-outline-light" href="<?php echo e(url('admin/membership')); ?>">Membership</a>
    <a class="btn btn-outline-light" href="<?php echo e(url('admin/membership_page')); ?>">Membership Page</a>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Membership</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

<div class="row">
    <div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Membership Form</div>
            <div class="card-body">
			    <?php if(session('status')): ?>
					<div class="alert alert-success">
						<?php echo e(session('status')); ?>

					</div>
				<?php endif; ?>
                <?php echo Form::open(['url' => 'admin/membership_action','method'=>'POST','id'=>'form']); ?>

                <?php echo e(csrf_field()); ?>

                  <div class="form-group">
					<label for="name">Membership Name:</label>
					<input type="text" class="form-control" placeholder="" id="name" name='name' required <?php if(isset($mem_data)): ?> value='<?php echo e($mem_data->name); ?>' <?php endif; ?>>
				  </div>
				  <div class="form-group">
					<label for="charges">Charges:</label>
					<input type="number" class="form-control" placeholder="" id="charges" name='charges' required <?php if(isset($mem_data)): ?> value='<?php echo e($mem_data->charges); ?>' <?php endif; ?>>
				  </div>
				  
				  
				  <div class="form-group">
					<label for="razorpay_subscription_id">Razorpay Plan ID:</label>
					<select class="form-control" id="razorpay_subscription_id" name='razorpay_subscription_id' required >
					      <option value=''></option>
					<?php if(array_key_exists("items",$sub_list)): ?>
					   <?php $__currentLoopData = $sub_list['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				          <option <?php if(isset($mem_data)&&$mem_data->razorpay_subscription_id==$row['id']): ?> selected <?php endif; ?> value="<?php echo e($row['id']); ?>"><?php echo e($row['id']); ?> - <?php echo e($row['item']['name']); ?></option>
				      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					<select>
				  </div>
				  
				  <div class="form-group">
					<label for="charge_recurring">Charge Recurring:</label>
					<select class="form-control" id="charge_recurring" name='charge_recurring' required >
					   <option <?php if(isset($mem_data)&&$mem_data->charge_recurring=='Monthly'): ?> selected <?php endif; ?>>Monthly</option>
					   <option <?php if(isset($mem_data)&&$mem_data->charge_recurring=='Quarterly'): ?> selected <?php endif; ?>>Quarterly</option>
					   <option <?php if(isset($mem_data)&&$mem_data->charge_recurring=='Annually'): ?> selected <?php endif; ?>>Annually</option>
					<select>
				  </div>
				  <div class="form-group">
					<label for="benifits">Benefits - Extra Discount % :</label>
					<input type="number" class="form-control" placeholder="" id="benifits" name='benifits' <?php if(isset($mem_data)): ?> value='<?php echo e($mem_data->benifits); ?>' <?php endif; ?>>
				  </div>
				  <div class="form-group">
					<label for="">Shipping Charges Off :</label>
					<div class="form-check-inline">
					  <label class="form-check-label">
						<input type="radio" class="form-check-input" name="shipping_charges" value='Yes' required <?php if(isset($mem_data)&&$mem_data->shipping_charges=='Yes'): ?> checked <?php endif; ?>>Yes
					  </label>
					</div>
					<div class="form-check-inline">
					  <label class="form-check-label">
						<input type="radio" class="form-check-input" name="shipping_charges" value='No' required  <?php if(isset($mem_data)&&$mem_data->shipping_charges=='No'): ?> checked <?php endif; ?>>No
					  </label>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="freebies_amount">Freebies – Equivalent Amount :</label>
					<input type="number" class="form-control" placeholder="" id="freebies_amount" name='freebies_amount' required <?php if(isset($mem_data)): ?> value='<?php echo e($mem_data->freebies_amount); ?>' <?php endif; ?>>
				  </div>
				  <div class="form-group">
					<label for="freebies_scheduling">Freebies – Scheduling for accruing:</label>
					<select class="form-control" id="freebies_scheduling" name='freebies_scheduling' required>
					   <option <?php if(isset($mem_data)&&$mem_data->freebies_scheduling=='Monthly'): ?> selected <?php endif; ?>>Monthly</option>
					   <option <?php if(isset($mem_data)&&$mem_data->freebies_scheduling=='Quarterly'): ?> selected <?php endif; ?>>Quarterly</option>
					   <option <?php if(isset($mem_data)&&$mem_data->freebies_scheduling=='Half Yearly'): ?> selected <?php endif; ?>>Half Yearly</option>
					   <option <?php if(isset($mem_data)&&$mem_data->freebies_scheduling=='Annually'): ?> selected <?php endif; ?>>Annually</option>
					<select>
				  </div>
				  <div class="form-group">
					<label for="terms_and_conditions">Terms and Conditions :</label>
					<textarea  class="form-control" placeholder="" id="terms_and_conditions" name='terms_and_conditions' required><?php if(isset($mem_data)): ?> <?php echo e($mem_data->terms_and_conditions); ?> <?php endif; ?></textarea>
				  </div>
				  <?php if(isset($mem_data)): ?>
					  <input type='hidden' name='id' value='<?php echo e($mem_data->id); ?>'>
				  <?php endif; ?>
				  <button type="submit" class="btn btn-primary"><?php if(isset($mem_data)): ?> Update <?php else: ?> Submit <?php endif; ?></button>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
	<div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Membership List</div>
            <div class="card-body">
			    <table class='table table-bordered table-striped'>
				  <thead>
				    <tr>
					  <th>#</th>
					  <th>Membership Name</th>
					  <th>Charges</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php if(count($data)): ?>
					  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				        <tr>
						   <td><?php echo e($key+1); ?></td>
						   <td><?php echo e($row->name); ?></td>
						   <td><?php echo e($row->charges); ?></td>
						   <td><a href="<?php echo e(url('admin/membership/'.$row->id)); ?>" class='btn btn-outline-primary btn-sm'>View or Edit</a></td>
						</tr>
				      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				  <?php else: ?>
				    <tr>
					  <td colspan='4'>No Data Found</td>
					</tr>
				  <?php endif; ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/membership/index.blade.php ENDPATH**/ ?>