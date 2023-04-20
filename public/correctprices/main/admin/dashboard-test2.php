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
	<style>
	.error-mb{
		border:1px solid red;
		padding:5px;
		border-radius:5px;
		cursor: pointer;
	}
	.success-mb{
		border:1px solid green;
		padding:5px;
		border-radius:5px;
		cursor: pointer;
	}
	.error{
		color:red;
		font-weight:bold;
	}
	.success{
		color:green;
		font-weight:bold;
	}
	input[type=file]{
		display:none;
	}
	.notransition {
	  -webkit-transition: none !important;
	  -moz-transition: none !important;
	  -o-transition: none !important;
	  -ms-transition: none !important;
	  transition: none !important;
	}
	<?php if($user['plan_id']==0 || $user['plan_expiry']<date('Y-m-d H:i:s')){ ?>
	 .mb-3{
		 opacity:.2;
	 }
	<?php } ?>
	.btn-danger{
		background-color: red !important;
	}
	.status_progress_span{
		z-index: 999999999999999999;
		margin-left:5px;
		color:#fff;
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
										<h4>Upload Your Files Below</h4>
									</div>
									<form action='query.php' id="form_id_01" method='post' enctype="multipart/form-data">
									<div class="card-body">
									    <?php if(isset($_SESSION['msg'])){ ?>
										<div class="alert alert-success" role="alert">
											<?= $_SESSION['msg'] ?>
										</div>
									    <?php unset($_SESSION['msg']);} ?>
										<?php if($user['plan_id']==0){ ?>
										<div class="alert alert-error" role="alert" style='color:red;text-align:center'>
											An active subscription is required before uploading files for analysis. Please <a href='my_profile.php'>Click here</a> to select a subscription plan.
										</div>
										<?php } ?>
									    <div class='mb-3 <?= ( $num_records && $data['store_prices'] ? "success-mb" : "error-mb" ) ?> store_prices' onclick="triggerFile('store_prices')">
											<p class="muted">Upload Store Prices :</p>
											<div class="progress">
												<div class="progress-bar bg-success progress-bar-striped store_price progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="25"
												 aria-valuemin="0" aria-valuemax="100"></div>
												 <span class='status_progress_span' id='store_prices_status'></span>
												 <input type="file" id="store_prices" name="store_prices" class="form-control-file" style="opacity: 0;" onchange='showProgress("store_price","store_prices")'>
											</div>
											<p class="error store_prices_p"><?= ( !$num_records || !$data['store_prices'] ? "File Required" : ""  ) ?></p>
											<p class="success"><?= ( $num_records && $data['store_prices'] ? "File Uploaded ".date('m-d-Y H:i:s',strtotime($data['store_prices_date'])) : '' ) ?></p>
										</div>
										<div class='mb-3 <?= ( $num_records && $data['store_ads'] ? "success-mb" : "error-mb" ) ?> store_ads' onclick="triggerFile('store_ads')">
											<p class="muted">Upload Store Ad :</p>
											<div class="progress">
												<div class="progress-bar bg-success progress-bar-striped store_ad progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="25"
												 aria-valuemin="0" aria-valuemax="100"></div>
												 <span class='status_progress_span' id='store_ads_status'></span>
												 <input type="file" id="store_ads" name="store_ads" class="form-control-file" style="opacity: 0;" onchange='showProgress("store_ad","store_ads")'>
											</div>
											<p class="error store_ads_p"><?= ( !$num_records || !$data['store_ads'] ? "File Required" : ""  ) ?></p>
											<p class="success"><?= ( $num_records && $data['store_ads'] ? "File Uploaded ".date('m-d-Y H:i:s',strtotime($data['store_ads_date'])) : '' ) ?></p>
										</div>
										<div class='mb-3 <?= ( $num_records && $data['weekly_ads'] ? "success-mb" : "error-mb" ) ?> weekly_ads' onclick="triggerFile('weekly_ads')">
											<p class="muted">Upload Weekly Ad :</p>
											<div class="progress">
												<div class="progress-bar bg-success progress-bar-striped weekly_ad progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="25"
												 aria-valuemin="0" aria-valuemax="100"></div>
												 <span class='status_progress_span' id='weekly_ads_status'></span>
												 <input type="file" id="weekly_ads" name="weekly_ads" class="form-control-file" style="opacity: 0;" onchange='showProgress("weekly_ad","weekly_ads")'>
											</div>
											<p class="error weekly_ads_p"><?= ( !$num_records || !$data['weekly_ads'] ? "File Required" : ""  ) ?></p>
											<p class="success"><?= ( $num_records && $data['weekly_ads'] ? "File Uploaded ".date('m-d-Y H:i:s',strtotime($data['weekly_ads_date'])) : '' ) ?></p>
										</div>
										<div class='mb-3 <?= ( $num_records && $data['wholesale_price_books'] ? "success-mb" : "error-mb" ) ?> wholesale_price_books' onclick="triggerFile('wholesale_price_books')">
											<p class="muted">Upload Wholesale :</p>
											<div class="progress">
												<div class="progress-bar bg-success progress-bar-striped wholesale_price progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="25"
												 aria-valuemin="0" aria-valuemax="100"></div>
												 <span class='status_progress_span' id='wholesale_price_books_status'></span>
												 <input type="file" id="wholesale_price_books" name="wholesale_price_books" class="form-control-file" style="opacity: 0;" onchange='showProgress("wholesale_price","wholesale_price_books")'>
											</div>  
											<p class="error wholesale_price_books_p"><?= ( !$num_records || !$data['wholesale_price_books'] ? "File Required" : ""  ) ?></p>
											<p class="success"><?= ( $num_records && $data['wholesale_price_books'] ? "File Uploaded ".date('m-d-Y H:i:s',strtotime($data['wholesale_price_books_date'])) : '' ) ?></p>
										</div>
										<div class='mb-3 <?= ( $num_records && $data['exceptions'] ? "success-mb" : "error-mb" ) ?> exceptions' onclick="triggerFile('exceptions')">
											<p class="muted">Upload Exceptions  :</p>
											<div class="progress">
												<div class="progress-bar bg-success progress-bar-striped exceptions_l progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="25"
												 aria-valuemin="0" aria-valuemax="100"></div>
												 <span class='status_progress_span' id='exceptions_status'></span>
												 <input type="file" id="exceptions" name="exceptions" class="form-control-file" style="opacity: 0;" onchange='showProgress("exceptions_l","exceptions")'>
											</div>
											<p class="error exceptions_p"><?= ( !$num_records || !$data['exceptions'] ? "File Required" : ""  ) ?></p>
											<p class="success"><?= ( $num_records && $data['exceptions'] ? "File Uploaded ".date('m-d-Y H:i:s',strtotime($data['exceptions_date'])) : '' ) ?></p>
										</div>
										<div class='mb-3 <?= ( $num_records && $data['department_lists'] ? "success-mb" : "error-mb" ) ?> department_lists' onclick="triggerFile('department_lists')">
											<p class="muted">Upload Department List  :</p>
											<div class="progress">
												<div class="progress-bar bg-success progress-bar-striped department_list progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="25"
												 aria-valuemin="0" aria-valuemax="100"></div>
												 <span class='status_progress_span' id='department_lists_status'></span>
												 <input type="file" id="department_lists" name="department_lists" class="form-control-file" style="opacity: 0;" onchange='showProgress("department_list","department_lists")'>
											</div>
											<p class="error department_lists_p"><?= ( !$num_records || !$data['department_lists'] ? "File Required" : ""  ) ?></p>
											<p class="success"><?= ( $num_records && $data['department_lists'] ? "File Uploaded ".date('m-d-Y H:i:s',strtotime($data['department_lists_date'])) : '' ) ?></p>
										</div>
											<div style='text-align:center'>
											<input type='hidden' name='type' value='excel_upload'>
											<input type='button' value='Initiate The Analysis' class='btn btn-secondary btn-xl' disabled='disabled' id='submit_btn'  onclick="window.location.replace('query.php?type=analyze');" >
											</div>
									</div>
									</form>
									<div class="form-group" id="proces" style=" display:none;">
										<div class="progress">
											<div class="progress-bar progress-bar-striped active" role=" progressbar " aria-valuemin="0" aria-valuemax="100">
											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2020 Correct Prices LLC. All rights reserved. </p>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>
    <script>
	//@ketan
	$(document).ready(function(){
		$('#form_id_01').on('subtmit',function(event){
			event.preventDefault();
			var count_error = 0;
			if($('#store_prices').val()=='')
			{
				$('#store_prices_error').text('File Required');
				count_error++;
			}
			else
			{
				$('#store_prices_error').text('');
			}
			if($('#store_ads').val()=='')
			{
				$('#store_ads_error').text('File Required');
				count_error++;
			}
			else
			{
				$('#store_ads_error').text('');
			}

			if($('#weekly_ads').val()=='')
			{
				$('#weekly_ads_error').text('File Required');
				count_error++;
			}
			else
			{
				$('#weekly_ads_error').text('');
			}
			if(count_error == 0){
				$.ajax({
					url:"query.php",
					method:"POST",
					beforeSend:function()
					{
						$('#Initiate The Analysis').attr('disabled','disabled');
						$('#process').attr('display','block');
					},
					success: function(data)
					{
							var percentage = 0;
							var timer = setInterval(function(){
								percentage = percentage+20;
								progress_bar_process(percentage,timer);
							},1000);
					}
				})
			}
			else
			{
				return false;
			}

		});
		function progress_bar_process(percentage, timer){
			$('.progress-bar').css('width',percentage + '%');
			if(percentage > 100)
			{
				clearInterval(timer);
				$('form_id_01')[0].reset();
				$('process').css('display','none');
				$('progress-bar').css('width','0%');
				setTimeout(function(){

				},5000);
				


			}
		}
	});

	function showProgress(value,input_id){
		if($("."+value)[0]){ 
		    $("."+value).removeClass("notransition");
		}
			var fileInput =  
                document.getElementById(input_id); 
              
            var filePath = fileInput.value; 
            
            // Allowing file type 
            var allowedExtensions =  
                    /(\.csv|\.xls|\.xlsx)$/i; 
              
            if (!allowedExtensions.exec(filePath)) { 
                alert('Invalid file type'); 
                fileInput.value = ''; 
				$("."+value).css('width',"0%");
				$("."+input_id).addClass("error-mb");
				$("."+input_id).removeClass("success-mb");
				$("."+input_id+"_p").html("File Required");
                return false; 
            }else{
				$("."+input_id).addClass("success-mb");
				$("."+input_id).removeClass("error-mb");
				$("."+input_id+"_p").html('');
				/************************************/
				var file_data = $('#'+input_id).prop('files')[0];   
				var form_data = new FormData();                  
				form_data.append(input_id, file_data);
				//alert(form_data);                             
				$.ajax({
					xhr: function() {
						var xhr = new window.XMLHttpRequest();
						xhr.upload.addEventListener("progress", function(evt) {
							if (evt.lengthComputable) {
								var percentComplete = ((evt.loaded / evt.total) * 100);
								$("."+value).css('width',percentComplete+"%");
								//console.log(percentComplete+'%');
								if(percentComplete==100){
									$('#'+input_id+'_status').html("Saving file to server. This could take a few minutes...");
								}else{
									$('#'+input_id+'_status').html("Uploading "+Math.floor(percentComplete)+"%");
								}
								
							}
						}, false);
						return xhr;
					},
					url: 'query.php?type=ajax_file_upload&file_type='+input_id,   
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'post',
					success: function(data){
						console.log(data);
						$('#'+input_id+'_status').html("");
						var data = JSON.parse(data);
						console.log(data);
						if(data['error']==true){
							alert(data['message']);
						    $("."+value).css('width',"0%");
							$("."+input_id).addClass("error-mb");
				            $("."+input_id).removeClass("success-mb");
							if($("."+input_id+" .success").text()==''){
							  $("."+input_id+"_p").html("File Required");
							}
							$("#"+input_id).val('');
						}else{
							$("."+input_id+"_p").html('');
							$("."+value).addClass("notransition");
							$("."+input_id).removeClass("success-mb");
							$("."+value).css('width',"0%");
							$("."+input_id+" .success").text("File Uploaded "+data['message']);
							$("."+input_id).addClass("success-mb");
							$("#"+input_id).val('');
							if(data['analyze']==true){
								$("#submit_btn").removeAttr('disabled');
								$("#submit_btn").removeClass('btn-secondary');
		                        $("#submit_btn").addClass('btn-danger');
							}
						}
					}
				 });
			   /************************************/
			}
		
		
	}  
	 <?php
    $file =mysqli_query($conn,"select * from files where user_id = '".$_SESSION['id']."' 
												and store_prices          is not Null
												and store_ads             is not Null
												and weekly_ads            is not Null
												and exceptions            is not Null
												and department_lists      is not Null
												and wholesale_price_books is not Null
												");
	if(mysqli_num_rows($file)){
		?>
		$(document).ready(function(){
		  $("#submit_btn").removeAttr('disabled');
		  $("#submit_btn").removeClass('btn-secondary');
		  $("#submit_btn").addClass('btn-danger');
		});
		<?php
	}	 
	?>
	function triggerFile(id){
		<?php if($user['plan_id']!=0 && $user['plan_expiry']>date('Y-m-d H:i:s')){ ?>
		document.getElementById(id).click();
		<?php }else{ ?>
		//alert('An active subscription is required before uploading files for analysis. Please Click here to select a plan. ');
		<?php } ?>
	}
	</script>
</body>

</html>
<!-- end document-->
