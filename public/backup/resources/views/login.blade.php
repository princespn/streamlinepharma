<!DOCTYPE html>

<html>



<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>UandC::Login</title>



    <!-- App Icons -->

    <link rel="shortcut icon" href="assets/images/favicon.ico">



    <!-- App css -->

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

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



                {{-- <h3 class="text-center m-0">

                    <a href="/" class="logo logo-admin"><img src="assets/images/logo_dark.png" height="30" alt="logo"></a>

                </h3> --}}



                <div class="p-3">

                    <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>

                    <p class="text-muted text-center">Sign in to continue to uandc.</p>



                    {!! Form::open(['route' => 'logIn','method'=>'POST','id'=>'form','class'=>'form-horizontal m-t-30']) !!}

                    {{ csrf_field() }}



                        <div class="form-group">

                            <label>Mobile Number</label>

                            <input type="text" class="form-control" name="phone" placeholder="Enter mobile number">

                        </div>



                        <div class="form-group">

                            <label>Password</label>

                            <input type="password" class="form-control" name="password" placeholder="Enter password">

                        </div>



                        <div class="form-group row m-t-20">                            

                            <div class="col-sm-12 text-right">

                                <button type="submit" class="btn btn-outline-primary">Log In</button>

                            </div>

                        </div>



                        <div class="form-group m-t-10 mb-0 row">

                            <div class="col-12 m-t-20">

                                <a href="{{route('forgotPasswordAdmin')}}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>

                            </div>

                        </div>

                    {!! Form::close() !!} 

                </div>



            </div>

        </div>



        <div class="m-t-40 text-center">

           <p>All rights reserved : Unique And Common © 2020</p>

        </div>



    </div>





    <!-- jQuery  -->

    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/popper.min.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/modernizr.min.js"></script>

    <script src="assets/js/waves.js"></script>

    <script src="assets/js/jquery.slimscroll.js"></script>

    <script src="assets/js/jquery.nicescroll.js"></script>

    <script src="assets/js/jquery.scrollTo.min.js"></script>



    <!-- App js -->

    <script src="assets/js/app.js"></script>



</body>



</html>