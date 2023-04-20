
<?php $__env->startSection('pageTitle'); ?>
<div class="float-right">
  
  <a class="btn btn-outline-light" href="<?php echo e(url('admin/referral_scheme')); ?>">Add</a>
    
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
				  <th>Scheme</th>
				  <th>Offering Product</th>
				  <th>Label</th>
				  <th>Charges</th>
				  <th>Referral Wallet Benefits</th>
				  <th>Validity</th>
				  <th>Share</th>
				  <th>Action</th>
				</tr>
			  </thead>
			  <tbody>
			    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				 <tr>
				   <td><?php echo e($row->scheme_name); ?></td>
				   <td><?php echo e($row->offering_product); ?></td>
				   <td><?php echo e($row->special_charges_label); ?></td>
				   <td><?php echo e($row->special_charges); ?></td>
				   <td><?php echo e($row->referral_wallet_benefits); ?></td>
				   <td><?php echo e($row->scheme_validity); ?></td>
				   <td class='share_container'>
				   <?php if($row->scheme_validity<date('Y-m-d')): ?>
					 <span style='color:red;font-family:bold'>Expired</span>
				   <?php else: ?>
				   
				     <a  href="https://wa.me/?text=<?php echo e($row->description.' '.url('product-detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id)))); ?>" data-action="share/whatsapp/share"  class="link-whatsapp"  target='_blank'><i class="fa fa-whatsapp"> </i> </a>

					 

					 <a href="https://www.facebook.com/sharer.php?u=<?php echo e(url('product-detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id)))); ?>"   class="link-facebook" target='_blank'><i class="fa fa-facebook"> </i> </a> 
					 
					 
					 <script type="IN/Share" data-url="<?php echo e(url('product-detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id)))); ?>"></script>
		
					 
					 
					 <a href="http://twitter.com/share?text=<?php echo e(urlencode($row->description.' '.url('product-detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id))))); ?>"   class="link-linkedin" target='_blank'><i class="fa fa-twitter"> </i> </a>
					
					 
					 <button class='btn btn-sm btn-info' data-toggle="modal" data-target="#user_list" type='button' onclick="$('#scheme_id').val('<?php echo e($row->id); ?>');">Share to User</button>
					 
					 <br>
					 <span style='color:red;font-family:bold'>Link : </span><?php echo e(url('product-detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id)))); ?>

					 
					 <?php endif; ?>
				   </td>
				   <td width='180'>
				    <a href="<?php echo e(url('admin/referral_scheme_delete/'.md5($row->id))); ?>" onclick="return confirm('Are you sure?')"  class='btn btn-sm btn-danger'>Delete</a>
					<?php if($row->status==1): ?>
					<a href="<?php echo e(url('admin/referral_scheme_status/'.md5($row->id).'/0')); ?>" onclick="return confirm('Are you sure?')" class='btn btn-sm btn-primary'>De Activate</a>	
					<?php else: ?>
				    <a href="<?php echo e(url('admin/referral_scheme_status/'.md5($row->id).'/1')); ?>" onclick="return confirm('Are you sure?')" class='btn btn-sm btn-primary'>Activate</a>
				    <?php endif; ?>
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
			  <th><input type='checkbox' id='all_checkbox' onclick='userCheckBox()'></th>
			  <th>Name</th>
			  <th>Phone</th>
			  <th>Email</th>
			</tr>
		  </thead>
		  <tbody>
		    <?php $__currentLoopData = $userList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    <tr>
			   <td><input class='all_user_checkbox' name='shared_with[]' form='referral_scheme_shared_with' value='<?php echo e($row->id); ?>' type='checkbox'></td>
			   <td><?php echo e($row->name); ?></td>
			   <td><?php echo e($row->phone); ?></td>
			   <td><?php echo e($row->email); ?></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  </tbody>
		</table>
		<label><input type='checkbox' form='referral_scheme_shared_with' name='is_sms_send' value='yes'> Send SMS</label>&nbsp;&nbsp;
		
		<?php echo Form::open(['url' => url('admin/referral_scheme_shared_with'), 'id' => 'referral_scheme_shared_with']); ?>

		<input type='hidden' name='scheme_id' id='scheme_id'>
		<?php echo Form::close(); ?>

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

<?php $__env->startSection('script'); ?>
<script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
<script>
function userCheckBox(){
	if($("#all_checkbox").prop("checked")==true){
		$(".all_user_checkbox").prop('checked', true);
	}else{
		$(".all_user_checkbox").prop('checked', false);
	}
}
$('#user_list').on('hidden.bs.modal', function () {
    $(".all_user_checkbox").prop('checked', false);
    $("#all_checkbox").prop('checked', false);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/offers/referral/view_referral_scheme.blade.php ENDPATH**/ ?>