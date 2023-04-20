

<?php $__env->startSection('pageTitle'); ?>



<h4 class="page-title"> <i class="dripicons-calendar"></i>Service Variant</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Service Variant</div>
            <div class="card-body">
			<?php if(session('status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('status')); ?>

			</div>
		    <?php endif; ?>
			<?php echo Form::open(['url' => '#']); ?>

			    <div class="control-group">
				    <label class="control-label" for='title'>Select Service</label>
					<div class="controls">
						<select type='text' name='brand' class='form-control' onchange="window.location.replace('<?php echo e(url('admin/services-variant/')); ?>/'+this.value);">
						  <option></option>
						<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						  <option value='<?php echo e($row->id); ?>'><?php echo e($row->service); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				<?php if(isset($id)): ?>
				<?php $__currentLoopData = explode(',',$variant->service_field); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="control-group">
				    <label class="control-label" for='title'><?php echo e($row); ?></label>
					<div class="controls">
						<label><input  type='radio' name='service_field<?php echo e($key); ?>' class='form-control'>Yes</label>
						<label><input  type='radio' name='service_field<?php echo e($key); ?>' class='form-control'>No</label>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<div class="control-group">
				    <label class="control-label" for='amount'>Amount</label>
					<div class="controls">
						<input type='text' name='amount' id='amount' class='form-control'>
					</div>
				</div>
				<div class="control-group services_field">
				    <label class="control-label" for='title'>&nbsp;</label>
					<div class="controls">
						<div class="input-group mb-3">
							<input type="number" class="form-control" placeholder="Discount">
							<input type="number" class="form-control" placeholder="Month">
							<input type="number" class="form-control" placeholder="Total">
							<div class="input-group-append">
							  <button class="input-group-text" type='button' onclick='addField()'>+</button>
							</div>
						</div>
					</div>  
				</div>
				<?php endif; ?>
                <div class="form-actions" style='text-align:center;margin-top:40px'>
					<input type="submit" class="btn btn-outline-success" value="Update">
				</div>				
			<?php echo Form::close(); ?>

			</div>
		</div>
		
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
function addField(){
	$('<div class="control-group services_field"><div class="controls"><div class="input-group mb-3"><input type="number" class="form-control" placeholder="Discount"><input type="number" class="form-control" placeholder="Month"><input type="number" class="form-control" placeholder="Total"></div></div></div>').insertAfter($('.services_field').last());
	
}
$(document).ready(function(){
  $(document).on("change",'.services_field input', function(){
     var discount = Number($(this).parent().closest('div').find('input:nth-child(1)').val());
     var month = Number($(this).parent().closest('div').find('input:nth-child(2)').val());
	 $(this).parent().closest('div').find('input:nth-child(3)').val((month*Number($('#amount').val()))-discount);
  });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/services/services-variant.blade.php ENDPATH**/ ?>