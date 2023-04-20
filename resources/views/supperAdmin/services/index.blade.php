@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
  
  <a class="btn btn-outline-light" href="#">View Services</a>
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Services</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Create Services</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		    @endif
			{!! Form::open(['url' => url('admin/services')]) !!}
			    <div class="control-group">
				    <label class="control-label" for='service'>Service</label>
					<div class="controls">
						<input type='text' name='service' class='form-control'  >
					</div>
				</div>
				<div class="control-group services_field">
				    <label class="control-label" for='title'>Service Field</label>
					<div class="controls">
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Service Field" required name="service_field[]">
							<div class="input-group-append">
							  <button class="input-group-text" type='button' onclick='addField()'>+</button>
							</div>
						</div>
					</div>  
				</div>
				
                <div class="form-actions" style='text-align:center;margin-top:40px'>
					<input type="submit" class="btn btn-outline-success" value="Add">
				</div>				
			{!! Form::close() !!}
			</div>
		</div>
		<div class="card m-b-20">
		    <div class="card-header">Added</div>
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>Service</th>
				      <th>Service Field</th>
				   </tr>
				</thead>
				<tbody>
			    @foreach($data as $key=>$row)
				   <tr>
				      <td>{{ $key+1 }}</td>
				      <td>{{ $row->service }}</td>
				      <td>
					      {!! str_replace(',','<br>',$row->service_field) !!}
					  </td>
				   </tr>
				@endforeach
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')
<script>
function addField(){
	$('<div class="control-group services_field"><label class="control-label" >Service Field</label><div class="controls"><div class="input-group mb-3"><input type="text" class="form-control" placeholder="Service Field"  required name="service_field[]"></div></div></div>').insertAfter($('.services_field').last());
}
</script>
@stop