@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/view_description')}}">View</a>
    
</div>
<h4 class="page-title"> <i class="dripicons-list"></i>Create description</h4>

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
		   {!! Form::open(['url' => url('admin/set_description'), 'class' => '']) !!}
		      <div class="form-group">
				<label for="scheme_name">Description:</label>
				<input type="text" class="form-control" placeholder="description" id="description" name="description" required>
			  </div>
			  
			 
			  
			  <button type="submit" class="btn btn-primary">Create</button>			  
		   {!! Form::close() !!}
			
         </div>
      </div>
   </div>
</div>

<!--------------------------------------------->
<!--------------------------------------------->

@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

</script>
@stop
