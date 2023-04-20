    
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
	<?php  if($_SESSION['login_type']=='google'){ ?>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script>
	      function onLoad() {
			  gapi.load('auth2', function() {
				gapi.auth2.init();
			  });
		  }
		  function signOut() {
			  onLoad();
			var auth2 = gapi.auth2.getAuthInstance();
			auth2.signOut().then(function () {
			  window.location.href = "logout.php";
			});
		  }
	</script>
	<?php } ?>