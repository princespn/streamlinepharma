@extends('layouts.app')



@section('pageTitle')



    <div class="float-right">

        <a href="{{route('account.index')}}" class="btn btn-outline-light">

            Back

        </a>

    </div>

    <h4 class="page-title"> <i class="dripicons-user-group"></i> Edit account</h4>

    

@endsection



@section('contentData')



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

                    {{ Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}

                    {{ csrf_field() }}

                

                        <div class="row">



                            <div class="col-sm-12 col-md-12 col-lg-12">

                                @if($errors->any())

                                    <div class="alert bg-danger text-white msgPopup" role="alert">

                                    {{$errors->first()}}

                                    </div>

                                @endif

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Choose Logo</label>

                                    {{-- <input type="file" name="logo" class="form-control" style="font-size: 11px;"> --}}

                                    <input type="file" name="logo" class="filestyle" data-buttonname="btn-secondary" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Account Type</label>

                                    <select type="text" name="account_type" class="form-control" required>
									<option>Demand</option>
									<option>Supply</option>
									</select>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Title</label>

                                <input type="text" name="title" class="form-control" value="{{$account->title}}" required/>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Email</label>

                                    <input type="email" class="form-control" value="{{$account->email}}" required readonly/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Phone Number</label>

                                    <input type="number" class="form-control" value="{{$account->phone}}" required readonly/>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>WhatsApp Number</label>

                                    <input type="number" name="whatsApp" class="form-control" value="{{$account->whatsApp}}"/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Landmark</label>

                                    <input type="text" name="landmark" class="form-control" value="{{$account->landmark}}" required/>

                                </div>

                            </div>                            

                            <div class="col-sm-6 col-md-4 col-lg-6">

                                <div class="form-group">

                                    <label>Address</label>

                                    <input type="text" name="address" class="form-control" value="{{$account->address}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Pin Code</label>

                                    <input type="number" name="pinCode" class="form-control" value="{{$account->pinCode}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>SMS User Name</label>

                                    <input type="text" name="SMSUserName" class="form-control" value="{{$account->SMSUserName}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>SMS User Password</label>

                                    <input type="password" name="SMSUserPassword" class="form-control" value="{{$account->SMSUserPassword}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>SMS Sender Id</label>

                                    <input type="text" name="SMSUserSenderId" class="form-control" value="{{$account->SMSUserSenderId}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="form-group">

                                    <label>SMS Link</label>
                                    <input type="text" name="SMSApi" class="form-control" value="{{$account->SMSApi}}" required/>
                                    <span class="font-13 text-muted">
                                        1. http://nimbusit.co.in/api/swsendSingle.asp?username=setUsername&password=setPassword&sender=setSenderId&sendto=setPhone&message=setMessage&TemplateID=setTEMPLATEID
                                    </span> <br>
                                    <span class="font-13 text-muted">
                                        2. http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=setUsername&Password=setPassword&SenderID=setSenderId&Phno=setPhone&Msg=setMessage&TemplateID=setTEMPLATEID
                                    </span>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Instamojo Api Key</label>

                                    <input type="text" name="instamojoApiKey" class="form-control" value="{{$account->instamojoApiKey}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Instamojo Auth Token</label>

                                    <input type="text" name="instamojoAuthToken" class="form-control" value="{{$account->instamojoAuthToken}}" required/>

                                </div>

                            </div>


                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Shipyaari User Name</label>

                                    <input type="text" name="shipyaariUserName" class="form-control" value="{{$account->shipyaariUserName}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Shipyaari Client Code</label>

                                    <input type="number" name="shipyaariClientCode" class="form-control" value="{{$account->shipyaariClientCode}}" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Shipyaari Parent Code</label>

                                    <input type="number" name="shipyaariParentCode" class="form-control" value="{{$account->shipyaariParentCode}}" required/>

                                </div>

                            </div>
							<div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Shiprocket API Email</label>

                                    <input type="email" name="shiprocketEmail" class="form-control" value="{{$account->shiprocketEmail}}" required/>

                                </div>

                            </div>
							<div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Shiprocket API Password</label>

                                    <input type="password" name="shiprocketPassword" class="form-control" value="{{$account->shiprocketPassword}}" required/>

                                </div>

                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Select Default Shipping Method</label>

                                    <select name="defaultShippingMethod" class="form-control select2" value="{{$account->defaultShippingMethod}}" required>

                                        <option value=''></option>
                                        <option value='Shipyaari'>Shipyaari</option>
                                        <option value='Shiprocket'>Shiprocket</option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Select Default Currency</label>

                                    <select name="defaultCurrency" class="form-control select2" value="{{$account->defaultCurrency}}" required>

                                        @foreach ($currencyList as $key=>$currency)

                                            <option value="{{$currency->id}}" {{$currency->id == $account->defaultCurrency ? 'selected' : ''}}>{{$currency->title}}</option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Select Website Type</label>

                                    <select name="type" class="form-control select2" value="{{$account->type}}" required>

                                        <option value="">Select Website Type</option>

                                        <option value="1" {{$account->type == 1 ? 'selected' : ''}}>E-Commerce</option>

                                        <option value="2" {{$account->type == 2 ? 'selected' : ''}}>Hybrid</option>

                                        <option value="3" {{$account->type == 3 ? 'selected' : ''}}>Inquiry</option>

                                    </select>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Select Theme Number</label>

                                    <select name="theme" class="form-control select2" value="{{$account->theme}}" required>

                                        <option value="">Select Theme Number</option>

                                        <option value="1" {{$account->theme == 1 ? 'selected' : ''}}>1</option>

                                        <option value="2" {{$account->theme == 2 ? 'selected' : ''}}>2</option>

                                        <option value="3" {{$account->theme == 3 ? 'selected' : ''}}>3</option>

                                    </select>

                                </div>

                            </div>

                            

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Theme Color</label>

                                    <input type="text" name="color" class="colorpicker-default form-control" value="{{$account->color}}" required>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Domain Name</label>

                                    <input type="text" name="domain" class="form-control" value="{{$account->domain}}" required/>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Charge in %</label>

                                    <input type="number" name="charge" class="form-control" value="{{$account->charge}}" max="50" required/>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Password</label>

                                    <input type="password" name="password" class="form-control"/>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Select Status</label>

                                    <select name="status" class="form-control select2" value="{{$account->status}}" required>

                                        <option value="0" {{$account->status == 0 ? 'selected' : ''}}>Inactive</option>

                                        <option value="1" {{$account->status == 1 ? 'selected' : ''}}>Active</option>

                                    </select>

                                </div>

                            </div>



                            <div class="col-sm-12 col-md-12 col-lg-12">



                                <button type="submit" class="btn btn-outline-primary">

                                    Submit

                                </button>



                            </div>

                        </div>



                    {!! Form::close() !!} 



                </div>

            </div>

        </div>

    </div>



@endsection