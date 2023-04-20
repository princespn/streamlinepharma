<footer class="main">
     <?php if($auth_home_page_lower_slide): ?>
		 <?php if($auth_home_page_lower_slide->link): ?> <a href='<?php echo e($auth_home_page_lower_slide->link); ?>'> <?php endif; ?>
        <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="position-relative newsletter-inner" style="background: url(<?php echo e($auth_home_page_lower_slide->image); ?>) no-repeat center;background-size: cover;">
                            <div class="newsletter-content">
                                <h2 class="mb-20">
								<?php echo e($auth_home_page_lower_slide->title1); ?>

                                <?php if($auth_home_page_lower_slide->title2): ?>								
								    <br />
                                    <?php echo e($auth_home_page_lower_slide->title2); ?>

								<?php endif; ?>
                                </h2>
                                <p class="mb-45"><?php echo e($auth_home_page_lower_slide->sub_title); ?> </p>
                                <!--form class="form-subcriber d-flex">
                                    <input type="email" placeholder="Your emaill address" />
                                    <button class="btn" type="submit">Subscribe</button>
                                </form-->
                            </div>
                            <!--img src="<?php echo e($auth_home_page_lower_slide->image); ?>" alt="newsletter" /-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<?php if($auth_home_page_lower_slide->link): ?> </a> <?php endif; ?>
	<?php endif; ?>
        <section class="featured section-padding">
            <div class="container">
                <div class="row">
				    <?php $__currentLoopData = $auth_banner_footer_slide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
					    <?php if($row->link): ?> <a href='<?php echo e($row->link); ?>'> <?php endif; ?>
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <div class="banner-icon">
                                <img src="<?php echo e($row->icon); ?>" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title"><?php echo e($row->title); ?></h3>
                                <p><?php echo e($row->subtitle); ?></p>
                            </div>
                        </div>
						<?php if($row->link): ?> </a> <?php endif; ?>
                    </div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </div>
            </div>
        </section>
        
<div class="modal delivery_address_modal" id="deliveryAddressModal">
  <div class="modal-dialog">
    <div class="modal-content">

      
      <div class="modal-header">
        <h4 class="modal-title">Choose your location</h4>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>


      <div class="modal-body">
	  <?php if(Session::get('register')): ?>
        <?php if(isset($loadAddress)): ?>
			<h6 style='text-align:center'>Select a delivery location to see product availability and delivery options<br></h6>
			<?php $__currentLoopData = $loadAddress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							        <div class="card delivery_address_card">
									  <div class="card-body">
									   <a href="<?php echo e(url('set_delivery_location/'.$row->zipCode)); ?>">
									      <strong style='font-size: 19px;'> <?php echo e($row->name); ?></strong><br>
										 <?php echo e($row->landmark); ?>, <?php echo e($row->cityId); ?><br>
										 <?php echo e($row->stateId); ?>, <?php echo e($row->countryId); ?>, <?php echo e($row->zipCode); ?><br>
										 Mo. <?php echo e($row->phone); ?> Email <?php echo e($row->email); ?>

											</a>	 
										 </div>
									</div>
							      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								  <br>
								  <a style='display: block;' href="<?php echo e(url('checkout')); ?>" class='btn btn-sm btn-xs'>Add an Address</a><br>
		<?php endif; ?>
		<?php else: ?>
			<a style='display: block;' href="<?php echo e(url('login')); ?>" class='btn btn-sm btn-xs'>Sign in to see your addresses</a>
		<?php endif; ?>
		<div class='a-divider a-divider-break a-spacing-top-base'>
		<hr>
		<h6 style='text-align:center'>or enter an Indian pincode</h6><br>
		<form action="<?php echo e(url('set_mannual_pincode')); ?>">
		  <div class='row'>
		    <div class='col-md-8'>
			  <input type='text' class='form-control' name='pincode'>
			</div>
			<div class='col-md-4'>
			  <button class='btn btn-primary'>Apply</button>
			</div>
		  </div>
		</form>
        </div>
      </div>

      

    </div>
  </div>
</div>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
					    <h4 class="widget-title">Contact</h4>
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <ul class="contact-infor">
                                <li><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-location.svg')); ?>" alt="" /><strong>Address: </strong> <span><?php echo e($account->address); ?></span></li>
                                <li><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-contact.svg')); ?>" alt="" /><strong>Call Us:</strong><span><?php echo e($account->phone); ?></span></li>
                                <li><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-email-2.svg')); ?>" alt="" /><strong>Email:</strong><span><?php echo e($account->email); ?></span></li>
                                <li><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-clock.svg')); ?>" alt="" /><strong>Hours:</strong><span>24*7</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12" >
                        <h4 class="widget-title">Information Link</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="<?php echo e(url('about')); ?>">About Us</a></li>
                            <li><a href="<?php echo e(url('privacy')); ?>">Privacy Policy</a></li>
                            <li><a href="<?php echo e(url('shipping-policy')); ?>">Shipping Policy</a></li>
                            <li><a href="<?php echo e(url('return-policy')); ?>">Returns Policy</a></li>
                            
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="<?php echo e(url('dashboard')); ?>">My Account</a></li>
                            <li><a href="<?php echo e(url('orders')); ?>">Order History</a></li>
							<?php $__currentLoopData = $dynamic_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dynamic_menu_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="#"><?php echo e($dynamic_menu_row->title); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <h4 class="widget-title">Customer Service</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="<?php echo e(url('contact')); ?>">Contact Us</a></li>
                            <li><a href="<?php echo e(url('term')); ?>">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
        </section>
        <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; <?php echo e(date('Y')); ?>, <strong class="text-brand"><?php echo e($account->title); ?></strong> <br />All rights reserved</p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                    
                    <div class="hotline d-lg-inline-flex">
                        <img src="<?php echo e(url('Nest/assets/imgs/theme/icons/phone-call.svg')); ?>" alt="hotline" />
                        <p><?php echo e($account->phone); ?><span>24/7 Support Center</span></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <h6>Follow Us</h6>
						<?php $socialList = App\Models\SocialMedia::where('account_id' , $account->id)->first() ?>
						
						<?php if($socialList && $socialList->facebook): ?>
						<a href="<?php echo e($socialList->facebook); ?>"><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-facebook-white.svg')); ?>" alt="" /></a>
					    <?php endif; ?>
                        <?php if($socialList && $socialList->twitter): ?>
						<a href="<?php echo e($socialList->twitter); ?>"><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-twitter-white.svg')); ?>" alt="" /></a>
						<?php endif; ?>
						<?php if($socialList && $socialList->googleplus): ?>
                        
					
					    <?php endif; ?>
                        <?php if($socialList && $socialList->instagram): ?>
                        <a href="<?php echo e($socialList->instagram); ?>"><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-instagram-white.svg')); ?>" alt="" /></a>
						<?php endif; ?>
                        <?php if($socialList && $socialList->pinterest): ?>
                        <a href="<?php echo e($socialList->pinterest); ?>"><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-pinterest-white.svg')); ?>" alt="" /></a>
					    <?php endif; ?>
                        <?php if($socialList && $socialList->youtube): ?>
                        <a href="<?php echo e($socialList->youtube); ?>"><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-youtube-white.svg')); ?>" alt="" /></a>
					    <?php endif; ?>
                    </div>
                    <p class="font-sm">Up to 15% discount on your first subscribe</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Preloader Start -->
    <!--div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="<?php echo e(url('Nest/assets/imgs/theme/loading.gif')); ?>" alt="" />
                </div>
            </div>
        </div>
    </div--><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/layout/footer.blade.php ENDPATH**/ ?>