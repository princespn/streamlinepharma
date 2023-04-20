<?php session_start(); ?>
<?php include "check_user.php"; ?>
<?php include "include/db.php"; ?>
<?php 
$last_file = mysqli_query($conn,"select * from files where user_id = '".$_SESSION['id']."'");
$num_records = mysqli_num_rows($last_file);
if($num_records){
	$data = mysqli_fetch_assoc($last_file);
}
$user = mysqli_fetch_assoc(mysqli_query($conn,"select * from users where id = '".$_SESSION['id']."'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "include/header-script.php"; ?> 
	<title>Download Report</title>
	<link rel="icon" type="image/png" href="favicon.png">
	<link href='https://fonts.googleapis.com/css?family=Courier Prime' rel='stylesheet'>
	<style>
	.card {
		font-family: 'Courier Prime';
	}
	td {
	 color: blue;
	}
	#progress-barr { 
      height: 20px;
      background: green; 
      width: 0px;
      text-align: left;
	  text-indent: 10px;
	  vertical-align: -10%;
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
									<!--<div class="card-header">
										<h4>My Downloads</h4>
									</div>--!>
									<div class="card-body">
									    
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
												    <tr>
													   <td><h3><u>DOWNLOAD REPORTS</u></h3>
													   </td>
													</tr>
													<tr>
													   <td><a class='store_prices' onclick="this.disabled=true;clickme()" style="cursor: pointer;" ><i class="fa fa-download"></i> Download your pricing error analysis report </a>
													   </td>
													</tr>
													<tr>
													   <td><a  class='tags' onclick="this.disabled=true;clicku()" style="cursor: pointer;" ><i class="fa fa-download"></i> Download your price tag list </a>
													   </td>
													</tr>
												<?php }else{ ?>
												    <tr><th colspan='6'>Prepare your report for download by first <a href="dashboard.php"><u>selecting and uploading</u></a> your price data.</th></tr>
												<?php } ?>
													<tr>
														<td><br><h3><u>DOWNLOAD FILES OR TEMPLATES</u></h3>
													   </td>
													</tr>
												<tr>
													   <td><a  class='exc' onclick= <?= ( $num_records && $data['exceptions'] ? "this.disabled=true;clickexc()" : "this.disabled=true;clicknoexc()" ) ?> style="cursor: pointer;" ><i class="fa fa-download"></i> Download your current exceptions file </a>
													   </td><br>
														<td><a  class='exctemp' onclick="this.disabled=true;clickexct()" style="cursor: pointer;" ><i class="fa fa-download"></i> Download the exceptions file template </a>
														</td>
													</tr>
													<tr>
													   <td><a  class='dpt' onclick= <?= ( $num_records && $data['department_lists'] ? "this.disabled=true;clickdpt()" : "this.disabled=true;clicknodpt()" ) ?> style="cursor: pointer;" ><i class="fa fa-download"></i> Download your current department list file </a>
													   </td><br>
														<td><a  class='dpttemp' onclick="this.disabled=true;clickdptt()" style="cursor: pointer;" ><i class="fa fa-download"></i> Download the department list file template </a>
														</td>
													</tr>
													<tr><td><br></td></tr>
												</tbody>
											</table>
											<div class="pppp" id="tst" >
												<div id="progress-barr" ></div>										
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
/**window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}**/
	var wdth=document.getElementById("progress-barr").style.width;
	$(document).ready(function(){
	getFIleStatus('department_lists');
	getFIleStatus('exceptions');
	getFIleStatus('store_ads');
	getFIleStatus('store_prices');
	getFIleStatus('weekly_ads');
	getFIleStatus('wholesale_price_books');
	});	
		
	function clickme() {
        //var div =$("<div id='progress-barr'></div>");
       // $("body").append(div);

		$('.store_prices').css('color', 'purple');
        $('#progress-barr').animate(
          {
            width: '100%'
          }, 
          {
            duration: 60000      
          }        
        );		
		var nVar=setTimeout(barText, 59000);
		window.location.href = "query.php?type=download_file&file_type=store_prices";
		var mVar = setInterval(redirc(mVar,nVar), 100);
      }
		
	function clicku() {
        //var div =$("<div id='progress-barr'></div>");
       // $("body").append(div);
		$('.tags').css('color', 'purple');
        $('#progress-barr').animate(
          {
            width: '100%'
          }, 
          {
            duration: 60000      
          }        
        );		
		var nVar = setTimeout(barText, 59000);
		window.location.href = "query.php?type=download_file&file_type=price_tags";
		var mVar = setInterval(redirc(mVar,nVar), 100);
      }
		
	function clickexc() {
        //var div =$("<div id='progress-barr'></div>");
       // $("body").append(div);
		$('.exc').css('color', 'purple');
        $('#progress-barr').animate(
          {
            width: '100%'
          }, 
          {
            duration: 60000      
          }        
        );		
		var nVar = setTimeout(barText, 59000);
		window.location.href = "query.php?type=download_file&file_type=Exceptions";
		var mVar = setInterval(redirc(mVar,nVar), 100);
      }	
	
	function clicknoexc() {
        alert("A current exceptions file cannot be downloaded until after your first price analysis has been run.  If you need to create an exceptions file, please download the exceptions file template.");
      }	
		
	function clickexct() {
        //var div =$("<div id='progress-barr'></div>");
       // $("body").append(div);
		$('.exctemp').css('color', 'purple');
        $('#progress-barr').animate(
          {
            width: '100%'
          }, 
          {
            duration: 60000      
          }        
        );		
		var nVar = setTimeout(barText, 59000);
		window.location.href = "query.php?type=download_file&file_type=ExcTemplate";
		var mVar = setInterval(redirc(mVar,nVar), 100);
      }	
		
	function clickdpt() {
        //var div =$("<div id='progress-barr'></div>");
       // $("body").append(div);
		$('.dpt').css('color', 'purple');
        $('#progress-barr').animate(
          {
            width: '100%'
          }, 
          {
            duration: 60000      
          }        
        );		
		var nVar = setTimeout(barText, 59000);
		window.location.href = "query.php?type=download_file&file_type=DeptList";
		var mVar = setInterval(redirc(mVar,nVar), 100);
      }	
		
	function clicknodpt() {
        alert("A current department list file cannot be downloaded until after your first price analysis has been run.  If you need to create a department list file, please download the department list file template.");
      }	
		
	function clickdptt() {
        //var div =$("<div id='progress-barr'></div>");
       // $("body").append(div);
		$('.dpttemp').css('color', 'purple');
        $('#progress-barr').animate(
          {
            width: '100%'
          }, 
          {
            duration: 60000      
          }        
        );		
		var nVar = setTimeout(barText, 59000);
		window.location.href = "query.php?type=download_file&file_type=DeptTemplate";
		var mVar = setInterval(redirc(mVar,nVar), 100);
      }	
		
	/*$(document).ready(function() {
			$('#progress-barr').stop();
			$('#progress-barr').width('100%');
		});	*/
		

	function redirc(mVar,nVar) {
		
		$.ajax({
		url: "query.php",
        type: "GET",
		dataType: 'json',
        contentType: false,
        processData: false,
        async: true,
        success: function (data) {
            console.log(data);
            if(data=='data'){
                setTimeout(endBar, 2000);
				clearInterval(mVar);
				clearTimeout(nVar);
            }
        }
    });
       /** url: "checker.php",
        type: "GET",
        contentType: false,
        processData: false,
        async: true,
        success: function (data) {
            console.log(data);
            if(data=='100'){
                setTimeout(endBar, 2000);
				clearInterval(mVar);
				clearTimeout(nVar);
            }
        }
    });	**/		
	}
		
	function endBar() {
		$('#progress-barr').stop();
		$('#progress-barr').width('100%');
		$("#progress-barr").css('color','white');
		$("#progress-barr").css("font-weight","Bold");
		$("#progress-barr").css("font-size",12);
		$("#progress-barr").text("Your downloaded file should be ready to open momentarily. There is also a copy in your Downloads folder.");
		setTimeout(clearBar, 30000);
	}
		
	function clearBar() {
		$('#progress-barr').stop();
		$('#progress-barr').width('0%');
		/**$("#progress-barr").css('color','white');
		$("#progress-barr").css("font-weight","Bold");
		$("#progress-barr").css("font-size",12);**/
		$("#progress-barr").text("");
	}
	
	function barText() {
		$("#progress-barr").css('color','white');
		$("#progress-barr").css("font-weight","Bold");
		$("#progress-barr").css("font-size",12);
		$("#progress-barr").text("Finalizing your report. This may take a few minutes...");
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
