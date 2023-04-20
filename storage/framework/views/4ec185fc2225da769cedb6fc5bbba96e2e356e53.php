

<?php $__env->startSection('pageTitle'); ?>



<h4 class="page-title"> <i class="dripicons-calendar"></i>Footer Slider</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Footer Slider</div>
            <div class="card-body">
			<?php if(session('status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('status')); ?>

			</div>
		    <?php endif; ?>
			<?php echo Form::open(['url' => 'admin/footer-slide','class'=>'']); ?>

			  <div class='form-group'>
			     <label for="title1">Title:</label>
				 <input type="text" id="title1" name="title" class="form-control" placeholder="" >
			  </div>
			  <div class='form-group'>
			     <label for="subtitle">Sub Title:</label>
				 <input type="text" id="subtitle" name="subtitle" class="form-control" placeholder="" >
			  </div>
			  <div class='form-group'>
			     <label for="subtitle">Link:</label>
				 <input type="text" id="link" name="link" class="form-control" placeholder="" >
			  </div>
			  
			  
			  
			  <div class='form-group'>
			     <label for="image">Icon:</label>
				 <div class="input-group">
				   <input type="text" class="form-control" name="icon" id="imageimage" required="" required>
				   <div class="input-group-prepend" onclick="openImagePopup('image')">
					  <span class="input-group-text"><i class="mdi mdi-file-image"></i></span>
				   </div>
				</div>
			  </div>
			  <div class='form-actions' style='text-align:center'>
                  <input type="hidden" value="" id="position">			  			  
				  <button type="submit" class="btn btn-primary" style='width:100%'>Add</button>
			  </div>
			<?php echo Form::close(); ?>

			</div>
		</div>
		<div class="card m-b-20">
		    <div class="card-header">Added</div>
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>Title</th>
				      <th>Sub Title</th>
				      <th>Link</th>
				      <th>Icon</th>
					  <th>Action</th>
				   </tr>
				</thead>
				<tbody>
			    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				   <tr>
				      <td><?php echo e($key+1); ?></td>
				      <td><?php echo e($row->title); ?></td>
				      <td><?php echo e($row->subtitle); ?></td>
				      <td><?php echo e($row->link); ?></td>
				      <td><img src='<?php echo e($row->icon); ?>' width='120'></td>
					  <td>
					    <button type='submit' form='deleteBanner' name='delete_button' value='<?php echo e($row->id); ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure?')">Delete</button>
					  </td>
				   </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			  </table>
			  <?php echo Form::open(['url' => 'admin/home-banner-action','id'=>'deleteBanner']); ?>

			     <input type='hidden' name='banner_type' value='7' >
			  <?php echo Form::close(); ?>

			</div>
		</div>
	</div>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title mt-0">Choose Image</h5>
                
                <button type="button" id="closeButton" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            </div>

            <div class="modal-body">

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="mb-2 text-center card-body text-muted">
                        <ul class="new_friend_list list-unstyled row" id="replceFolderImage">
                        
                            <?php $__currentLoopData = $imageUploadList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <?php if($image->mediaType == 1): ?>
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="openFolder('<?php echo e($image->id); ?>')">
                                        <img src="http://ecommerce.uniqueandcommon.com/assets/images/folder.png" class="img-thumbnail">
                                        <h6 class="users_name"><?php echo e($image->title); ?></h6>
                                    </li>
                                <?php else: ?>
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl('<?php echo e($image->name); ?>')">
                                        <img src="<?php echo e(URL::asset($image->name)); ?>" class="img-thumbnail" >
                                        <h6 class="users_name"><?php echo e($image->title); ?></h6>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/banner/home1/footer-slide.blade.php ENDPATH**/ ?>