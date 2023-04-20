<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e($account->title); ?></title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(url($account->logo)); ?>" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(url('Nest/assets/css/plugins/animate.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('Nest/assets/css/main.css?v=5.3')); ?>" />
    <?php echo $__env->yieldContent('custom-css'); ?>
	<?php echo $__env->yieldPushContent('custom-css'); ?>
	<style>
	   .logo.logo-width-1 a img{
		   width:80px;
		   min-width:80px;
	   }
	   .newsletter .newsletter-inner img{
		   max-width: 100%;
		   right: 0;
		   top: 0;
		   height: -webkit-fill-available;
	   }
	   .delivery_address_modal small{
		   margin-top:5px;
		   margin-bottom:5px;
	   }
	   .delivery_address_card{
		   border-radius: 0px;
		   border: 1px solid grey;
	   }
	   .product-img.product-img-zoom a {
			/*min-height: 328px;*/
		}
		.product-content-wrap h2 a{
			max-width: 94ch;
			text-overflow: ellipsis;
			white-space: nowrap;
		}
		@media  only screen and (min-width : 991.5px) {
           .mobile_home_7{
		   display:none;
		   }
        }
		.address_footer label,.address_footer a{
		  width:100%;
		  text-align:center;
		  display: inline-block !important;
		}
		.address_footer .col-6 label,.address_footer .col-6 a{
		    background: -webkit-linear-gradient(top,#f7f8fa,#e7e9ec);
			box-shadow: 0 1px 0 rgb(255 255 255 / 60%) inset;
			color: #333;
			border: 1px solid grey;
			font-size: 10px;
			line-height: 5px;
		}
		.address_footer label.selected{
		    background: -webkit-linear-gradient(top,#f7f8fa,#e7e9ec);
			box-shadow: 0 1px 0 rgb(255 255 255 / 60%) inset;
			color: #333;
			border: 1px solid grey; 
			cursor: no-drop;
		}
		.address_footer .col-6 label:hover{
		        background: #d8dce0;
		}
	</style>


<!-- Hotjar Tracking Code for https://streamlinepharma.ltd/ -->
	<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:3366997,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</head>

<body>
    <?php echo $__env->make('FrontEndTheme.Nest.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <!--End header-->
    <?php echo $__env->yieldContent('page-content'); ?>
	<!---------------------------------->
	<div class="modal" id="address_modal">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Add Address</h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">
			<form id='add_address_form' method='post' action="<?php echo e(url('save_address')); ?>">
			<?php echo csrf_field(); ?>
			   <div class="form-group">
					<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
               </div>
			   <div class="form-group">
					<input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" required>
               </div>
			   <div class="form-group">
					<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
               </div>
			   <div class="form-group">
					<input type="text" class="form-control" id="landmark" placeholder="Enter Landmark" name="landmark" required>
               </div>
			   <div class="form-group">
					<input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required>
               </div>
			   <div class="form-group">
					<input type="text" class="form-control" id="zip" placeholder="Enter ZIP" name="zip" required>
               </div>
			   <div class="form-group">
					<input type="text" class="form-control" id="city" placeholder="Enter City" name="city" required>
               </div>
			   <div class="form-group">
					<input type="text" class="form-control" id="state" placeholder="Enter State" name="state" required>
               </div>
			   <div class="form-group">
					<input type="text" class="form-control" id="country" placeholder="Enter Country" name="country" required>
               </div>
			</form>
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
		    <input type="hidden" form="add_address_form" id="address_id"  name="address_id">
			<button form='add_address_form' id='add_address_form_btn' type="submit" class="btn btn-primary btn-sm">Add Address</button> 
			<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
		  </div>

		</div>
	  </div>
	</div>
    <?php echo $__env->make('FrontEndTheme.Nest.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <!-- Vendor JS-->
    <script src="<?php echo e(url('Nest/assets/js/vendor/modernizr-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/vendor/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/vendor/jquery-migrate-3.3.0.min.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/vendor/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/slick.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/jquery.syotimer.min.js')); ?>"></script>
	<script src="<?php echo e(url('Nest/assets/js/plugins/slider-range.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/waypoints.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/wow.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/perfect-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/magnific-popup.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/select2.min.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/counterup.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/jquery.countdown.min.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/images-loaded.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/isotope.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/scrollup.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/jquery.vticker-min.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/jquery.theia.sticky.js')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/plugins/jquery.elevatezoom.js')); ?>"></script>
    <!-- Template  JS -->
    <script src="<?php echo e(url('Nest/assets/js/main.js?v=5.3')); ?>"></script>
    <script src="<?php echo e(url('Nest/assets/js/shop.js?v=5.3')); ?>"></script>
	<?php echo $__env->yieldContent('custom-scripts'); ?>
	<?php echo $__env->yieldPushContent('custom-scripts'); ?>
	<script>
	function openAddressModal(type,id=null){
		$('#add_address_form')[0].reset();
		$("[name=address_id]").val('');
		if(type=='edit'){
			$('#add_address_form_btn').html('Update Address');
			var myKeyVals = { 
							  id      : id,
							  _token   : $('input[name=_token]').val(),
							}
			var saveData = $.ajax({
				  type: 'POST',
				  url: "<?php echo e(url('getAddress')); ?>",
				  data: myKeyVals,
				  dataType: "text",
				  success: function(data){ 
					 data = JSON.parse(data);
					 console.log(data);
					 $("#add_address_form [name=name]").val(data.name);
					 $("#add_address_form [name=mobile]").val(data.phone);
					 $("#add_address_form [name=email]").val(data.email);
					 $("#add_address_form [name=landmark]").val(data.landmark);
					 $("#add_address_form [name=address]").val(data.address);
					 $("#add_address_form [name=zip]").val(data.zipCode);
					 $("#add_address_form [name=city]").val(data.cityId);
					 $("#add_address_form [name=state]").val(data.stateId);
					 $("#add_address_form [name=country]").val(data.countryId);
					 $("[name=address_id]").val(id);
				  }
			});
			saveData.error(function(){ 
				alert('Something went wrong, please try after some time.');
			});
		}else{
			$('#add_address_form_btn').html('Add Address');
		}
		$('#address_modal').modal('show');
	}
	</script>
</body> 

</html><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/layout/layout.blade.php ENDPATH**/ ?>