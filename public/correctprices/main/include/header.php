<head>
	<link href='https://fonts.googleapis.com/css?family=Courier Prime' rel='stylesheet'>
	<style>
		img {
			padding-left: 400px;
		}
		#menu {
			font-size: 32px;			
		}
		.account-dropdown__item {
			font-family: 'Courier Prime';
		}
	</style>
</head> 
<!-- HEADER DESKTOP-->
            <header class="header-desktop" style="background:#071830;">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
							<img src="HeaderOval4.png" width="995" height="59">
					
						   <!--<h2></h2>
						       <!--ul class="nav">
								  <li class="nav-item">
									<a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"> </i> Dashboard</a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" href="my_profile.php"><i class="fas fa-user"> </i> My Account</a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" href="my_downloads.php"><i class="fas fa-file"> </i> My Downloads</a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" <!--?php if($_SESSION['login_type']=='google'){ ?> href="#" onclick="signOut();" <!--?php }else{ ?> href="logout.php" <!--?php } ?> ><i class="fas fa-tachometer-alt"> </i> Log Out</a>
								  </li>
								</ul-->
									<!--a class="js-arrow" href="dashboard.php">
										 Dashboard</a>
								
									<a class="js-arrow" href="dashboard.php">
										<i class="fas fa-tachometer-alt"> </i> My Profile</a>
								
									<a class="js-arrow" <!--?php if($_SESSION['login_type']=='google'){ ?> href="#" onclick="signOut();" <!--?php }else{ ?> href="logout.php" <!--?php } ?> >
										<i class="fas fa-tachometer-alt"> </i> Log Out</a-->
								
                            <!--form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form-->
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        
                                        <div class="content" style='display:block'>
                                            <a class="js-acc-btn" id="menu" style="color:white;font-family:'Courier Prime'" href="#">Menu</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown" style="background-color:white">
                                            
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="dashboard.php"  style="font-size: 16px; color:#071830;">
                                                        <i class="zmdi zmdi-money-box"></i> Upload Files</a>
                                                </div>
                                                
                                                <div class="account-dropdown__item">
                                                    <a href="my_downloads.php" style="font-size: 16px; color:#071830;">
                                                        <i class="zmdi zmdi-download"></i> Download Files</a>
                                                </div>
												
                                            </div>
                                            <div class="account-dropdown__footer">
												<div class="account-dropdown__item">
                                                    <a href="tutorial.php" style="font-size: 16px; color:#071830;">
                                                        <i class="zmdi zmdi-help-outline"></i> Tutorial</a>
                                                </div>
												<div class="account-dropdown__item">
                                                    <a href="my_profile.php" style="font-size: 16px; color:#071830;">
                                                        <i class="zmdi zmdi-account"></i> My Account</a>
                                                </div>
												<div class="account-dropdown__item">
                                                    <a href="contact_us.php" style="font-size: 16px; color:#071830;">
                                                        <i class="zmdi zmdi-email"></i> Contact Us</a>
                                                </div>
												<div class="account-dropdown__item">
                                                	<a style="font-size: 16px; color:#071830;" <?php if($_SESSION['login_type']=='google'){ ?> href="#" onclick="signOut();" <?php }else{ ?> href="logout.php" <?php } ?>>
                                                    	<i class="zmdi zmdi-power"></i> Logout</a>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
		<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>
        <script>
            function signOut() {
			window.onLoadCallback = function(){
                gapi.load('auth2', function() {
                    gapi.auth2.init().then(function(){
                        var auth2 = gapi.auth2.getAuthInstance();
                        auth2.disconnect().then(function () {
                            document.location.href = 'index.php';
                        });
                    });
                });
            };
			}
        </script>