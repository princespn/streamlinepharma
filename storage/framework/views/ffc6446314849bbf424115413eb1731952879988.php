
<?php $__env->startSection('pageTitle'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h4 class="page-title"> <i class="dripicons-list"></i> Advance Product Template</h4>

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
		 <?php if(session('error')): ?>
			<div class="alert alert-danger">
				<?php echo e(session('error')); ?>

			</div>
		 <?php endif; ?>
		<?php echo Form::open(['url' => 'admin/advance_product_template', 'class' => 'form-inline']); ?>

            <table class='table table-bordered table-striped'>
               <thead>
                  <tr>
                     <th>Field</th>
                     <th style='width:50%;'>Type</th>
                     <th>Filter</th>
                     <th>isOptional</th>
                     <th>Grouping</th>
                     <th>Hint</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Name</td>
                     <td><input type="text" class="form-control" required="required"  name="name" id="name" <?php if(isset($data)): ?> value='<?php echo e($data->name); ?>' <?php endif; ?>  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='name' <?php if(isset($data)&& in_array('name',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='name' <?php if(isset($data)&& in_array('name',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='name_hint'><?php if(isset($hints)): ?> <?php echo e($hints->name_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  
                  <tr>
                     <td>Title</td>
                     <td><input type="checkbox" class="form-control"   name="title_check" id="title_check" <?php if(isset($data)&&$data->title_check==1): ?> checked <?php endif; ?>  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='title' <?php if(isset($data)&& in_array('title',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='title' <?php if(isset($data)&& in_array('title',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='title_hint'><?php if(isset($hints)): ?> <?php echo e($hints->title_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Brand Name</td>
                     <td><input type="checkbox" class="form-control"   name="brand_check" id="brand_check" <?php if(isset($data)&&$data->brand_check==1): ?> checked <?php endif; ?>  /></td>
                     <td><input type="checkbox" class="form-control"   name="brand_filter" id="brand_check" <?php if(isset($data)&&$data->brand_filter==1): ?> checked <?php endif; ?>   /></td>
                     <td><input type='checkbox' name='isOptional[]' value='brand' <?php if(isset($data)&& in_array('brand',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='brand' <?php if(isset($data)&& in_array('brand',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='brand_hint'><?php if(isset($hints)): ?> <?php echo e($hints->brand_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Thumbnail</td>
                     <td><input type="checkbox" class="form-control"   name="thumbnail_check" id="thumbnail_check" <?php if(isset($data)&&$data->thumbnail_check==1): ?> checked <?php endif; ?>  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='thumbnail' <?php if(isset($data)&& in_array('thumbnail',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='thumbnail' <?php if(isset($data)&& in_array('thumbnail',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='thumbnail_hint'><?php if(isset($hints)): ?> <?php echo e($hints->thumbnail_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
				<?php for($i=1;$i<8;$i++): ?>
					<?php 
				      $var = 'image'.$i.'_check';
				      $tvar = 'image'.$i.'_hint';
					 ?>
                  <tr>
                     <td>Image <?php echo e($i); ?></td>
                     <td><input type="checkbox" class="form-control"   name="image<?php echo e($i); ?>_check" id="thumbnail1_check" <?php if(isset($data)&&$data->$var==1): ?> checked <?php endif; ?> /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='image<?php echo e($i); ?>' <?php if(isset($data)&& in_array('image'.$i,$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='image<?php echo e($i); ?>' <?php if(isset($data)&& in_array('image'.$i,$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='image<?php echo e($i); ?>_hint'><?php if(isset($hints)): ?> <?php echo e($hints->$tvar); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
				 <?php endfor; ?>
                  <tr>
                     <td>Video</td>
                     <td><input type="checkbox" class="form-control"   name="video_check" id="video_check" <?php if(isset($data)&&$data->video_check==1): ?> checked <?php endif; ?>  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='video' <?php if(isset($data)&& in_array('video',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='video' <?php if(isset($data)&& in_array('video',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='title_hint'><?php if(isset($hints)): ?> <?php echo e($hints->video_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>360 File</td>
                     <td><input type="checkbox" class="form-control"   name="view_360_file_check" id="view_360_file_check" <?php if(isset($data)&&$data->view_360_file_check==1): ?> checked <?php endif; ?>  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='view_360_file' <?php if(isset($data)&& in_array('view_360_file',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='view_360_file' <?php if(isset($data)&& in_array('view_360_file',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='title_hint'><?php if(isset($hints)): ?> <?php echo e($hints->view_360_file_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>SKU</td>
                     <td><input type="checkbox" class="form-control"   name="sku_check" id="sku_check" <?php if(isset($data)&&$data->sku_check==1): ?> checked <?php endif; ?>  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='sku' <?php if(isset($data)&& in_array('sku',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='sku' <?php if(isset($data)&& in_array('sku',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='sku_hint'><?php if(isset($hints)): ?> <?php echo e($hints->sku_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Product Code</td>
                     <td><input type="checkbox" class="form-control"   name="product_code_check" id="product_code_check"  <?php if(isset($data)&&$data->product_code_check==1): ?> checked <?php endif; ?>  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='product_code' <?php if(isset($data)&& in_array('product_code',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='product_code' <?php if(isset($data)&& in_array('product_code',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='product_code_hint'><?php if(isset($hints)): ?> <?php echo e($hints->product_code_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  
                  <tr>
                     <td>Unit</td>
                     <td><input type="checkbox" class="form-control"   name="unit_type_check" id="unit_type_check" <?php if(isset($data)&&$data->unit_type_check==1): ?> checked <?php endif; ?> >
                        <textarea  class="form-control"  name="unit_type_check_value_multi" id="unit_type_check_value_multi" placeholder='Comma Seprated Unit Value'><?php if(isset($data)): ?><?php echo e($data->unit_type_check_value_multi); ?><?php endif; ?></textarea>
                     </td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='unit' <?php if(isset($data)&& in_array('unit',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='unit' <?php if(isset($data)&& in_array('unit',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='unit_hint'><?php if(isset($hints)): ?> <?php echo e($hints->unit_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>HSN Code</td>
                     <td><input type="checkbox" class="form-control"   name="hsn_code_check" id="hsn_code_check" <?php if(isset($data)&&$data->hsn_code_check==1): ?> checked <?php endif; ?>   /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='hsn_code' <?php if(isset($data)&& in_array('hsn_code',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='hsn_code' <?php if(isset($data)&& in_array('hsn_code',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='hsn_code_hint'><?php if(isset($hints)): ?> <?php echo e($hints->hsn_code_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Product Price</td>
                     <td><input type="checkbox" class="form-control"   name="product_price_check" id="product_price_check" <?php if(isset($data)&&$data->product_price_check==1): ?> checked <?php endif; ?>   /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='product_price' <?php if(isset($data)&& in_array('product_price',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='product_price'  <?php if(isset($data)&& in_array('product_price',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='product_price_hint'><?php if(isset($hints)): ?> <?php echo e($hints->product_price_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Selling Price</td>
                     <td><input type="checkbox" class="form-control"   name="selling_price_check" id="selling_price_check" <?php if(isset($data)&&$data->selling_price_check==1): ?> checked <?php endif; ?>   />
                        <input type='text' class="form-control" placeholder='Selling Price Field Name' name='selling_price_label' <?php if(isset($data)): ?> value='<?php echo e($data->selling_price_label); ?>' <?php endif; ?>>
                     </td>
                     <td><input type="checkbox" class="form-control"   name="selling_price_filter" id="selling_price_filter"  /></td>
                     <td><input type='checkbox' name='isOptional[]' value='selling_price' <?php if(isset($data)&& in_array('selling_price',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='selling_price' <?php if(isset($data)&& in_array('selling_price',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='selling_price_hint'><?php if(isset($hints)): ?> <?php echo e($hints->selling_price_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>MOQ</td>
                     <td><input type="checkbox" class="form-control"   name="moq_check" id="moq_check" <?php if(isset($data)&&$data->moq_check==1): ?> checked <?php endif; ?>   /></td>
                     <td><input type="checkbox" class="form-control"   name="moq_filter" id="moq_filter" <?php if(isset($data)&&$data->moq_filter==1): ?> checked <?php endif; ?>  /></td>
                     <td><input type='checkbox' name='isOptional[]' value='moq' <?php if(isset($data)&& in_array('moq',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='moq' <?php if(isset($data)&& in_array('moq',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='moq_hint'><?php if(isset($hints)): ?> <?php echo e($hints->moq_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Product Tax</td>
                     <td><input type="checkbox" class="form-control"   name="product_tax_check" id="product_tax_check" <?php if(isset($data)&&$data->product_tax_check==1): ?> checked <?php endif; ?> >
                        <!--input type='text' class='form-control' value='' name='product_tax_check_value' id='product_tax_check_value' placeholder='Product Tax Value' <?php if(isset($data)): ?> value='<?php echo e($data->product_tax_check_value); ?>' <?php endif; ?> -->
                     </td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='product_tax' <?php if(isset($data)&& in_array('product_tax',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='product_tax' <?php if(isset($data)&& in_array('product_tax',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='product_tax_hint'><?php if(isset($hints)): ?> <?php echo e($hints->product_tax_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Tax Method</td>
                     <td><input type="checkbox" class="form-control"   name="tax_method_check" id="tax_method_check" <?php if(isset($data)&&$data->tax_method_check==1): ?> checked <?php endif; ?> ></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='tax_method' <?php if(isset($data)&& in_array('tax_method',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='tax_method' <?php if(isset($data)&& in_array('tax_method',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='tax_method_hint'><?php if(isset($hints)): ?> <?php echo e($hints->tax_method_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Cess</td>
                     <td><input type="checkbox" class="form-control"   name="cess_check" id="cess_check" <?php if(isset($data)&&$data->cess_check==1): ?> checked <?php endif; ?>>
                        <!--input type='text' class='form-control' value='' name='cess_check_value' id='cess_check_value' placeholder='Product Tax Value' <?php if(isset($data)): ?> value='<?php echo e($data->cess_check_value); ?>' <?php endif; ?> -->
                     </td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='cess' <?php if(isset($data)&& in_array('cess',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='cess' <?php if(isset($data)&& in_array('cess',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='cess_hint'><?php if(isset($hints)): ?> <?php echo e($hints->cess_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Description</td>
                     <td><input type="checkbox" class="form-control"   name="description_check" id="description_check" <?php if(isset($data)&&$data->description_check==1): ?> checked <?php endif; ?>></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='description' <?php if(isset($data)&& in_array('description',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='description' <?php if(isset($data)&& in_array('description',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='description_hint'><?php if(isset($hints)): ?> <?php echo e($hints->description_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Status</td>
                     <td><input type="checkbox" class="form-control"  name="status_check" id="status_check" <?php if(isset($data)&&$data->status_check==1): ?> checked <?php endif; ?> ></td>
                     <td><input type="checkbox" class="form-control"   name="status_filter" id="status_filter" <?php if(isset($data)&&$data->status_filter==1): ?> checked <?php endif; ?>  /></td>
                     <td></td>
                     <td></td>
					 <td>
					    <textarea class='form-control' name='status_hint'><?php if(isset($hints)): ?> <?php echo e($hints->status_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <th colspan='3'>Attribute</th>
                  </tr>
                  <tr>
                     <td>Color</td>
                     <td>
                        <input type="checkbox" class="span1"   name="color_check" <?php if(isset($data)&&$data->color_check==1): ?> checked <?php endif; ?> >
                        <select class='form-control' name='color_check_value' onchange="$('#color_btn_add').toggle();">
                           <option <?php if(isset($data)&&$data->color_check_value=='Single'): ?> selected <?php endif; ?> >Single</option>
                           <option <?php if(isset($data)&&$data->color_check_value=='Multiple'): ?> selected <?php endif; ?> >Multiple</option>
                        </select>
                        
                     </td>
                     <td><input type="checkbox" class="form-control"   name="color_filter" id="color_filter" <?php if(isset($data)&&$data->color_filter==1): ?> checked <?php endif; ?>  /></td>
                     <td><input type='checkbox' name='isOptional[]' value='color' <?php if(isset($data)&& in_array('color',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='color' <?php if(isset($data)&& in_array('color',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='color_hint'><?php if(isset($hints)): ?> <?php echo e($hints->color_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Dimension</td>
                     <td><input type="checkbox" class="form-control"  name="dimension_check" id="dimension_check" placeholder='Height' <?php if(isset($data)&&$data->dimension_check==1): ?> checked <?php endif; ?>>
                        
                     </td>
                     <td><input type="checkbox" class="form-control"   name="dimension_filter" id="dimension_filter" <?php if(isset($data)&&$data->dimension_filter==1): ?> checked <?php endif; ?>  /></td>
                     <td><input type='checkbox' name='isOptional[]' value='dimension' <?php if(isset($data)&& in_array('dimension',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='dimension' <?php if(isset($data)&& in_array('dimension',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='dimension_hint'><?php if(isset($hints)): ?> <?php echo e($hints->dimension_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Size</td>
                     <td>
                        <input type="checkbox" class="form-control"  name="size_check" id="size_check" placeholder='' <?php if(isset($data)&&$data->size_check==1): ?> checked <?php endif; ?> >
                        <select class='form-control' onchange="changeAttribute(this.value,'size_value')" name='size_check_value' id='size_check_value'>
                           <option <?php if(isset($data)&&$data->size_check_value=='Single'): ?> selected <?php endif; ?> >Single</option>
                           <option <?php if(isset($data)&&$data->size_check_value=='Single'): ?> selected <?php endif; ?> >Multiple</option>
                        </select>
                        <textarea  class="form-control"   name="size_check_value_option" id="size_check_value_option" placeholder='Value'><?php if(isset($data)): ?><?php echo e($data->size_check_value_option); ?><?php endif; ?></textarea>
                     </td>
                     <td><input type="checkbox" class="form-control"   name="size_filter" id="size_filter" <?php if(isset($data)&&$data->size_filter==1): ?> checked <?php endif; ?> /></td>
                     <td><input type='checkbox' name='isOptional[]' value='size' <?php if(isset($data)&& in_array('size',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='size' <?php if(isset($data)&& in_array('size',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='size_hint'><?php if(isset($hints)): ?> <?php echo e($hints->size_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Weight</td>
                     <td><input type="checkbox" class="form-control"   name="weight_check" id="weight_check" placeholder='' <?php if(isset($data)&&$data->weight_check==1): ?> checked <?php endif; ?> >
                        
                     </td>
                     <td><input type="checkbox" class="form-control"   name="weight_filter" id="weight_filter" <?php if(isset($data)&&$data->weight_filter==1): ?> checked <?php endif; ?>  /></td>
                     <td><input type='checkbox' name='isOptional[]' value='weight' <?php if(isset($data)&& in_array('weight',$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='weight' <?php if(isset($data)&& in_array('weight',$grouping) ): ?> checked <?php endif; ?>></td>
					 <td>
					    <textarea class='form-control' name='weight_hint'><?php if(isset($hints)): ?> <?php echo e($hints->weight_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Search Key Words</td>
                     <td><input type="checkbox" class="form-control"   name="search_key_words_check" id="search_key_words_check" <?php if(isset($data)&&$data->search_key_words_check==1): ?> checked <?php endif; ?>  /></td>
                     <td><input type="checkbox" class="form-control"   name="search_key_words_filter" id="search_key_words_filter" <?php if(isset($data)&&$data->search_key_words_filter==1): ?> checked <?php endif; ?>  /></td>
                     <td></td>
                     <td></td>
					 <td>
					    <textarea class='form-control' name='search_key_words_hint'><?php if(isset($hints)): ?> <?php echo e($hints->search_key_words_hint); ?> <?php endif; ?></textarea>
					 </td>
                  </tr>
				  
               </tbody>
            </table>
			<table class='table table-bordered table-striped'>
               <thead>
			      <tr>
				     <th colspan='5'>Addional Attribute</th>
				  </tr>
                  <tr>
                     <th>Attribute</th>
                     <th>Type</th>
                     <th>Value</th>
                     <th>isOptional</th>
                     <th>Grouping</th>
                  </tr>
               </thead>
               <tbody>
			   <?php $i=1; ?>
			   <?php if(isset($data)&&$data->additional_attribute!=Null&&count($additional_attribute)): ?>
				   
				   <?php $__currentLoopData = $additional_attribute[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			         
			         <tr>
                     <td>
					     <input type='text' class='form-control atr<?php echo e($i); ?>' placeholder='Attribute Name' name='additional_attribute[]'  value='<?php echo e($row); ?>'>
					     <input type="checkbox" class="form-control"  name="size_check" id="attr_check<?php echo e($i); ?>" placeholder='' onchange='if($("#attr_check<?php echo e($i); ?>").prop("checked",true)){  $(".atr<?php echo e($i); ?>").removeAttr("disabled"); }else{ $(".atr<?php echo e($i); ?>").attr("disabled","disabled"); }' checked>
					 </td>
                     <td>
					     <select class='form-control  atr<?php echo e($i); ?>' onchange="changeAttribute(this.value,'size_value')" name='additional_attribute_option[]' id='additional_attribute_option' >
											   <option <?php if($additional_attribute[1][$key]=='Checkboxes'): ?> selected <?php endif; ?>>Checkboxes</option>
											   <option <?php if($additional_attribute[1][$key]=='Dropdown'): ?> selected <?php endif; ?>>Dropdown</option>
											</select>
					 </td>
                     <td>
					     <textarea  class="form-control  atr<?php echo e($i); ?>"   name="additional_attribute_value[]" id="additional_attribute_value" placeholder='Value'  ><?php echo e($additional_attribute[2][$key]); ?></textarea>
					 </td>
                     <td><input type='checkbox' name='isOptional[]' value='addiotioanl<?php echo e($i); ?>' <?php if(isset($data)&& in_array('addiotioanl'.$i,$optional) ): ?> checked <?php endif; ?>></td>
                     <td><input type='checkbox' name='grouping[]' value='addiotioanl<?php echo e($i); ?>' <?php if(isset($data)&& in_array('addiotioanl'.$i,$grouping) ): ?> checked <?php endif; ?>></td>
                  </tr>
				   <?php $i++; ?>
			       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			   <?php endif; ?>
			      <?php for($i=$i;$i<=20;$i++): ?>
					 <tr>
                     <td>
					     <input type='text' class='form-control atr<?php echo e($i); ?>' placeholder='Attribute Name <?php echo e($i); ?>' name='additional_attribute[]'  disabled>
					     <input type="checkbox" class="form-control"  name="size_check" id="attr_check<?php echo e($i); ?>" placeholder='' onchange='if(document.getElementById("attr_check<?php echo e($i); ?>").checked==true){  $(".atr<?php echo e($i); ?>").removeAttr("disabled"); }else{ $(".atr<?php echo e($i); ?>").attr("disabled","disabled"); }' >
					 </td>
                     <td>
					     <select class='form-control  atr<?php echo e($i); ?>' onchange="changeAttribute(this.value,'size_value')" name='additional_attribute_option[]' id='additional_attribute_option'  disabled>
											   <option>Checkboxes</option>
											   <option>Dropdown</option>
											</select>
					 </td>
                     <td>
					     <textarea  class="form-control  atr<?php echo e($i); ?>"   name="additional_attribute_value[]" id="additional_attribute_value" placeholder='Value' disabled></textarea>
					 </td>
                     <td><input type='checkbox' name='isOptional[]' value='addiotioanl<?php echo e($i); ?>'></td>
                     <td><input type='checkbox' name='grouping[]' value='addiotioanl<?php echo e($i); ?>'></td>
                  </tr> 
				  <?php endfor; ?>
				  
               </tbody> 
			   <tfoot>
			      <tr>
                     <td colspan='4'>
					   <?php if(isset($data)): ?>
						   <input type='hidden' value='<?php echo e($data->id); ?>' name='id'>
					   <?php endif; ?>
					   <input type='submit' class='btn btn-primary' value='<?php if(isset($data)): ?> Update <?php else: ?> Submit <?php endif; ?>'>
					 </td>
                  </tr>
			   </tfoot>
			</table>
			<?php echo Form::close(); ?>

         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$('.searchable_class').select2({
	 width: 'resolve'
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/advance_product/advance_product_template.blade.php ENDPATH**/ ?>