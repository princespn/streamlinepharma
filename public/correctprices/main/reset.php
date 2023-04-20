
<?php include "include/db.php"; 
session_start(); ?>
<?php
if($_GET['key'] && $_GET['reset'])
{
  $email=$_GET['key'];
  $pass=$_GET['reset'];
  $select=mysqli_query($conn, "select email,password from users where md5(email)='$email' and md5(password)='$pass'");
  if(mysqli_num_rows($select)==1)
  {
    ?>
<html lang="en">

<head>
    <?php include "include/header-script.php"; ?>
	<title>Reset Password</title>
	<link rel="icon" type="image/png" href="favicon.png">
</head>
	
<body class="animsition">
    <div class="page-wrapper">
        <?php //include "include/left-menu.php"; ?>

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <?php include "include/header.php"; ?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        <div class="row m-t-25">
						    <div class='col-lg-12'>
                                <div class="card">
									<div class="card-header">
										<h4>Create New Password</h4>
									</div>
									<div class="card-body">
										
										<?php if(isset($_SESSION['msg'])){ ?>
										<hr>
										<div class="alert alert-success" role="alert">
											<?= $_SESSION['msg'] ?>
										</div>
									    <?php unset($_SESSION['msg']);} ?>
                                        <form method="post" action="submit_new.php">
										  <input type="hidden" name="email" value="<?php echo $email;?>">
										  <p>Enter New Password</p>
										  <input class="au-input au-input--full" type="password" name="password">
										  <input class="au-btn au-btn--block au-btn--blue m-b-20 m-t-5" type="submit" name="submit_password">
										</form>
                                    </div>
								</div>
							</div>
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2021 Correct Prices LLC. All rights reserved. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <?php include "include/footer-script.php"; ?>
</body>

</html>
<?php
  }
}
?>