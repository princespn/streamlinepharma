<ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($order_menu=='dashboard'): ?> active <?php endif; ?>" id="dashboard-tab" href="<?php echo e(url('dashboard')); ?>"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link <?php if($order_menu=='wallet'): ?> active <?php endif; ?>" id="orders-tab"  href="<?php echo e(url('wallet')); ?>"><i class="fi-rs-shopping-bag mr-10"></i>Wallet</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($order_menu=='orders'): ?> active <?php endif; ?>" id="orders-tab"  href="<?php echo e(url('orders')); ?>"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($order_menu=='address'): ?> active <?php endif; ?>" id="address-tab"  href="<?php echo e(url('my-address')); ?>"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($order_menu=='my-schemes'): ?> active <?php endif; ?>" id="my-schemes-tab"  href="<?php echo e(url('my-schemes')); ?>"><i class="fi-rs-marker mr-10"></i>My Scheme</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($order_menu=='account'): ?> active <?php endif; ?>" id="account-detail-tab" href="<?php echo e(url('account-detail')); ?>"><i class="fi-rs-user mr-10"></i>Account details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(url('logout')); ?>"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                        </li>
                                    </ul><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/layout/dashboard_menu.blade.php ENDPATH**/ ?>