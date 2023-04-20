

<?php $__env->startSection('pageTitle'); ?>



<h4 class="page-title"> <i class="dripicons-calendar"></i>Home Page Setting</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
	
        <div class="card m-b-20">
		    <div class="card-header">Home Page Setting</div>
            <div class="card-body">
			<?php if(session('status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('status')); ?>

			</div>
		    <?php endif; ?>
			
			<?php echo Form::open(['url' => 'admin/home-page-setting','class'=>'']); ?>

			  <div class='form-group'>
			     <label for="home_page">Seelct Layout:</label>
				 <select type="text" id="home_page" name="home_page" class="form-control" placeholder="" >
				    <option value='1' <?php if($home->home_page==1): ?> selected <?php endif; ?>>Homepage 1</option>
				    <option value='2' <?php if($home->home_page==2): ?> selected <?php endif; ?>>Homepage 2</option>
				    <option value='3' <?php if($home->home_page==3): ?> selected <?php endif; ?>>Homepage 3</option>
				    <option value='4' <?php if($home->home_page==4): ?> selected <?php endif; ?>>Homepage 4</option>
				    <option value='5' <?php if($home->home_page==5): ?> selected <?php endif; ?>>Homepage 5</option>
				    <option value='6' <?php if($home->home_page==6): ?> selected <?php endif; ?>>Homepage 6</option>
				    <option value='7' <?php if($home->home_page==7): ?> selected <?php endif; ?>>Homepage 7</option>
				 </select>
			  </div>
			  
			  <div class='form-actions' style='text-align:center'>
                  <input type="hidden" value="" id="position">			  
				  <button type="submit" class="btn btn-primary" style='width:100%'>Update</button>
			  </div>
			<?php echo Form::close(); ?>

			
			</div>
		</div>
		
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/users/home-page-setting.blade.php ENDPATH**/ ?>