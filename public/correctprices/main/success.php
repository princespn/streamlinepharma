<?php include "check_user.php"; ?>
<?php include "include/db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "include/header-script.php"; ?>
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
                        
                        
                        
                        <div class="row">
						    <div class="col-lg-12">
							     <div class="card" style='min-height:500px'>
                                    <div class="card-body">
                                        <div class="alert alert-success" role="alert">
											Your payment has been processed successfully and your plan has been activated.<br>
											<a href='dashboard.php'>Click here</a> to upload your files for analysis.
										</div>
                                    </div>
                                </div>
							</div>
						</div>
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2020 -<?php echo date("Y"); ?> Correct Prices LLC. All rights reserved. </p>
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
