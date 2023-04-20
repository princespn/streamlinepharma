@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/dynamic_menu')}}">My Subscription</a>
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>All Advance Product </h4>

@endsection

@section('contentData')


<div class="row">
    <div class='col-12'> 
      <div class='card m-b-20'>
      <div class='card-body'>
	  <div class='row'>
	  {!! Form::open(['url' => 'admin/view_advance_product','class'=>'form-inline','method'=>'get']) !!}
	  <div class='col-md-12'>
	     <select class='form-control' name='qc'>
		   <option value=''>All</option>
		   <option value='0'>Awaiting Review</option>
		   <option value='1'>Approved</option>
		   <option value='2'>Declined</option>
		 </select>
		 <input type="text" class="form-control" placeholder='SKU' name='sku'>
		 <input type="text" class="form-control" placeholder='Keyword' name='keyword'>
		 <input type="text" class="form-control" placeholder='Title' name='title'>
		 <select class="form-control" placeholder='Affiliate' name='affiliate'>
              <option value=''>Affiliate</option>
			  <option>Yes</option>
			  <option>No</option>
         </select>
		 <input type="text" class="form-control" placeholder='Scheme' name='scheme'>
		 <input type='submit' value='Search' class='btn btn-primary'>
	  </div>
	  <br>
	  <br>
	  {!! Form::close() !!}
	  </div>
      <table class='table table-striped table-bordered'>
	    <thead>
		  <tr>
		    <th>#</th>
		    <th>Product</th>
		    <th>Thumbnail</th>
		    <th>Price</th>
		    <th>Unit</th>
		    <th>Status</th>
			@if(Session::get('user')->id==1)
			<th>Account</th>
			@endif
		    <th>Catalogue</th>
		    <th>Action</th>
		  </tr>
		</thead>
	    <tbody>
      @foreach($data as $key=>$row)
           <tr>
		     <td>{{ ($key+1) }}</td>
		     <td>{{ $row->title }}</td>
		     <td><img style='height:70px;width:auto;' class="card-img-top" src="{{ $row->thumbnail }}" alt="{{ $row->title }}"></td>
		     <td><span style="text-decoration: line-through;">{{ $row->product_price }}</span> {{ $row->selling_price }}
			 <br>
			 Tax : {{ $row->product_tax }} {{ $row->tax_method }}
			 </td>
			 <td>{{ $row->unit_quanitity }} {{ $row->unit }}</td>
		     <td><span style='padding: 3px 10px;background-color:{{ $qc_color[$row->qc] }}'>{{ $qc[$row->qc] }}</span>
			 @if($row->qc==2&&$row->decline_remarks!=Null)
				 <br>
			    <strong>Reason : </strong>{!! nl2br($row->decline_remarks) !!}
			 @endif
			 </td>
			 @if(Session::get('user')->id==1)
			 <td>{{ $row->account->title }}</td>
			 @endif
			 <td>
			   <a href="{{ url('admin/advance_product_catalogue/'.$row->id) }}" class='btn btn-sm btn-xs btn-primary'>View or Add</a>
			 </td>
		     <td>
			 @if(Session::get('user')->id==1)
				<a href="https://{{ $row->account->domain }}/detail/{{ $row->sku }}" class="card-link" target='_blank'>View</a>
			   @if($row->qc==0)
				<br>
			    <button type='button' class='btn btn-sm btn-primary' data-toggle="modal" data-target="#updateQcModal" onclick='$("#advance_product_qc_id").val({{$row->id}});'>Update Status</button> 
			   @endif
				   
			   
			 @else
			    <a href="{{ url('admin/add_advance_product/'.$row->dynamic_menu.'/'.$row->id) }}" class="card-link">Edit</a>
			    <a href="{{ url('admin/add_advance_product/'.$row->setting_id.'/'.$row->id) }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateProductModal" onclick='setProductData("{{$row->id}}","{{ $row->selling_price }}","{{ $row->product_price }}","{{ $row->unit_quanitity }}","{{ $row->product_tax }}","{{ $row->tax_method }}",{{ $row->dynamic_selling_price }},"{{ $row->shipping_method }}","{{ $row->is_affiliation }}","{{ $row->affiliation_price }}","{{ $row->affiliation_payment_release_online }}","{{ $row->affiliation_payment_release_cod }}","{{ $row->is_return }}")'>Update</a>
			 @endif
			</td>
		   </tr>
      @endforeach
	   </tbody>
       </table>	
       {{ $data->links() }}	   
	</div>
	</div>
	</div>
</div>
<!------------------------------------------------>

