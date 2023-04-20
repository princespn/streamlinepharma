
<?php $__env->startSection('pageTitle'); ?>
<style>
.hide{
	display:none;
}
</style>
<h4 class="page-title"> <i class="dripicons-calendar"></i>Advance Product Catalogue</h4>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentData'); ?>
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-header">Advance Product Catalogue</div>
         <div class="card-body">
            <?php if(session('status')): ?>
            <div class="alert alert-success">
               <?php echo e(session('status')); ?>

            </div>
            <?php endif; ?>
            <?php echo Form::open(['url' => 'admin/advance_product_catalogue']); ?>

            <div class="form-group">
               <label for="title">Title :</label>
               <input type='text' <?php if(isset($pre)): ?> value="<?php echo e($pre->title); ?>" <?php endif; ?> required name='title'  class='form-control'>
            </div>
			<div class="form-group">
               <label for="description">Description :</label>
               <textarea type='text'   name='description' required class='form-control'><?php if(isset($pre)): ?> <?php echo e($pre->description); ?> <?php endif; ?></textarea>
            </div>
			<div class='form-group'>
			     <label for="image">Image:</label>
				 <div class="input-group">
				   <input readonly type="text"  class="form-control" name="image" id="imageimage" required="" required <?php if(isset($pre)): ?> value="<?php echo e($pre->image); ?>" <?php endif; ?>>
				   <div class="input-group-prepend" onclick="openImagePopup('image')">
					  <span class="input-group-text"><i class="mdi mdi-file-image"></i></span>
				   </div>
				</div>
			</div>
            <div class="form-group">
               <label for="order">Order :</label>
               <input type='number' required name='order' class='form-control' <?php if(isset($pre)): ?> value="<?php echo e($pre->order); ?>" <?php endif; ?>>
            </div>
            <div class="form-actions" style="text-align:center;margin-top:40px">
               <input type="hidden" class="id" name="product_id" value="<?php echo e($id); ?>">
			   <?php if(isset($pre)): ?>  
				   <input type="hidden" value="<?php echo e($pre->id); ?>" name="pre_id">
			   <?php endif; ?>
			   <input type="hidden" value="" id="position">
               <input type="submit" class="btn btn-outline-success" value="<?php if(isset($pre)): ?> Update <?php else: ?> Add <?php endif; ?>">
            </div>
            <?php echo Form::close(); ?>

         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-header">View Advance Product Catalogue</div>
         <div class="card-body">
            <table class='table table-bordered table-striped'>
              <thead>
			     <tr>
				     <th>#</th>
				     <th>Title</th>
				     <th>Description</th>
				     <th>Image</th>
				     <th>Order</th>
				     <th>Action</th>
				 </tr>
			  </thead>
			  <tbody>
			     <?php if(count($data)): ?>
				  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
					  <td><?php echo e(($key+1)); ?></td>
					  <td><?php echo e($row->title); ?></td>
					  <td><?php echo e($row->description); ?></td>
					  <td><img src='<?php echo e(url($row->image)); ?>' width='50'></td>
					  <td><?php echo e($row->order); ?></td>
					  <td>
					     <a class='btn btn-primary btn-xs btn-sm' href="<?php echo e(url('admin/advance_product_catalogue/'.$id.'/'.$row->id)); ?>" >Edit</a>
					     <a class='btn btn-danger btn-xs btn-sm' href="<?php echo e(url('admin/advance_product_catalogue_delete/'.$row->id)); ?>" >Delete</a>
					  </td>
					</tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>			  
				 <?php else: ?>
				 <tr>
				   <td colspan='5'>No Data Found</td>
				 </tr>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/advance_product/advance_product_catalogue.blade.php ENDPATH**/ ?>