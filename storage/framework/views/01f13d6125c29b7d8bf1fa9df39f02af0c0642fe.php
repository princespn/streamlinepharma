
<?php $__env->startSection('pageTitle'); ?>
<style>
.hide{
	display:none;
}
</style>
<h4 class="page-title"> <i class="dripicons-calendar"></i>Return , Replacement & Cancel Management</h4>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentData'); ?>
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-header">Return , Replacement & Cancel Management</div>
         <div class="card-body">
            <?php if(session('status')): ?>
            <div class="alert alert-success">
               <?php echo e(session('status')); ?>

            </div>
            <?php endif; ?>
            <?php echo Form::open(['url' => 'admin/advance_product_category_action']); ?>

            <div class="form-group">
               <label for="email">Return :</label>
               <select type="text" class="form-control" name="is_return" id="is_return" onchange="if(this.value=='Yes'){$('.return_div').removeClass('hide');}else{$('.return_div').addClass('hide');}">
                  <option <?php if($data->is_return=='No'): ?> selected  <?php endif; ?>>No</option>
                  <option <?php if($data->is_return=='Yes'): ?> selected  <?php endif; ?>>Yes</option>
               </select>
            </div>
            <div class="control-group return_div <?php if($data->is_return=='No'): ?> selected hide <?php endif; ?>">
               <label class="control-label">Return Days</label>
               <div class="controls">
                  <input type="number" class="form-control" name="return_days" id="return_days" value='<?php echo e($data->return_days); ?>'>
               </div>
            </div>
            <div class="control-group">
               <label class="control-label">Return T&amp;C</label>
               <div class="controls">
                  <textarea class="form-control" name="return_terms" id="return_terms"><?php echo e($data->return_terms); ?></textarea>
               </div>
            </div>
            <div class="control-group">
               <label class="control-label">Replace</label>
               <div class="controls">
                  <select type="text" class="form-control" name="is_replace" id="is_replace" onchange="if(this.value=='Yes'){$('.replace_div').removeClass('hide');}else{$('.replace_div').addClass('hide');}">
                     <option <?php if($data->is_replace=='No'): ?> selected  <?php endif; ?>>No</option>
                     <option <?php if($data->is_replace=='Yes'): ?> selected  <?php endif; ?>>Yes</option>
                  </select>
               </div>
            </div>
            <div class="control-group replace_div <?php if($data->is_replace=='No'): ?> selected hide <?php endif; ?>   ">
               <label class="control-label">Replace Days</label>
               <div class="controls">
                  <input type="number" class="form-control" name="replace_days" id="replace_days" value='<?php echo e($data->replace_days); ?>'>
               </div>
            </div>
            <div class="control-group">
               <label class="control-label">Replace T&amp;C</label>
               <div class="controls">
                  <textarea class="form-control" name="replace_terms" id="replace_terms"><?php echo e($data->replace_terms); ?></textarea>
               </div>
            </div>
			<div class="form-group">
               <label for="email">Cancel Reason :</label>
               <textarea name='cancel_reason' class='form-control' placeholder='comma seprated'><?php echo e($data->cancel_reason); ?></textarea>
            </div>
            <div class="form-actions" style="text-align:center;margin-top:40px">
               <input type="hidden" class="id" name="id" value="<?php echo e($data->cat_id); ?>">
               <input type="submit" class="btn btn-outline-success" value="Update">
            </div>
            <?php echo Form::close(); ?>

         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/advance_product/advance_product_category_action.blade.php ENDPATH**/ ?>