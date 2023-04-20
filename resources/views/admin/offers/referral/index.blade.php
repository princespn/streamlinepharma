@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/view_referral_scheme')}}">View</a>
    
</div>
<h4 class="page-title"> <i class="dripicons-list"></i>Referral Scheme</h4>

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
		   {!! Form::open(['url' => url('admin/referral_scheme'), 'class' => '']) !!}
		      <div class="form-group">
				<label for="scheme_name">Scheme Name:</label>
				<input type="text" class="form-control" placeholder="Scheme Name" id="scheme_name" name="scheme_name" required>
			  </div>
			  <div class="form-group">
				<label for="offering_product">Offering Product:</label>
				<input type='text' readonly  class="form-control" placeholder="Offering Product" id="offering_product" name="offering_product" data-toggle="modal" data-target="#offeringProductModal" required>
			  </div> 
			  <!--div class="form-group">
				<label for="discount">Discount:</label>
				<input type="number" class="form-control" placeholder="Discount" id="discount" name="discount" required>
			  </div--> 
			  <div class="form-group">
				<label for="special_charges_label">Special Charges Label:</label>
				<input type="text" class="form-control" placeholder="" id="special_charges_label" name="special_charges_label" required>
			  </div> 
			  <div class="form-group">
				<label for="special_charges">Special Charges:</label>
				<input type="number" class="form-control" placeholder="" id="special_charges" name="special_charges" required>
			  </div> 
			  <div class="form-group">
				<label for="referral_wallet_benefits">Referral Wallet Benefits:</label>
				<input type="text" class="form-control" placeholder="Referral Wallet Benefits" id="referral_wallet_benefits" name="referral_wallet_benefits" required>
			  </div> 
			  <div class="form-group">
				<label for="description">Description:</label>
				<div class="input-group">
				  <textarea  class="form-control" placeholder="Scheme Description" id="description" name="description" required></textarea>
				</div>
			  </div> 
			  <div class="form-group">
				<label for="scheme_validity">Scheme Validity:</label>
				<input type="date" class="form-control" placeholder="" id="scheme_validity" name="scheme_validity" required> 
			  </div>
			  <button type="submit" class="btn btn-primary">Create</button>			  
		   {!! Form::close() !!}
			
         </div>
      </div>
   </div>
</div>

<!--------------------------------------------->
<div class="modal" id="offeringProductModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Offering Product</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type='text' class='form-control' placeholder='type sku or title' onkeyup='advanceProductSearch(this.value)'>
		<div class='result_product'></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--------------------------------------------->

@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
function advanceProductSearch(value){
	$.ajax({
			  url: "{{ url('admin/advance_product_search') }}",
			  data : { searchTerm:value },
			  cache: false,
			  success: function(data){
				console.log(data);
				var html = '';
				for(var i=0;i<data.length;i++){
					html += "<div class='row' style='margin-top:50px;cursor: pointer;'  data-dismiss='modal' onclick=\"$('#offering_product').val('"+data[i].sku+"');\"><div class='col-md-2'><img src='"+data[i].thumbnail+"' style='width: 100%'></div><div class='col-md-10'><h5 style='margin:0px'>"+data[i].title+"</h5><strong> Template - </strong>"+data[i].name+"<br><strong>SKU - </strong>"+data[i].sku+" <strong> HSN - </strong>"+data[i].hsn_code+"<br><strong>Price - </strong>"+data[i].product_price+" <strong> "+data[i].selling_price_label+" - </strong>"+data[i].selling_price+"<br><strong> Description - </strong>"+data[i].description+"</div></div><hr>";
				}
				$('.result_product').html(html);
			  }
	});
}
</script>
@stop
