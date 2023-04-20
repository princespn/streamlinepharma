@extends('layouts.app')
@section('pageTitle')
    <h4 class="page-title"> <i class="dripicons-meter"></i> Dashboard</h4>
@endsection

@section('contentData')

<div class="row">

    

    @if($userType==1)

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-purple">
                        {{  $orders  }}
                    </h3>

                    Delivered Orders

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-danger">
                        {{$cancel_orders}}
                    </h3>

                    Cancel Orders

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-primary">
                        {{$revers_order}}
                    </h3>

                    Reverse Order

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-dark">{{$replace_order}}</h3>

                    Replcament Order

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-warning">{{$aff_orders}}</h3>

                    Affiliate Order

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-warning">{{$total_enq}}</h3>

                    Total Inquiry

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card text-center m-b-30">

                <div class="mb-2 card-body text-muted">

                    <h3 class="text-warning">{{$registers}}</h3>

                    Register User

                </div>

            </div>

        </div>
    @else 
    <div class="col-md-6 col-xl-3">

        <div class="card text-center m-b-30">

            <div class="mb-2 card-body text-muted">

                <h3 class="text-purple">
                    ₹ {{ $income_aff }} 
                    
                </h3>
                Affiliate
            </div>

        </div>

    </div>
	<div class="col-md-6 col-xl-3">

        <div class="card text-center m-b-30">

            <div class="mb-2 card-body text-muted">

                <h3 class="text-purple">
                    ₹ {{ $income_aff_hold }} 
                    
                </h3>
                Affiliate ( Hold )
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