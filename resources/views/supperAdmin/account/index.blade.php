@extends('layouts.app')  

@section('pageTitle')
    @if(Session::get('userType')==1)
        @if(Session::get('user')->id == 1)  
            <div class="float-right">            
                <a href="{{route('account.create')}}" class="btn btn-outline-light">
                    Create account
                </a>            
            </div>
        @endif
    @elseif(Session::get('userType')==3)
        @php
            $restrictionArray = Session::get('restrictions');
            $add = 0;            
            foreach($restrictionArray as $key => $value)
            {
                $action_id = $value["action_id"];
                if($action_id == 2){
                    $add = 1;
                }                                            
            } 
        @endphp
        @if($add == 1)
            <div class="float-right">                        
                <a href="{{route('account.create')}}" class="btn btn-outline-light">
                    Create account
                </a>
            </div>
        @endif
    @endif  

    <h4 class="page-title"> <i class="dripicons-user-group"></i> Account listing</h4>

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
                                        <th>Logo</th>
                                        <th>Title</th>
                                        <th>Domain</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                    @endif
                                @elseif(Session::get('userType')==3)
                                    @php
                                        $restrictionArray = Session::get('restrictions');
                                        $edit = 0;
                                        $delete = 0;
                                        $view = 0; 
                                        $viewLedger = 0;
                                        foreach($restrictionArray as $key => $value)
                                        {
                                            $action_id = $value["action_id"];
                                            
                                            if($action_id == 4){
                                                $delete = 1;
                                            } 
                                            if($action_id == 3){
                                                $edit = 1;
                                            }                                    
                                            if($action_id == 1){
                                                $view = 1;
                                            } 
                                            if($action_id == 10){
                                                $viewLedger = 1;
                                            }
                                        }          
                                    @endphp
                                    @if($delete == 1 || $view == 1 || $edit == 1 || $viewLedger == 1 )
                                        <th>#</th>
                                    @endif                                                                          
                                    <th>No</th>
                                    <th>Logo</th>
                                    <th>Title</th>
                                    <th>Domain</th>
                                    <th>Phone</th>
                                    <th>Status</th> 
                                @endif                                                    
                            </tr>
                        </thead>

                        <tbody>
                            @if(Session::get('userType')==1)
                                @if(Session::get('user')->id == 1)  
                                    @foreach ($accountList as $key=>$account)
                                        <tr>
                                            <td>
                                                <!--Delete Popup-->

                                                    @if($account->id != 1)

                                                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$account->id}}" title="Delete this data"></i>

                                                        <div class="modal fade deletePopup{{$account->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                            <div class="modal-dialog modal-dialog-centered">

                                                                <div class="modal-content">

                                                                    <div class="modal-header">

                                                                        <h5 class="modal-title mt-0">{{$account->title}}</h5>

                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                                    </div>

                                                                    <div class="modal-body">

                                                                        <p>Are you sure want to delete this?</p>

                                                                    </div>

                                                                    <div class="modal-footer">

                                                                        {{ Form::open(array('url' => 'admin/account/' . $account->id)) }}

                                                                        {{ Form::hidden('_method', 'DELETE') }}

                                                                            <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                                        {{ Form::close() }}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    @endif

                                                <!--Edit Icon-->
                                            
                                                    <!--a href="{{ URL::to('admin/account/' . $account->id . '/edit') }}">
                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                                    </a-->

                                                <!--Detals Popup-->

                                                <i class="mdi mdi-account-card-details btn btn-outline-dark" data-toggle="modal" data-target=".detailsPopup{{$account->id}}" title="View more data"></i>

                                                <div class="modal fade detailsPopup{{$account->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                    <div class="modal-dialog modal-dialog-centered">

                                                        <div class="modal-content">

                                                            <div class="modal-header">

                                                                <h5 class="modal-title mt-0">{{$account->title}}</h5>

                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                            </div>

                                                            <div class="modal-body">

                                                                <table id="datatable" class="table table-bordered">

                                                                    <thead>
                                                                        <tr>
                                                                            <th>Email</th>
                                                                            <td>{{$account->email}}</td>
                                                                        </tr>
                                                                        <tr>

                                                                            <th>Domain Name</th>

                                                                            <td>{{$account->domain}}</td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>WhatsApp Number</th>

                                                                            <td>{{$account->whatsApp}}</td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>Address</th>

                                                                            <td>{{$account->address}}</td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>Default Currency</th>

                                                                            <td>

                                                                                {{@$account->currency->title}}

                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>Website Type</th>

                                                                            <td>

                                                                                @switch($account->type)

                                                                                    @case(1)

                                                                                        E-Commerce

                                                                                        @break



                                                                                    @case(2)

                                                                                        Hybrid

                                                                                        @break



                                                                                    @default

                                                                                        Inquiry

                                                                                @endswitch

                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>Theme Number</th>

                                                                            <td>

                                                                                @switch($account->theme)

                                                                                    @case(1)

                                                                                        Theme 1

                                                                                        @break



                                                                                    @case(2)

                                                                                        Theme 2

                                                                                        @break



                                                                                    @default

                                                                                        Theme 3

                                                                                @endswitch    

                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>Theme Color</th>

                                                                            <td>{{$account->color}}</td>

                                                                        </tr> 

                                                                        <tr>

                                                                            <th>Charge in %</th>

                                                                            <td>{{$account->charge}}</td>

                                                                        </tr>

                                                                    </thead>

                                                                </table>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                @if($account->id != 1)
                                                    <a href="{{url("admin/domainAffiliateLedger/".$account->id)}}">
                                                        <i class="mdi mdi-eye btn btn-outline-warning" title="View Ledger"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$key+1}}</td>
                                            <td><img src="{{URL::asset($account->logo)}}" class="d-flex align-self-end" height="20"></td>
                                            <td onclick='newPopup("{{ url("admin/accountDetail/".$account->id) }}")' style='cursor:pointer'>{{$account->title}}</td>
                                            <td>{{$account->domain}}</td>
                                            <td>{{$account->phone}}</td>
                                            <td>
                                                @switch($account->status)



                                                    @case(1)

                                                        

                                                        <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active
                                                        <a href="{{ url('admin/user_action/'.$account->id.'/0') }}" class='btn btn-danger btn-sm' onclick="return confirm('Are you sure want to Dactivate?')">Dactivate</a>
                                                    @break



                                                    @default

                                                    

                                                        <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive
                                                        <a href="{{ url('admin/user_action/'.$account->id.'/1') }}" class='btn btn-primary btn-sm' onclick="return confirm('Are you sure want to activate?')">Activate</a>
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @elseif(Session::get('userType')==3)
                              
                                @foreach ($accountList as $key=>$account)
                                    <tr>
                                        @if($delete == 1 || $view == 1 || $edit == 1 || $viewLedger == 1 )
                                            <td>
                                                <!--Delete Popup-->
                                                @if($delete == 1)
                                                    @if($account->id != 1)

                                                            <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$account->id}}" title="Delete this data"></i>



                                                            <div class="modal fade deletePopup{{$account->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                                <div class="modal-dialog modal-dialog-centered">

                                                                    <div class="modal-content">

                                                                        <div class="modal-header">

                                                                            <h5 class="modal-title mt-0">{{$account->title}}</h5>

                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                                        </div>

                                                                        <div class="modal-body">

                                                                            <p>Are you sure want to delete this?</p>

                                                                        </div>

                                                                        <div class="modal-footer">

                                                                            {{ Form::open(array('url' => 'admin/account/' . $account->id)) }}

                                                                            {{ Form::hidden('_method', 'DELETE') }}

                                                                                <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                                            {{ Form::close() }}

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>


                                                        @endif
                                                    @endif

                                                <!--Edit Icon-->
                                                @if($edit == 1)
                                                    <a href="{{ URL::to('admin/account/' . $account->id . '/edit') }}">

                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>

                                                    </a>
                                                @endif

                                                <!--Detals Popup-->
                                                @if($view == 1)
                                                    <i class="mdi mdi-account-card-details btn btn-outline-dark" data-toggle="modal" data-target=".detailsPopup{{$account->id}}" title="View more data"></i>

                                                    <div class="modal fade detailsPopup{{$account->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">

                                                            <div class="modal-content">

                                                                <div class="modal-header">

                                                                    <h5 class="modal-title mt-0">{{$account->title}}</h5>

                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                                </div>

                                                                <div class="modal-body">

                                                                    <table id="datatable" class="table table-bordered">

                                                                        <thead>
                                                                            <tr>
                                                                                <th>Email</th>
                                                                                <td>{{$account->email}}</td>
                                                                            </tr>
                                                                            <tr>

                                                                                <th>Domain Name</th>

                                                                                <td>{{$account->domain}}</td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>WhatsApp Number</th>

                                                                                <td>{{$account->whatsApp}}</td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>Address</th>

                                                                                <td>{{$account->address}}</td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>Default Currency</th>

                                                                                <td>

                                                                                    {{$account->currency->title}}

                                                                                </td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>Website Type</th>

                                                                                <td>

                                                                                    @switch($account->type)

                                                                                        @case(1)

                                                                                            E-Commerce

                                                                                            @break



                                                                                        @case(2)

                                                                                            Hybrid

                                                                                            @break



                                                                                        @default

                                                                                            Inquiry

                                                                                    @endswitch

                                                                                </td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>Theme Number</th>

                                                                                <td>

                                                                                    @switch($account->theme)

                                                                                        @case(1)

                                                                                            Theme 1

                                                                                            @break



                                                                                        @case(2)

                                                                                            Theme 2

                                                                                            @break



                                                                                        @default

                                                                                            Theme 3

                                                                                    @endswitch    

                                                                                </td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>Theme Color</th>

                                                                                <td>{{$account->color}}</td>

                                                                            </tr> 

                                                                            <tr>

                                                                                <th>Charge in %</th>

                                                                                <td>{{$account->charge}}</td>

                                                                            </tr>

                                                                        </thead>

                                                                    </table>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                @endif

                                                @if($viewLedger == 1)
                                                    @if($account->id != 1)
                                                            <a href="{{url("admin/domainAffiliateLedger/".$account->id)}}">
                                                                <i class="mdi mdi-eye btn btn-outline-warning" title="View Ledger"></i>
                                                            </a>
                                                    @endif
                                                @endif
                                            </td>
                                        @endif
                                        <td>{{$key+1}}</td>
                                        <td><img src="{{URL::asset($account->logo)}}" class="d-flex align-self-end" height="20"></td>
                                        <td>{{$account->title}}</td>
                                        <td>{{$account->domain}}</td>
                                        <td>{{$account->phone}}</td>                                        
                                        <td>
                                            @switch($account->status)
                                                @case(1)
                                                    <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active
                                                @break
                                                @default
                                                    <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive
                                            @endswitch
                                        </td>                                      
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
    function newPopup(url) {
      var myWindow = window.open(url+"?ph=true", "_top ", "width=880,height=600");
    }
    </script>
@endsection