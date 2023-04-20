<?php include  "check_user.php"; ?>
<?php include  "../include/db.php"; ?>
<?php
if(isset($_GET['id'])){
	$ed_data = mysqli_fetch_assoc(mysqli_query($conn,"select * from subscription_plan where id = '".$_GET['id']."'"));
}
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
    <title>All Users</title>

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
                            <div class="col-lg-12">
							     <h2 class="title-1 m-b-25">Subscription Plan</h2>
                                <div class="card">
                                    <div class="card-body">
                                        <hr>
										<?php if(isset($_SESSION['msg'])){ ?>
										<div class="alert alert-success" role="alert">
											<?= $_SESSION['msg'] ?>
										</div>
									    <?php unset($_SESSION['msg']);} ?>
                                        <form action="query.php" method="post">
										    <div class="form-group">
                                                <label for="plan_name" class="control-label mb-1">Authorizing Salesperson - Plan</label>
                                                <input id="plan_name" name="plan_name" type="text" class="form-control"  required value='<?= ( isset($ed_data) ? $ed_data['plan_name'] : '' ) ?>' >
                                            </div>
                                            <div class="form-group">
                                                <label for="amount" class="control-label mb-1">Price</label>
                                                <input id="amount" name="amount" type="number" class="form-control"  required value='<?= ( isset($ed_data) ? $ed_data['amount'] : '' ) ?>'>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="validity" class="control-label mb-1">Payment Frequency (in months)</label>
                                                <input id="validity" name="validity" type="text" class="form-control" required value='<?= ( isset($ed_data) ? $ed_data['validity'] : '' ) ?>'>
                                            </div>
                                            
                                            <div>
											    <input type='hidden' value='subscription_plan' name='type'>
												<?php if(isset($ed_data)){ ?>
												<input type='hidden' value='<?= $_GET['id'] ?>' name='id'>
												<?php } ?>
                                                <button type="submit" class="btn btn-xs btn-info btn-block"><?= ( isset($ed_data) ? 'Update' : 'Create' ) ?> Plan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Subscription Plan List</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Plan Name</th>
                                                <th>Price</th>
                                                <th>Payment Cycle</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
										$query = mysqli_query($conn,"select * from subscription_plan");
										while($row = mysqli_fetch_assoc($query)){
										?>
                                            <tr>
                                                <td><?= $row['plan_name'] ?></td>
                                                <td><?= $row['amount'] ?></td>
                                                <td><?= $row['validity'] ?> month</td>
                                                <td>
												  <a href='subscription_plan.php?id=<?= $row['id'] ?>' class='btn btn-xs btn-primary'>Edit</a>
												  <a href='query.php?type=del_sb_pl&id=<?= $row['id'] ?>' class='btn btn-xs btn-danger'>Delete</a>
												</td>
                                            </tr>
										<?php } ?>
                                        </tbody>
                                    </table>
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

</body>

</html>
<!-- end document-->
