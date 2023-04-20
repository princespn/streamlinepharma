
<?php $__env->startSection('pageTitle'); ?>
<style>
.hide{
	display:none;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h4 class="page-title"> <i class="dripicons-list"></i>Add Advance Product </h4>
<input type="hidden" value="1" id="position">
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="csrfToken">
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
		
		<?php echo Form::open(['url' => 'admin/upload_advance_product', 'files' => true]); ?>

		<div class="form-group">
			<label for="advance_product_file">Attach Excel:</label>
			<input type="file" id='advance_product_file' name='advance_product_file' class="form-control" placeholder="">
		</div>
		<input type='hidden' name='id' value='<?php echo e($data->id); ?>'>
		<button type="submit" class="btn btn-primary">Upload</button>
		<?php echo Form::close(); ?>

		<br>
		<hr style='border: 2px solid #1d1f44;background:#1d1f44;'>
		<br>
		<?php echo Form::open(['url' => 'admin/insert_advance_product', 'class' => '', 'files' => true]); ?>

		                     <?php if($data->grouping_name!=Null): ?>
								 <?php $__currentLoopData = json_decode($data->grouping_name,true)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kr=>$gr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                            <div class="form-check">
										<label class="form-check-label">
										  <input class="form-check-input" type="checkbox" <?php if(isset($pre_data)): ?> <?php if(in_array($gr,explode(',',$pre_data->grouping_name))): ?> checked <?php endif; ?> <?php endif; ?> name='grouping_name[]' value='<?php echo e($gr); ?>' ><?php echo e(json_decode($data->grouping_name,true)[1][$kr]); ?>

										</label>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<br>
							  <?php endif; ?>
                              <?php if($data->thumbnail_check): ?>    
									<div class="control-group">
										<label class="control-label">Thumbnail</label>
										<div class="input-group">
											<input type="text" class="form-control"   name="thumbnail" id="imagethumbnail" <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->thumbnail); ?>' <?php endif; ?> <?php if(!in_array('thumbnail',$optional)): ?> required  <?php endif; ?>  />
											<div class="input-group-prepend" onclick="openImagePopup('thumbnail')">
											  <span class="input-group-text"><i class="mdi mdi-file-image"></i></span>
											</div>
										</div>
									</div>
								<?php endif; ?>	
								<?php for($i=1;$i<=7;$i++): ?>	
								   <?php $var = 'image'.$i.'_check';
									$pre_f = 'image'.$i;
									
									?>
								   <?php if($data->$var): ?>
									<div class="control-group">
										<label class="control-label">Image <?php echo e($i); ?></label>
										
										<div class="input-group">
											<input type="text" class="form-control"   name="image<?php echo e($i); ?>" id="imageimage<?php echo e($i); ?>" <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->$pre_f); ?>' <?php endif; ?> <?php if(!in_array('image'.$i,$optional)): ?> required  <?php endif; ?>  />
											<div class="input-group-prepend" onclick="openImagePopup('image<?php echo e($i); ?>')" >
											  <span class="input-group-text"><i class="mdi mdi-file-image"></i></span>
											</div>
											
										</div>
									</div>
								   <?php endif; ?>
								<?php endfor; ?>
								<?php if($data->video_check): ?>
									<div class="control-group">
										<label class="control-label">Video</label>
										<div class="input-group">
											<input type="text" class="form-control"   name="video" id="video"  <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->video); ?>' <?php endif; ?> <?php if(!in_array('video',$optional)): ?> required  <?php endif; ?>  />
											<div class='input-group-prepend '>
											  
											</div>
										</div>
									</div>
								<?php endif; ?>
								<?php if($data->view_360_file_check): ?>
									<div class="control-group">
										<label class="control-label">360 File <small>Only .glb files are accepted.</small></label>
										<div class="input-group">
											<input type="file" class="form-control"   name="view_360_file" id="view_360_file"  <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->view_360_file); ?>' <?php endif; ?> <?php if(!in_array('view_360_file',$optional)): ?> required  <?php endif; ?>  />
											<div class='input-group-prepend '>
											  
											</div>
										</div>
									</div>
								<?php endif; ?>
									<div class="control-group">
										<label class="control-label">Name</label>
										<div class="controls">
											<input type="text" class="form-control"   name="name" readonly value='<?php echo e($data->name); ?>' id="name" <?php if(!in_array('name',$optional)): ?> required  <?php endif; ?>  />
										</div>
									</div>
								
							
								
								<?php if($data->title_check): ?>    
									<div class="control-group">
										<label class="control-label" for='title'>Title</label>
										<div class="controls">
											<input type="text" class="form-control"   name="title" id="title" <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->title); ?>' <?php endif; ?> <?php if(!in_array('title',$optional)): ?> required  <?php endif; ?>  />
										</div>
									</div>
								<?php endif; ?>
								<?php if($data->brand_check): ?>    
									<div class="control-group">
										<label class="control-label" for='title'>Brand Name</label>
										<div class="controls">
										  <select name='brand' class='form-control' <?php if(!in_array('brand',$optional)): ?> required  <?php endif; ?> >
										  <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option <?php if(isset($pre_data)&&$pre_data->brand==$b_row->id): ?> selected <?php endif; ?> value='<?php echo e($b_row->id); ?>'><?php echo e($b_row->name); ?></option>
										  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										  </select>
										</div>
									</div>
								<?php endif; ?>	
								<?php if($data->sku_check): ?>
									<div class="control-group">
										<label class="control-label">SKU</label>
										<div class="input-group">
											<input type="text" class="form-control"   name="sku" id="sku" onchange='checkSKU(this.value)' <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->sku); ?>' <?php endif; ?> <?php if(!in_array('sku',$optional)): ?> required  <?php endif; ?>  />
											<div class='input-group-prepend '>
											  <span class='input-group-text sku_message'></span>
											</div>
										</div>
									</div>
								<?php endif; ?>	
								<?php if($data->product_code_check): ?>	
									<div class="control-group">
										<label class="control-label">Product Code</label>
										<div class="controls">
											<input type="text" class="form-control"   name="product_code" readonly id="product_code" <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->product_code); ?>' <?php else: ?> value='<?= time(); ?>' <?php endif; ?> <?php if(!in_array('product_code',$optional)): ?> required  <?php endif; ?>  />
										</div>
									</div>
								<?php endif; ?>	
									
								<?php if($data->unit_type_check): ?>	
									<div class="control-group">
										<label class="control-label">Unit</label>
										<div class="input-group"> 
										    <input type='text' class='form-control' name='unit_quanitity' required <?php if(!in_array('unit_quanitity',$optional)): ?> required  <?php endif; ?> <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->unit_quanitity); ?>' <?php endif; ?>>
											<select type="text" class="form-control" <?php if(!in_array('unit',$optional)): ?> required  <?php endif; ?>   name="unit" id="unit">
											<?php $__currentLoopData = explode(',',$data->unit_type_check_value_multi); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $un): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											  <option <?php if(isset($pre_data)&&$pre_data->unit==$un): ?> selected <?php endif; ?>><?php echo e($un); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
									
								<?php endif; ?>	
								<?php if($data->hsn_code_check): ?>	
									
									<div class="control-group">
										<label class="control-label">HSN Code</label>
										<div class="controls">
											<input type="text" class="form-control"   name="hsn_code" id="hsn_code" <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->hsn_code); ?>' <?php endif; ?>  <?php if(!in_array('hsn_code',$optional)): ?> required  <?php endif; ?>  />
										</div>
									</div>
								<?php endif; ?>
								<?php if($data->product_price_check): ?>	
									
									<div class="control-group">
										<label class="control-label">Product Price</label>
										<div class="controls">
											<input type="text" class="form-control"   name="product_price" id="product_price" <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->product_price); ?>' <?php endif; ?>  <?php if(!in_array('product_price',$optional)): ?> required  <?php endif; ?>  />
										</div>
									</div>
								<?php endif; ?>	
								
								<?php if($data->selling_price_check): ?>	
									
									<div class="control-group">
										<label class="control-label"><?php echo e($data->selling_price_label); ?></label>
										<div class="controls">
											<input type="text" class="form-control"   name="selling_price" id="selling_price"  <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->selling_price); ?>' <?php endif; ?>  <?php if(!in_array('selling_price',$optional)): ?> required  <?php endif; ?>  />
											<input type="hidden" class="form-control"   name="selling_price_label" value='<?php echo e($data->selling_price_label); ?>' id="selling_price_label"  />
										</div>
									</div>
								<?php endif; ?>	
								<?php if($data->moq_check): ?>	
									
									<div class="control-group">
										<label class="control-label">MOQ</label>
										<div class="controls">
											<input type="text" class="form-control"   name="moq" id="moq" <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->moq); ?>' <?php endif; ?>  <?php if(!in_array('moq',$optional)): ?> required  <?php endif; ?>  />
										</div>
									</div>
								<?php endif; ?>
								
								<?php if($data->product_tax_check): ?>	
									
									<div class="control-group">
										<label class="control-label">Product Tax</label>
										<div class="controls">
											<!--
											<select type="text" class="form-control"   name="product_tax" id="product_tax" <?php if(!in_array('product_tax',$optional)): ?> required  <?php endif; ?>>
											  <?php $__currentLoopData = explode(',',$data->product_tax_check_value); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $un): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											  <option <?php if(isset($pre_data)&&$pre_data->product_tax==$un): ?> selected <?php endif; ?>><?php echo e($un); ?></option>
											  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select> -->
											<input type="number" name="product_tax" id="product_tax" class="form-control" <?php if(isset($pre_data)): ?> value="<?php echo e($pre_data->product_tax); ?>" <?php endif; ?> >
										</div>
									</div>
								<?php endif; ?>	
								<?php if($data->tax_method_check): ?>	
									
									<div class="control-group">
										<label class="control-label">Tax Method</label>
										<div class="controls">
											<select type="text" class="form-control"   name="tax_method" id="tax_method"<?php if(!in_array('tax_method',$optional)): ?> required  <?php endif; ?>>
											  <option <?php if(isset($pre_data)&&$pre_data->tax_method=='Inclusive'): ?> selected <?php endif; ?>>Inclusive</option>
											  <option <?php if(isset($pre_data)&&$pre_data->tax_method=='Exclusive'): ?> selected <?php endif; ?>>Exclusive</option>
											</select>
										</div>
									</div>
								<?php endif; ?>	
								
								
								<?php if($data->cess_check): ?>	
									
									<div class="control-group">
										<label class="control-label">Cess</label>
										<div class="controls">
											<select type="text" class="form-control"   name="cess" id="cess" <?php if(!in_array('cess',$optional)): ?> required  <?php endif; ?>>
											  <?php $__currentLoopData = explode(',',$data->cess_check_value); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $un): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											  <option <?php if(isset($pre_data)&&$pre_data->cess==$un): ?> selected <?php endif; ?>><?php echo e($un); ?></option>
											  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
								<?php endif; ?>	
								
								
								<?php if($data->description_check): ?>	
									
									<div class="control-group">
										<label class="control-label">Description</label>
										<div class="controls">
											<textarea type="text" class="form-control"   name="description" id="description"  <?php if(!in_array('description',$optional)): ?> required  <?php endif; ?>><?php if(isset($pre_data)): ?> <?php echo e($pre_data->description); ?> <?php endif; ?></textarea>
										</div>
									</div>
								<?php endif; ?>	
								<?php if($data->status_check): ?>	
									
									<div class="control-group">
										<label class="control-label">Status</label>
										<div class="controls">
											<select type="text" class="form-control"   name="status" id="status1" <?php if(!in_array('status',$optional)): ?> required  <?php endif; ?>>
											  <option <?php if(isset($pre_data)&&$pre_data->status=='Active'): ?> selected <?php endif; ?>>Active</option>
											  <option <?php if(isset($pre_data)&&$pre_data->status=='Inactive'): ?> selected <?php endif; ?>>Inactive</option>
											</select>
										</div>
									</div>
								<?php endif; ?>	
									
									<div class="control-group">
										<label class="control-label">Attribute</label>
										<div class="controls">
											
										</div>
									</div>
									
									
								<?php if($data->color_check): ?>	
									<div class="control-group">
									    <label class="control-label">Color</label>
										<div class="controls">
											<select class='form-control' name='color' id='color' <?php if(!in_array('color',$optional)): ?> required  <?php endif; ?>>
											<?php $__currentLoopData = $all_color; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											  <option  <?php if(isset($pre_data)&&$pre_data->color==$color): ?> selected <?php endif; ?>><?php echo e($color); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
								<?php endif; ?>	
								<?php if($data->dimension_check): ?>
									<div class="control-group">
									    <label class="control-label">Dimension</label>
										<div class="input-group">
											<input type="text" class="form-control"   name="height" id="height" placeholder='Height' <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->height); ?>' <?php endif; ?> <?php if(!in_array('height',$optional)): ?> required  <?php endif; ?>>
											<input type="text" class="form-control"   name="width" id="width" placeholder='Width' <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->width); ?>' <?php endif; ?> <?php if(!in_array('width',$optional)): ?> required  <?php endif; ?>>
											<input type="text" class="form-control"   name="length" id="length" placeholder='Length' <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->length); ?>' <?php endif; ?> <?php if(!in_array('length',$optional)): ?> required  <?php endif; ?>>
											<select class='form-control' name='dimension_unit' id='dimension_unit'>
											  <option>CM</option>
											</select>
										</div>
									</div>
								<?php endif; ?>	
								<?php if($data->size_check): ?>	
									<div class="control-group">
									    <label class="control-label">Size</label>
										<div class="controls">
											<select class='form-control searchable_class' name='size_check_value_option' id='size_check_value_option' <?php if(!in_array('size_check_value_option',$optional)): ?> required  <?php endif; ?> >
											   <?php $__currentLoopData = explode(',',$data->size_check_value_option); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $un): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											  <option  <?php if(isset($pre_data)&&$pre_data->size==$un): ?> selected <?php endif; ?>><?php echo e($un); ?></option>
											  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
								<?php endif; ?>	
								<?php if($data->weight_check): ?>	
									<div class="control-group">
									    <label class="control-label">Weight</label>
										<div class="input-group">
											<input type="text" class="form-control"   name="weight" id="weight" placeholder='' <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->weight); ?>' <?php endif; ?> <?php if(!in_array('weight',$optional)): ?> required  <?php endif; ?>>
											<select class='form-control' name='weight_unit' id='weight_unit'>
											   <option>KG</option>
											</select>
										</div>
									</div>
								<?php endif; ?>		
								
							<?php for($num=1;$num<6;$num++): ?>
                            <?php  
						    $pre_keyword = [];
							if(isset($pre_data)&&$pre_data->search_key_words!=NULL){
								$pre_keyword = explode(',',$pre_data->search_key_words);
								//echo //count($pre_keyword);print_r($pre_keyword);exit;
							}
							?>
								<?php if($data->search_key_words_check): ?>    
									<div class="control-group">
										<label class="control-label" for='txtInput'>Search Key Words <?php echo e($num); ?></label>
										
											<input type="text" class="form-control"     name='search_key_words[]' <?php if(isset($pre_data)&& count($pre_keyword)>=$num ): ?> value='<?php echo e($pre_keyword[($num-1)]); ?>' <?php endif; ?> />
											
										
									</div>
								<?php endif; ?>	
								<?php endfor; ?>	
									
									
									
									<div class="control-group">
										<label class="control-label">Return</label>
										<div class="controls">
											<select type="text" class="form-control"   name="is_return" id="is_return" onclick="if(this.value=='Yes'){$('.return_div').removeClass('hide');}else{$('.return_div').addClass('hide');}">
											  <option <?php if(isset($pre_data)&&$pre_data->is_return=='No'): ?> selected <?php endif; ?>>No</option>
											  <option <?php if(isset($pre_data)&&$pre_data->is_return=='Yes'): ?> selected <?php endif; ?>>Yes</option>
											</select>
										</div>
									</div>
									
									<div class="control-group return_div <?php if(isset($pre_data)&&$pre_data->is_return=='Yes'): ?>  <?php else: ?> hide <?php endif; ?>">
										<label class="control-label">Return Days</label>
										<div class="controls">
											<input type='number' class='form-control' name='return_days' id='return_days' <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->return_days); ?>' <?php endif; ?>>
										</div>
									</div>
									
									<div class="control-group return_div <?php if(isset($pre_data)&&$pre_data->is_return=='Yes'): ?>  <?php else: ?> hide <?php endif; ?>">
										<label class="control-label">Return T&#38;C</label>
										<div class="controls">
											<textarea class='form-control'  name='return_terms' id='return_terms'><?php if(isset($pre_data)): ?> <?php echo e($pre_data->return_terms); ?> <?php endif; ?></textarea>
										</div>
									</div>
									
									
									
									<div class="control-group">
										<label class="control-label">Replace</label>
										<div class="controls">
											<select type="text" class="form-control"   name="is_replace" id="is_replace" onclick="if(this.value=='Yes'){$('.replace_div').removeClass('hide');}else{$('.replace_div').addClass('hide');}">
											  <option  <?php if(isset($pre_data)&&$pre_data->is_replace=='No'): ?> selected <?php endif; ?>>No</option>
											  <option  <?php if(isset($pre_data)&&$pre_data->is_replace=='Yes'): ?> selected <?php endif; ?>>Yes</option>
											</select>
										</div>
									</div>
									
									<div class="control-group replace_div <?php if(isset($pre_data)&&$pre_data->is_replace=='Yes'): ?>  <?php else: ?> hide <?php endif; ?>">
										<label class="control-label">Replace Days</label>
										<div class="controls">
											<input type='number' class='form-control' name="replace_days" id="replace_days" <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->replace_days); ?>' <?php endif; ?>>
										</div>
									</div>
									
									<div class="control-group replace_div <?php if(isset($pre_data)&&$pre_data->is_replace=='Yes'): ?>  <?php else: ?> hide <?php endif; ?>">
										<label class="control-label">Replace T&#38;C</label>
										<div class="controls">
											<textarea class='form-control'  name="replace_terms" id="replace_terms"><?php if(isset($pre_data)): ?> <?php echo e($pre_data->replace_terms); ?> <?php endif; ?></textarea>
										</div>
									</div>
								
                                    

								    <div class="control-group">
										<label class="control-label">Shipping Method</label>
										<div class="controls">
											<select type="text" class="form-control"    name="shipping_method" id="shipping_method">
											  <option  <?php if(isset($pre_data)&&$pre_data->shipping_method=='Inclusive'): ?> selected <?php endif; ?>>Inclusive</option>
											  <option  <?php if(isset($pre_data)&&$pre_data->shipping_method=='Exclusive'): ?> selected <?php endif; ?>>Exclusive</option>
											</select>
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label">Affiliation</label>
										<div class="controls">
											<select type="text" class="form-control"   name="is_affiliation" id="is_affiliation" onchange="if(this.value=='Yes'){$('.affiliation_div').removeClass('hide');}else{$('.affiliation_div').addClass('hide');}">
											  <option  <?php if(isset($pre_data)&&$pre_data->is_affiliation=='No'): ?> selected <?php endif; ?>>No</option>
											  <option  <?php if(isset($pre_data)&&$pre_data->is_affiliation=='Yes'): ?> selected <?php endif; ?>>Yes</option>
											</select>
										</div>
									</div>
									
									<div class="control-group affiliation_div <?php if(isset($pre_data)&&$pre_data->is_affiliation=='Yes'): ?>  <?php else: ?> hide <?php endif; ?>">
										<label class="control-label">Affiliation Price</label>
										<div class="controls">
											<input type='number' class='form-control' name="affiliation_price" id="affiliation_price" <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->affiliation_price); ?>' <?php endif; ?>>
										</div>
									</div>

									<div class="control-group affiliation_div <?php if(isset($pre_data)&&$pre_data->is_affiliation=='Yes'): ?>  <?php else: ?> hide <?php endif; ?>">
										<label class="control-label">Affiliate Payment release on Online Payment</label>
										<div class="controls">
										<select type="text" class="form-control"   name="affiliation_payment_release_online" id="affiliation_payment_release_online" >
										        <option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='On Order recieved'): ?> selected <?php endif; ?>>On Order recieved</option>
												<option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='On Payment Received'): ?> selected <?php endif; ?>>On Payment Received</option>
												<option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='On Return period complition'): ?> selected <?php endif; ?>>On Return period complition</option>
												<option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='On Return pick up'): ?> selected <?php endif; ?>>On Return pick up</option> 
												<option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='On Return good recieved'): ?> selected <?php endif; ?>>On Return good recieved</option>
												<option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='>On Return good audit'): ?> selected <?php endif; ?>>On Return good audit</option>
											</select>
										</div>
									</div>

									<div class="control-group affiliation_div <?php if(isset($pre_data)&&$pre_data->is_affiliation=='Yes'): ?>  <?php else: ?> hide <?php endif; ?>">
										<label class="control-label">Affiliate Payment release on For COD </label>
										<div class="controls">
										<select type="text" class="form-control"   name="affiliation_payment_release_cod" id="affiliation_payment_release_cod" >
										       <option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='On Order recieved'): ?> selected <?php endif; ?>>On Order recieved</option>
												<option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='On Payment Received'): ?> selected <?php endif; ?>>On Payment Received</option>
												<option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='On Return period complition'): ?> selected <?php endif; ?>>On Return period complition</option>
												<option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='On Return pick up'): ?> selected <?php endif; ?>>On Return pick up</option> 
												<option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='On Return good recieved'): ?> selected <?php endif; ?>>On Return good recieved</option>
												<option <?php if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='>On Return good audit'): ?> selected <?php endif; ?>>On Return good audit</option>
											</select>
										</div>
									</div>
									
									
									<div class="control-group">
										<label class="control-label">COD Available</label>
										<div class="controls">
											<select type="text" class="form-control"   name="is_cod_available" id="is_cod_available">
											  <option  <?php if(isset($pre_data)&&$pre_data->is_cod_available=='Yes'): ?> selected <?php endif; ?>>Yes</option>
											  <option  <?php if(isset($pre_data)&&$pre_data->is_cod_available=='No'): ?> selected <?php endif; ?>>No</option>
											</select>
										</div>
									</div>
									
									
								<?php if($data->additional_attribute!=Null&&count(json_decode($data->additional_attribute))): ?>	<div class="control-group">
										<label class="control-label">Addional Attribute</label>
										<div class="controls">
											
										</div>
									</div>
								<?php $i=1; ?>
								<?php $__currentLoopData = json_decode($data->additional_attribute)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								    <div class="control-group">
									    <label class="control-label"><?php echo e($row); ?></label>
										<div class="controls">
									    <input type='hidden' value='<?php echo e($row); ?>' name='attribute[]'>
										<input type='hidden' value='<?php echo e(json_decode($data->additional_attribute)[1][$key]); ?>' name='attribute_option[]'>
									   <?php if(json_decode($data->additional_attribute)[1][$key]=='Checkboxes'): ?>
											<select name='attr_checkbox_<?php echo e($key); ?>[]' id="multi_drop_id<?php echo e($key); ?>" multiple="multiple" class="form-control position" <?php if(!in_array('addiotioanl'.$i,$optional)): ?> required  <?php endif; ?> onchange="$('#attr_checkbox_<?php echo e($key); ?>').val($('#multi_drop_id<?php echo e($key); ?>').val());">
											
											
											<?php $__currentLoopData = explode(',',json_decode($data->additional_attribute)[2][$key]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<!--<input type='checkbox' <?php if(!in_array('addiotioanl'.$i,$optional)): ?> required  <?php endif; ?> value='<?php echo e($opt); ?>' name='attr_checkbox_<?php echo e($key); ?>' onchange='checkBoxToInput("attr_checkbox_<?php echo e($key); ?>")' <?php if(isset($pre_data)&& (count($pre_data->json[0])==count(json_decode($data->additional_attribute)[0])) && in_array($opt,explode(',',$pre_data->json[2][$key])) ): ?>   checked <?php endif; ?>> -->
											
												<option <?php if(isset($pre_data)&& (count($pre_data->json[0])==count(json_decode($data->additional_attribute)[0])) && in_array($opt,explode(',',$pre_data->json[2][$key])) ): ?>   selected <?php endif; ?>> <?php echo e($opt); ?></option>
											
										    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
											<input type='hidden' value='' id='attr_checkbox_<?php echo e($key); ?>'  name='attribute_value[]'>
										<?php else: ?>
											<select name='attribute_value[]' <?php if(!in_array('addiotioanl'.$i,$optional)): ?> required  <?php endif; ?>>									    <?php $__currentLoopData = explode(',',json_decode($data->additional_attribute)[2][$key]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option  <?php if(isset($pre_data)&& (count($pre_data->json[0])==count(json_decode($data->additional_attribute)[0])) && $pre_data->json[2][$key] ==$opt ): ?>   selected <?php endif; ?>><?php echo e($opt); ?></option>
										    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										    </select>
										<?php endif; ?>
										</div>
									</div>
								<?php $i++; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>	
									
									
									
									
									
									
									<div class="form-actions" style='text-align:center;margin-top:40px'>
									    <input type='hidden' class='product_id' name='product_id' value='<?php echo e($data->id); ?>'>
										<?php if(isset($pre_data)): ?>  
										<input type='hidden' name='pre_product_id' value='<?php echo e($pre_data->id); ?>'>
										<?php endif; ?>
										<input type='hidden' value='<?php echo e($menu->category); ?>' name="category">
									    <input type='hidden' value='<?php echo e($menu->sub_category); ?>' name="sub_category">
									    <input type='hidden' value='<?php echo e($menu->id); ?>' name="dynamic_menu">
										<input type="submit" class="btn btn-outline-success" value="<?php if(isset($pre_data)): ?> Update <?php else: ?> Add <?php endif; ?>  Advance Product Profile">
									</div>
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
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
<style type="text/css">
        .bootstrap-tagsinput{
            width: 100%;
        }
        .label-info{
            background-color: #17a2b8;

        }
        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script-->
<script>
	$(".position").select2({
  allowClear:true,
  placeholder: '-Select-'
});
   function checkSKU(value){
	   $('.sku_message').html('Checking...');
		if(value!=''){
			$.ajax({
			  url: "<?php echo e(url('admin/checkSKU')); ?>",
			  data : { value:value },
			  cache: false,
			  success: function(data){
				$('.sku_message').html(data.message);
			  }
			});
		}else{  
			$('#sub_category').html("<option value=''></option>");
		}
   }
   function checkBoxToInput(name){
   var favorite = [];
          $.each($("input[name='"+name+"']:checked"), function(){
              favorite.push($(this).val());
          });
   $("#"+name).val(favorite.join(","));
   }
   <?php if($data->view_360_file_check): ?>
    $(document).ready( function (){
		$("#view_360_file").change(function () {
			var fileExtension = ['glb'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				alert("Only formats are allowed : "+fileExtension.join(', '));
				$(this).val('');
			}
		});
    });
   <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/advance_product/add_advance_product.blade.php ENDPATH**/ ?>