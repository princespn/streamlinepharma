<?php include "check_user.php"; ?>
<?php include "include/db.php"; ?>
<?php 
$data = mysqli_fetch_assoc(mysqli_query($conn,"select users.*,subscription_plan.plan_name from users
left join subscription_plan on users.plan_id = subscription_plan.id
where users.id = '".$_SESSION['id']."' "));
$plan = mysqli_query($conn,"select * from subscription_plan");
?>
<?php
define('PAYPAL_ID', 'service@correctprices.com'); 
define('PAYPAL_SANDBOX', false); //TRUE or FALSE 
define('PAYPAL_RETURN_URL', 'https://correctprices.com/success.php'); 
define('PAYPAL_CANCEL_URL', 'https://correctprices.com/failed.php'); 
define('PAYPAL_NOTIFY_URL', 'https://correctprices.com/responce.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/":"https://www.paypal.com/cgi-bin/webscr");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "include/header-script.php"; ?>
	<link rel="icon" type="image/png" href="favicon.png">
	<title>My Account</title>
	<link href='https://fonts.googleapis.com/css?family=Courier Prime' rel='stylesheet'>
	<style>
	.container-fluid {
		font-family: 'Courier Prime';
	}
	a:link {
	 color: blue;
		font-weight: bold;
	}
	a:visited {
	 color: purple;
		font-weight: bold;
	}
	#dt {
		padding-bottom: 4px;
		}
	#pln {
		font-size: 22px;
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
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
										<table>
											<tr>
												<td>
													<div class="icon">
														<i class="zmdi zmdi-shopping-cart"></i>
													</div>
												</td>
												<td>
													<div class="text">
														<h2 style="font-size: 31px;"><?= ( $data['plan_id']=='' || $data['plan_expiry'] < date('Y-m-d H:i:s') ? "Inactive" : "Active -" ) ?></h2>
													</div>
													<div class="text">
														<h2 style="font-size: 31px;"><?= ( $data['plan_id']=='' || $data['plan_expiry'] < date('Y-m-d H:i:s') ? "" : "Annual Plan" ) ?></h2>     
													</div>
												</td>
											</tr>
										</table>
											<div class="text" style="color: white;"><br>Account Status</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2 style="font-size: 31px;" id="dt"><?= ( $data['plan_expiry']=='0000-00-00 00:00:00' || $data['plan_expiry']=='' || $data['plan_expiry'] == Null ? '&nbsp;' :  date('d M Y',strtotime($data['plan_expiry']))) ?></h2><br>
											</div>
											<div class="text">
                                                <span style="color: white;">Auto-renewal Date<br>Unless Canceled</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
						    <div class="col-lg-6">
							     <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Select or Update Subscription Plan</h3>
                                        </div>
                                        <hr>
                                        <form action="<?php echo PAYPAL_URL; ?>" method="post">
                                            <div class="form-group">
                                                <!--<label for="item_name" class="control-label mb-1">Select Plan from Dropdown Menu Below</label>-->
                                                <select id="item_name" name="item_name" class="form-control" onchange='putDetail()' required>
												  <option value=''>Select Your Plan</option>
											<?php
											while($row = mysqli_fetch_assoc($plan)){
											?>	
                                                    <option value='<?= $row['plan_name'] ?>' item_id='<?= $row['id'] ?>' pr='<?= $row['amount'] ?>' validity='<?= $row['validity'] ?>'><?= $row['plan_name'].' - $'.$row['amount'].' paid every '.$row['validity'].' months' ?></option>
                                            <?php } ?>											
												</select>  
                                            </div>
											<!------------------------------------------>
											<!-- Identify your business so that you can collect the payments -->
											<input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
											<!-- Specify a subscriptions button. -->
											<input type="hidden" name="cmd" value="_xclick-subscriptions">
											<!-- Specify details about the subscription that buyers will purchase -->
											<input type="hidden" name="item_number" id="item_number" value>
											<input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
											<input type="hidden" name="a3" id="paypalAmt" value>
											<input type="hidden" name="p3" id="paypalValid" value>
											<input type="hidden" name="t3" value="M">
											<!-- Set recurring payments until canceled. -->
   											<input type="hidden" name="src" value="1">

											<!-- Custom variable user ID -->
											<input type="hidden" name="custom" value="<?php echo $_SESSION['id']; ?>">
											<!-- Specify urls -->
											<input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
											<input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
											<input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
											<!------------------------------------------>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-xs btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Pay</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Transaction History</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Payment</th>
                                                <th>Plan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
										$tr = mysqli_query($conn,"select * from transactions where custom = '".$_SESSION['id']."'");$num = 1;
										if(mysqli_num_rows($tr)){
                                        while($tr_row = mysqli_fetch_assoc($tr)){
										?>
                                            <tr>
                                                <td><?= $num ?></td>
                                                <td><?= date("m-d-Y",strtotime($tr_row['created_at'])) ?></td>
                                                <td>$ <?= $tr_row['payment_amount'] ?> </td>
                                                <td>Annual with payments every <?= $tr_row['pay_months'] ?> months</td>
                                            </tr>
										<?php $num++;}}else{ ?>
										    <tr>
                                                <td colspan='4'>No Transactions Found.</td>
                                            </tr>
										<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <a href="tandc.php" target="_blank" style="cursor: pointer;">Terms and Conditions</a><br>
						<a href="privacy.php" target="_blank" style="cursor: pointer;">Privacy Policy</a><br>
						<a href="reset_pass.php" target="_blank" style="cursor: pointer;">Change Password</a>
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
    <script>
				function putDetail(){
					var item_id = jQuery('option:selected', "#item_name").attr('item_id');
					var price = jQuery('option:selected',  "#item_name").attr('pr');
					var validity = jQuery('option:selected',  "#item_name").attr('validity');
					document.getElementById("item_number").value = item_id;
					document.getElementById("paypalAmt").value = price;
					document.getElementById("payment-button-amount").innerHTML = "Pay $"+price;
					document.getElementById("paypalValid").value = validity;
				}
	</script>
</body>

</html>
<!-- end document-->
