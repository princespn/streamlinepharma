

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
  
  <a class="btn btn-outline-light" href="<?php echo e(url('admin/view_advance_product')); ?>">View Added Product</a>
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Advance Product Template Subscription</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Subscribe Template</div>
            <div class="card-body">
			<?php if(session('status')): ?>
			<div class="alert alert-success">
				<?php echo e(session('status')); ?>

			</div>
		    <?php endif; ?>
			<?php echo Form::open(['url' => 'admin/advance_product_subscription']); ?>

			     <div class="form-group">
					<label for="email">Available :</label>
					<select class="form-control searchable_class" multiple  id="email" required  name='subscribed[]'>
					<?php $__currentLoopData = $available; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					  <option value='<?php echo e($row->id); ?>'><?php echo e($row->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				 </div>
				 <button type="submit" class="btn btn-primary">Subscribe</button>
			<?php echo Form::close(); ?>

			</div>
		</div>
		<div class="card m-b-20">
		    <div class="card-header">Subscribed Template</div>
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>Name</th>
				      <th>Category</th>
				      <th>Sub Category</th>
				      <th>Grouping</th>
				      <th>Product Count</th>
				      <th>Banner</th>
				      <th>Return, Replace & Cancel Reason</th>
				      <th>Action</th>
				   </tr>
				</thead>
				<tbody>
			    <?php $__currentLoopData = $subscribed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				  <tr>
				    <td><?php echo e($key+1); ?></td>
				    <td><?php echo e($row->name); ?></td>
				    <td><?php echo e($row->categories_name); ?></td>
				    <td><?php echo e($row->sub_categories_name); ?></td>
				    <td>
					<?php if($row->grouping!=Null): ?>
					  
					   <strong>Grouping Available on : </strong> <?php echo e($row->grouping); ?>

				      
				      <?php if($row->grouping_name!=Null&&count(json_decode($row->grouping_name,true))): ?>
						  <?php $__currentLoopData = json_decode($row->grouping_name,true)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kr=>$gr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						  <br><strong><?php echo e($gr); ?> : </strong> <?php echo e(json_decode($row->grouping_name,true)[1][$kr]); ?>

						  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					  <?php endif; ?>
				    <?php endif; ?>
				    </td>
					<td><?php echo e($row->added_product); ?></td>
					<td>
					 <div id='banner_div<?php echo e($row->cat_id); ?>'>
					    <?php if($row->banner): ?>
							<img src="<?php echo e(url($row->banner)); ?>" width='80'>
						<?php else: ?>
							NA
						<?php endif; ?>
					 </div>
					 <button class='btn btn-sm btn-xs btn-primary' onclick="openImagePopup('banner_div<?php echo e($row->cat_id); ?>')">Change</button>
					 <button type='submit' form='save_category_banner' class='btn btn-sm btn-xs btn-success'>Update</button>
					 <input type="hidden" value="" id="position">
					 <input type="hidden" value="<?php echo e(url('')); ?>" id="base_url">
					</td>
					<td>
					  <strong>Return : </strong><?php echo e($row->is_return); ?>

					  <br>
					  <strong>Replace : </strong><?php echo e($row->is_replace); ?>

					  <br>
					  <strong>Cancel Reason : </strong><?php echo ($row->cancel_reason ? '<br>'.implode('<br>',explode(',',$row->cancel_reason)) : ''); ?>

					  <br>
					  <a href="<?php echo e(url('admin/advance_product_category_action/'.$row->cat_id)); ?>" class='btn btn-primary btn-sm'>Edit</a>
					</td>
				    <td>
					<?php if( $row->categories_name!=''&&$row->sub_categories_name!='' ): ?>
					<?php if( ($row->grouping==Null && $row->grouping_name==Null) || ( $row->grouping!=Null && $row->grouping_name!=Null ) ): ?>
					   <a href="<?php echo e(url('admin/add_advance_product/'.$row->id)); ?>" class='btn btn-primary btn-sm'>+</a>
				    <?php endif; ?>
				    <?php endif; ?>
					   <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#category_modal" onclick="$('#setting_id').val(<?php echo e($row->id); ?>);">
						  Update Category
					   </button>
					   <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#brand_modal" onclick="$('#brand_setting_id').val(<?php echo e($row->id); ?>);">
						  Update Brand
					   </button>
					   <?php if($row->grouping!=Null): ?>
					   <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#grouping_modal" onclick="groupingFunction(<?php echo e($row->id); ?>,'<?php echo e($row->grouping); ?>')">
						  Grouping Name
					   </button>
					   <?php endif; ?>
					   
					   <a href="advance_product_unsubscribe/<?php echo e($row->id); ?>" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure ?')">
						  Unsubscribe
					   </a>
					   <a href="<?php echo e(url('admin/advance_product_excel_download/'.$row->id)); ?>" class='btn btn-sm'>Download Excel</a>
					</td>
				  </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php if(count($un_subscribed)): ?>
					<tr>
				      <th colspan='7'><h2>Unsubscribed but Product Added</h2></th>
				    </tr>
					<tr>
					   <th>#</th>
					   <th colspan='3'>Name</th>
					   <th>Category</th>
					   <th>Sub Category	</th>
					   <th>Product Count</th>
					</tr>
					<?php $__currentLoopData = $un_subscribed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $un_key=>$un_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				    <tr>
					   <td><?php echo e($un_key+1); ?></td>
					   <td colspan='3'><?php echo e($un_row->name); ?></td>
				       <td><?php echo e($un_row->categories_name); ?></td>
				       <td><?php echo e($un_row->sub_categories_name); ?></td>
				       <td><?php echo e($un_row->added_product); ?></td>
					</tr>
				    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				</tbody>
			  </table>
			  <!---------------------------------------------->
			  <div class="modal" id="grouping_modal">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Grouping Modal</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
					  <?php echo Form::open(['url' => 'admin/save_grouping_name', 'id' => 'save_grouping_name']); ?>

						<div class='save_grouping_name_content'>
						
						</div>
					  <?php echo Form::close(); ?>

					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
					   
					    <input type='hidden' id='grouping_setting_id' name='grouping_setting_id' form='save_grouping_name'>
						<button form='save_grouping_name' type="submit" class="btn btn-primary" >Update</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					  </div>

					</div>
				  </div>
				</div>
			  <!---------------------------------------------->
			  <!---------------------------------------------->
			  <div class="modal" id="category_modal">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Update Category</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
					  <?php echo Form::open(['url' => 'admin/save_subscription_category', 'id' => 'save_subscription_category']); ?>

						<div class="form-group">
							<label for="email">Category:</label>
							<select class="form-control" onchange='getSubCategory(this.value)' id='category' name='category'>
							<option value=''></option>
							<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							  <option value='<?php echo e($row->id); ?>'><?php echo e($row->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="pwd">Sub Category:</label>
							<select class="form-control"  id='sub_category' name='sub_category'>
							</select>
						 </div>
					  <?php echo Form::close(); ?>

					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
					    <input type='hidden' id='setting_id' name='setting_id' form='save_subscription_category'>
						<button form='save_subscription_category' type="submit" class="btn btn-primary" >Update</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					  </div>

					</div>
				  </div>
				</div>
			  <!---------------------------------------------->
			  <!---------------------------------------------->
			  <div class="modal" id="brand_modal">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Update Brand</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					  </div>
 
					  <!-- Modal body -->
					  <div class="modal-body">
					  <?php echo Form::open(['url' => 'admin/save_brand_for_template', 'id' => 'save_brand_for_template']); ?>

						<div class="form-group">
							<label for="email">Brand:</label>
							<select class="form-control searchable_class"  id='brand' name='brands[]' multiple>
							<?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							  <option value='<?php echo e($row->id); ?>'><?php echo e($row->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						
					  <?php echo Form::close(); ?>

					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
					    <input type='hidden' id='brand_setting_id' name='brand_setting_id' form='save_brand_for_template'>
						<button form='save_brand_for_template' type="submit" class="btn btn-primary" >Update</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					  </div>

					</div>
				  </div>
				</div>
			  <!---------------------------------------------->
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
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="openFolder('<?php echo e($image->id); ?>','view')">
                                        <img src="http://ecommerce.uniqueandcommon.com/assets/images/folder.png" class="img-thumbnail">
                                        <h6 class="users_name"><?php echo e($image->title); ?></h6>
                                    </li>
                                <?php else: ?>
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl('<?php echo e($image->name); ?>','view')">
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
<?php echo Form::open(['url' => 'admin/save_category_banner', 'id' => 'save_category_banner']); ?>

<input type='hidden' name='category_banner_id' id='category_banner_id'>
<input type='hidden' name='category_banner_url' id='category_banner_url'>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$('.searchable_class').select2({
	 width: 'resolve'
});
function getSubCategory(value){
	$('#sub_category').html("<option value=''></option>");
	if(value!=''){
		$.ajax({
		  url: "<?php echo e(url('admin/getSubCategory')); ?>/"+value,
		  cache: false,
		  success: function(data){
			if(data.length){
				for(var i = 0;i<data.length;i++){
					$('#sub_category').append($("<option></option>").attr("value", data[i].id).text(data[i].name)); 
				}
			}
		  }
		});
	}else{
		$('#sub_category').html("<option value=''></option>");
	}
}
function groupingFunction(id,value){
	$('#grouping_setting_id').val(id);
	var array = value.split(",");
	var html = '';
	for(var i =0;i<array.length;i++){
		html += '<div class="form-group"><label>'+array[i]+':</label><input type="hidden" class="form-control" value="'+array[i]+'" name="label[]" form="save_grouping_name"><input type="text" class="form-control" placeholder="Grouping Name" name="value[]"  form="save_grouping_name"></div>';
		$('#save_grouping_name .save_grouping_name_content').html(html);
	}
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/advance_product/advance_product_subscription.blade.php ENDPATH**/ ?>