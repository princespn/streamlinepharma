@extends('layouts.app')
@section('pageTitle')
<style>
.hide{
	display:none;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h4 class="page-title"> <i class="dripicons-list"></i>Add Advance Product </h4>
<input type="hidden" value="1" id="position">
<input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
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
		
		{!! Form::open(['url' => 'admin/upload_advance_product', 'files' => true]) !!}
		<div class="form-group">
			<label for="advance_product_file">Attach Excel:</label>
			<input type="file" id='advance_product_file' name='advance_product_file' class="form-control" placeholder="">
		</div>
		<input type='hidden' name='id' value='{{ $data->id }}'>
		<button type="submit" class="btn btn-primary">Upload</button>
		{!! Form::close() !!}
		<br>
		<hr style='border: 2px solid #1d1f44;background:#1d1f44;'>
		<br>
		{!! Form::open(['url' => 'admin/insert_advance_product', 'class' => '', 'files' => true]) !!}
		                     @if($data->grouping_name!=Null)
								 @foreach(json_decode($data->grouping_name,true)[0] as $kr=>$gr)
		                            <div class="form-check">
										<label class="form-check-label">
										  <input class="form-check-input" type="checkbox" @if(isset($pre_data)) @if(in_array($gr,explode(',',$pre_data->grouping_name))) checked @endif @endif name='grouping_name[]' value='{{ $gr }}' >{{ json_decode($data->grouping_name,true)[1][$kr] }}
										</label>
									</div>
									@endforeach
									<br>
							  @endif
                              @if($data->thumbnail_check)    
									<div class="control-group">
										<label class="control-label">Thumbnail</label>
										<div class="input-group">
											<input type="text" class="form-control"   name="thumbnail" id="imagethumbnail" @if(isset($pre_data)) value='{{ $pre_data->thumbnail }}' @endif @if(!in_array('thumbnail',$optional)) required  @endif  />
											<div class="input-group-prepend" onclick="openImagePopup('thumbnail')">
											  <span class="input-group-text"><i class="mdi mdi-file-image"></i></span>
											</div>
										</div>
									</div>
								@endif	
								@for($i=1;$i<=7;$i++)	
								   <?php $var = 'image'.$i.'_check';
									$pre_f = 'image'.$i;
									
									?>
								   @if($data->$var)
									<div class="control-group">
										<label class="control-label">Image {{ $i }}</label>
										
										<div class="input-group">
											<input type="text" class="form-control"   name="image{{ $i }}" id="imageimage{{ $i }}" @if(isset($pre_data)) value='{{ $pre_data->$pre_f }}' @endif @if(!in_array('image'.$i,$optional)) required  @endif  />
											<div class="input-group-prepend" onclick="openImagePopup('image{{ $i }}')" >
											  <span class="input-group-text"><i class="mdi mdi-file-image"></i></span>
											</div>
											
										</div>
									</div>
								   @endif
								@endfor
								@if($data->video_check)
									<div class="control-group">
										<label class="control-label">Video</label>
										<div class="input-group">
											<input type="text" class="form-control"   name="video" id="video"  @if(isset($pre_data)) value='{{ $pre_data->video }}' @endif @if(!in_array('video',$optional)) required  @endif  />
											<div class='input-group-prepend '>
											  
											</div>
										</div>
									</div>
								@endif
								@if($data->view_360_file_check)
									<div class="control-group">
										<label class="control-label">360 File <small>Only .glb files are accepted.</small></label>
										<div class="input-group">
											<input type="file" class="form-control"   name="view_360_file" id="view_360_file"  @if(isset($pre_data)) value='{{ $pre_data->view_360_file }}' @endif @if(!in_array('view_360_file',$optional)) required  @endif  />
											<div class='input-group-prepend '>
											  
											</div>
										</div>
									</div>
								@endif
									<div class="control-group">
										<label class="control-label">Name</label>
										<div class="controls">
											<input type="text" class="form-control"   name="name" readonly value='{{ $data->name }}' id="name" @if(!in_array('name',$optional)) required  @endif  />
										</div>
									</div>
								
							
								
								@if($data->title_check)    
									<div class="control-group">
										<label class="control-label" for='title'>Title</label>
										<div class="controls">
											<input type="text" class="form-control"   name="title" id="title" @if(isset($pre_data)) value='{{ $pre_data->title }}' @endif @if(!in_array('title',$optional)) required  @endif  />
										</div>
									</div>
								@endif
								@if($data->brand_check)    
									<div class="control-group">
										<label class="control-label" for='title'>Brand Name</label>
										<div class="controls">
										  <select name='brand' class='form-control' @if(!in_array('brand',$optional)) required  @endif >
										  @foreach($brand as $b_row)
											<option @if(isset($pre_data)&&$pre_data->brand==$b_row->id) selected @endif value='{{ $b_row->id }}'>{{ $b_row->name }}</option>
										  @endforeach
										  </select>
										</div>
									</div>
								@endif	
								@if($data->sku_check)
									<div class="control-group">
										<label class="control-label">SKU</label>
										<div class="input-group">
											<input type="text" class="form-control"   name="sku" id="sku" onchange='checkSKU(this.value)' @if(isset($pre_data)) value='{{ $pre_data->sku }}' @endif @if(!in_array('sku',$optional)) required  @endif  />
											<div class='input-group-prepend '>
											  <span class='input-group-text sku_message'></span>
											</div>
										</div>
									</div>
								@endif	
								@if($data->product_code_check)	
									<div class="control-group">
										<label class="control-label">Product Code</label>
										<div class="controls">
											<input type="text" class="form-control"   name="product_code" readonly id="product_code" @if(isset($pre_data)) value='{{ $pre_data->product_code }}' @else value='<?= time(); ?>' @endif @if(!in_array('product_code',$optional)) required  @endif  />
										</div>
									</div>
								@endif	
									
								@if($data->unit_type_check)	
									<div class="control-group">
										<label class="control-label">Unit</label>
										<div class="input-group"> 
										    <input type='text' class='form-control' name='unit_quanitity' required @if(!in_array('unit_quanitity',$optional)) required  @endif @if(isset($pre_data)) value='{{ $pre_data->unit_quanitity }}' @endif>
											<select type="text" class="form-control" @if(!in_array('unit',$optional)) required  @endif   name="unit" id="unit">
											@foreach( explode(',',$data->unit_type_check_value_multi) as $un )
											  <option @if(isset($pre_data)&&$pre_data->unit==$un) selected @endif>{{ $un }}</option>
											@endforeach
											</select>
										</div>
									</div>
									
								@endif	
								@if($data->hsn_code_check)	
									
									<div class="control-group">
										<label class="control-label">HSN Code</label>
										<div class="controls">
											<input type="text" class="form-control"   name="hsn_code" id="hsn_code" @if(isset($pre_data)) value='{{ $pre_data->hsn_code }}' @endif  @if(!in_array('hsn_code',$optional)) required  @endif  />
										</div>
									</div>
								@endif
								@if($data->product_price_check)	
									
									<div class="control-group">
										<label class="control-label">Product Price</label>
										<div class="controls">
											<input type="text" class="form-control"   name="product_price" id="product_price" @if(isset($pre_data)) value='{{ $pre_data->product_price }}' @endif  @if(!in_array('product_price',$optional)) required  @endif  />
										</div>
									</div>
								@endif	
								
								@if($data->selling_price_check)	
									
									<div class="control-group">
										<label class="control-label">{{ $data->selling_price_label }}</label>
										<div class="controls">
											<input type="text" class="form-control"   name="selling_price" id="selling_price"  @if(isset($pre_data)) value='{{ $pre_data->selling_price }}' @endif  @if(!in_array('selling_price',$optional)) required  @endif  />
											<input type="hidden" class="form-control"   name="selling_price_label" value='{{ $data->selling_price_label }}' id="selling_price_label"  />
										</div>
									</div>
								@endif	
								@if($data->moq_check)	
									
									<div class="control-group">
										<label class="control-label">MOQ</label>
										<div class="controls">
											<input type="text" class="form-control"   name="moq" id="moq" @if(isset($pre_data)) value='{{ $pre_data->moq }}' @endif  @if(!in_array('moq',$optional)) required  @endif  />
										</div>
									</div>
								@endif
								
								@if($data->product_tax_check)	
									
									<div class="control-group">
										<label class="control-label">Product Tax</label>
										<div class="controls">
											<!--
											<select type="text" class="form-control"   name="product_tax" id="product_tax" @if(!in_array('product_tax',$optional)) required  @endif>
											  @foreach( explode(',',$data->product_tax_check_value) as $un )
											  <option @if(isset($pre_data)&&$pre_data->product_tax==$un) selected @endif>{{ $un }}</option>
											  @endforeach
											</select> -->
											<input type="number" name="product_tax" id="product_tax" class="form-control" @if(isset($pre_data)) value="{{ $pre_data->product_tax }}" @endif >
										</div>
									</div>
								@endif	
								@if($data->tax_method_check)	
									
									<div class="control-group">
										<label class="control-label">Tax Method</label>
										<div class="controls">
											<select type="text" class="form-control"   name="tax_method" id="tax_method"@if(!in_array('tax_method',$optional)) required  @endif>
											  <option @if(isset($pre_data)&&$pre_data->tax_method=='Inclusive') selected @endif>Inclusive</option>
											  <option @if(isset($pre_data)&&$pre_data->tax_method=='Exclusive') selected @endif>Exclusive</option>
											</select>
										</div>
									</div>
								@endif	
								
								
								@if($data->cess_check)	
									
									<div class="control-group">
										<label class="control-label">Cess</label>
										<div class="controls">
											<select type="text" class="form-control"   name="cess" id="cess" @if(!in_array('cess',$optional)) required  @endif>
											  @foreach( explode(',',$data->cess_check_value) as $un )
											  <option @if(isset($pre_data)&&$pre_data->cess==$un) selected @endif>{{ $un }}</option>
											  @endforeach
											</select>
										</div>
									</div>
								@endif	
								
								
								@if($data->description_check)	
									
									<div class="control-group">
										<label class="control-label">Description</label>
										<div class="controls">
											<textarea type="text" class="form-control"   name="description" id="description"  @if(!in_array('description',$optional)) required  @endif>@if(isset($pre_data)) {{ $pre_data->description }} @endif</textarea>
										</div>
									</div>
								@endif	
								@if($data->status_check)	
									
									<div class="control-group">
										<label class="control-label">Status</label>
										<div class="controls">
											<select type="text" class="form-control"   name="status" id="status1" @if(!in_array('status',$optional)) required  @endif>
											  <option @if(isset($pre_data)&&$pre_data->status=='Active') selected @endif>Active</option>
											  <option @if(isset($pre_data)&&$pre_data->status=='Inactive') selected @endif>Inactive</option>
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
										<div class="controls">
											<select class='form-control' name='color' id='color' @if(!in_array('color',$optional)) required  @endif>
											@foreach($all_color as $color)
											  <option  @if(isset($pre_data)&&$pre_data->color==$color) selected @endif>{{ $color }}</option>
											@endforeach
											</select>
										</div>
									</div>
								@endif	
								@if($data->dimension_check)
									<div class="control-group">
									    <label class="control-label">Dimension</label>
										<div class="input-group">
											<input type="text" class="form-control"   name="height" id="height" placeholder='Height' @if(isset($pre_data)) value='{{ $pre_data->height }}' @endif @if(!in_array('height',$optional)) required  @endif>
											<input type="text" class="form-control"   name="width" id="width" placeholder='Width' @if(isset($pre_data)) value='{{ $pre_data->width }}' @endif @if(!in_array('width',$optional)) required  @endif>
											<input type="text" class="form-control"   name="length" id="length" placeholder='Length' @if(isset($pre_data)) value='{{ $pre_data->length }}' @endif @if(!in_array('length',$optional)) required  @endif>
											<select class='form-control' name='dimension_unit' id='dimension_unit'>
											  <option>CM</option>
											</select>
										</div>
									</div>
								@endif	
								@if($data->size_check)	
									<div class="control-group">
									    <label class="control-label">Size</label>
										<div class="controls">
											<select class='form-control searchable_class' name='size_check_value_option' id='size_check_value_option' @if(!in_array('size_check_value_option',$optional)) required  @endif >
											   @foreach( explode(',',$data->size_check_value_option) as $un )
											  <option  @if(isset($pre_data)&&$pre_data->size==$un) selected @endif>{{ $un }}</option>
											  @endforeach
											</select>
										</div>
									</div>
								@endif	
								@if($data->weight_check)	
									<div class="control-group">
									    <label class="control-label">Weight</label>
										<div class="input-group">
											<input type="text" class="form-control"   name="weight" id="weight" placeholder='' @if(isset($pre_data)) value='{{ $pre_data->weight }}' @endif @if(!in_array('weight',$optional)) required  @endif>
											<select class='form-control' name='weight_unit' id='weight_unit'>
											   <option>KG</option>
											</select>
										</div>
									</div>
								@endif		
								
							@for($num=1;$num<6;$num++)
                            @php  
						    $pre_keyword = [];
							if(isset($pre_data)&&$pre_data->search_key_words!=NULL){
								$pre_keyword = explode(',',$pre_data->search_key_words);
								//echo //count($pre_keyword);print_r($pre_keyword);exit;
							}
							@endphp
								@if($data->search_key_words_check)    
									<div class="control-group">
										<label class="control-label" for='txtInput'>Search Key Words {{ $num }}</label>
										
											<input type="text" class="form-control"     name='search_key_words[]' @if(isset($pre_data)&& count($pre_keyword)>=$num ) value='{{ $pre_keyword[($num-1)] }}' @endif />
											
										
									</div>
								@endif	
								@endfor	
									
									
									
									<div class="control-group">
										<label class="control-label">Return</label>
										<div class="controls">
											<select type="text" class="form-control"   name="is_return" id="is_return" onclick="if(this.value=='Yes'){$('.return_div').removeClass('hide');}else{$('.return_div').addClass('hide');}">
											  <option @if(isset($pre_data)&&$pre_data->is_return=='No') selected @endif>No</option>
											  <option @if(isset($pre_data)&&$pre_data->is_return=='Yes') selected @endif>Yes</option>
											</select>
										</div>
									</div>
									
									<div class="control-group return_div @if(isset($pre_data)&&$pre_data->is_return=='Yes')  @else hide @endif">
										<label class="control-label">Return Days</label>
										<div class="controls">
											<input type='number' class='form-control' name='return_days' id='return_days' @if(isset($pre_data)) value='{{ $pre_data->return_days }}' @endif>
										</div>
									</div>
									
									<div class="control-group return_div @if(isset($pre_data)&&$pre_data->is_return=='Yes')  @else hide @endif">
										<label class="control-label">Return T&#38;C</label>
										<div class="controls">
											<textarea class='form-control'  name='return_terms' id='return_terms'>@if(isset($pre_data)) {{ $pre_data->return_terms }} @endif</textarea>
										</div>
									</div>
									
									
									
									<div class="control-group">
										<label class="control-label">Replace</label>
										<div class="controls">
											<select type="text" class="form-control"   name="is_replace" id="is_replace" onclick="if(this.value=='Yes'){$('.replace_div').removeClass('hide');}else{$('.replace_div').addClass('hide');}">
											  <option  @if(isset($pre_data)&&$pre_data->is_replace=='No') selected @endif>No</option>
											  <option  @if(isset($pre_data)&&$pre_data->is_replace=='Yes') selected @endif>Yes</option>
											</select>
										</div>
									</div>
									
									<div class="control-group replace_div @if(isset($pre_data)&&$pre_data->is_replace=='Yes')  @else hide @endif">
										<label class="control-label">Replace Days</label>
										<div class="controls">
											<input type='number' class='form-control' name="replace_days" id="replace_days" @if(isset($pre_data)) value='{{ $pre_data->replace_days }}' @endif>
										</div>
									</div>
									
									<div class="control-group replace_div @if(isset($pre_data)&&$pre_data->is_replace=='Yes')  @else hide @endif">
										<label class="control-label">Replace T&#38;C</label>
										<div class="controls">
											<textarea class='form-control'  name="replace_terms" id="replace_terms">@if(isset($pre_data)) {{ $pre_data->replace_terms }} @endif</textarea>
										</div>
									</div>
								
                                    

								    <div class="control-group">
										<label class="control-label">Shipping Method</label>
										<div class="controls">
											<select type="text" class="form-control"    name="shipping_method" id="shipping_method">
											  <option  @if(isset($pre_data)&&$pre_data->shipping_method=='Inclusive') selected @endif>Inclusive</option>
											  <option  @if(isset($pre_data)&&$pre_data->shipping_method=='Exclusive') selected @endif>Exclusive</option>
											</select>
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label">Affiliation</label>
										<div class="controls">
											<select type="text" class="form-control"   name="is_affiliation" id="is_affiliation" onchange="if(this.value=='Yes'){$('.affiliation_div').removeClass('hide');}else{$('.affiliation_div').addClass('hide');}">
											  <option  @if(isset($pre_data)&&$pre_data->is_affiliation=='No') selected @endif>No</option>
											  <option  @if(isset($pre_data)&&$pre_data->is_affiliation=='Yes') selected @endif>Yes</option>
											</select>
										</div>
									</div>
									
									<div class="control-group affiliation_div @if(isset($pre_data)&&$pre_data->is_affiliation=='Yes')  @else hide @endif">
										<label class="control-label">Affiliation Price</label>
										<div class="controls">
											<input type='number' class='form-control' name="affiliation_price" id="affiliation_price" @if(isset($pre_data)) value='{{ $pre_data->affiliation_price }}' @endif>
										</div>
									</div>

									<div class="control-group affiliation_div @if(isset($pre_data)&&$pre_data->is_affiliation=='Yes')  @else hide @endif">
										<label class="control-label">Affiliate Payment release on Online Payment</label>
										<div class="controls">
										<select type="text" class="form-control"   name="affiliation_payment_release_online" id="affiliation_payment_release_online" >
										        <option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='On Order recieved') selected @endif>On Order recieved</option>
												<option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='On Payment Received') selected @endif>On Payment Received</option>
												<option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='On Return period complition') selected @endif>On Return period complition</option>
												<option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='On Return pick up') selected @endif>On Return pick up</option> 
												<option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='On Return good recieved') selected @endif>On Return good recieved</option>
												<option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_online=='>On Return good audit') selected @endif>On Return good audit</option>
											</select>
										</div>
									</div>

									<div class="control-group affiliation_div @if(isset($pre_data)&&$pre_data->is_affiliation=='Yes')  @else hide @endif">
										<label class="control-label">Affiliate Payment release on For COD </label>
										<div class="controls">
										<select type="text" class="form-control"   name="affiliation_payment_release_cod" id="affiliation_payment_release_cod" >
										       <option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='On Order recieved') selected @endif>On Order recieved</option>
												<option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='On Payment Received') selected @endif>On Payment Received</option>
												<option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='On Return period complition') selected @endif>On Return period complition</option>
												<option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='On Return pick up') selected @endif>On Return pick up</option> 
												<option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='On Return good recieved') selected @endif>On Return good recieved</option>
												<option @if(isset($pre_data)&&$pre_data->affiliation_payment_release_cod=='>On Return good audit') selected @endif>On Return good audit</option>
											</select>
										</div>
									</div>
									
									
									<div class="control-group">
										<label class="control-label">COD Available</label>
										<div class="controls">
											<select type="text" class="form-control"   name="is_cod_available" id="is_cod_available">
											  <option  @if(isset($pre_data)&&$pre_data->is_cod_available=='Yes') selected @endif>Yes</option>
											  <option  @if(isset($pre_data)&&$pre_data->is_cod_available=='No') selected @endif>No</option>
											</select>
										</div>
									</div>
									
									
								@if($data->additional_attribute!=Null&&count(json_decode($data->additional_attribute)))	<div class="control-group">
										<label class="control-label">Addional Attribute</label>
										<div class="controls">
											
										</div>
									</div>
								@php $i=1; @endphp
								@foreach( json_decode($data->additional_attribute)[0] as $key=>$row)
								    <div class="control-group">
									    <label class="control-label">{{ $row }}</label>
										<div class="controls">
									    <input type='hidden' value='{{ $row }}' name='attribute[]'>
										<input type='hidden' value='{{ json_decode($data->additional_attribute)[1][$key] }}' name='attribute_option[]'>
									   @if(json_decode($data->additional_attribute)[1][$key]=='Checkboxes')
											<select name='attr_checkbox_{{ $key }}[]' id="multi_drop_id{{ $key }}" multiple="multiple" class="form-control position" @if(!in_array('addiotioanl'.$i,$optional)) required  @endif onchange="$('#attr_checkbox_{{ $key }}').val($('#multi_drop_id{{ $key }}').val());">
											
											
											@foreach(explode(',',json_decode($data->additional_attribute)[2][$key]) as $opt)
											<!--<input type='checkbox' @if(!in_array('addiotioanl'.$i,$optional)) required  @endif value='{{ $opt }}' name='attr_checkbox_{{ $key }}' onchange='checkBoxToInput("attr_checkbox_{{ $key }}")' @if(isset($pre_data)&& (count($pre_data->json[0])==count(json_decode($data->additional_attribute)[0])) && in_array($opt,explode(',',$pre_data->json[2][$key])) )   checked @endif> -->
											
												<option @if(isset($pre_data)&& (count($pre_data->json[0])==count(json_decode($data->additional_attribute)[0])) && in_array($opt,explode(',',$pre_data->json[2][$key])) )   selected @endif> {{ $opt }}</option>
											
										    @endforeach
											</select>
											<input type='hidden' value='' id='attr_checkbox_{{ $key }}'  name='attribute_value[]'>
										@else
											<select name='attribute_value[]' @if(!in_array('addiotioanl'.$i,$optional)) required  @endif>									    @foreach(explode(',',json_decode($data->additional_attribute)[2][$key]) as $opt)
											<option  @if(isset($pre_data)&& (count($pre_data->json[0])==count(json_decode($data->additional_attribute)[0])) && $pre_data->json[2][$key] ==$opt )   selected @endif>{{ $opt }}</option>
										    @endforeach
										    </select>
										@endif
										</div>
									</div>
								@php $i++; @endphp
								@endforeach
								@endif	
									
									
									
									
									
									
									<div class="form-actions" style='text-align:center;margin-top:40px'>
									    <input type='hidden' class='product_id' name='product_id' value='{{ $data->id }}'>
										@if(isset($pre_data))  
										<input type='hidden' name='pre_product_id' value='{{ $pre_data->id }}'>
										@endif
										<input type='hidden' value='{{ $menu->category }}' name="category">
									    <input type='hidden' value='{{ $menu->sub_category }}' name="sub_category">
									    <input type='hidden' value='{{ $menu->id }}' name="dynamic_menu">
										<input type="submit" class="btn btn-outline-success" value="@if(isset($pre_data)) Update @else Add @endif  Advance Product Profile">
									</div>
				{!! Form::close() !!}
			
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
                        
                            @foreach ($imageUploadList as $key=>$image)
                                
                                @if($image->mediaType == 1)
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="openFolder('{{$image->id}}')">
                                        <img src="http://ecommerce.uniqueandcommon.com/assets/images/folder.png" class="img-thumbnail">
                                        <h6 class="users_name">{{$image->title}}</h6>
                                    </li>
                                @else
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl('{{$image->name}}')">
                                        <img src="{{URL::asset($image->name)}}" class="img-thumbnail" >
                                        <h6 class="users_name">{{$image->title}}</h6>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection
@section('css')
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
@stop
@section('script')
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
			  url: "{{ url('admin/checkSKU') }}",
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
   @if($data->view_360_file_check)
    $(document).ready( function (){
		$("#view_360_file").change(function () {
			var fileExtension = ['glb'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				alert("Only formats are allowed : "+fileExtension.join(', '));
				$(this).val('');
			}
		});
    });
   @endif
</script>
@stop