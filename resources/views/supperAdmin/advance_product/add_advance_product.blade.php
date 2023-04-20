@extends('layouts.app')
@section('pageTitle')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h4 class="page-title"> <i class="dripicons-list"></i>Add Advance Product </h4>

@endsection
@section('contentData')
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-body">
		 @if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
		
                              @if($data->thumbnail_check)    
									<div class="control-group">
										<label class="control-label">Thumbnail</label>
										<div class="controls">
											<input type="text" class="span6" required="required"  name="thumbnail" id="thumbnail" />
										</div>
									</div>
								@endif	
								@for($i=1;$i<=7;$i++)	
								   <?php $var = 'image'.$i.'_check'; ?>
								   @if($data->$var)
									<div class="control-group">
										<label class="control-label">Image {{ $i }}</label>
										
										<div class="controls">
											<input type="text" class="span6" required="required"  name="image{{ $i }}" id="thumbnail" />
										</div>
									</div>
								   @endif
								@endfor
									<div class="control-group">
										<label class="control-label">Name</label>
										<div class="controls">
											<input type="text" class="span6" required="required"  name="name" readonly value='{{ $data->name }}' id="name" />
										</div>
									</div>
								@if($data->title_check)    
									<div class="control-group">
										<label class="control-label" for='title'>Title</label>
										<div class="controls">
											<input type="text" class="span6" required="required"  name="title" id="title" />
										</div>
									</div>
								@endif
								@if($data->brand_check)    
									<div class="control-group">
										<label class="control-label" for='title'>Brand Name</label>
										<div class="controls">
										  <select name='brand' class='span6'>
											<option>Brand 1</option>
											<option>Brand 2</option>
											<option>Brand 3</option>
										  </select>
										</div>
									</div>
								@endif	
								@if($data->sku_check)
									<div class="control-group">
										<label class="control-label">SKU</label>
										<div class="controls">
											<input type="text" class="span6" required="required"  name="sku" id="sku" onchange='checkSKU(this.value)' />
											<span class='sku_message'></span>
										</div>
									</div>
								@endif	
								@if($data->product_code_check)	
									<div class="control-group">
										<label class="control-label">Product Code</label>
										<div class="controls">
											<input type="text" class="span6" required="required"  name="product_code" readonly id="product_code" value='<?= time(); ?>' />
										</div>
									</div>
								@endif	
								@if($data->category_check)	
									<div class="control-group">
										<label class="control-label">Category</label>
										<div class="controls">
											<select  class="span6 searchable_class" required="required"  name="category" id="category"  ></select>
											
										</div>
									</div>
								@endif	
								@if($data->sub_category_check)	
									<div class="control-group">
										<label class="control-label">Sub Category</label>
										<div class="controls">
											<select class="span6 searchable_class" required="required"  name="sub_category" id="sub_category"  ></select>
											
										</div>
									</div>
								@endif	
								@if($data->unit_type_check)	
									<div class="control-group">
										<label class="control-label">Unit</label>
										<div class="controls"> 
										    <input type='text' class='span4' name='unit_quanitity' required>
											<select type="text" class="span2" required="required"  name="unit" id="unit">
											@foreach( explode(',',$data->unit_type_check_value_multi) as $un )
											  <option>{{ $un }}</option>
											@endforeach
											</select>
										</div>
									</div>
									
								@endif	
								@if($data->hsn_code_check)	
									
									<div class="control-group">
										<label class="control-label">HSN Code</label>
										<div class="controls">
											<input type="text" class="span6" required="required"  name="hsn_code" id="hsn_code"  />
										</div>
									</div>
								@endif
								@if($data->product_price_check)	
									
									<div class="control-group">
										<label class="control-label">Product Price</label>
										<div class="controls">
											<input type="text" class="span6" required="required"  name="product_price" id="product_price"  />
										</div>
									</div>
								@endif	
								
								@if($data->selling_price_check)	
									
									<div class="control-group">
										<label class="control-label">{{ $data->selling_price_label }}</label>
										<div class="controls">
											<input type="text" class="span6" required="required"  name="selling_price" id="selling_price"  />
											<input type="hidden" class="span6" required="required"  name="selling_price_label" value='{{ $data->selling_price_label }}' id="selling_price_label"  />
										</div>
									</div>
								@endif	
								@if($data->moq_check)	
									
									<div class="control-group">
										<label class="control-label">MOQ</label>
										<div class="controls">
											<input type="text" class="span6" required="required"  name="moq" id="moq"  />
										</div>
									</div>
								@endif
								
								@if($data->product_tax_check)	
									
									<div class="control-group">
										<label class="control-label">Product Tax</label>
										<div class="controls">
											<select type="text" class="span6" required="required"  name="product_tax" id="product_tax">
											  @foreach( explode(',',$data->product_tax_check_value) as $un )
											  <option>{{ $un }}</option>
											  @endforeach
											</select>
										</div>
									</div>
								@endif	
								@if($data->tax_method_check)	
									
									<div class="control-group">
										<label class="control-label">Tax Method</label>
										<div class="controls">
											<select type="text" class="span6" required="required"  name="tax_method" id="tax_method">
											  <option>Inclusive</option>
											  <option>Exclusive</option>
											</select>
										</div>
									</div>
								@endif	
								
								
								@if($data->cess_check)	
									
									<div class="control-group">
										<label class="control-label">Cess</label>
										<div class="controls">
											<select type="text" class="span6" required="required"  name="cess" id="cess">
											  @foreach( explode(',',$data->cess_check_value) as $un )
											  <option>{{ $un }}</option>
											  @endforeach
											</select>
										</div>
									</div>
								@endif	
								
								
								@if($data->description_check)	
									
									<div class="control-group">
										<label class="control-label">Description</label>
										<div class="controls">
											<textarea type="text" class="span6" required="required"  name="description" id="description" ></textarea>
										</div>
									</div>
								@endif	
								@if($data->status_check)	
									
									<div class="control-group">
										<label class="control-label">Status</label>
										<div class="controls">
											<select type="text" class="span6" required="required"  name="status" id="status">
											  <option>Active</option>
											  <option>Inactive</option>
											</select>
										</div>
									</div>
								@endif	
									
									<div class="control-group">
										<label class="control-label">Attribute</label>
										<div class="controls">
											
										</div>
									</div>
									
									
								@if($data->color_check)	
									<div class="control-group">
									    <label class="control-label">Color</label>
										<div class="controls color_div">
											@foreach( explode(',',$data->color_check_value_multi) as $un )
											  <label><input type='checkbox' value='{{ $un }}'><span style='background-color:{{ $un }};
    height: 16px;
    width: 16px;
    display: inline-block;'></span></label>
											  @endforeach
										</div>
									</div>
								@endif	
								@if($data->dimension_check)
									<div class="control-group">
									    <label class="control-label">Dimension</label>
										<div class="controls">
											<input type="text" class="span2" required="required"  name="height" id="height" placeholder='Height'>
											<input type="text" class="span2" required="required"  name="width" id="width" placeholder='Width'>
											<input type="text" class="span2" required="required"  name="length" id="length" placeholder='Length'>
											<select class='span2' name='dimension_unit' id='dimension_unit'>
											   @foreach( explode(',',$data->dimension_check_value) as $un )
											  <option>{{ $un }}</option>
											  @endforeach
											</select>
										</div>
									</div>
								@endif	
								@if($data->size_check)	
									<div class="control-group">
									    <label class="control-label">Size</label>
										<div class="controls">
											<select class='span2 searchable_class' name='size_check_value_option' id='size_check_value_option' >
											   @foreach( explode(',',$data->size_check_value_option) as $un )
											  <option>{{ $un }}</option>
											  @endforeach
											</select>
										</div>
									</div>
								@endif	
								@if($data->weight_check)	
									<div class="control-group">
									    <label class="control-label">Weight</label>
										<div class="controls">
											<input type="text" class="span2" required="required"  name="weight" id="weight" placeholder=''>
											<select class='span2' name='weight_unit' id='weight_unit'>
											   @foreach( explode(',',$data->weight_check_value) as $un )
											  <option>{{ $un }}</option>
											  @endforeach
											</select>
										</div>
									</div>
								@endif		
								@if($data->search_key_words_check)    
									<div class="control-group">
										<label class="control-label" for='txtInput'>Search Key Words</label>
										<div class="controls txtInput_div" id='divKeywords'>
											<input type="text" class="span6"    id="txtInput" />
											<input type='hidden' name='search_key_words' id='search_key_words'>
										</div>
									</div>
								@endif	
			
         </div>
      </div>
   </div>
</div>
@endsection