<div class="modal" id="updateProductModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Product Update</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        {!! Form::open(['url' => 'admin/updateProductForm', 'id' => 'updateProductForm']) !!}
		  <div class="form-group">
			<label for="product_price">MRP:</label>
			<input type="text" class="form-control" placeholder="" name="product_price">
		  </div>
		  
		  <div class="form-group">
			<label for="selling_price">Selling Price:</label>
			<input type="text" class="form-control" placeholder="" name="selling_price">
		  </div>
		  
		  <div class="form-group">
			<label for="dynamic_selling_price">Dynamic Selling Price:</label>
			<input type="text" class="form-control" placeholder="" name="dynamic_selling_price">
		  </div>
		  
		  
		  <div class="form-group">
			<label for="unit_quanitity">Unit:</label>
			<input type="text" class="form-control" placeholder="" name="unit_quanitity">
		  </div>
		  
		  <div class="form-group">
			<label for="selling_price">Tax:</label>
			
		  </div>
		  
		  
		  <div class="input-group mb-3">
			<input type="text" class="form-control" placeholder="" name='product_tax'>
			<div class="input-group-append">
			  
			    <select class='form-control' name='tax_method'>
				  <option>Inclusive</option>
				  <option>Exclusive</option>
				</select>
			  
			</div>
		  </div>
		  <div class="form-group">
			<label for="shipping_method">Shipping Method:</label>
			<select class='form-control' name='shipping_method'>
				  <option>Inclusive</option>
				  <option>Exclusive</option>
		    </select>
		  </div>
		  <div class="form-group">
			<label for="shipping_method">Affiliation:</label>
			<select class='form-control' name='is_affiliation' onchange="if(this.value=='Yes'){$('.affiliation_price_div').show();}else{$('.affiliation_price_div').hide();}">
				  <option>No</option>
				  <option>Yes</option>
		    </select>
		  </div>
		  <div class="form-group affiliation_div">
			<label for="affiliation_price">Affiliation Price:</label>
			<input type="text" class="form-control" placeholder="" name="affiliation_price">
		  </div>
		  <div class="control-group affiliation_div">
										<label class="control-label">Affiliate Payment release on Online Payment</label>
										<div class="controls">
										<select type="text" class="form-control aff_payment_term"   name="affiliation_payment_release_online" id="affiliation_payment_release_online" >
										        <option>On Order recieved</option>
												<option>On Order Delivered</option>
												<option>On Payment Received</option>
												<option>On Return period complition</option>
												<option>On Return pick up</option> 
												<option>On Return good recieved</option>
												<option>On Return good audit</option>
											</select>
										</div>
			</div>

			<div class="control-group affiliation_div">
										<label class="control-label">Affiliate Payment release on For COD </label>
										<div class="controls">
										<select type="text" class="form-control  aff_payment_term"   name="affiliation_payment_release_cod" id="affiliation_payment_release_cod" >
										        <option>On Order recieved</option>
												<option>On Order Delivered</option>
												<option>On Payment Received</option>
												<option>On Return period complition</option>
												<option>On Return pick up</option> 
												<option>On Return good recieved</option>
												<option>On Return good audit</option>
											</select>
										</div>
			</div>		  
		  <input type='hidden' name='id' >
		{!! Form::close() !!}
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" form='updateProductForm' class="btn btn-success">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!------------------------------------------------>
<!------------------------------------------------>
@if(Session::get('user')->id==1)
<div class="modal" id="updateQcModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Product Update</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        {!! Form::open(['url' => 'admin/advance_product_qc', 'id' => 'advance_product_qc']) !!}
		  <div class="form-group">
			<label for="qc_status">Status:</label>
			<select class="form-control" placeholder="Enter email" id="qc_status" name="qc_status" onchange='if(this.value==2){$(".decline_remarks_div").show();}else{$(".decline_remarks_div").hide();}'>
			   <option value=''></option>
			   <option value='1'>Approve</option>
			   <option value='2'>Decline</option>
			</select>
		  </div>
		  <div class="form-group decline_remarks_div" style='display:none'>
			<label for="decline_remarks">Decline Reason:</label>
			<textarea class="form-control" placeholder="Decline Remarks" name="decline_remarks" id="decline_remarks"></textarea>
		  </div>
		  
		  <input type='hidden' name='advance_product_qc_id' id='advance_product_qc_id'>
		{!! Form::close() !!}
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" form='advance_product_qc' class="btn btn-success">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endif
<!------------------------------------------------>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$('.searchable_class').select2({
	 width: 'resolve'
});
function setProductData(id,selling_price,product_price,unit_quanitity,product_tax,tax_method,dynamic_selling_price,shipping_method,is_affiliation,affiliation_price,affiliation_payment_release_online,affiliation_payment_release_cod,is_return){
	var option_html = '<option>On Order recieved</option><option>On Order Delivered</option><option>On Payment Received</option><option>On Return period complition</option><option>On Return pick up</option><option>On Return good recieved</option><option>On Return good audit</option>';
	if(is_return=='No'){
		option_html = '<option>On Order recieved</option><option>On Payment Received</option><option>On Order Delivered</option>';
	}
	$('.aff_payment_term').html(option_html);
	$('#updateProductForm input[name=id]').val(id);
	$('#updateProductForm input[name=selling_price]').val(selling_price);
	$('#updateProductForm input[name=product_price]').val(product_price);
	$('#updateProductForm input[name=unit_quanitity]').val(unit_quanitity);
	$('#updateProductForm input[name=product_tax]').val(product_tax);
	$('#updateProductForm [name=tax_method]').val(tax_method);
	$('#updateProductForm input[name=dynamic_selling_price]').val(dynamic_selling_price);
	$('#updateProductForm [name=shipping_method]').val(shipping_method);
	$('#updateProductForm [name=is_affiliation]').val(is_affiliation);
	$('#updateProductForm input[name=affiliation_price]').val(affiliation_price);
	$('#updateProductForm [name=affiliation_payment_release_online]').val(affiliation_payment_release_online);
	$('#updateProductForm [name=affiliation_payment_release_cod]').val(affiliation_payment_release_cod);
	if(is_affiliation=='Yes'){
		$('.affiliation_div').show();
	}else{
		$('.affiliation_div').hide();
	}
}
</script>
@stop