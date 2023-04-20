<?php include  "check_user.php"; ?>
<?php include  "../include/db.php"; ?>
<?php
if(isset($_GET['id'])){
	$ed_data = mysqli_fetch_assoc(mysqli_query($conn,"select * from subscription_plan where id = '".$_GET['id']."'"));
}
$plan = mysqli_query($conn,"select * from subscription_plan");
?>
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
    <title>Enter Payment</title>

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

</head>

<body class="animsition">
    <div class="page-wrapper">
        <?php include "include/left-menu.php"; ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php include "include/header.php"; ?>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
						<div class="row">
						    <div class="col-lg-6">
							     <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Enter Received Non-PayPal Payments</h3>
                                        </div>
										
                                        <hr>
										<?php if(isset($_SESSION['msg'])){ ?>
										<div class="alert alert-success" role="alert">
											<?= $_SESSION['msg'] ?>
										</div>
									    <?php unset($_SESSION['msg']);} ?>
										<?php if(isset($_SESSION['xmsg'])){ ?>
										<div class="alert alert-danger" role="alert">
											<?= $_SESSION['xmsg'] ?>
										</div>
									    <?php unset($_SESSION['xmsg']);} ?>
                                        <form action="" method="post" onsubmit="return ExpFn();">
										    <div class="form-group">
                                                <label for="plan_name" class="control-label mb-1">Customer Email Address</label>
         <!-- change info in this line -->      <input id="email" name="email" type="text" class="form-control" > 
                                            </div>
                                            <div class="form-group">
                                                <!--<label for="item_name" class="control-label mb-1">Select Plan from Dropdown Menu Below</label>-->
                                                <select id="item_name" name="item_name" class="form-control" onchange='putDetail()' required>
												  <option value=''>Select the Purchased Plan</option>
											<?php
											while($row = mysqli_fetch_assoc($plan)){
											?>	
                                                    <option value='<?= $row['plan_name'] ?>' item_id='<?= $row['id'] ?>' pr='<?= $row['amount'] ?>' validity='<?= $row['validity'] ?>'><?= $row['plan_name'].' - $'.$row['amount'].' paid every '.$row['validity'].' months' ?></option>
                                            <?php } ?>											
												</select>  
                                            </div>
											<input type="hidden" name="item_number" id="item_number" value>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-xs btn-info btn-block">
                                                    <span id="payment-button-amount">Activate the Subscription</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
	
	<script>
		function ExpFn(){
		      /************************************/
			    $.ajax({
                    url:"expyqry.php",
                    type:'POST',
					data : "email="+$("#email").val(),
                    success:function(data){
						if(data=='User registered successfully.'){
							PayFn();
						}else{
							if(data=='Email address was not found in the customer records. Please try again.'){
								alert(data);
								window.location.href = "paid_plan.php";
							}else{
								if(confirm(data)){
									PayFn();
								}else{
									alert("This payment entry has been canceled.");
									window.location.href = "paid_plan.php";
								}
							}
						}
                    }
                });
				return false;
			   /************************************/
	   }
		
		function PayFn(){
		      /************************************/
			    $.ajax({
                    url:"payqry.php",
                    type:'POST',
					data : "item_number="+$("#item_number").val()+"&email="+$("#email").val(),
                    success:function(data){
						if(data=='User registered successfully.'){
							window.location.href = "paid_plan.php";
						}else{
							alert(data);
							window.location.href = "paid_plan.php";
						}
                    }
                });
				return false;
			   /************************************/
	   }
		
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
