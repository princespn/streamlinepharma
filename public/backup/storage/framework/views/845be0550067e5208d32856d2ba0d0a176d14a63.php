<?php $__env->startSection('theme1Content'); ?>

    <!-- Page Banner -->

    <div class="page-banner container-fluid no-padding">

        <!-- Container -->

        <div class="container">

            <div class="banner-content">

                <h3>Cart</h3>

            </div>

            <ol class="breadcrumb">

                <li><a href="/" title="Home">Home</a></li>

                <li class="active">Cart</li>

            </ol>

        </div><!-- Container /- -->

    </div><!-- Page Banner /- -->

    <!-- Cart -->

    <div class="woocommerce-cart container-fluid no-left-padding no-right-padding">
        <!-- Container -->
        <div class="container">
            <!-- Cart Table -->
            <div class="col-md-12 col-sm-12 col-xs-12 cart-table">
                <form>
                    <input type="hidden" value="<?php echo e(csrf_token()); ?>" id="csrfToken">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Item</th>
                                <th class="product-name">Product Name</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-unit-price">Unit Price</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <input type="hidden" value="<?php echo e(csrf_token()); ?>" id="csrfToken">

                            <?php 
                                $totalAmt = 0; 
                                $totalTax = 0;
                            ?>

                            <?php $__currentLoopData = $cartList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="cart_item">
                                    <td class="product-thumbnail"><img src="<?php echo e($item->cartInventory->imageURL0); ?>" style="height: 50px;"/></td>
                                    <td class="product-name" style="font-family: 'Montserrat', sans-serif;font-size: larger;">
                                        <?php echo e($item->cartInventory->productName); ?>

                                        
                                        <br>
                                        <?php if($item->cartInventory->payementOption == 2): ?>
                                            <span style="font-size:12px;">(Accept cod payment only)</span>
                                        <?php elseif($item->cartInventory->payementOption == 3): ?>
                                            <span style="font-size:12px;">(Accept online payment only)</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="product-quantity">
                                        <div class="prd-quantity" data-title="Quantity">
                                            <input value="-" class="qtyminus btn" data-field="quantity<?php echo e($item->id); ?>" type="button" onclick="updateCart(<?php echo e($item->id); ?>,0)">
                                            <input name="quantity<?php echo e($item->id); ?>" value="<?php echo e($item->qty); ?>" min="1" class="qty" type="text" id="qty<?php echo e($item->id); ?>" readonly>
                                            <input value="+" class="qtyplus btn" data-field="quantity<?php echo e($item->id); ?>" type="button" onclick="updateCart(<?php echo e($item->id); ?>,1)">
                                        </div>
                                        <h3 id="cartMSG<?php echo e($item->id); ?>"></h3>
                                    </td>
                                    <td data-title="Unit Price" class="product-unit-price">
                                        Rs <?php echo e(number_format($item->inventoryPrice['sprice'],2)); ?>

                                    </td>
                                    <td data-title="Total" class="product-subtotal">Rs <?php echo e(number_format(($item->inventoryPrice['sprice']) * ($item->qty),2)); ?></td>
                                    <td data-title="Remove" class="product-remove" onclick="removeProduct(<?php echo e($item->id); ?>);"><i class="icon icon-Delete"></i></td>
                                </tr>

                                <?php 
                                    $totalTax += ($item->qty * ($item->inventoryPrice->sprice * ($item->cartInventory->ProductTax['includeTax'] == 0 ? $item->cartInventory->ProductTax['tax'] : 0)/100));
                                    //$totalTax += (($item->inventoryPrice['sprice'] * $item->cartInventory->ProductTax['tax'] * $item->qty))/100;
                                    $totalAmt += $item->inventoryPrice['sprice'] * $item->qty;
                                ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php 
                                $grandTotal = $totalTax + $totalAmt;
                            ?>
                            
                            <!--
                            <tr>
                                <td class="action" colspan="6">
                                    <a href="#" title="Continue shopping">Continue shopping</a>
                                    <a href="#" title="update shopping cart">update shopping cart</a>
                                </td>
                            </tr>
                            -->
                        </tbody>
                    </table>
                </form>
            </div><!-- Cart Table /- -->
            
            <!-- Coupon -->
            <!--
                <div class="col-md-offset-4 col-md-4 col-sm-6 col-xs-6 coupon">
                <div class="coupon-box">
                    <h4>coupon code</h4>
                    <h6>If You Have A Coupon Code Enter Here</h6>
                    <form>
                        <input type="text" class="form-control" placeholder="Coupon Code" />
                        <input type="submit" value="apply code" />
                    </form>
                </div>
            </div>
            -->
            <!-- Coupon /- -->

            <div class="col-md-offset-8 col-md-4 col-sm-6 col-xs-6 cart-collaterals">
                <div class="cart_totals">
                    <h3>Cart totals</h3>
                    <table>
                        <tr>
                            <th>Sub Total</th>
                            <td>Rs <?php echo e(number_format($totalAmt,2)); ?></td>
                        </tr>
                        <tr>
                            <th>Tax</th>
                            <td>Rs <?php echo e(number_format($totalTax,2)); ?></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>Rs <?php echo e(number_format($grandTotal,2)); ?></td>
                        </tr>
                    </table>
                    <div class="wc-proceed-to-checkout">
                        <?php if(Session::get('register')): ?>
                        
                            <a href="<?php echo e(route('checkOut')); ?>" class="checkout-button button alt wc-forward">Proceed to Checkout</a>
                        
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="checkout-button button alt wc-forward">Proceed to Checkout</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div><!-- Container /- -->
    </div>

    <!-- Cart /- -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('theams/theam1/layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/backup/resources/views/theams/theam1/cartList.blade.php ENDPATH**/ ?>