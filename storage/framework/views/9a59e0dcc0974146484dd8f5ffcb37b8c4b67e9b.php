

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">

    <a class="btn btn-outline-light" href="<?php echo e(url('admin/membership')); ?>">Membership</a>
    <a class="btn btn-outline-light" href="<?php echo e(url('admin/membership_page')); ?>">Membership Page</a>
</div>
<input type="hidden" value="1" id="position">
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="csrfToken">
<h4 class="page-title"> <i class="dripicons-calendar"></i>Membership Page</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

<div class="row">
    <div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Membership Page</div>
            <div class="card-body">
			    <?php if(session('status')): ?>
					<div class="alert alert-success">
						<?php echo e(session('status')); ?>

					</div>
				<?php endif; ?>
                <?php echo Form::open(['url' => 'admin/membership_page','method'=>'POST','id'=>'form']); ?>

                <?php echo e(csrf_field()); ?>

                  <div class="form-group">
					<label for="title">Title:</label>
					<textarea type="text" class="summernote form-control" placeholder="" id="title" name='title' required ><?php if(isset($mem_data)): ?> <?php echo e($mem_data->title); ?> <?php endif; ?></textarea>
				  </div>
				  <div class="form-group">
					<label for="sub_title">Sub Title:</label>
					<textarea type="text" class="summernote form-control" placeholder="" id="sub_title" name='sub_title' required ><?php if(isset($mem_data)): ?> <?php echo e($mem_data->sub_title); ?> <?php endif; ?></textarea>
				  </div>
				  
				  
				  
				  
				  <div class="form-group">
					<label for="image">Image:</label>
					<input type='text' <?php if(isset($mem_data)): ?> value='<?php echo e($mem_data->image); ?>' <?php endif; ?> class='form-control' name='image' id='imageimage' onclick="openImagePopup('image')">
				  </div>
				  
				  
				  <div class="form-group">
					<label for="sorting_order">Sorting Order :</label>
					<input type="number" class="form-control" placeholder="" id="sorting_order" name='sorting_order' <?php if(isset($mem_data)): ?> value='<?php echo e($mem_data->sorting_order); ?>' <?php endif; ?>>
				  </div>
				  
				  <?php if(isset($mem_data)): ?>
					  <input type='hidden' name='id' value='<?php echo e($mem_data->id); ?>'>
				  <?php endif; ?>
				  <?php if(count($data)<5): ?>
				  <?php echo e(5-count($data)); ?> Remaining.<br>
				  <?php endif; ?>
				  <?php if(count($data)<5||isset($mem_data)): ?>
				     <button type="submit" class="btn btn-primary"><?php if(isset($mem_data)): ?> Update <?php else: ?> Submit <?php endif; ?></button>
			      <?php endif; ?>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
	<div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Membership Page</div>
            <div class="card-body">
			    <table class='table table-bordered table-striped table-responsive'>
				  <thead>
				    <tr>
					  <th>Title</th>
					  <th>Sub Title</th>
					  <th>Image</th>
					  <th>Sorting Order</th>
					  
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php if(count($data)): ?>
					  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr>
						   <td><?php echo strip_tags($row->title); ?></td>
						   <td><?php echo strip_tags($row->sub_title); ?></td>
						   <td><img width='80' src="<?php echo e($row->image); ?>"></td>
						   <td><?php echo $row->sorting_order; ?></td>
						   
						   <td>
						     <a href="<?php echo e(url('admin/membership_page/'.$row->id)); ?>" class='btn btn-outline-primary btn-sm'>Edit</a><br><br>
						     <button data-toggle="modal" data-target="#preview_modal<?php echo e($key); ?>"  class='btn btn-outline-danger btn-sm'>PreView</button>
							 <!---------------------------------------->
							 <div class="modal" id="preview_modal<?php echo e($key); ?>">
							  <div class="modal-dialog modal-lg">
								<div class="modal-content">

								  <!-- Modal Header -->
								  <div class="modal-header">
									<h4 class="modal-title">PreView</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								  </div>

								  <!-- Modal body -->
								  <div class="modal-body">
									<div style="position:relative">
									  <img src="<?php echo e($row->image); ?>" style="width:100%;">
									  <div style="width: 100%;position: absolute;top:0px;">
									    <h2><?php echo $row->title; ?></h2>
										<h4><?php echo $row->sub_title; ?></h4>
									  </div>
									</div>
								  </div>

								  <!-- Modal footer -->
								  <div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								  </div>

								</div>
							  </div>
							</div>
							 <!---------------------------------------->
						   </td>
						</tr>
					  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				  <?php else: ?>
					<tr><th colspan='5'>No Data Found!</th></tr>  
				  <?php endif; ?>
				  </tbody>
				</table>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/membership/membership_page.blade.php ENDPATH**/ ?>