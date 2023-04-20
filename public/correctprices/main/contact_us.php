
<?php include "include/db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "include/header-script.php"; ?>
	<title>Contact Us</title>
	<link rel="icon" type="image/png" href="favicon.png">
	<link href='https://fonts.googleapis.com/css?family=Courier Prime' rel='stylesheet'>
	<style>
	.container-fluid {
		font-family: 'Courier Prime';
	}
	</style>
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
										<h4>Contact Us</h4>
									</div>
									<div class="card-body">
                                        <hr>
										<?php if(isset($_SESSION['msg'])){ ?>
										<div class="alert alert-success" role="alert">
											<?= $_SESSION['msg'] ?>
										</div>
									    <?php unset($_SESSION['msg']);} ?>
                                        <form action="query.php" method="post">
                                            <div class="form-group">
                                                <label for="email" class="control-label mb-1">Your Email Address</label>
                                                <input id="email" name="email" type="email" class="form-control"  required>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="subject" class="control-label mb-1">Subject</label>
                                                <input id="subject" name="subject" type="text" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="message" class="control-label mb-1">Message</label>
                                                <textarea id="message" name="message" type="text" class="form-control" rows='4' required></textarea>
                                            </div>
                                            
                                            <div>
											    <input type='hidden' name='type' value='contact_us_email'>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    Send
                                                </button>
                                            </div>
                                        </form>
                                    </div>
								</div>
							</div>
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2021-<?php echo date("Y"); ?> Correct Prices LLC. All rights reserved. </p>
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
