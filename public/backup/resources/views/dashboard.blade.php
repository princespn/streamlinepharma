@extends('layouts.app')
@section('pageTitle')
    <h4 class="page-title"> <i class="dripicons-meter"></i> Dashboard</h4>
@endsection

@section('contentData')

<div class="row">

    @if($affiliateMsg)
        <div class="col-md-12 col-xl-12">
            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">
                    <h3 class="text-danger">{{$affiliateMsg }}</h3>

                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target=".payPopup" title="Pay for affiliation product">Pay now</button>

                    <div class="modal fade payPopup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            {!! Form::open(['route' => 'affiliatePayDetail','method'=>'POST','id'=>'form','class'=>'form-horizontal m-t-30']) !!}
                            {{ csrf_field() }}
                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title mt-0">Pay for affiliation product</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                </div>

                                <div class="modal-body text-left">

                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <b>Bank Details</b><br>
                                            <b>Number</b> : 39721348304 <br>
                                            <b>Name</b> : Unique and Common Business Solutions <br>
                                            <b>Bank</b> : State Bank of India <br>
                                            <b>IFSC</b> : SBINOO5OO31 <br>
                                            <b>Branch</b> : Ahmedgarh <br>
                                        </div>
                
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Mode of deposite</label>
                                                <select name="paymentMode" class="select2 form-control" required>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Bank transfer">Bank transfer</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Enter amount</label>
                                                <input type="number" name="paymentAmount" class="form-control" required/>
                                            </div>
                                            <div class="form-group">
                                                <label>Date of deposite</label>
                                                <input type="date" name="paymentDate" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success">Submit</button>
                                </div>
                            </div>
                            {!! Form::close() !!} 

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($domainDashboard['userType']==1)

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-purple">
                        {{$domainDashboard['normalOrder']}}
                    </h3>

                    Delivered Orders

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-danger">
                        {{$domainDashboard['cancelOrder']}}
                    </h3>

                    Cancel Orders

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-primary">
                        {{$domainDashboard['reverseOrder']}}
                    </h3>

                    Reverse Order

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-dark">{{$domainDashboard['replcamentOrder']}}</h3>

                    Replcament Order

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-warning">{{$domainDashboard['affiliateOrder']}}</h3>

                    Affiliate Order

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-warning">{{$domainDashboard['productInquiry']}}</h3>

                    Total Inquiry

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-warning">{{$domainDashboard['registerUser']}}</h3>

                    Register User

                </div>

            </div>

        </div>
    @else 
    <div class="col-md-6 col-xl-3">

        <div class="card text-center m-b-30">

            <div class="mb-2 card-body text-muted">

                <h3 class="text-purple">
                    {{-- {{$domainDashboard['normalOrder']}} --}}
                    -
                </h3>
                Affiliate
            </div>

        </div>

    </div>
        
    @endif
</div>


{{-- <div class="row">

    <div class="col-xl-8">

        <div class="card m-b-30">

            <div class="card-body">

                <h4 class="mt-0 m-b-30 header-title">Pending Orders</h4>

                <div class="table-responsive">

                    <table class="table m-t-20 mb-0 table-vertical">

                        <tbody>

                            <tr>

                                <td>

                                    <img src="assets/images/users/avatar-2.jpg" alt="user-image" class="thumb-sm rounded-circle mr-2"/>

                                    Herbert C. Patton

                                </td>

                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>

                                <td>

                                    $14,584

                                    <p class="m-0 text-muted font-14">Amount</p>

                                </td>

                                <td>

                                    5/12/2016

                                    <p class="m-0 text-muted font-14">Date</p>

                                </td>

                                <td>

                                    <button type="button" class="btn btn-secondary btn-sm waves-effect">Edit</button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-4">

        <div class="card m-b-30">

            <div class="card-body">

                <h4 class="mt-0 m-b-15 header-title">QC Messages</h4>

                <ol class="activity-feed mb-0">                    

                    <li class="feed-item">

                        <span class="date">Sep 21</span>

                        <span class="activity-text">Responded to need “In-Kind Opportunity”</span>

                    </li>

                    <li class="feed-item">

                        <span class="date">Sep 18</span>

                        <span class="activity-text">Created need “Volunteer Activities”</span>

                    </li>

                    <li class="feed-item">

                        <span class="date">Sep 17</span>

                        <span class="activity-text">Attending the event “Some New Event”. Responded to needed</span>

                    </li>

                </ol>

            </div>

        </div>

    </div>

</div> --}}

@endsection