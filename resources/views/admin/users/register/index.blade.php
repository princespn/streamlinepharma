@extends('layouts.app')

@section('pageTitle')

    <!--
    <div class="float-right">
        <a href="{{route('register.create')}}" class="btn btn-outline-light">
            Add User
        </a>
    </div>
    -->
    
    <h4 class="page-title"> <i class="dripicons-list"></i> Register Users listing</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Phone</th>
                                @if(in_array('Membership and Scheme',$array))
                                    <th>Membership</th>
                                @endif
                                @if(in_array('Referral',$array))
                                <th>Referral </th>
                                @endif
                                @if(in_array('Last Order',$array))
								<th>Last Order Day</th>
                                @endif
                                @if(in_array('Last Login',$array))
								<th>Last Login</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registerList as $key=>$register)
                                <tr>
                                    <td onclick="custPopup('{{route('customerDetail',$register->id)}}')">{{$register->phone}}</td>
                                    @if(in_array('Membership and Scheme',$array))
									<td></td>
                                    @endif
                                    @if(in_array('Referral',$array))
									<td></td>
                                    @endif
                                    @if(in_array('Last Order',$array))
									<td>{{$register->latestOrder() }}</td>
                                    @endif
                                    @if(in_array('Last Login',$array))
                                    <td>{{ $register->last_login_at }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
<script>
    function custPopup(url) {
      var myWindow = window.open(url+"?ph=true", "_top ", "width=880,height=600");
    }
    </script>
@endsection