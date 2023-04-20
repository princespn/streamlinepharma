@extends('layouts.app')

@section('pageTitle')



<h4 class="page-title"> <i class="dripicons-calendar"></i>Service Variant</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Service Variant</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		    @endif
			{!! Form::open(['url' => '#']) !!}
			    <div class="control-group">
				    <label class="control-label" for='title'>Select Service</label>
					<div class="controls">
						<select type='text' name='brand' class='form-control' onchange="window.location.replace('{{ url('admin/services-variant/') }}/'+this.value);">
						  <option></option>
						@foreach($data as $row)
						  <option value='{{ $row->id }}'>{{ $row->service }}</option>
						@endforeach
						</select>
					</div>
				</div>
				@if(isset($id))
				@foreach(explode(',',$variant->service_field) as $key=>$row)
				<div class="control-group">
				    <label class="control-label" for='title'>{{ $row }}</label>
					<div class="controls">
						<label><input  type='radio' name='service_field{{ $key }}' class='form-control'>Yes</label>
						<label><input  type='radio' name='service_field{{ $key }}' class='form-control'>No</label>
					</div>
				</div>
				@endforeach
				<div class="control-group">
				    <label class="control-label" for='amount'>Amount</label>
					<div class="controls">
						<input type='text' name='amount' id='amount' class='form-control'>
					</div>
				</div>
				<div class="control-group services_field">
				    <label class="control-label" for='title'>&nbsp;</label>
					<div class="controls">
						<div class="input-group mb-3">
							<input type="number" class="form-control" placeholder="Discount">
							<input type="number" class="form-control" placeholder="Month">
							<input type="number" class="form-control" placeholder="Total">
							<div class="input-group-append">
							  <button class="input-group-text" type='button' onclick='addField()'>+</button>
							</div>
						</div>
					</div>  
				</div>
				@endif
                <div class="form-actions" style='text-align:center;margin-top:40px'>
					<input type="submit" class="btn btn-outline-success" value="Update">
				</div>				
			{!! Form::close() !!}
			</div>
		</div>
		
	</div>
</div>

@endsection
@section('script')
<script>
function addField(){
	$('<div class="control-group services_field"><div class="controls"><div class="input-group mb-3"><input type="number" class="form-control" placeholder="Discount"><input type="number" class="form-control" placeholder="Month"><input type="number" class="form-control" placeholder="Total"></div></div></div>').insertAfter($('.services_field').last());
	
}
$(document).ready(function(){
  $(document).on("change",'.services_field input', function(){
     var discount = Number($(this).parent().closest('div').find('input:nth-child(1)').val());
     var month = Number($(this).parent().closest('div').find('input:nth-child(2)').val());
	 $(this).parent().closest('div').find('input:nth-child(3)').val((month*Number($('#amount').val()))-discount);
  });
});
</script>
@stop
