@extends('layouts.app')
@section('pageTitle')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h4 class="page-title"> <i class="dripicons-list"></i> Advance Product Template</h4>

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
		 @if (session('error'))
			<div class="alert alert-danger">
				{{ session('error') }}
			</div>
		 @endif
		{!! Form::open(['url' => 'admin/advance_product_template', 'class' => 'form-inline']) !!}
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
                     <td><input type="text" class="form-control" required="required"  name="name" id="name" @if(isset($data)) value='{{ $data->name }}' @endif  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='name' @if(isset($data)&& in_array('name',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='name' @if(isset($data)&& in_array('name',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='name_hint'>@if(isset($hints)) {{ $hints->name_hint }} @endif</textarea>
					 </td>
                  </tr>
                  
                  <tr>
                     <td>Title</td>
                     <td><input type="checkbox" class="form-control"   name="title_check" id="title_check" @if(isset($data)&&$data->title_check==1) checked @endif  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='title' @if(isset($data)&& in_array('title',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='title' @if(isset($data)&& in_array('title',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='title_hint'>@if(isset($hints)) {{ $hints->title_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Brand Name</td>
                     <td><input type="checkbox" class="form-control"   name="brand_check" id="brand_check" @if(isset($data)&&$data->brand_check==1) checked @endif  /></td>
                     <td><input type="checkbox" class="form-control"   name="brand_filter" id="brand_check" @if(isset($data)&&$data->brand_filter==1) checked @endif   /></td>
                     <td><input type='checkbox' name='isOptional[]' value='brand' @if(isset($data)&& in_array('brand',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='brand' @if(isset($data)&& in_array('brand',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='brand_hint'>@if(isset($hints)) {{ $hints->brand_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Thumbnail</td>
                     <td><input type="checkbox" class="form-control"   name="thumbnail_check" id="thumbnail_check" @if(isset($data)&&$data->thumbnail_check==1) checked @endif  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='thumbnail' @if(isset($data)&& in_array('thumbnail',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='thumbnail' @if(isset($data)&& in_array('thumbnail',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='thumbnail_hint'>@if(isset($hints)) {{ $hints->thumbnail_hint }} @endif</textarea>
					 </td>
                  </tr>
				@for($i=1;$i<8;$i++)
					@php 
				      $var = 'image'.$i.'_check';
				      $tvar = 'image'.$i.'_hint';
					 @endphp
                  <tr>
                     <td>Image {{ $i }}</td>
                     <td><input type="checkbox" class="form-control"   name="image{{ $i }}_check" id="thumbnail1_check" @if(isset($data)&&$data->$var==1) checked @endif /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='image{{ $i }}' @if(isset($data)&& in_array('image'.$i,$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='image{{ $i }}' @if(isset($data)&& in_array('image'.$i,$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='image{{ $i }}_hint'>@if(isset($hints)) {{ $hints->$tvar }} @endif</textarea>
					 </td>
                  </tr>
				 @endfor
                  <tr>
                     <td>Video</td>
                     <td><input type="checkbox" class="form-control"   name="video_check" id="video_check" @if(isset($data)&&$data->video_check==1) checked @endif  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='video' @if(isset($data)&& in_array('video',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='video' @if(isset($data)&& in_array('video',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='title_hint'>@if(isset($hints)) {{ $hints->video_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>360 File</td>
                     <td><input type="checkbox" class="form-control"   name="view_360_file_check" id="view_360_file_check" @if(isset($data)&&$data->view_360_file_check==1) checked @endif  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='view_360_file' @if(isset($data)&& in_array('view_360_file',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='view_360_file' @if(isset($data)&& in_array('view_360_file',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='title_hint'>@if(isset($hints)) {{ $hints->view_360_file_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>SKU</td>
                     <td><input type="checkbox" class="form-control"   name="sku_check" id="sku_check" @if(isset($data)&&$data->sku_check==1) checked @endif  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='sku' @if(isset($data)&& in_array('sku',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='sku' @if(isset($data)&& in_array('sku',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='sku_hint'>@if(isset($hints)) {{ $hints->sku_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Product Code</td>
                     <td><input type="checkbox" class="form-control"   name="product_code_check" id="product_code_check"  @if(isset($data)&&$data->product_code_check==1) checked @endif  /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='product_code' @if(isset($data)&& in_array('product_code',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='product_code' @if(isset($data)&& in_array('product_code',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='product_code_hint'>@if(isset($hints)) {{ $hints->product_code_hint }} @endif</textarea>
					 </td>
                  </tr>
                  
                  <tr>
                     <td>Unit</td>
                     <td><input type="checkbox" class="form-control"   name="unit_type_check" id="unit_type_check" @if(isset($data)&&$data->unit_type_check==1) checked @endif >
                        <textarea  class="form-control"  name="unit_type_check_value_multi" id="unit_type_check_value_multi" placeholder='Comma Seprated Unit Value'>@if(isset($data)){{ $data->unit_type_check_value_multi }}@endif</textarea>
                     </td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='unit' @if(isset($data)&& in_array('unit',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='unit' @if(isset($data)&& in_array('unit',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='unit_hint'>@if(isset($hints)) {{ $hints->unit_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>HSN Code</td>
                     <td><input type="checkbox" class="form-control"   name="hsn_code_check" id="hsn_code_check" @if(isset($data)&&$data->hsn_code_check==1) checked @endif   /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='hsn_code' @if(isset($data)&& in_array('hsn_code',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='hsn_code' @if(isset($data)&& in_array('hsn_code',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='hsn_code_hint'>@if(isset($hints)) {{ $hints->hsn_code_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Product Price</td>
                     <td><input type="checkbox" class="form-control"   name="product_price_check" id="product_price_check" @if(isset($data)&&$data->product_price_check==1) checked @endif   /></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='product_price' @if(isset($data)&& in_array('product_price',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='product_price'  @if(isset($data)&& in_array('product_price',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='product_price_hint'>@if(isset($hints)) {{ $hints->product_price_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Selling Price</td>
                     <td><input type="checkbox" class="form-control"   name="selling_price_check" id="selling_price_check" @if(isset($data)&&$data->selling_price_check==1) checked @endif   />
                        <input type='text' class="form-control" placeholder='Selling Price Field Name' name='selling_price_label' @if(isset($data)) value='{{ $data->selling_price_label }}' @endif>
                     </td>
                     <td><input type="checkbox" class="form-control"   name="selling_price_filter" id="selling_price_filter"  /></td>
                     <td><input type='checkbox' name='isOptional[]' value='selling_price' @if(isset($data)&& in_array('selling_price',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='selling_price' @if(isset($data)&& in_array('selling_price',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='selling_price_hint'>@if(isset($hints)) {{ $hints->selling_price_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>MOQ</td>
                     <td><input type="checkbox" class="form-control"   name="moq_check" id="moq_check" @if(isset($data)&&$data->moq_check==1) checked @endif   /></td>
                     <td><input type="checkbox" class="form-control"   name="moq_filter" id="moq_filter" @if(isset($data)&&$data->moq_filter==1) checked @endif  /></td>
                     <td><input type='checkbox' name='isOptional[]' value='moq' @if(isset($data)&& in_array('moq',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='moq' @if(isset($data)&& in_array('moq',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='moq_hint'>@if(isset($hints)) {{ $hints->moq_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Product Tax</td>
                     <td><input type="checkbox" class="form-control"   name="product_tax_check" id="product_tax_check" @if(isset($data)&&$data->product_tax_check==1) checked @endif >
                        <!--input type='text' class='form-control' value='' name='product_tax_check_value' id='product_tax_check_value' placeholder='Product Tax Value' @if(isset($data)) value='{{ $data->product_tax_check_value }}' @endif -->
                     </td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='product_tax' @if(isset($data)&& in_array('product_tax',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='product_tax' @if(isset($data)&& in_array('product_tax',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='product_tax_hint'>@if(isset($hints)) {{ $hints->product_tax_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Tax Method</td>
                     <td><input type="checkbox" class="form-control"   name="tax_method_check" id="tax_method_check" @if(isset($data)&&$data->tax_method_check==1) checked @endif ></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='tax_method' @if(isset($data)&& in_array('tax_method',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='tax_method' @if(isset($data)&& in_array('tax_method',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='tax_method_hint'>@if(isset($hints)) {{ $hints->tax_method_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Cess</td>
                     <td><input type="checkbox" class="form-control"   name="cess_check" id="cess_check" @if(isset($data)&&$data->cess_check==1) checked @endif>
                        <!--input type='text' class='form-control' value='' name='cess_check_value' id='cess_check_value' placeholder='Product Tax Value' @if(isset($data)) value='{{ $data->cess_check_value }}' @endif -->
                     </td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='cess' @if(isset($data)&& in_array('cess',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='cess' @if(isset($data)&& in_array('cess',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='cess_hint'>@if(isset($hints)) {{ $hints->cess_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Description</td>
                     <td><input type="checkbox" class="form-control"   name="description_check" id="description_check" @if(isset($data)&&$data->description_check==1) checked @endif></td>
                     <td></td>
                     <td><input type='checkbox' name='isOptional[]' value='description' @if(isset($data)&& in_array('description',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='description' @if(isset($data)&& in_array('description',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='description_hint'>@if(isset($hints)) {{ $hints->description_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Status</td>
                     <td><input type="checkbox" class="form-control"  name="status_check" id="status_check" @if(isset($data)&&$data->status_check==1) checked @endif ></td>
                     <td><input type="checkbox" class="form-control"   name="status_filter" id="status_filter" @if(isset($data)&&$data->status_filter==1) checked @endif  /></td>
                     <td></td>
                     <td></td>
					 <td>
					    <textarea class='form-control' name='status_hint'>@if(isset($hints)) {{ $hints->status_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <th colspan='3'>Attribute</th>
                  </tr>
                  <tr>
                     <td>Color</td>
                     <td>
                        <input type="checkbox" class="span1"   name="color_check" @if(isset($data)&&$data->color_check==1) checked @endif >
                        <select class='form-control' name='color_check_value' onchange="$('#color_btn_add').toggle();">
                           <option @if(isset($data)&&$data->color_check_value=='Single') selected @endif >Single</option>
                           <option @if(isset($data)&&$data->color_check_value=='Multiple') selected @endif >Multiple</option>
                        </select>
                        
                     </td>
                     <td><input type="checkbox" class="form-control"   name="color_filter" id="color_filter" @if(isset($data)&&$data->color_filter==1) checked @endif  /></td>
                     <td><input type='checkbox' name='isOptional[]' value='color' @if(isset($data)&& in_array('color',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='color' @if(isset($data)&& in_array('color',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='color_hint'>@if(isset($hints)) {{ $hints->color_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Dimension</td>
                     <td><input type="checkbox" class="form-control"  name="dimension_check" id="dimension_check" placeholder='Height' @if(isset($data)&&$data->dimension_check==1) checked @endif>
                        
                     </td>
                     <td><input type="checkbox" class="form-control"   name="dimension_filter" id="dimension_filter" @if(isset($data)&&$data->dimension_filter==1) checked @endif  /></td>
                     <td><input type='checkbox' name='isOptional[]' value='dimension' @if(isset($data)&& in_array('dimension',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='dimension' @if(isset($data)&& in_array('dimension',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='dimension_hint'>@if(isset($hints)) {{ $hints->dimension_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Size</td>
                     <td>
                        <input type="checkbox" class="form-control"  name="size_check" id="size_check" placeholder='' @if(isset($data)&&$data->size_check==1) checked @endif >
                        <select class='form-control' onchange="changeAttribute(this.value,'size_value')" name='size_check_value' id='size_check_value'>
                           <option @if(isset($data)&&$data->size_check_value=='Single') selected @endif >Single</option>
                           <option @if(isset($data)&&$data->size_check_value=='Single') selected @endif >Multiple</option>
                        </select>
                        <textarea  class="form-control"   name="size_check_value_option" id="size_check_value_option" placeholder='Value'>@if(isset($data)){{ $data->size_check_value_option }}@endif</textarea>
                     </td>
                     <td><input type="checkbox" class="form-control"   name="size_filter" id="size_filter" @if(isset($data)&&$data->size_filter==1) checked @endif /></td>
                     <td><input type='checkbox' name='isOptional[]' value='size' @if(isset($data)&& in_array('size',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='size' @if(isset($data)&& in_array('size',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='size_hint'>@if(isset($hints)) {{ $hints->size_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Weight</td>
                     <td><input type="checkbox" class="form-control"   name="weight_check" id="weight_check" placeholder='' @if(isset($data)&&$data->weight_check==1) checked @endif >
                        
                     </td>
                     <td><input type="checkbox" class="form-control"   name="weight_filter" id="weight_filter" @if(isset($data)&&$data->weight_filter==1) checked @endif  /></td>
                     <td><input type='checkbox' name='isOptional[]' value='weight' @if(isset($data)&& in_array('weight',$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='weight' @if(isset($data)&& in_array('weight',$grouping) ) checked @endif></td>
					 <td>
					    <textarea class='form-control' name='weight_hint'>@if(isset($hints)) {{ $hints->weight_hint }} @endif</textarea>
					 </td>
                  </tr>
                  <tr>
                     <td>Search Key Words</td>
                     <td><input type="checkbox" class="form-control"   name="search_key_words_check" id="search_key_words_check" @if(isset($data)&&$data->search_key_words_check==1) checked @endif  /></td>
                     <td><input type="checkbox" class="form-control"   name="search_key_words_filter" id="search_key_words_filter" @if(isset($data)&&$data->search_key_words_filter==1) checked @endif  /></td>
                     <td></td>
                     <td></td>
					 <td>
					    <textarea class='form-control' name='search_key_words_hint'>@if(isset($hints)) {{ $hints->search_key_words_hint }} @endif</textarea>
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
			   @php $i=1; @endphp
			   @if(isset($data)&&$data->additional_attribute!=Null&&count($additional_attribute))
				   
				   @foreach($additional_attribute[0] as $key=>$row)
			         
			         <tr>
                     <td>
					     <input type='text' class='form-control atr{{ $i }}' placeholder='Attribute Name' name='additional_attribute[]'  value='{{ $row }}'>
					     <input type="checkbox" class="form-control"  name="size_check" id="attr_check{{ $i }}" placeholder='' onchange='if($("#attr_check{{ $i }}").prop("checked",true)){  $(".atr{{ $i }}").removeAttr("disabled"); }else{ $(".atr{{ $i }}").attr("disabled","disabled"); }' checked>
					 </td>
                     <td>
					     <select class='form-control  atr{{ $i }}' onchange="changeAttribute(this.value,'size_value')" name='additional_attribute_option[]' id='additional_attribute_option' >
											   <option @if($additional_attribute[1][$key]=='Checkboxes') selected @endif>Checkboxes</option>
											   <option @if($additional_attribute[1][$key]=='Dropdown') selected @endif>Dropdown</option>
											</select>
					 </td>
                     <td>
					     <textarea  class="form-control  atr{{ $i }}"   name="additional_attribute_value[]" id="additional_attribute_value" placeholder='Value'  >{{ $additional_attribute[2][$key] }}</textarea>
					 </td>
                     <td><input type='checkbox' name='isOptional[]' value='addiotioanl{{ $i }}' @if(isset($data)&& in_array('addiotioanl'.$i,$optional) ) checked @endif></td>
                     <td><input type='checkbox' name='grouping[]' value='addiotioanl{{ $i }}' @if(isset($data)&& in_array('addiotioanl'.$i,$grouping) ) checked @endif></td>
                  </tr>
				   @php $i++; @endphp
			       @endforeach
			   @endif
			      @for($i=$i;$i<=20;$i++)
					 <tr>
                     <td>
					     <input type='text' class='form-control atr{{ $i }}' placeholder='Attribute Name {{ $i }}' name='additional_attribute[]'  disabled>
					     <input type="checkbox" class="form-control"  name="size_check" id="attr_check{{ $i }}" placeholder='' onchange='if(document.getElementById("attr_check{{ $i }}").checked==true){  $(".atr{{ $i }}").removeAttr("disabled"); }else{ $(".atr{{ $i }}").attr("disabled","disabled"); }' >
					 </td>
                     <td>
					     <select class='form-control  atr{{ $i }}' onchange="changeAttribute(this.value,'size_value')" name='additional_attribute_option[]' id='additional_attribute_option'  disabled>
											   <option>Checkboxes</option>
											   <option>Dropdown</option>
											</select>
					 </td>
                     <td>
					     <textarea  class="form-control  atr{{ $i }}"   name="additional_attribute_value[]" id="additional_attribute_value" placeholder='Value' disabled></textarea>
					 </td>
                     <td><input type='checkbox' name='isOptional[]' value='addiotioanl{{ $i }}'></td>
                     <td><input type='checkbox' name='grouping[]' value='addiotioanl{{ $i }}'></td>
                  </tr> 
				  @endfor
				  
               </tbody> 
			   <tfoot>
			      <tr>
                     <td colspan='4'>
					   @if(isset($data))
						   <input type='hidden' value='{{ $data->id }}' name='id'>
					   @endif
					   <input type='submit' class='btn btn-primary' value='@if(isset($data)) Update @else Submit @endif'>
					 </td>
                  </tr>
			   </tfoot>
			</table>
			{!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$('.searchable_class').select2({
	 width: 'resolve'
});
</script>
@stop
