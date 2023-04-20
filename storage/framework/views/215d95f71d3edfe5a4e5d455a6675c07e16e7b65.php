<?php $categoryList = App\Models\Category::where('account_id' , $account->id)->whereNull('ref_id')->whereNull('deleted_at')->get() ?>
<header class="header-area header-style-1 header-height-2">
        <!--div class="mobile-promotion">
            <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
        </div-->
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li><a href="<?php echo e(url('about')); ?>">About Us</a></li>
                                <li><a href="<?php echo e(url('dashboard')); ?>">My Account</a></li>
                                <li><a href="<?php echo e(url('orders')); ?>">Order Tracking</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class='header-info'>
						   <?php if(Session::get('delivery_location')): ?>
							   <strong>Deliver To  <?php echo e(Session::get('delivery_location')); ?></strong>
						   <button class='btn btn-danger btn-xs' data-bs-toggle="modal" data-bs-target="#deliveryAddressModal">Change</button>
						   <?php else: ?>
							   <button class='btn btn-danger btn-xs' data-bs-toggle="modal" data-bs-target="#deliveryAddressModal">Enter Pincode</button>
						   <?php endif; ?>
						   <!-------------------->
						   
<!--<div class="modal delivery_address_modal" id="deliveryAddressModal">
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
</div>-->
<!----------------->
                        </div>    
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>Need help? Call Us: <strong class="text-brand"> <?php echo e($account->phone); ?></strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url($account->logo)); ?>" alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="<?php echo e(url('shop')); ?>">
                                <select class="select-active">
                                    <option value=''>All Categories</option>
									<?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e(url('shop/'.$category->id)); ?>'><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <input type="text" placeholder="Search for items..." name='search' />
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                
                                
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="<?php echo e(url('cart')); ?>">
                                        <img alt="Nest" src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-cart.svg')); ?>" />
                                        <span class="pro-count blue"><?php echo e(count($cartList)); ?></span>
                                    </a>
                                    <a href="<?php echo e(url('/cart')); ?>"><span class="lable">Cart</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
										<?php $cart_total = 0; ?>
										<?php $__currentLoopData = $cartList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href="<?php echo e(url('product-detail/'.$item->product->sku)); ?>"><img alt="Nest" src="<?php echo e($item->product->thumbnail); ?>" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="shop-product-right.html"><?php echo e(substr($item->product->title,0,15)); ?></a></h4>
                                                    <h4><span><?php echo e($item->qty); ?> × </span><?php echo e(number_format($item->product->selling_price,2)); ?></h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
											<?php $cart_total += $item->qty*$item->product->selling_price; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span><?php echo e(number_format($cart_total,2)); ?></span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="<?php echo e(url('/cart')); ?>" class="outline">View cart</a>
                                                <a href="<?php echo e(url('/checkout')); ?>">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-action-icon-2">
                                    
									<?php if(Session::get('register')): ?>
									<a href="page-account.html">
                                        <img class="svgInject" alt="Nest" src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-user.svg')); ?>" />
                                    </a>
									<a href="<?php echo e(url('dashboard')); ?>"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="<?php echo e(url('dashboard')); ?>"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                            </li>
											<li>
                                                <a href="<?php echo e(url('wallet')); ?>"><i class="fi fi-rs-book-alt mr-10"></i>Wallet</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(url('orders')); ?>"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(url('my-address')); ?>"><i class="fi fi-rs-label mr-10"></i>Saved Address</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(url('account-detail')); ?>"><i class="fi fi-rs-heart mr-10"></i>Account Details</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(url('logout')); ?>"><i class="fi fi-rs-heart mr-10"></i>Logout</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
									<?php else: ?>
										<a href="<?php echo e(url('login')); ?>">
                                        <img class="svgInject" alt="Nest" src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-user.svg')); ?>" />
                                        </a>
									<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php if((!isset($categoryIcon)&&$account->home_page=='7')||($account->home_page!='7')): ?>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url($account->logo)); ?>" alt="logo" /></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="<?php echo e(url('/')); ?>">Home</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('about')); ?>">About Us</a>
                                    </li>
									<li>
                                        <a href="<?php echo e(url('contact')); ?>">Contact Us</a>
                                    </li>
									
                           
									<?php $__currentLoopData = $dynamic_menu_auth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li>
									   <?php if($row->category!=Null): ?>
									     <a href="<?php echo e(url('shop/'.$row->category)); ?>"><?php echo e($row->cat->name); ?> <i class="fi-rs-angle-down"></i></a>
									     <ul class="sub-menu">
										    <?php if($row->sub_category!=Null): ?>
												<?php $sub = App\Models\DynamicMenu::where('category' , $row->category)->get(); ?>
												<?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sum_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												   <li><a href="<?php echo e(url('shop/'.$row->category.'/'.$sum_row->sub_category)); ?>"><?php echo e($sum_row->sub_cat->name); ?> <i class="fi-rs-angle-right"></i></a>
													<ul class="level-menu">
													  <?php $set = App\Models\DynamicMenu::where('sub_category' , $sum_row->sub_category)->get(); ?>
														<?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sum_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														  <li><a href="<?php echo e(url('shop/'.$row->category.'/'.$sum_row->sub_category.'/'.$sum_row->setting)); ?>"><?php echo e($sum_row->template->name); ?></a></li>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</ul>
												   </li>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										    <?php endif; ?>
											<?php if($row->sub_category==Null): ?>
												<?php $sub = App\Models\DynamicMenu::where('category' , $row->category)->whereNull('sub_category')->get(); ?>
											    
												<?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sum_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												     <li><a href="<?php echo e(url('shop/'.$row->category.'/0/'.$sum_row->setting)); ?>"><?php echo e($sum_row->template->name); ?></a></li>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												
											<?php endif; ?>
										 </ul>
								       <?php endif; ?>
									   <?php if($row->category==Null&&$row->sub_category!=Null): ?>
									     <a href="<?php echo e(url('shop/0/'.$row->sub_category)); ?>"><?php echo e(($row->sub_cat ? $row->sub_cat->name:'')); ?> <i class="fi-rs-angle-down"></i></a>
									      <ul class="sub-menu">
										    
												  <?php $set = App\Models\DynamicMenu::where('sub_category' , $sum_row->sub_category)->get(); ?>
											        <?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sum_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													  <li><a href="<?php echo e(url('shop/0/'.$row->sub_category.'/'.$sum_row->setting)); ?>"><?php echo e($sum_row->template->name); ?></a></li>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										 </ul>
								       <?php endif; ?>
									   <?php if($row->category==Null&&$row->sub_category==Null&&$row->setting!=Null): ?>
									     <a href="<?php echo e(url('shop/0/0/'.$row->setting)); ?>"><?php echo e(($row->template ? $row->template->name:'')); ?> </a>
								       <?php endif; ?>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php if($account->offer_page_title!=Null): ?>
									<li>
                                        <a href="<?php echo e(url('offer')); ?>"><?php echo e($account->offer_page_title); ?></a>
                                    </li>	
									<?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-flex">
                        <img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-headphone.svg')); ?>" alt="hotline" />
                        <p><?php echo e($account->phone); ?><span>24/7 Support Center</span></p>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <!--div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="Nest" src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-heart.svg')); ?>" />
                                    <span class="pro-count white">4</span>
                                </a>
                            </div-->
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="#">
                                    <img alt="Nest" src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-cart.svg')); ?>" />
                                    <span class="pro-count white"><?php echo e(count($cartList)); ?></span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <?php $cart_total = 0; ?>
										<?php $__currentLoopData = $cartList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href="shop-product-right.html"><img alt="Nest" src="<?php echo e($item->product->thumbnail); ?>" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="shop-product-right.html"><?php echo e(substr($item->product->title,0,15)); ?></a></h4>
                                                    <h4><span><?php echo e($item->qty); ?> × </span><?php echo e(number_format($item->product->selling_price,2)); ?></h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
											<?php $cart_total += $item->qty*$item->product->selling_price; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span><?php echo e(number_format($cart_total,2)); ?></span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="<?php echo e(url('/cart')); ?>">View cart</a>
                                            <a href="<?php echo e(url('/checkout')); ?>">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php else: ?>
		<div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container-fluid">
			  <div class='row mobile_home_7' style='box-shadow: 0 2px 5px rgb(0 0 0 / 7%);'>
			    <div class='col-2'>
				   <img src='<?php echo e(url($account->logo)); ?>' width='80'>
				</div>
			    <div class='col-8'>
				     <form action="<?php echo e(url('shop')); ?>">
					      <input type="text" style='height: 40px;margin-bottom: 20px;' placeholder="Search for items..." name='search' />
                     </form>
				</div>
				<div class='col-2'>
				   <a class="mini-cart-icon" href="<?php echo e(url('cart')); ?>">
                        <img alt="Nest" style='margin-top:6px' src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-cart.svg')); ?>" />
                        <span class="pro-count blue"><?php echo e(count($cartList)); ?></span>
                    </a>
				</div>
			  </div>
			  <div class='row' style='padding:10px'>
			    <?php $__currentLoopData = $categoryIcon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				  <div class='col-3 col-md-1' style='text-align:center;'>
				    <a href='<?php echo e($icon->link); ?>'>
						<img src='<?php echo e($icon->icon); ?>' width='120'><br>
						<strong><?php echo e($icon->title); ?></strong>
					</a>
				  </div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  </div>
		    </div>
		</div>
		<?php endif; ?>
    </header>
	<div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url($account->logo)); ?>" alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="<?php echo e(url('shop')); ?>">
                        <input type="text" placeholder="Search for items…" name='search' />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li>
                                        <a href="<?php echo e(url('/')); ?>">Home</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('about')); ?>">About Us</a>
                                    </li>
									<li>
                                        <a href="<?php echo e(url('contact')); ?>">Contact Us</a>
                                    </li>
								

                                    <?php $__currentLoopData = $dynamic_menu_auth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li>
									   <?php if($row->category!=Null): ?>
									     <a href="<?php echo e(url('shop/'.$row->category)); ?>"><?php echo e($row->cat->name); ?> <i class="fi-rs-angle-down"></i></a>
									     <ul class="sub-menu">
										    <?php if($row->sub_category!=Null): ?>
												<?php $sub = App\Models\DynamicMenu::where('category' , $row->category)->get(); ?>
												<?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sum_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												   <li><a href="<?php echo e(url('shop/'.$row->category.'/'.$sum_row->sub_category)); ?>"><?php echo e($sum_row->sub_cat->name); ?> <i class="fi-rs-angle-right"></i></a>
													<ul class="level-menu">
													  <?php $set = App\Models\DynamicMenu::where('sub_category' , $sum_row->sub_category)->get(); ?>
														<?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sum_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														  <li><a href="<?php echo e(url('shop/'.$row->category.'/'.$sum_row->sub_category.'/'.$sum_row->setting)); ?>"><?php echo e($sum_row->template->name); ?></a></li>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</ul>
												   </li>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										    <?php endif; ?>
											<?php if($row->sub_category==Null): ?>
												<?php $sub = App\Models\DynamicMenu::where('category' , $row->category)->whereNull('sub_category')->get(); ?>
											    
												<?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sum_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												     <li><a href="<?php echo e(url('shop/'.$row->category.'/0/'.$sum_row->setting)); ?>"><?php echo e($sum_row->template->name); ?></a></li>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												
											<?php endif; ?>
										 </ul>
								       <?php endif; ?>
									   <?php if($row->category==Null&&$row->sub_category!=Null): ?>
									     <a href="<?php echo e(url('shop/0/'.$row->sub_category)); ?>"><?php echo e(($row->sub_cat ? $row->sub_cat->name:'')); ?> <i class="fi-rs-angle-down"></i></a>
									      <ul class="sub-menu">
										    
												  <?php $set = App\Models\DynamicMenu::where('sub_category' , $sum_row->sub_category)->get(); ?>
											        <?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sum_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													  <li><a href="<?php echo e(url('shop/0/'.$row->sub_category.'/'.$sum_row->setting)); ?>"><?php echo e($sum_row->template->name); ?></a></li>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										 </ul>
								       <?php endif; ?>
									   <?php if($row->category==Null&&$row->sub_category==Null&&$row->setting!=Null): ?>
									     <a href="<?php echo e(url('shop/0/0/'.$row->setting)); ?>"><?php echo e(($row->template ? $row->template->name:'')); ?> </a>
								       <?php endif; ?>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                
                
               <!-- <div class="mobile-header-info-wrap">
                
                    <div class="single-mobile-header-info">
                        <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                    </div>
                </div>-->
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="#"><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-facebook-white.svg')); ?>" alt="" /></a>
                    <a href="#"><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-twitter-white.svg')); ?>" alt="" /></a>
                    <a href="#"><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-instagram-white.svg')); ?>" alt="" /></a>
                    <a href="#"><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-pinterest-white.svg')); ?>" alt="" /></a>
                    <a href="#"><img src="<?php echo e(url('Nest/assets/imgs/theme/icons/icon-youtube-white.svg')); ?>" alt="" /></a>
                </div>
                <!--<div class="site-copyright">Copyright 2022 © . All rights reserved. Powered by AliThemes.</div>-->
            </div>
        </div>
    </div><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/layout/header.blade.php ENDPATH**/ ?>