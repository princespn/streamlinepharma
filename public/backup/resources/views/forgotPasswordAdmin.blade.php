<!DOCTYPE html>

<html>



<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>UandC::Forgot Password</title>



    <!-- App Icons -->

    <link rel="shortcut icon" href="assets/images/favicon.ico">



    <!-- App css -->

    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />

    <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>



    <!-- Loader -->

    <div id="preloader">

        <div id="status">

            <div class="spinner"></div>

        </div>

    </div>



    <!-- Begin page -->

    <div class="accountbg"></div>

    <div class="wrapper-page">

        <div class="card">

            <div class="card-body">
                <script>
                    function changePassword() {
                
                        var enteredOTP = document.getElementById("enteredOTP").value;
                        var enteredPassword = document.getElementById("enteredPassword").value;
                        var generatedOTP = document.getElementById("generatedOTP").value;
                        var csrfToken= document.getElementById("csrfToken").value;

                        if(enteredOTP == '') {

                            alert("enter OTP");

                        } else if(enteredOTP != generatedOTP) {

                            alert("OTP not match!");

                        } else if(enteredPassword == '') {
                            
                            alert("enter password");

                        } else {
                            
                            const param = {"password":enteredPassword};

                            jQuery.ajax({
                                url: "forgotPasswordAdminUpdate",
                                type: "POST",
                                headers: {
                                    'X-CSRF-TOKEN':csrfToken,
                                    'Accept' : 'application/json',
                                    'Content-Type' : 'application/json'
                                },
                                data: JSON.stringify({data : param}),
                                success: function(data)
                                {
                                    window.location.replace("/admin");
                                }
                            });
                        }
                    }
                </script>

                <div class="p-3">

                    <h4 class="text-muted font-18 m-b-5 text-center">Forgot Password !</h4>

                    @if(Session::get('OTP'))

                            <div class="form-group">

                                <label>Enter OTP</label>

                                <input type="text" class="form-control" id="enteredOTP" placeholder="Enter OTP">

                            </div>

                            <div class="form-group">

                                <label>Enter Password</label>

                                <input type="password" class="form-control" id="enteredPassword" placeholder="Enter new password">

                            </div>

                            <div class="form-group row m-t-20">                            

                                <div class="col-sm-12 text-right">

                                    <button type="button" class="btn btn-outline-primary" onclick="changePassword();">Change Password</button>
                                    <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
                                    <input type="hidden" id="generatedOTP" class="form-control" value="{{Session::get('OTP')}}" required required/>
                    
                                </div>

                            </div>

                            <div class="form-group m-t-10 mb-0 row">

                                <div class="col-12 m-t-20">
                                    <a href="/admin" class="text-muted"><i class="mdi mdi-lock"></i> Login to panel</a>
                                </div>

                            </div>

                    @else

                        {!! Form::open(['route' => 'forgotPasswordAdminSubmit','method'=>'POST','id'=>'form','class'=>'form-horizontal m-t-30']) !!}

                        {{ csrf_field() }}

                            <div class="form-group">

                                <label>Mobile Number</label>

                                <input type="text" class="form-control" name="phone" placeholder="Enter mobile number">

                            </div>

                            <div class="form-group row m-t-20">                            

                                <div class="col-sm-12 text-right">

                                    <button type="submit" class="btn btn-outline-primary">Send OTP</button>

                                </div>

                            </div>

                            <div class="form-group m-t-10 mb-0 row">

                                <div class="col-12 m-t-20">
                                    <a href="/admin" class="text-muted"><i class="mdi mdi-lock"></i> Login to panel</a>
                                </div>

                            </div>

                        {!! Form::close() !!} 
                    @endif
                </div>



            </div>

        </div>



        <div class="m-t-40 text-center">

           <p>All rights reserved : Unique And Common © 2020</p>

        </div>

    </div>


    



    <!-- jQuery  -->

    <script src="../../assets/js/jquery.min.js"></script>

    <script src="../../assets/js/popper.min.js"></script>

    <script src="../../assets/js/bootstrap.min.js"></script>

    <script src="../../assets/js/modernizr.min.js"></script>

    <script src="../../assets/js/waves.js"></script>

    <script src="../../assets/js/jquery.slimscroll.js"></script>

    <script src="../../assets/js/jquery.nicescroll.js"></script>

    <script src="../../assets/js/jquery.scrollTo.min.js"></script>



    <!-- App js -->

    <script src="../../assets/js/app.js"></script>



</body>



</html>