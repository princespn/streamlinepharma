<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <title> <?php echo e($account->title); ?></title>

    <!-- Standard Favicon -->

    <link rel="icon" type="image/x-icon" href="<?php echo e(asset($account->logo)); ?>" />

    <!-- Library - Google Font Familys -->

    <link href="https://fonts.googleapis.com/css?family=Arizonia|Crimson+Text:400,400i,600,600i,700,700i|Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/theam1/revolution/css/settings.css')); ?>">

    <!-- RS5.0 Layers and Navigation Styles -->

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/theam1/revolution/css/layers.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/theam1/revolution/css/navigation.css')); ?>">

    <!-- Library - Bootstrap v3.3.5 -->

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/theam1/libraries/lib.css')); ?>">
    <!-- Custom - Common CSS -->

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/theam1/css/plugins.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/theam1/css/navigation-menu.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/theam1/css/shortcode.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/theam1/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/theam1/css/xzoom.css')); ?>">

    <link type="text/css" rel="stylesheet" media="all" href="<?php echo e(asset('assets/theam1/fancybox/source/jquery.fancybox.css')); ?>" />
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo e(asset('assets/theam1/magnific-popup/css/magnific-popup.css')); ?>" />

</head>
<body data-offset="200" data-spy="scroll" data-target=".ow-navigation"> <!--onload="cartList();"-->

    <div class="main-container">

        <!-- Loader -->

        <div id="site-loader" class="load-complete">

            <div class="loader">

                <div class="loader-inner ball-clip-rotate">

                    <div></div>

                </div>

            </div>

        </div>

        <!-- Loader /- -->



        <!-- Header -->

        <header class="header-section container-fluid no-padding">

            <!-- Top Header -->

            <div class="top-header container-fluid no-padding">

                <!-- Container -->

                <div class="container">

                    <div class="col-md-7 col-sm-7 col-xs-7 dropdown-bar">

                        <h5>Welcome To <?php echo e($account->title); ?></h5>

                        <!-- <div class="language-dropdown dropdown">

                            <button class="btn dropdown-toggle"><?php echo e($account->currency->title); ?></button>

                        </div> -->

                    </div>

                    <!-- Social -->

                    <div class="col-md-5 col-sm-5 col-xs-5 header-social">

                        <?php $socialList = App\Models\SocialMedia::where('account_id' , $account->id)->first() ?>

                        <ul>

                            <?php if($socialList && $socialList->facebook): ?>

                                <li><a href="<?php echo e($socialList->facebook); ?>" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>  

                            <?php endif; ?>



                            <?php if($socialList && $socialList->twitter): ?>

                                <li><a href="<?php echo e($socialList->twitter); ?>" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>  

                            <?php endif; ?>



                            <?php if($socialList && $socialList->googleplus): ?>

                                <li><a href="<?php echo e($socialList->googleplus); ?>" target="_blank" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>

                            <?php endif; ?>



                            <?php if($socialList && $socialList->instagram): ?>

                                <li><a href="<?php echo e($socialList->instagram); ?>" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>

                            <?php endif; ?>



                            <?php if($socialList && $socialList->pinterest): ?>

                                <li><a href="<?php echo e($socialList->pinterest); ?>" target="_blank" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>  

                            <?php endif; ?>



                            <?php if($socialList && $socialList->dribble): ?>

                                <li><a href="<?php echo e($socialList->dribble); ?>" target="_blank" title="Dribbble"><i class="fa fa-dribbble"></i></a></li>

                            <?php endif; ?>



                            <?php if($socialList && $socialList->vimeo): ?>

                                <li><a href="<?php echo e($socialList->vimeo); ?>" target="_blank" title="Vimeo"><i class="fa fa-vimeo"></i></a></li>

                            <?php endif; ?>



                            <?php if($socialList && $socialList->youtube): ?>

                                <li><a href="<?php echo e($socialList->youtube); ?>" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li> 

                            <?php endif; ?>

                        </ul>

                    </div><!-- Social /- -->

                </div><!-- Container /- -->

            </div><!-- Top Header /- -->



            <!-- Menu Block -->

            <div class="container-fluid no-padding menu-block">

                <!-- Container -->

                <div class="container">

                    <!-- nav -->

                    <nav class="navbar navbar-default ow-navigation">

                        <div class="navbar-header">

                            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">

                                <span class="sr-only">Toggle navigation</span>

                                <span class="icon-bar"></span>

                                <span class="icon-bar"></span>

                                <span class="icon-bar"></span>

                            </button>

                            <a href="/" class="navbar-brand"><img src="<?php echo e(asset($account->logo)); ?>" /></a>

                        </div>

                        <!-- Menu Icon -->

                        <div class="menu-icon">

                            <div class="search">

                                <a href="#" id="search" title="Search"><i class="icon icon-Search"></i></a>

                            </div>

                            <ul class="cart">

                                <li>

                                    <a aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="cart" class="btn dropdown-toggle" title="Add To Cart" href="#"><i class="icon icon-ShoppingCart"></i></a>

                                    <ul class="dropdown-menu no-padding">

                                        <?php if(!$cartList->isEmpty()): ?>

                                            <?php $__currentLoopData = $cartList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="mini_cart_item">
                                                <a href="#" class="shop-thumbnail">
                                                    <img class="attachment-shop_thumbnail" src="<?php echo e($item->cartInventory->imageURL0); ?>" style="height: 50px;">
                                                    <?php echo e(substr($item->cartInventory->productName,0,15)); ?>

                                                </a>
                                                <span class="quantity"><?php echo e($item->qty); ?> &#215; <span class="amount">Rs <?php echo e(number_format($item->inventoryPrice['sprice'],2)); ?></span></span>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <li class="button">
                                                <a href="<?php echo e(route('cartList')); ?>" title="View Cart">View Cart</a>

                                                <?php if(Session::get('register')): ?>
                                                    <a href="<?php echo e(route('checkOut')); ?>" title="Check Out">Check out</a>
                                                <?php endif; ?>
                                            </li>

                                        <?php else: ?>
                                            <li class="button">
                                                <h3>Your Basket is empty.</h3>
                                            </li>
                                        <?php endif; ?>
                                    </ul>

                                </li>
								<li>
                                    <span id="cartDisplay"></span>
                                    <?php if(Session::get('register')): ?>
                                    
                                        <a href="<?php echo e(route('orderList')); ?>" class="logo">
                                            Welcome <?php echo e(Session::get('register')->name); ?>

                                        </a>
                                        
                                        <a href="<?php echo e(route('logOutClick')); ?>" class="logo" style="color:#ec0000">
											Logout
										</a>
									<?php else: ?>
										<a href="<?php echo e(route('login')); ?>" title="User"><i class="icon icon-User"></i></a>
									<?php endif; ?>
                                </li>
                            </ul>

                        </div><!-- Menu Icon /- -->

                        <div class="navbar-collapse collapse navbar-right" id="navbar">

                            <ul class="nav navbar-nav">

                                <li class="active"><a href="/" title="Home">Home</a></li>

                             

                                <?php $categoryList = App\Models\Category::where('account_id' , $account->id)->where('level', 1)->where('status', 1)->with(['subCategory'=> function($query){ $query->with('subCategory'); }])->get() ?>

                                <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								
                                    <li class="dropdown">

                                        <a href="<?php echo e(route('product', array('leval' => 1 , 'ref_id' => $category->id))); ?>" title="Home" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo e($category->name); ?> </a>

                                        <i class="ddl-switch fa fa-angle-down"></i>

                                        

                                        <ul class="dropdown-menu">

                                            <?php $__currentLoopData = $category->subCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                                                <li class="active dropdown">

                                                    <a href="<?php echo e(route('product', array('leval' => 2 , 'ref_id' => $subCategory->id))); ?>" title="<?php echo e($subCategory->name); ?>"><?php echo e($subCategory->name); ?></a>

                                                    <?php if(count($subCategory->subCategory)>0): ?>
                                                    <ul class="dropdown-menu mega-menu">

                                                        <?php $__currentLoopData = $subCategory->subCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsubCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><a href="<?php echo e(route('product' , array('leval' => 3 , 'ref_id' => $subsubCategory->id) )); ?>" title="<?php echo e($subsubCategory->name); ?>"><?php echo e($subsubCategory->name); ?></a> </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </ul>
                                                    <?php endif; ?>


                                                </li>

                                                

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    

                                        </ul>

                                    </li>

                            

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                

                                <li><a href="<?php echo e(route('about')); ?>" title="About Us">About Us</a></li>

                                <li><a href="<?php echo e(route('contact')); ?>" title="Contact Us">Contact Us</a></li>

                            </ul>

                        </div>

                        <!--/.nav-collapse -->

                    </nav><!-- nav /- -->



                    <!-- Search Box -->

                    <div class="search-box">

                        <span><i class="icon_close"></i></span>

                        <?php echo Form::open(['route' => 'search','method'=>'get','id'=>'form','enctype'=>'multipart/form-data']); ?>

                        <?php echo e(csrf_field()); ?>

                            <input type="text" name="search" class="form-control" placeholder="Enter a keyword and press enter..." />

                        <?php echo Form::close(); ?> 

                    </div><!-- Search Box /- -->



                </div><!-- Container /- -->

            </div><!-- Menu Block /- -->

        </header>

        <!-- Header /- -->



        <main>

            <?php echo $__env->yieldContent('theme1Content'); ?>

        </main>



        <!-- Footer Main -->

        <footer id="footer-main" class="footer-main container-fluid">

            <!-- Container -->

            <div class="container">

                <div class="row">

                    <!-- Widget Links -->

                    <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_links">

                        <h3 class="widget-title">Information Link</h3>

                        <ul>

                            <li><a href="<?php echo e(route('about')); ?>" title="About Us">About Us</a></li>

                            <li><a href="<?php echo e(route('privacy')); ?>" title="Privacy Policy">Privacy Policy</a></li>

                            <li><a href="<?php echo e(route('shipping')); ?>" title="Shipping Policy">Shipping Policy</a></li>

                            <li><a href="<?php echo e(route('return')); ?>" title="Returns Policy">Returns Policy</a></li>

                        </ul>

                    </aside>

                    <!-- Widget Links /- -->



                    <!-- Widget Account -->

                    <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_links widget_account">

                        <h3 class="widget-title">My Account</h3>

                        <ul>

                            <li><a href="<?php echo e(route('address')); ?>" title="My Order Details">My Account</a></li>

                            <li><a href="<?php echo e(route('orderList')); ?>" title="My credit Offers">Order History</a></li>

                        </ul>

                    </aside>

                    <!-- Widget Account /- -->

                    

                    <!-- Widget Account -->

                    <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_links widget_account">

                        <h3 class="widget-title">Customer Service</h3>

                        <ul>

                            <li><a href="<?php echo e(route('contact')); ?>" title="My Order Details">Contact Us</a></li>

                            <li><a href="<?php echo e(route('term')); ?>" title="My credit Offers">Terms & Conditions</a></li>

                        </ul>

                    </aside>

                    <!-- Widget Account /- -->

                    

                    <!-- Widget About -->

                    <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_about">

                        

                        <div class="info">

                            <p><i class="icon icon-Pointer"></i><?php echo e($account->address); ?></p>

                            <p><i class="icon icon-Phone2"></i><a href="tel:<?php echo e($account->phone); ?>" title="Phone" class="phone"><?php echo e($account->phone); ?></a></p>

                            <p><i class="icon icon-Imbox"></i><a href="mailto:<?php echo e($account->email); ?>" title="<?php echo e($account->email); ?>"><?php echo e($account->email); ?></a></p>

                        </div>

                    </aside><!-- Widget About /- -->

                    

                </div>

                <div class="copyright-section">

                    <div class="coyright-content">

                        <p>All rights reserved : Unique And Common © 2020</p>

                    </div>

                </div>

            </div><!-- Container /- -->

        </footer>

        <!-- Footer Main /- -->



    </div>
    <!-- JQuery v1.12.4 -->

    <script src="<?php echo e(asset('assets/theam1/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/theam1/js/xzoom.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/theam1/js/setup.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/theam1/fancybox/source/jquery.fancybox.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/theam1/magnific-popup/js/magnific-popup.js')); ?>"></script>

    <!-- Library - Js -->

    <script src="<?php echo e(asset('assets/theam1/libraries/lib.js')); ?>"></script>



    <script src="<?php echo e(asset('assets/theam1/libraries/jquery.countdown.min.js')); ?>"></script>



    <!-- RS5.0 Core JS Files -->

    <script type="text/javascript" src="<?php echo e(asset('assets/theam1/revolution/js/jquery.themepunch.tools.min.js?rev=5.0')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('assets/theam1/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('assets/theam1/revolution/js/extensions/revolution.extension.video.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('assets/theam1/revolution/js/extensions/revolution.extension.slideanims.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('assets/theam1/revolution/js/extensions/revolution.extension.layeranimation.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('assets/theam1/revolution/js/extensions/revolution.extension.navigation.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('assets/theam1/revolution/js/extensions/revolution.extension.actions.min.js')); ?>"></script>



    <!-- Library - Theme JS -->

    <script src="<?php echo e(asset('assets/theam1/js/functions.js')); ?>"></script>
    <script src="<?php echo e(asset('cartManage/cart.js')); ?>"></script>
    
    <script>
        // $(document).ready(function(){

        //     $('.container').each(function(){  
        //         var highestBox = 0;

        //         $(this).find('.column').each(function(){
        //             if($(this).height() > highestBox){  
        //                 highestBox = $(this).height();  
        //             }
        //         })

        //         $(this).find('.column').height(highestBox);
        //     }); 
        // });
    </script>
    <script>
	   function checkMobile(){
		   $('.change_number_btn').removeClass('hide');
		   $('#pre_phone').attr('disabled',true);
		   $('.ajax_message_response').html('');
		   var mobile = $('#pre_phone').val();
		    $.ajax({
                    url:"<?php echo e(url('check_mobile')); ?>",
                    type:'GET',
					data : "mobile="+mobile,
                    success:function(data){
                        console.log(data);
						if(data.error==true){
							$('.pre_set_btn').addClass('hide');
							$('.new_login').removeClass('hide');
							$('.old_login').addClass('hide');
						}else{
							$('.pre_set_btn').addClass('hide');
							$('.new_login').addClass('hide');
							$('.old_login').removeClass('hide');
						}
                    }
            });
	   }
	   function resetLoginForm(){
		   $('.pre_set_btn').removeClass('hide');
		   $('.new_login').addClass('hide');
		   $('.old_login').addClass('hide');
		   $('#pre_phone').removeAttr('disabled',true);
		   $('.ajax_message_response').html('');
	   }
	   function checkLoginDetails(){
		   var pre_phone    = $('#pre_phone').val();
		   var old_password = $('#old_password').val();
		   $.ajax({
                    url:"<?php echo e(url('checkLoginDetails')); ?>",
                    type:'GET',
					data : "phone="+pre_phone+"&password="+old_password,
                    success:function(data){
                        console.log(data);
						if(data.error==true){
							$('.ajax_message_response').html(data.message);
						}else{
							location.reload();
							$('.ajax_message_response').html(data.message);
						}
                    }
            });
	   }
	   function proceedToOrderSummary(){
		     $('.delivery_summary').hide();
			 $('.delivery_address_header').css('background','#ec0000');
			 $('.order_summary').removeClass('hide'); 
	   }
	   function proceedToPaymentOption(){
		     $('.order_summary').addClass('hide');
			 $('.order_summary_header').css('background','#ec0000');
			 $('.payment_div_summary').removeClass('hide'); 
	   }
    </script>
</body>
</html><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/backup/resources/views/theams/theam1/layouts/app.blade.php ENDPATH**/ ?>