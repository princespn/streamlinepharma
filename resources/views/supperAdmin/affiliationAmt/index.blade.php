@extends('layouts.app')

@section('pageTitle')

@if(Session::get('userType')==1)
    @if(Session::get('user')->id == 1)
        <div class="float-right">
            <a href="{{route('affiliationCreditAmt.create')}}" class="btn btn-outline-light">
                Credit Domain Affiliation Amt.
            </a>
        </div>
    @endif
@elseif(Session::get('userType')==3)
    @php
        $restrictionArray = Session::get('restrictions');
        $creditDomianaffiliation = 0;
        $delete = 0;            
        foreach($restrictionArray as $key => $value)
        {
            $action_id = $value["action_id"];
            if($action_id == 8){
                $creditDomianaffiliation = 1;
            }
            
            if($action_id == 4){
                $delete = 1;
            }
        } 
    @endphp
    @if($creditDomianaffiliation == 1)
        <div class="float-right">
            <a href="{{route('affiliationCreditAmt.create')}}" class="btn btn-outline-light">
                Credit Domain Affiliation Amt.
            </a>
        </div>
    @endif
@endif

<h4 class="page-title"> <i class="dripicons-user-group"></i> Domain Affiliation Amt listing</h4>

@endsection

@section('contentData')

    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

                    <table id="datatable" class="table table-bordered">

                        <thead>

                            <tr>                     
                                @if(Session::get('userType')==1)
                                    @if(Session::get('user')->id == 1)
                                        <th>#</th>
                                        <th>No</th>
                                        <th>Domain</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    @endif
                                @elseif(Session::get('userType')==3)
                                    @if($delete == 1 )
                                        <th>#</th>
                                    @endif
                                    <th>No</th>
                                    <th>Domain</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                @endif  
                            </tr>
                        </thead>

                        <tbody>
                            @if(Session::get('userType')==1)
                                @foreach ($affiliationAmtList as $key=>$affiliationAmt)
                                    <tr>
                                        @if(Session::get('user')->id == 1)
                                            <td>
                                                <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$affiliationAmt->id}}" title="Delete this data"></i>

                                                <div class="modal fade deletePopup{{$affiliationAmt->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                    <div class="modal-dialog modal-dialog-centered">

                                                        <div class="modal-content">

                                                            <div class="modal-header">

                                                                <h5 class="modal-title mt-0">{{$affiliationAmt->account->domain ?? ''}}</h5>

                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                            </div>

                                                            <div class="modal-body">

                                                                <p>Are you sure want to delete {{$affiliationAmt->amount}} this?</p>

                                                            </div>

                                                            <div class="modal-footer">

                                                                {{ Form::open(array('url' => 'admin/affiliationCreditAmt/' . $affiliationAmt->id)) }}

                                                                {{ Form::hidden('_method', 'DELETE') }}

                                                                    <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                                {{ Form::close() }}

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </td>
                                        @endif

                                        <td>{{$key+1}}</td>
                                        <td>{{$affiliationAmt->account->domain ?? ''}}</td>
                                        <td>{{$affiliationAmt->amount}}</td>
                                        <td>{{$affiliationAmt->created_at}}</td>                                        
                                    </tr>
                                @endforeach
                            @elseif(Session::get('userType')==3)
                                @foreach ($affiliationAmtList as $key=>$affiliationAmt)
                                    <tr>
                                        @if($delete == 1)
                                            <td>
                                                @if($delete == 1)
                                                    <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$affiliationAmt->id}}" title="Delete this data"></i>

                                                    <div class="modal fade deletePopup{{$affiliationAmt->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                        <div class="modal-dialog modal-dialog-centered">

                                                            <div class="modal-content">

                                                                <div class="modal-header">

                                                                    <h5 class="modal-title mt-0">{{$affiliationAmt->account->domain ?? ''}}</h5>

                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                                </div>

                                                                <div class="modal-body">

                                                                    <p>Are you sure want to delete {{$affiliationAmt->amount}} this?</p>

                                                                </div>

                                                                <div class="modal-footer">

                                                                    {{ Form::open(array('url' => 'admin/affiliationCreditAmt/' . $affiliationAmt->id)) }}

                                                                    {{ Form::hidden('_method', 'DELETE') }}

                                                                        <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                                    {{ Form::close() }}

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                        <td>{{$key+1}}</td>
                                        <td>{{$affiliationAmt->account->domain ?? ''}}</td>
                                        <td>{{$affiliationAmt->amount}}</td>
                                        <td>{{$affiliationAmt->created_at}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection