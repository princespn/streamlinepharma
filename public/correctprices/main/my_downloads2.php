<?php include "check_user.php"; ?>
<?php include "include/db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="refresh" content="2;url=my_downloads.php" />
    <?php include "include/header-script.php"; ?> 
	<style>
	#progress-barr { 
      height: 20px;
      background: green; 
      width: 0px;
      text-align: center;
      border: none;
    }
	#progress-dun { 
      height: 20px;
      background: green; 
      width: 100%;
      text-align: center;
      border: none;
    }
    .pppp{
      width : 100%;
      background-color: #e0e0e0;
    }
	.notransition {
	  -webkit-transition: none !important;
	  -moz-transition: none !important;
	  -o-transition: none !important;
	  -ms-transition: none !important;
	  transition: none !important;
	}
	.custom_hid{
		display:none;
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
										<h4>My Downloads</h4>
									</div>
									<div class="card-body">
									    <?php if(isset($_SESSION['msg'])){ ?>
										<div class="alert alert-success" role="alert">
											<?= $_SESSION['msg'] ?>
										</div>
										<?php unset($_SESSION['msg']);} ?>
									    <div class="table-responsive table--no-card m-b-40">
											<table class="table table-borderless ">
												<!--<thead>
													<tr>
														<th>#</th>
														<th>File</th>
													</tr>
												</thead>-->
												<tbody>
												<?php 
												
												$analyzed_files =mysqli_query($conn,"select * from users where id = '".$_SESSION['id']."' and analyzed = 1");
												if(mysqli_num_rows($analyzed_files)){
												$file_data = mysqli_fetch_assoc($analyzed_files);
												
												?>
												    <tr class='store_prices'>
													   <td><a><i class="fa fa-download"></i> Download your report </a>
													   </td>
													</tr>
												<?php }else{ ?>
												    <tr><th colspan='6'>Prepare your report for download by first <a href="dashboard.php"><u>uploading and analyzing</u></a> your price data.</th></tr>
												<?php } ?>
																								
												</tbody>
											</table>
											<div class="pppp" id="tst" >
												<div id="progress-dun" ></div>										
											</div>
											<br>
										</div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	var wdth=document.getElementById("progress-barr").style.width;
	$(document).ready(function(){
	getFIleStatus('department_lists');
	getFIleStatus('exceptions');
	getFIleStatus('store_ads');
	getFIleStatus('store_prices');
	getFIleStatus('weekly_ads');
	getFIleStatus('wholesale_price_books');
	});
	
	/*var timer;
	var cnt = 0;
 
    // The function to refresh the progress bar.
    function refreshProgress() {
		
	// We use Ajax again to check the progress by calling the checker script.
      // Also pass the session id to read the file because the file which storing the progress is placed in a file per session.
      // If the call was success, display the progress bar.
      $.ajax({
        url: "checker.php?file=<?//php echo session_id() ?>",
        success:function(data){
          $("#progress-barr").width( data.percent + '%' ) //html('<div style="width:' + data.percent + '%"></div>');
          // If the process is completed, we should stop the checking process.
          if (data.percent == 100) {
            window.clearInterval(timer);
            timer = window.setInterval(completed, 1000);
          }
        }
      });
    }
		
	
	
	
 
    function completed() {
      window.clearInterval(timer);
    }
	var myFil="tmp/"+<?php echo session_id() ?>+".txt"; 
    // When the document is ready
    function clickme() {
		
      // Trigger the process in web server.
      //$.ajax({url: "query.php"});
      // Refresh the progress bar every 1 second.
		alert myFil;
      timer = window.setInterval(moveProgress, 1000);
    }
		
	function moveProgress() {
		var cntr = null;
		  var xmlhttp = new XMLHttpRequest();
		  xmlhttp.open("GET", myFil, true);
		  xmlhttp.send();
		  if (xmlhttp.status==200) {
			cntr = xmlhttp.responseText;
		  }
		$("#progress-barr").width( cntr + '%' );
	}*/
		
	function clickme(){
        //var div =$("<div id='progress-barr'></div>");
       // $("body").append(div);
        $('#progress-barr').animate(
          {
            width: '100%'
          }, 
          {
            duration: 240000      
          }        
        );
		window.location.href = "query.php?type=download_file&file_type=store_prices";
		//$('#progress-barr').stop();
		//$('#progress-barr').width('100%');
      }
	/**function movepb(wdth) {
		var elem = $("<div id='progress-barr'></div>");
		elem.style.width = wdth + "%";
	}**/
	   function getFIleStatus(file_name){
		      /************************************/
			    $.ajax({
                    url:"query.php",
                    type:'POST',
					data : "file_type="+file_name+"&type=download_file&sub_type=check_status",
                    success:function(data){
						console.log(data);
                        var data = JSON.parse(data);
						if(data['error']==true){
							$('.'+file_name).addClass('custom_hid');
						}else{
							$('.'+file_name).removeClass('custom_hid');
						}
                    }
                });
				return false;
			   /************************************/
	   }
	</script>
</html>
<!-- end document-->
