
<?php $__env->startSection('title', 'Cart'); ?>
<?php $__env->startSection('page-content'); ?>
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo e(url('/')); ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop
                    <span></span> Cart
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Your Cart</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand"><?php echo e($cartListQty); ?></span> products in your cart</h6>
                        <h6 class="text-body"><a href="<?php echo e(url('remove_cart/all')); ?>" onclick="return confirm('Are you sure?')"  class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
							    <?php $cart_total = 0; ?>
							    <?php $__currentLoopData = $cartList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="pt-30">
                                    
                                    <td class="image product-thumbnail pt-40"><img src="<?php echo e($item->product->thumbnail); ?>" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html"><?php echo e($item->product->title); ?></a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            
                                        </div>
										<?php if($item->price!=$item->product->selling_price): ?>
											<?php if($item->price<$item->product->selling_price): ?>
												<span style='color:red'>Price increased by <?php echo e($item->product->selling_price-$item->price); ?>₹ from  <?php echo e($item->price); ?>₹</span>
											<?php else: ?>
												<span style='color:green'>Price decreased by <?php echo e($item->price-$item->product->selling_price); ?>₹ from  <?php echo e($item->price); ?>₹</span>
											<?php endif; ?>
										<?php endif; ?>
										<?php if($item->product->dynamic_selling_price!=0&& date("Y-m-d H:i:s",strtotime("-15 minutes ".$item->created_at)) < date("Y-m-d H:i:s")): ?>
									        <span style='color:green'>Price descreased by <?php echo e($item->product->selling_price-$item->product->dynamic_selling_price); ?> from <?php echo e($item->product->selling_price); ?></span>
								         <?php endif; ?>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-body">
								<?php
if($item->product->dynamic_selling_price!=0&& date("Y-m-d H:i:s",strtotime("-15 minutes ".$item->created_at)) < date("Y-m-d H:i:s")){
$product_pr = ( $item->product->tax_method=='Exclusive' ? ( $item->product->dynamic_selling_price + $item->product->dynamic_selling_price*($item->product->product_tax/100) ) : $item->product->dynamic_selling_price );	
}else{
$product_pr = ( $item->product->tax_method=='Exclusive' ? ( $item->product->selling_price + $item->product->selling_price*($item->product->product_tax/100) ) : $item->product->selling_price );
}

                                ?>	
                                <?php if($item->scheme_id): ?>
								  <?php echo e($item->ReferralScheme->special_charges); ?>

                                <?php else: ?>
								  
								   <?php echo e(number_format($product_pr,2)); ?>

                                <?php endif; ?>									
								
								
								<?php if($item->scheme_id): ?>
									<br>
								<span style='color:red;font-family:bold;font-size: 20px;'><?php echo e($item->ReferralScheme->scheme_name); ?> </span>
								
								<?php endif; ?>
								</h4>
								
								<br>
								<?php echo e(( $item->product->shipping_method=='Exclusive' ? "Excluding Shipping" :"Free Shipping" )); ?>

                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <div class="detail-extralink mr-15">
                                            <div class="detail-qty border radius">
                                                
<input type="number" class="qty-val" value="<?php echo e($item->qty); ?>" name='qty<?php echo e($item->id); ?>' form='update-cart' min="1">

                                            </div>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand"><?php echo e($item->qty*($item->scheme_id ? $item->ReferralScheme->special_charges : number_format($product_pr,2))); ?></h4>
                                    </td>
                                    <td class="action text-center" data-title="Remove"><a href="<?php echo e(url('remove_cart/'.$item->id)); ?>" onclick="return confirm('Are you sure to remove from cart?')"  class="text-body"><i class="fi-rs-trash"></i></a></td>
                                </tr>
								<?php $cart_total += $item->qty*($item->scheme_id ? $item->ReferralScheme->special_charges : number_format($product_pr,2)); ?>
								<input type='hidden'  form='update-cart' name='id[]' value='<?php echo e($item->id); ?>'>


                                <?php if($item->product->purchase_product_offer&&$item->qty>=$item->product->purchase_product_offer->qty): ?>
							<?php
						       $offerered_qty = intdiv($item->qty,$item->product->purchase_product_offer->qty);
						    ?> 
								<tr class="pt-30">
                                    <td class="image product-thumbnail pt-40"><img src="<?php echo e($item->product->purchase_product_offer->offerProduct->thumbnail); ?>"></td>
                                    <td class="product-des product-name">
                                       <h6 class="mb-5"><?php echo e($item->product->purchase_product_offer->offerProduct->title); ?></h6><br>
									<span class='offer'><strong>Offer Applied - </strong><?php echo e($item->product->purchase_product_offer->sceheme->title); ?></span>
                                    </td>
                                    <td class="product-quantity">
									<?php echo e($offerered_qty); ?>

                                    </td>
                                    <td data-title="Unit Price" class="product-unit-price">
                                        Rs <?php echo e(number_format($item->product->purchase_product_offer->offerProduct->selling_price,2)); ?>

										<br>
										<small>Incl : <?php echo e($item->product->purchase_product_offer->offerProduct->product_tax); ?>% Tax</small>
                                    </td>
                                    <td data-title="Total" class="product-subtotal" colspan='2'>
									<span style='text-decoration: line-through;'>Rs <?php echo e(number_format(($item->product->purchase_product_offer->offerProduct->selling_price) * ($offerered_qty),2)); ?>

									</span><br> Rs 0
									</td>
                                      
                                </tr>
							<?php endif; ?>


                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
						<small>*Shipping charges will be shown on checkout page.</small>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="cart-action d-flex justify-content-between">
                        <a href="<?php echo e(url('/')); ?>" class="btn "><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
						<form action="<?php echo e(url('update-cart')); ?>" method='post' id='update-cart'>
                        <?php echo csrf_field(); ?>
                        <button type='submit' class="btn  mr-10 mb-sm-15"><i class="fi-rs-refresh mr-10"></i>Update Cart</button>
						</form>
                    </div>
                    
                </div>
                <div class="col-lg-4">
                    <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end"><?php echo e($cart_total); ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end"><?php echo e($cart_total); ?></h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="<?php echo e(url('/checkout')); ?>" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-css'); ?>
<style>
 input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button {  

   opacity: 1;

}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/cart.blade.php ENDPATH**/ ?>