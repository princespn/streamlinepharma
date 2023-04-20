@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/referral_scheme')}}">Add</a>
    
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
		<div class="table-responsive">
			<table class='table table-bordered table-striped'>
			  <thead>
			    <tr>
				  <th>Scheme</th>
				  <th>Offering Product</th>
				  <th>Label</th>
				  <th>Charges</th>
				  <th>Referral Wallet Benefits</th>
				  <th>Validity</th>
				  <th>Share</th>
				  <th>Action</th>
				</tr>
			  </thead>
			  <tbody>
			    @foreach($data as $row)
				 <tr>
				   <td>{{ $row->scheme_name }}</td>
				   <td>{{ $row->offering_product }}</td>
				   <td>{{ $row->special_charges_label }}</td>
				   <td>{{ $row->special_charges }}</td>
				   <td>{{ $row->referral_wallet_benefits }}</td>
				   <td>{{ $row->scheme_validity }}</td>
				   <td class='share_container'>
				   @if($row->scheme_validity<date('Y-m-d'))
					 <span style='color:red;font-family:bold'>Expired</span>
				   @else
				   
				     <a  href="https://wa.me/?text={{ $row->description.' '.url('product-detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id))) }}" data-action="share/whatsapp/share"  class="link-whatsapp"  target='_blank'><i class="fa fa-whatsapp"> </i> </a>

					 

					 <a href="https://www.facebook.com/sharer.php?u={{ url('product-detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id))) }}"   class="link-facebook" target='_blank'><i class="fa fa-facebook"> </i> </a> 
					 
					 
					 <script type="IN/Share" data-url="{{ url('product-detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id))) }}"></script>
		
					 
					 
					 <a href="http://twitter.com/share?text={{urlencode($row->description.' '.url('product-detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id))))}}"   class="link-linkedin" target='_blank'><i class="fa fa-twitter"> </i> </a>
					
					 
					 <button class='btn btn-sm btn-info' data-toggle="modal" data-target="#user_list" type='button' onclick="$('#scheme_id').val('{{ $row->id }}');">Share to User</button>
					 
					 <br>
					 <span style='color:red;font-family:bold'>Link : </span>{{ url('product-detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id))) }}
					 
					 @endif
				   </td>
				   <td width='180'>
				    <a href="{{ url('admin/referral_scheme_delete/'.md5($row->id)) }}" onclick="return confirm('Are you sure?')"  class='btn btn-sm btn-danger'>Delete</a>
					@if($row->status==1)
					<a href="{{ url('admin/referral_scheme_status/'.md5($row->id).'/0') }}" onclick="return confirm('Are you sure?')" class='btn btn-sm btn-primary'>De Activate</a>	
					@else
				    <a href="{{ url('admin/referral_scheme_status/'.md5($row->id).'/1') }}" onclick="return confirm('Are you sure?')" class='btn btn-sm btn-primary'>Activate</a>
				    @endif
				   </td>
				 </tr>
				@endforeach
			  </tbody>
			</table>
         </div>
</div>
      </div>
   </div>
</div>

<!----------------------------------------------------->
<div class="modal" id="user_list">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Share to</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <table class='table table-bordered table-striped'>
		  <thead>
		    <tr>
			  <th><input type='checkbox' id='all_checkbox' onclick='userCheckBox()'></th>
			  <th>Name</th>
			  <th>Phone</th>
			  <th>Email</th>
			</tr>
		  </thead>
		  <tbody>
		    @foreach($userList as $row)
		    <tr>
			   <td><input class='all_user_checkbox' name='shared_with[]' form='referral_scheme_shared_with' value='{{ $row->id }}' type='checkbox'></td>
			   <td>{{ $row->name }}</td>
			   <td>{{ $row->phone }}</td>
			   <td>{{ $row->email }}</td>
			</tr>
			@endforeach
		  </tbody>
		</table>
		<label><input type='checkbox' form='referral_scheme_shared_with' name='is_sms_send' value='yes'> Send SMS</label>&nbsp;&nbsp;
		
		{!! Form::open(['url' => url('admin/referral_scheme_shared_with'), 'id' => 'referral_scheme_shared_with']) !!}
		<input type='hidden' name='scheme_id' id='scheme_id'>
		{!! Form::close() !!}
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" form='referral_scheme_shared_with' class="btn btn-primary" >Share with Selected User</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!----------------------------------------------------->
@endsection
@section('css')
<style>
.share_container a{
	display: inline-block;
    margin: 5px;
    border: 1px solid black;
    text-align: center;
    padding: 5px 10px;
    border-radius: 50%;
}
</style>

@section('script')
<script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
<script>
function userCheckBox(){
	if($("#all_checkbox").prop("checked")==true){
		$(".all_user_checkbox").prop('checked', true);
	}else{
		$(".all_user_checkbox").prop('checked', false);
	}
}
$('#user_list').on('hidden.bs.modal', function () {
    $(".all_user_checkbox").prop('checked', false);
    $("#all_checkbox").prop('checked', false);
});
</script>
@stop
