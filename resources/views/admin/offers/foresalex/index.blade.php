@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
  
 <a class="btn btn-outline-light" href="{{url('admin/view_fore_sale_x')}}">View</a> 
    
</div>
<h4 class="page-title"> <i class="dripicons-list"></i>Sale X</h4>

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
		   {!! Form::open(['url' => url('admin/four_sale_x'), 'class' => '']) !!}
          
                <div class="form-row">
                    <div class="col-md-12 mb-6">
                    <label for="validationDefault01">Scheme Name</label>
                    <input type="text" class="form-control" id="scheme_name" name="scheme_name" value="" required>
                    </div>
                   
                </div><br/>
                <div class="form-row" id="addMore">
                    <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Template (Advance Product Template)</label>
                    <select class="custom-select" id="validationDefault04" name="template[]" required onchange="getLastPrice(this.value)">
                     <option value=''></option>
                    @foreach($available as $row)
					  <option value='{{ $row->id }}'>{{ $row->name }}</option>
					@endforeach
                    </select>
                    </div>
                    <div class="col-md-2 mb-3">
                       <label for="user_type">User Type</label>
                       <select type="text" class="form-control" id="user_type" name="user_type" required>
                          <option>All</option>
                          <option>New</option>
                       </select>
                    </div>
                    <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Number of Coupon</label>
                    <input type="text" class="form-control" id="validationDefault03" name="number_of_coupon[]" required>
                    </div>

                    <div class="col-md-2 mb-3">
                    <label for="validationDefault05">Refferal Benifit</label>
                    <input type="text" class="form-control" id="validationDefault05" name="refferal_benifit[]" required>
                    </div>

                    <div class="col-md-2 mb-3">
                    <label for="validationDefault05">Refree Benifit</label>
                    <input type="text" class="form-control" id="validationDefault05" name="refree_benifit[]" required>
                    </div>
                    <div class="col-md-1 mb-1">
                        <label for="validationDefault05">.</label>
                        <button type="button" class="btn btn-info form-control" onclick="addMore()"><i class="dripicons-plus"></i></button>
                    </div> 
                </div>
              
                <div class="form-row">
                   <div class='col-md-12 pr_price_last'>
                   </div>
                </div>
             

                <div class="form-row">
                    <div class="col-md-8 mb-6">
                    <label for="validationDefault01">Number of Set</label>
                    <input type="text" class="form-control" id="number_of_set"  name="number_of_set" value="" required>
                    </div>
                    <div class="col-md-4 mb-6">
                    <label for="validationDefault01">Valid Date</label>
                    <input type="date" class="form-control" id="validity_date"  name="validity_date" value="" required>
                    </div>
                   
                </div><br/>
                <button class="btn btn-primary" type="submit">Submit form</button>
	  
		   {!! Form::close() !!}
			
         </div>
      </div>
   </div>
</div>



@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        let count = 0;
        function addMore(){
            if(count <=6){
            count++;
            $("#addMore").after('<div class="form-row" id="min_close_'+count+'"><div class="col-md-5 mb-3""><select class="custom-select" id="validationDefault04" name="template[]" required>@foreach($available as $row)<option value="{{ $row->id }}">{{ $row->name }}</option>@endforeach</select></div><div class="col-md-2 mb-3"><input type="text" class="form-control" id="validationDefault03" name="number_of_coupon[]" required></div><div class="col-md-2 mb-3"><input type="text" class="form-control" id="validationDefault05" name="refferal_benifit[]" required></div><div class="col-md-2 mb-3"><input type="text" class="form-control" id="validationDefault05" name="refree_benifit[]" required></div><div class="col-md-1 mb-1"><button type="button" class="btn btn-danger form-control" onclick="remove_more('+count+')">-</button></div></div>');
            }
        }

        function remove_more(count){
            //alert('#min_close_'+count);
            $("#min_close_"+count).remove();
        }
        
        function getLastPrice(value){
            $( ".pr_price_last" ).load( "{{ url('admin/getLastPrice') }}/"+value );
        }
        
    </script>

@stop
