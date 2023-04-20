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
    <title>Register</title>
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
	<style>
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
                        <div class="login-logo">
                            <h3>Registration</h3>
                        </div>
                        <div class="login-form">
                            <form action="" method="post" onsubmit="return RegisterFn();">
                                <div class="form-group">
                                    <label>Store ID</label>
                                    <input class="au-input au-input--full" type="text" name="name" id="name" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" id="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" id="password" placeholder="Password" required>
                                </div>
								<div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="au-input au-input--full" type="password" name="password_confirm" id="password_confirm" placeholder="Confirm Password" required>
                                </div>
                                <div class="login-checkbox">
									<p>
                                        <input type="checkbox" name="aggree" required> Agree to the <a id="tc" href="tandc.php" target="_blank" style="cursor: pointer;" >terms and conditions</a> of use
									</p>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
                                
                            </form>
                            <div>
                                <p>
                                    Already have an account?
                                    <a href="login.php">Sign In Here</a>
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

    <!-- Main JS-->
    <script src="js/main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
	   function RegisterFn(){
		      /************************************/
			    $.ajax({
                    url:"query.php",
                    type:'POST',
					data : "name="+$("#name").val()+"&id=&profile=&email="+$("#email").val()+"&login_type=website&type=registration&password="+$("#password").val()+"&passwordconf="+$("#password_confirm").val(),
                    success:function(data){
                        alert(data);
						if(data=='User registered successfully.'){
							window.location.href = "dashboard.php";
						}
                    }
                });
				return false;
			   /************************************/
	   }
		
		function tandc(){
			$("#tc").css('color', 'purple');
			
		}
		
	</script>
</body>

</html>
<!-- end document-->