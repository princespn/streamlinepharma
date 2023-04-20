@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/create_employee')}}">Add</a>
    
</div>
<h4 class="page-title"> <i class="dripicons-list"></i>Given Permission</h4>

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
        <!-----------------------Select Users------------------------------------>
        {!! Form::open(['url' => url('admin/give_menu_permission'), 'class' => '' ,'id' => 'give_permission']) !!}
		       
			  <div class="form-group">
				<label for="special_charges">Employee :</label>
				
				<select class="form-control" name="employee" id="employee" required>
					<option value="">--Select Employee --</option>
                    @foreach($emp as $empvalue)
                    <option value="{{$empvalue->id}}">{{$empvalue->title}}</option>
                    @endforeach
					
					
				</select>
			  </div> 
			 
			  
			  		  
		{!! Form::close() !!}
			
         </div>

        <!------------------------Select Users------------------------------------>

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
<button type="submit" form="give_permission" class="btn btn-primary">Create</button><br/>
      </div>
   </div>
</div>

<!----------------------------------------------------->
<div class="modal" id="user_list">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

     
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


@stop
