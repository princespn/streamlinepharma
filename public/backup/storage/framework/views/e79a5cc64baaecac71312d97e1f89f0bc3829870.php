<?php $__env->startSection('theme1Content'); ?>
<?php echo Form::open(['route' => 'confirmOrder','method'=>'POST','id'=>'formCheckOut','enctype'=>'multipart/form-data']); ?>

            <?php echo e(csrf_field()); ?>

<!-- Page Banner -->
<!--div class="page-banner container-fluid no-padding">
   <div class="container">
   
       <div class="banner-content">
   
           <h3>Login</h3>
   
       </div>
   
       <ol class="breadcrumb">
   
           <li><a href="/" title="Home">Home</a></li>
   
           <li class="active">Login</li>
   
       </ol>
   
   </div>
   
   </div--><!-- Page Banner /- -->
<style>
.hide{
	display:none;
}
.section-header{
	margin-bottom:0px !important;
}
.form-detail{
	margin-bottom:30px !important;
}
</style>
<!-- Login Section -->
<div class="contact-us container-fluid no-padding">
   <div class="row">
      <div class="col-md-6 col-sm-6 col-md-offset-1 col-xs-12 ">
         <div class="form-detail" style="
            padding-top: 23px;
            padding: 0px;
            margin-bottom: 10px;
            ">
            <!-- Section Header -->
            <div class="section-header" style="
               text-align: left;
               background: #ec0000;
               color: #fff !important;
               padding: 12px;
               ">
               <h3 class="" style="color: #fff;margin-bottom: 0px;">
			   <?php if(Session::get('register')): ?>
			    1-  Welcome <?php echo e(Session::get('register')->name); ?>

			   <?php else: ?>
			     1- Login or SignUp
			   <?php endif; ?> 
			   </h3>
            </div>
            <!-- Section Header /- -->
			<?php if(!Session::get('register')): ?>
            
               <input name="_token" type="hidden" value="mS9hGqSxiWHHDKnBwZGAN9TC2pDN4So7TYd2A9Lf">
               <input type="hidden" name="_token" value="mS9hGqSxiWHHDKnBwZGAN9TC2pDN4So7TYd2A9Lf">
			   <br>
               <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                  <input type="number" name="phone" id='pre_phone' class="form-control" placeholder="Enter your phone number *" required="">
				  <span class='hide change_number_btn' onclick='resetLoginForm()' style='padding: 3px 5px;
    cursor: pointer;
    background: #fff;
    display: inline-block;
    margin-top: 5px;
    border: 1px solid #EC0000;
    font-size: 12px;'>Change Number</span>
               </div>
			   <div class="col-md-12 col-sm-12 col-xs-12 form-group new_login hide" >
                  <input type="number" name="new_otp" id='new_otp' class="form-control" placeholder="Enter OTP" required="">
               </div>
			   <div class="col-md-12 col-sm-12 col-xs-12 form-group new_login hide"  >
                  <input type="password" name="set_password" id='set_password' class="form-control" placeholder="Set Password" required="">
               </div>
			   <div class="col-md-12 col-sm-12 col-xs-12 form-group old_login hide"  >
                  <input type="password" name="old_password" id='old_password' class="form-control" placeholder="Enter Your Password" required="">
               </div>
			   
               <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="
                  /* display: none; */
                  ">
                  By continuing, you agree to Terms and Conditions
               </div>
               <div class="form-group col-md-12 col-sm-12 col-xs-12 old_login hide" >
                  <button  class='' type="button" name="post" onclick="checkLoginDetails()">Continue to Login</button>
               </div>
			   <div class="form-group col-md-12 col-sm-12 col-xs-12 new_login hide" >
                  <button title="Submit" type="button" name="post" onclick="checkMobile()">Continue to Sign Up</button>
               </div>
			   <div class="form-group col-md-12 col-sm-12 col-xs-12 pre_set_btn">
                  <button title="Submit" type="button" name="post" onclick="checkMobile()">Continue</button>
               </div>
			   <div class="col-md-12 col-sm-12 col-xs-12 form-group ajax_message_response">
                    
               </div>
            </form>
			<?php endif; ?>
            <div class="col-md-12 col-sm-12 col-xs-12" style="
               display: none;
               ">
               <h5 class="entry-title">
                  Dont have an account? <a href="https://mountmiller.com/backup/public/register"><span class="read-more">Register</span></a>
               </h5>
               <h5>
                  Forgotten your password? <a class="active" href="https://mountmiller.com/backup/public/forgotPassword">Recover Password</a>
               </h5>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-sm-6 col-md-offset-1 col-xs-12 ">
         <div class="form-detail" style="
            padding-top: 23px;
            padding: 0px;
            ">
            <!-- Section Header -->
            <div class="section-header delivery_address_header" style="
               text-align: left;
               background: grey;
               color: #fff !important;
               padding: 12px;
               margin-bottom: 0px;
               ">
               <h3 class="" style="color: #fff;margin-bottom: 0px;">2 Delivery Address</h3>
            </div>
            <!-- Section Header /- -->
            <div class="col-md-12 col-sm-12 col-xs-12 delivery_summary" >
               <h3>Shipping Address</h2>
			   <?php if(Session::get('register')): ?>
                    <ul class="checkout-steps">
                        <li>

                            <div class="form-group required-field">
                                <label>Name </label>
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo e($addresses['name']); ?>" require>
                            </div>

                            <div class="form-group required-field">
                                <label>Phone</label>
                                <input type="tel" name="phone" id="phone" class="form-control" value="<?php echo e($addresses['phone']); ?>" require>
                            </div>

                            <div class="form-group required-field">
                                <label>Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?php echo e($addresses['email']); ?>" require>
                            </div>
                        
                            <div class="form-group required-field">
                                <label>Landmark</label>
                                <input type="text" name="landmark" id="landmark" class="form-control" value="<?php echo e($addresses['landmark']); ?>" require>
                            </div>

                            <div class="form-group required-field">
                                <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="<?php echo e($addresses['address']); ?>" require>
                            </div>

                            <div class="form-group required-field">
                                <label>Zip/Postal Code </label>
                                <input type="text" name="zipCode" id="zipCode" onchange="zipCodeCheck(this.value);" class="form-control" value="<?php echo e($addresses['zipCode']); ?>" require>
                                <p id="zipMSG"></p>
                                <input type="hidden" value="<?php echo e(csrf_token()); ?>" id="csrfToken">
                            </div>
                        </li>
                    </ul>
				<?php endif; ?>
					<button type="button" id="" class="btn btn-primary" onclick='proceedToOrderSummary()'>Continue</button>
					<br>
					<br>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-sm-6 col-md-offset-1 col-xs-12 ">
         <div class="form-detail " style="
            padding-top: 23px;
            padding: 0px;
            ">
            <!-- Section Header -->
            <div class="section-header order_summary_header" style="
               text-align: left;
               background: grey;
               color: #fff !important;
               padding: 12px;
               margin-bottom: 0px;
               ">
               <h3 class="" style="color: #fff;margin-bottom: 0px;">3 Order Summary</h3>
            </div>
            <!-- Section Header /- -->
            <div class="col-md-12 col-sm-12 col-xs-12 order_summary hide">
               <!----------------------------------------->
			   <h4>
                            <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="true" aria-controls="order-cart-section"><?php echo e(count($cartList)); ?> products in Cart</a>
                        </h4>

                        <div class="collapse in" id="order-cart-section" style="">
                            <table class="table table-mini-cart">
                                <tbody>
                                    <?php 
                                        $totalAmt = 0; 
                                        $totalTax = 0;
                                        $totalShipmentCOD = 0;
                                        $totalShipmentOnline = 0;

                                        $includeShipping = 1;

                                        $bothPaymentItem = 0;
                                        $codPaymentItem = 0;
                                        $onlinePaymentItem = 0;
                                    ?>

                                    <?php $__currentLoopData = $cartList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                            if($item->inventoryOffer) {

                                                if($item->inventoryPrice->sprice >= $item->inventoryOffer->cartMinValue)
                                                {
                                                    $basePrice = $item->inventoryPrice->sprice - ($item->inventoryPrice->sprice * $item->inventoryOffer->discount / 100);
                                                } else {
                                                    $basePrice = $item->inventoryPrice->sprice;
                                                }

                                            } else {
                                                $basePrice = $item->inventoryPrice->sprice;
                                            }

                                            $totalTax += ($item->qty * ($basePrice * ($item->cartInventory->ProductTax['includeTax'] == 0 ? $item->cartInventory->ProductTax['tax'] : 0)/100));
                                            $totalAmt += $basePrice * $item->qty;
                                            $totalShipmentCOD += ($item->shipmentCOD * $item->qty);
                                            $totalShipmentOnline += ($item->shipmentOnline * $item->qty);

                                            if($item->inventoryPackaging->includeShipping == 0)
                                            {
                                                $includeShipping = 0;
                                            }

                                            if($item->cartInventory->payementOption == 1) {
                                                $bothPaymentItem += 1;
                                            } else if($item->cartInventory->payementOption == 2) {
                                                $codPaymentItem += 1;
                                            } else if($item->cartInventory->payementOption == 3) {
                                                $onlinePaymentItem += 1;
                                            }
                                        ?>
                                        <tr>
                                            <td class="product-col">
                                                <figure class="product-image-container">
                                                    <img src="<?php echo e($item->cartInventory->imageURL0); ?>" style="height: 50px;">
                                                </figure>
                                                <div>
                                                    <h2 class="product-title" style="max-width: none;">
                                                        <?php echo e($item->cartInventory->productName); ?>

                                                    </h2>

                                                    <span class="product-qty">Qty: <?php echo e($item->qty); ?></span>
                                                    <br>
                                                    <span class="product-qty">
                                                        <?php if($item->cartInventory->payementOption == 2): ?>
                                                            COD Available
                                                        <?php elseif($item->cartInventory->payementOption == 3): ?>
                                                            Accept online payment only
                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="price-col">
                                                <?php if($item->inventoryOffer): ?>
                                                    <del>Rs <?php echo e(number_format(($item->inventoryPrice->sprice) * ($item->qty),2)); ?></del>
                                                    <span class="product-qty">
                                                        Rs <?php echo e(number_format(($basePrice) * ($item->qty),2)); ?> <br>
                                                        offer apply
                                                    </span>
                                                <?php else: ?>
                                                    Rs <?php echo e(number_format(($basePrice) * ($item->qty),2)); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                        $grandTotalCOD = $totalTax + $totalAmt + $totalShipmentCOD;
                                        $grandTotalOnline = $totalTax + $totalAmt + $totalShipmentOnline;
                                    ?>

                                    <tr>
                                        <td class="product-col">
                                            <h2 class="product-title" style="max-width: none;">
                                                Sub Total
                                            </h2>
                                        </td>
                                        <td class="price-col">Rs <?php echo e(number_format($totalAmt,2)); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="product-col">
                                            <h2 class="product-title" style="max-width: none;">
                                                Tax
                                            </h2>
                                        </td>
                                        <td class="price-col">Rs <?php echo e(number_format($totalTax,2)); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="product-col">
                                            <h2 class="product-title" style="max-width: none;">
                                                Shipping
                                            </h2>
                                        </td>
                                        <td class="price-col">
                                            RS. <span id="shipmentDisplay"><?php echo e(number_format($totalShipmentOnline,2)); ?></span>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="product-col">
                                            <h2 class="product-title" style="max-width: none;">
                                                Grand Total
                                            </h2>
                                        </td>
                                        <td class="price-col">
                                            RS. <span id="grandTotalDisplay"><?php echo e(number_format($grandTotalOnline,2)); ?></span>

                                            <input type="hidden" id="grandTotal" name="grandTotal" class="form-control" value="<?php echo e($grandTotalOnline); ?>">
                                        </td>
                                    </tr>
                                    
                                </tbody>    
                            </table>
                        </div>
               <!----------------------------------------->
			   <button type="button" id="" class="btn btn-primary" onclick='proceedToPaymentOption()'>Continue</button>
					<br>
					<br>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-sm-6 col-md-offset-1 col-xs-12 ">
         <div class="form-detail" style="
            padding-top: 23px;
            padding: 0px;
            ">
            <!-- Section Header -->
            <div class="section-header" style="
               text-align: left;
               background: grey;
               color: #fff !important;
               padding: 12px;
               margin-bottom: 0px;
               ">
               <h3 class="" style="color: #fff;margin-bottom: 0px;">4 Payment Options</h3>
            </div>
            <!-- Section Header /- -->
            <div class="col-md-12 col-sm-12 col-xs-12">
               <!---------------------------------------------------------->
			   <table class="table payment_div_summary hide" style="border:0px" >
                                <tbody>

                                    <?php if($bothPaymentItem>0 && $codPaymentItem == 0 && $onlinePaymentItem == 0): ?>
                                        <tr>
                                            <td>
                                                <h4><input type="radio" name="transactionType" value="1" onclick="shipmentCalculation('<?php echo e($totalShipmentCOD); ?>','<?php echo e($grandTotalCOD); ?>')"> Cash on delivery</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4><input type="radio" name="transactionType" value="2" checked onclick="shipmentCalculation('<?php echo e($totalShipmentOnline); ?>','<?php echo e($grandTotalOnline); ?>')"> Pay Online</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" id="submitButton" class="btn btn-primary">Confirm</button>
                                                <button type="button" id="loadingButton" class="btn btn-primary" style="display:none">Loading..!</button>
                                            </td>
                                        </tr>
                                    <?php elseif($codPaymentItem>0 && $bothPaymentItem == 0 && $onlinePaymentItem == 0): ?>
                                        <tr>
                                            <td>
                                                <h4><input type="radio" name="transactionType" value="1" checked onclick="shipmentCalculation('<?php echo e($totalShipmentCOD); ?>','<?php echo e($grandTotalCOD); ?>')"> Cash on delivery</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" id="submitButton" class="btn btn-primary">Confirm</button>
                                                <button type="button" id="loadingButton" class="btn btn-primary" style="display:none">Loading..!</button>
                                            </td>
                                        </tr>
                                    <?php elseif($onlinePaymentItem>0 && $codPaymentItem == 0 && $bothPaymentItem == 0): ?>
                                        <tr>
                                            <td>
                                                <h4><input type="radio" name="transactionType" value="2" checked onclick="shipmentCalculation('<?php echo e($totalShipmentOnline); ?>','<?php echo e($grandTotalOnline); ?>')"> Pay Online</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" id="submitButton" class="btn btn-primary">Confirm</button>
                                                <button type="button" id="loadingButton" class="btn btn-primary" style="display:none">Loading..!</button>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td>
                                                <p>Sorry! you can't add multiple items with different payment methods.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="<?php echo e(route('cartList')); ?>" class="checkout-button button alt wc-forward">
                                                    <button type="button" class="btn btn-primary">Back to cart</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
               <!---------------------------------------------------------->
            </div>
         </div>
      </div>
   </div>
</div>
<?php echo Form::close(); ?> 
<!-- Login Section /- -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theams/theam1/layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/backup/resources/views/theams/theam1/login.blade.php ENDPATH**/ ?>