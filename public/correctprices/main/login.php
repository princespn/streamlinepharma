<?php include "include/db.php"; 
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>
	<link rel="icon" type="image/png" href="favicon.png">

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <meta name="google-signin-client_id" content="554538854796-1ol4jvkqte1ddapophfsm69rovlg9294.apps.googleusercontent.com">
	<style>
	.abcRioButton.abcRioButtonLightBlue{
		width:100% !important;
	}
	a:link {
	 color: blue;
		font-weight: bold;
	}
	a:visited {
	 color: purple;
		font-weight: bold;
	}
	</style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
						<?php if(isset($_SESSION['msg'])){ ?>
						<hr>
						<div class="alert alert-success" role="alert">
							<?= $_SESSION['msg'] ?>
						</div>
						<?php unset($_SESSION['msg']);} ?>
                        <div class="login-logo">
                            <h3>Access your Account</h3>
                        </div>
                        <div class="login-form">
                            <form action="#" method="post" onsubmit="return loginFn();">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email"  id="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" id="password" placeholder="Password" required>
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                <div class="social-login-content" style="width: 100%;">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20" type='button' onclick='showFacebookLogin()'>sign in with facebook</button>
                                        <div class="g-signin2" data-onsuccess="onSignIn"></div>
                                         
									
                                    </div>
                                </div>
                            </form>
                            <div>
                                <p>
                                    Don't have an account?
                                    <a href="register.php">Sign Up Here</a><br>
                                    Need to Reset Password?
									<a href="reset_pass.php">Click Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script>
	    function onSignIn(googleUser) {
		  var profile = googleUser.getBasicProfile();
		  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
		  console.log('Name: ' + profile.getName());
		  console.log('Image URL: ' + profile.getImageUrl());
		  console.log('Email: ' + profile.getEmail());
			googleUser.disconnect();
		  $.ajax({
                    url:"query.php",
                    type:'POST',
					data : "name="+profile.getName()+"&id="+profile.getId()+"&profile="+profile.getImageUrl()+"&email="+profile.getEmail()+"&login_type=google&type=google_login",
                    success:function(data){
                        window.location.href = "dashboard.php";
                    }
            });
		}
		
		
	</script>
	
	
	
	

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '3651731784940199',
      cookie     : true,
      xfbml      : true,
      version    : 'v8.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
   function checkLoginState() {
	  FB.getLoginStatus(function(response) {
		  
		statusChangeCallback(response); 
	  });
	}
   function statusChangeCallback(response){
	   console.log(response);
   }
   
   function showFacebookLogin(){
	   FB.login(function(response) {
		  if (response.authResponse) {
			 console.log('Welcome!  Fetching your information.... ');
			 FB.api('/me?fields=email,name', function(response) {
			   console.log(response.email); 
			   console.log(response);
			   /************************************/
			     $.ajax({
                    url:"query.php",
                    type:'POST',
					data : "name="+response.name+"&id="+response.id+"&profile=&email="+response.email+"&login_type=facebook&type=facebook_login",
                    success:function(data){
                        window.location.href = "dashboard.php";
                    }
                });
			   /************************************/
			   
			   
			 });
			} else {
			 console.log('User cancelled login or did not fully authorize.');
			}
		},{
			scope: 'email',
			return_scopes: true
		});
   }
   
   
   function loginFn(){
	   /************************************/
			    $.ajax({
                    url:"query.php",
                    type:'POST',
					data : "email="+$("#email").val()+"&type=login&password="+$("#password").val(),
                    success:function(data){
                        if(data!='Logged In!'){
							alert(data);
						}else{
							window.location.href = "dashboard.php";
						}
                    }
                });
				return false;
	   /************************************/
   }
</script>
</body>

</html>
<!-- end document-->