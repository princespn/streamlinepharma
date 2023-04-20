@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/view_employee')}}">View Employee</a>
    
</div>
<h4 class="page-title"> <i class="dripicons-list"></i>Create Employee</h4>

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
		   {!! Form::open(['url' => url('admin/set_employee'), 'class' => '', 'id' => 'give_permission']) !!}

           <div class="form-group">
				<label for="special_charges">Assigned to:</label>
				
				<select class="form-control" name="assigned_to" id="assigned_to" required>
					<option value="">--Select--</option>
					@foreach($emp as $empvalue)
					<option value="{{$empvalue->id}}">{{$empvalue->title}}</option>
					@endforeach
				</select>
			  </div> 
		      <div class="form-group">
				<label for="scheme_name">Employee Name:</label>
				<input type="text" class="form-control" placeholder="Employee Name" id="employee_name" name="employee_name" required>
			  </div>
			  
			  <div class="form-group">
				<label for="discount">Employee Email Id:</label>
				<input type="email" class="form-control" placeholder="Employee Email" id="employee_email" name="employee_email" required>
			 </div>
			  <div class="form-group">
				<label for="special_charges_label">Mobile :</label>
				<input type="text" class="form-control" placeholder="" id="employee_mobile" name="employee_mobile" required>
			  </div> 
			  <div class="form-group">
				<label for="special_charges">Description:</label>
				
				<select class="form-control" name="description" id="description" required>
					<option value="">--Select Description --</option>
					@foreach($data as $value)
					<option value="{{$value->id}}">{{$value->name}}</option>
					@endforeach
				</select>
			  </div> 
			  <div class="form-group">
				<label for="special_charges_label">Password :</label>
				<input type="password" class="form-control" placeholder="" id="password" name="password" required>
			  </div> 
			 
			  
			 		  
		   {!! Form::close() !!}

		        <!-----------------------Permission--------------------------->
		<div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <input form="give_permission" type="checkbox"  name="dashboard"/>  Dashboard
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse">
                <div class="card-body">
                    
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <input form="give_permission" type="checkbox" name="approval"/>  Approval
                    </button>
                </h2>
                </div>
                <div id="collapseTwo" class="collapse">
                <div class="card-body">
                <ol>
                        <li> <input form="give_permission" type="checkbox" name="product_approval"/> Product Approval</li>
                        <li> <input form="give_permission" type="checkbox" name="reject_slider"/> Reject Slider</li>
                    </ol>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <input form="give_permission" type="checkbox" name="affiliation"/>  Affiliation
                    </button>
                </h2>
                </div>
                <div id="collapseThree" class="collapse">
                <div class="card-body">
                <ol>
                        <li> <input form="give_permission" type="checkbox" name="affiliate"/> Affiliate</li>
                        <li> <input form="give_permission" type="checkbox" name="affiliate_keywords"/> Affiliate Keywords</li>
                        <li> <input form="give_permission" type="checkbox" name="credit_domain_affiliation_amt"/> Credit Domain Affiliation Amt</li>
                        <li> <input form="give_permission" type="checkbox" name="affiliate_payment"/> Affiliate Payment</li>
                    </ol>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFore">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFore" aria-expanded="false" aria-controls="collapseThree">
                    <input form="give_permission" type="checkbox" name="account_and_currency"/>  Account & Currency
                    </button>
                </h2>
                </div>
                <div id="collapseFore" class="collapse">
                <div class="card-body">
                <ol>
                        <li> <input form="give_permission" type="checkbox" name="account_listing"/> Account Listing</li>
                        <li> <input form="give_permission" type="checkbox" name="currency_listing"/> Currency Listing</li>
                        <li> <input form="give_permission" type="checkbox" name="advance_product_order"/> Advance Product Order</li>
                        <li> <input form="give_permission" type="checkbox" name="advance_product_template"/> Advance Product Template</li>
                        <li> <input form="give_permission" type="checkbox" name="view_advance_product_template"/> View Advance Product Template</li>
                    </ol>
                </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                    <input form="give_permission" type="checkbox" name="permission"/> Permission
                    </button>
                </h2>
                </div>
                <div id="collapseFive" class="collapse">
                <div class="card-body">
                <ol>
                        <li> <input form="give_permission" type="checkbox" name="employee_restriction"/> Employee Restriction</li>
                        <li> <input form="give_permission" type="checkbox" name="employee_listing"/> Employee Listing</li>
                        <li> <input form="give_permission" type="checkbox" name="action"/> Action</li>
                        <li> <input form="give_permission" type="checkbox" name="pages"/> Pages</li>
                     
                    </ol>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSeven">
                    <input form="give_permission" type="checkbox" name="employee"/>  Employee
                    </button>
                </h2>
                </div>
                <div id="collapseSix" class="collapse">
                <div class="card-body">
                <ol>
                        <li> <input form="give_permission" type="checkbox" name="create_view_emp"/> Create / View</li>
                       
                     
                    </ol>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingSeven">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    <input form="give_permission" type="checkbox" name="setting"/> Setting
                    </button>
                </h2>
                </div>
                <div id="collapseSeven" class="collapse">
                <div class="card-body">
                <ol>
                        <li> <input form="give_permission" type="checkbox" name="add_desciption"/> Add Desciption</li>
                       
                     
                    </ol>
                </div>
                </div>
            </div>
            </div>
            	
        <!--------------------------Permission----------------------------------->
			
         </div>
		
      </div>
	  <button type="submit" form="give_permission" class="btn btn-primary">Create</button><br/>
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
