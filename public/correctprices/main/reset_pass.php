
<?php include "include/db.php"; 
session_start();
?>
<!DOCTYPE html>
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
										<h4>Reset Password</h4>
									</div>
									<div class="card-body">
										
										<?php if(isset($_SESSION['msg'])){ ?>
										<hr>
										<div class="alert alert-success" role="alert">
											<?= $_SESSION['msg'] ?>
										</div>
									    <?php unset($_SESSION['msg']);} ?>
                                        <form method="post" action="send_link.php">
										  <p>Enter Email Address To Send Password Link</p>
										  <input class="au-input au-input--full" type="text" name="email">
										  <input class="au-btn au-btn--block au-btn--blue m-b-20 m-t-5" type="submit" name="submit_email">
										</form>
                                    </div>
								</div>
							</div>
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2021 -<?php echo date("Y"); ?> Correct Prices LLC. All rights reserved. </p>
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
<!-- end document-->
