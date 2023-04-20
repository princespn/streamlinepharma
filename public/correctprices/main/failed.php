<?php include "check_user.php"; ?>
<?php include "include/db.php"; ?>
<?php 
$data = mysqli_fetch_assoc(mysqli_query($conn,"select * from users where id = '".$_SESSION['id']."'"));
$plan = mysqli_query($conn,"select * from subscription_plan");
?>
<?php
define('PAYPAL_ID', 'service@correctprices.com'); 
define('PAYPAL_SANDBOX', false); //TRUE or FALSE 
define('PAYPAL_RETURN_URL', 'https://correctprices.com/success.php'); 
define('PAYPAL_CANCEL_URL', 'https://correctprices.com/failed.php'); 
define('PAYPAL_NOTIFY_URL', 'https://correctprices.com/responce.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 //var_dump($_REQUEST);
// Database configuration 
/*define('DB_HOST', 'MySQL_Database_Host'); 
define('DB_USERNAME', 'MySQL_Database_Username'); 
define('DB_PASSWORD', 'MySQL_Database_Password'); 
define('DB_NAME', 'MySQL_Database_Name');*/ 
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");

?>
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
                                        <div class="alert alert-error" role="alert">
											Oops! Looks like something went wrong.<br><a href='my_profile.php'>Click here</a> to go back and select your recurring subscription plan.
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
