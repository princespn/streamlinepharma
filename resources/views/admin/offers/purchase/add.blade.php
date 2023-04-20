@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
    <a href="{{route('offers.index')}}" class="btn btn-outline-light">
        Back
    </a>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Add Offer</h4>

@endsection

@section('contentData')

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                {!! Form::open(['route' => 'offers.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        @if($errors->any())
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            {{$errors->first()}}
                        </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label>Select Scheme</label>

                            <select name="scheme" class="form-control" required>
                                <option value="">Choose Scheme</option>
                                @if(isset($schemeList))
                                @foreach($schemeList as $key=>$scheme)
                                <option value="{{$scheme->id}}" @if(isset($offerList)&&$offerList->scheme==$scheme->id) selected   @endif>{{$scheme->title}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <p class="col-lg-12"></p>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>Purchase Product SKU</label>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <input type="text" placeholder="Enter Product SKU" name="product_sku" id="product_sku" class="form-control" required value='@if(isset($offerList)){{ $offerList->product_sku }}@endif' data-toggle="modal" data-target="#offeringProductModal"  readonly  onclick="$('#tmp_id').val('product_sku');$('.result_product').html('');$('#search_advance_input').val('');" />
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3">
                                    <input type="text" placeholder="Enter QTY" value='@if(isset($offerList)){{ $offerList->qty }}@endif' name="product_qty" class="form-control " required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>GET Product SKU</label>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <input type="text" placeholder="Enter get Product SKU" name="get_product_sku" id='get_product_sku' class="form-control" value='@if(isset($offerList)){{ $offerList->get_prod_sku }}@endif' data-toggle="modal" data-target="#offeringProductModal"  readonly onclick="$('#tmp_id').val('get_product_sku');$('.result_product').html('');$('#search_advance_input').val('');" />
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3">
                                    <input type="text" placeholder="Get QTY" value='@if(isset($offerList)){{ $offerList->get_qty }}@endif' name="get_qty" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="col-lg-12"></p>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="datetime-local" id='startDate' name="startDate" class="form-control" required  @if(isset($offerList)) value='{{ $offerList->startDate }}' @endif  />
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="datetime-local" name="endDate" class="form-control" required @if(isset($offerList)) value='{{ $offerList->endDate }}' @endif  id='endDate' />
                        </div>
                    </div>
					<div class="col-sm-12">
                        <div class="form-group">
                            <label>Terms and Conditions</label>
                            <textarea  name="terms_and_conditions" class="summernote form-control" required >@if(isset($offerList)){{ $offerList->terms_and_conditions }}@endif</textarea>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
					@if(isset($offerList)) 
						<input type='hidden' name='id' value='{{ $offerList->id }}'>
					@endif
                        <button type="submit" class="btn btn-outline-primary">
                            @if(isset($offerList)) Update @else Submit @endif
							</button>
                    </div>
                </div>
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
        <input type='text' class='form-control' placeholder='type sku or title' onkeyup='advanceProductSearch(this.value)' id='search_advance_input'>
		<div class='result_product'></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<input type='hidden' id='tmp_id'>
<!--------------------------------------------->
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
function advanceProductSearch(value){
	$('.result_product').html('');
	var tmp_id = $('#tmp_id').val();
	$.ajax({
			  url: "{{ url('admin/advance_product_search') }}",
			  data : { searchTerm:value },
			  cache: false,
			  success: function(data){
				console.log(data);
				var html = '';
				for(var i=0;i<data.length;i++){
					html += "<div class='row' style='margin-top:50px;cursor: pointer;'  data-dismiss='modal' onclick='$("+'"#'+tmp_id+'"'+").val("+'"'+data[i].sku+'"'+");' ><div class='col-md-2'><img src='"+data[i].thumbnail+"' style='width: 100%'></div><div class='col-md-10'><h5 style='margin:0px'>"+data[i].title+"</h5><strong> Template - </strong>"+data[i].name+"<br><strong>SKU - </strong>"+data[i].sku+" <strong> HSN - </strong>"+data[i].hsn_code+"<br><strong>Price - </strong>"+data[i].product_price+" <strong> "+data[i].selling_price_label+" - </strong>"+data[i].selling_price+"<br><strong> Description - </strong>"+data[i].description+"</div></div><hr>";
				}
				$('.result_product').html(html);
			  }
	});
}
</script>
@stop