<?php $__env->startSection('theme1Content'); ?>

<style>
    .owl-item active {
        width: auto;
    }

</style>


<div class="shop-single container-fluid no-padding">

    <!-- Container -->

    <div class="container">

        <div class="product-views">

            <div class="col-md-4 col-sm-6 col-xs-12">

                <div class="large-5 column">
                    <div class="xzoom-container">
                        <img class="xzoom4" id="xzoom-fancy" src="<?php echo e(asset($inventoryData->imageURL0)); ?>" xoriginal="<?php echo e(asset($inventoryData->imageURL0)); ?>" />
                        
                        <div class="xzoom-thumbs">
                            <?php if($inventoryData->imageURL0): ?>
                                <a href="<?php echo e(asset($inventoryData->imageURL0)); ?>">
                                    <img class="xzoom-gallery4" src="<?php echo e(asset($inventoryData->imageURL0)); ?>" xpreview="<?php echo e(asset($inventoryData->imageURL0)); ?>" style="height:75px;width:75px;">
                                </a>
                            <?php endif; ?>

                            <?php if($inventoryData->imageURL1): ?>
                                <a href="<?php echo e(asset($inventoryData->imageURL1)); ?>">
                                    <img class="xzoom-gallery4" src="<?php echo e(asset($inventoryData->imageURL1)); ?>" xpreview="<?php echo e(asset($inventoryData->imageURL1)); ?>" style="height:75px;width:75px;">
                                </a>
                            <?php endif; ?>

                            <?php if($inventoryData->imageURL2): ?>
                                <a href="<?php echo e(asset($inventoryData->imageURL2)); ?>">
                                    <img class="xzoom-gallery4" src="<?php echo e(asset($inventoryData->imageURL2)); ?>" xpreview="<?php echo e(asset($inventoryData->imageURL2)); ?>" style="height:75px;width:75px;">
                                </a>
                            <?php endif; ?>

                            <?php if($inventoryData->imageURL3): ?>
                                <a href="<?php echo e(asset($inventoryData->imageURL3)); ?>">
                                    <img class="xzoom-gallery4" src="<?php echo e(asset($inventoryData->imageURL3)); ?>" xpreview="<?php echo e(asset($inventoryData->imageURL3)); ?>" style="height:75px;width:75px;">
                                </a>
                            <?php endif; ?>

                            <?php if($inventoryData->imageURL4): ?>
                                <a href="<?php echo e(asset($inventoryData->imageURL4)); ?>">
                                    <img class="xzoom-gallery4" src="<?php echo e(asset($inventoryData->imageURL4)); ?>" xpreview="<?php echo e(asset($inventoryData->imageURL4)); ?>" style="height:75px;width:75px;">
                                </a>
                            <?php endif; ?>

                            <?php if($inventoryData->imageURL5): ?>
                                <a href="<?php echo e(asset($inventoryData->imageURL5)); ?>">
                                    <img class="xzoom-gallery4" src="<?php echo e(asset($inventoryData->imageURL5)); ?>" xpreview="<?php echo e(asset($inventoryData->imageURL5)); ?>" style="height:75px;width:75px;">
                                </a>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
                
                

            </div>

            <!-- Entry Summary -->

            <div class="col-md-8 col-sm-6 col-xs-12 entry-summary">

                <?php if($account->affiliationLink == 0 && $affiliateId!=0): ?>
                <div class="col-md-12 col-sm-12 col-xs-12 description">
                    <p style="color: #ec0000;font-size: x-large;">
                        This link is expired. Try another one.
                    </p>
                </div>
                <?php endif; ?>

                <h3 class="product_title">
                    <span id="productName"><?php echo e($inventoryData->productName); ?></span>
                </h3>
                
                

                <p class="stock in-stock"><span>Availablity:</span> in stock</p>
                <p class="stock in-stock"><span><?php echo e($inventoryData->sku); ?></span></p>
                
                <p class="stock in-stock">
                    <span>
                        <del>
                            MRP
                            <span id="productMRP"><?php echo e(number_format($inventoryData ->inventory_price->mrp,2)); ?> </span>
                        <del>
                    </span>

                    <?php
                    $offPerchantage = round(($inventoryData ->inventory_price->mrp - $inventoryData ->inventory_price->sprice) * 100 / $inventoryData ->inventory_price->mrp)
                    ?>
                    <br>
                    <span>
                        <?php echo e($offPerchantage); ?>% Off 
                    </span>

                    <h3 class="product_title" style="color: #ec0000;">Rs
                        <span id="productSprice">
                            <?php echo e(number_format($inventoryData ->inventory_price->sprice,2)); ?>

                            <?php echo e($productData ->tax_detail->includeTax == 0 ? '+ Tax' : ''); ?>

                            <?php echo e($inventoryData ->product_packaging->includeShipping == 0 ? '+ Shipping Charge' : ''); ?>

                        </span>
                    </h3>
                    <span class="stock in-stock">
                        <span style="font-size:13px;">
                            <?php if($inventoryData->payementOption == 2): ?>
                                (Accept cod payment only)
                            <?php elseif($inventoryData->payementOption == 3): ?>
                                (Accept online payment only)
                            <?php endif; ?>
                        </span>
                    </span>
                </p>

                <form>
                    <div class="product-attribute">
                        <?php if(isset($productData->optionList)): ?>

                        <?php $position = 0; ?>
                        <?php $__currentLoopData = $productData->optionList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="select">

                            <select id="optionId<?php echo e($position); ?>" name="<?php echo e($option->tag); ?>" onchange="optionFilter(<?php echo e($productData->id); ?>);">

                                <option disabled><?php echo e($option->tag); ?> *</option>

                                <?php $__currentLoopData = $option->optionsIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($options->id); ?>"><?php echo e($options->label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>

                        <?php $position++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php endif; ?>

                        <input type="hidden" value="<?php echo e($position); ?>" id="optionsCount">
                        <input type="hidden" value="<?php echo e(csrf_token()); ?>" id="csrfToken">
                        <input type="hidden" value="<?php echo e($inventoryData->id); ?>" id="inventoryId">
                        <input type="hidden" value="<?php echo e($affiliateId); ?>" id="affiliateId">
                    </div>
                    
                    <?php if($account->affiliationLink == 0 && $affiliateId!=0): ?>

                        <button type="button" class="add_to_cart form-group col-md-12 col-sm-12 col-xs-12">Link Expired!</button>
                        
                    <?php else: ?>
                        
                        <?php if($account->type==1 || $account->type==2): ?>
                            <button type="button" class="add_to_cart" onclick="addToCart()" id="addToCartButton">Add To Cart</button>
                        <?php endif; ?>

                        <?php if($account->type==3 || $account->type==2): ?>
                            <button type="button" class="add_to_cart" data-toggle="modal" data-target="#inquiryModel">Send Inquiry</button>
                            
                            <?php if($errors->any()): ?>
                                <div id="alert-msg" class="alert-msg"><?php echo e($errors->first()); ?></div>
                            <?php endif; ?>
                            
                        <?php endif; ?>

                        <button type="button" class="add_to_cart" id="addToCartLoadingButton" style="display:none;">Loading..</button>
                        <p id="cartMSG"></p>
                    <?php endif; ?>

                </form>

                <div class="product-views">
                    <div class="col-md-6 col-sm-6 col-xs-12 entry-summary" style="padding: 0px;">
                        <h3 class="product_title">Services</h3>

                        <div class="about-content">
                            <?php if($inventoryData->payementOption != 1): ?>
                                <p>
                                    <i class="fa fa-circle"></i>
                                    Payment Option : 
                                        <?php if($inventoryData->payementOption == 2): ?>
                                            Accept cod payment only
                                        <?php elseif($inventoryData->payementOption == 3): ?>
                                            Accept online payment only
                                        <?php endif; ?>
                                </p>
                            <?php endif; ?>

                            <p>
                                <i class="fa fa-circle"></i>
                                Cancellation : <?php echo e(($inventoryData->inventory_shipping->cancelOrder ?? 0) == 1 ? 'Yes' : 'No'); ?>

                            </p>

                            <p>
                                <i class="fa fa-circle"></i>
                                Return : <?php echo e(($inventoryData->inventory_shipping->returnOrder ?? 0) == 1 ? 'Yes within '.$inventoryData->inventory_shipping->returnOrderDays.' days' : 'No'); ?>

                            </p>

                            <p>
                                <i class="fa fa-circle"></i>
                                Replacement : <?php echo e(($inventoryData->inventory_shipping->replacementOrder ?? 0) == 1 ? 'Yes within '.$inventoryData->inventory_shipping->replacementOrderDays.' days' : 'No'); ?>

                            </p>

                        </div>
                    </div>
                    
                    <?php if(isset($inventoryData->inventory_warranty)): ?>
                        <div class="col-md-6 col-sm-6 col-xs-12 entry-summary">
                            <h3 class="product_title">Warranty</h3>

                            <div class="about-content">

                                <?php if(isset($inventoryData->inventory_warranty->domestic)): ?>
                                <p>
                                    <i class="fa fa-circle"></i>
                                    Domestic : <?php echo e(($inventoryData->inventory_warranty->domestic ?? 0) == 1 ? 'Yes' : 'No'); ?>

                                </p>
                                <?php endif; ?>

                                <?php if(isset($inventoryData->inventory_warranty->international)): ?>
                                <p>
                                    <i class="fa fa-circle"></i>
                                    International : <?php echo e(($inventoryData->inventory_warranty->international ?? 0) == 1 ? 'Yes' : 'No'); ?>

                                </p>
                                <?php endif; ?>

                                <?php if(isset($inventoryData->inventory_warranty->summary)): ?>
                                <p>
                                    <i class="fa fa-circle"></i>
                                    Summary : <?php echo e($inventoryData->inventory_warranty->summary ?? ''); ?>

                                </p>
                                <?php endif; ?>

                                <?php if(isset($inventoryData->inventory_warranty->coveredIn)): ?>
                                <p>
                                    <i class="fa fa-circle"></i>
                                    CoveredIn : <?php echo e($inventoryData->inventory_warranty->coveredIn ?? ''); ?>

                                </p>
                                <?php endif; ?>

                                <?php if(isset($inventoryData->inventory_warranty->notCovered)): ?>
                                <p>
                                    <i class="fa fa-circle"></i>
                                    Not Covered : <?php echo e($inventoryData->inventory_warranty->notCovered ?? ''); ?>

                                </p>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="product_meta">

                    <span class="posted_in">

                        <a href="#"><i class="fa fa-heart"></i></a>

                        <a href="#"><i class="fa fa-retweet"></i></a>

                        <a href="#"><i class="fa fa-envelope-o"></i></a>

                    </span>

                    <ul class="social">

                        <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>

                        <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>

                        <li><a href="#" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>

                        <li><a href="#" title="Tumblr"><i class="fa fa-tumblr"></i></a></li>

                        <li><a href="#" title="Vimeo"><i class="fa fa-vimeo"></i></a></li>

                    </ul>

                </div>

            </div><!-- Entry Summary /- -->

        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 description">

            <h5>Description about this product</h5>

            <p>
                <span id="productDescription">
                    <?php echo $inventoryData->productDescription; ?>

                </span>
            </p>

        </div>

        <?php if(count($relatedProduct) > 0): ?>
            <div class="blog-section latest-blog container-fluid">
                <!-- Container -->
                <div class="container">

                    <!-- Section Header -->
                    <div class="section-header">
                        <h3>Related Products</h3>
                        <img src="<?php echo e(asset('assets/theam1/images/section-seprator.png')); ?>" alt="section-seprator" />
                    </div>
                    <!-- Section Header /- -->

                    <?php $__currentLoopData = $relatedProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($item->inventory_price->sprice ?? 0 && $item->inventory_price->mrp ?? 0): ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="type-post">
                                    <div class="entry-cover" style="text-align: center;">
                                        <a href="<?php echo e(route('detail', array('id' => $item->id))); ?>">
                                            <img src="<?php echo e(asset($item->imageURL0)); ?>" style="object-fit: cover;height: 300px;">
                                        </a>
                                        <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                    </div>

                                    <div class="blog-content">
                                        <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                            <a title="<?php echo e($item->productName); ?>" href="<?php echo e(route('detail', array('id' => $item->id))); ?>">
                                                <span><?php echo e($item->productName); ?></span>
                                            </a>
                                        </h3>
                                        <?php
                                        $offPerchantage = round(($item->inventory_price->mrp - $item->inventory_price->sprice) * 100 / $item->inventory_price->mrp)
                                        ?>
                                        <div class="entry-meta">
                                            <span class="post-like">
                                                <del>
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <?php echo e(number_format($item->inventory_price->mrp,2)); ?>

                                                </del>
                                                &nbsp;
                                                <b>
                                                    <?php echo e($offPerchantage); ?>% Off
                                                </b>
                                            </span>

                                            <span class="post-admin" style="color: #ec0000;">
                                                <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                <b><?php echo e(number_format($item->inventory_price->sprice,2)); ?></b>
                                            </span>

                                        </div>
                                        <div class="entry-content">
                                            <p style="height: 50px;overflow: hidden;"><?php echo $item->productDescription; ?></p>
                                            <a href="<?php echo e(route('detail', array('id' => $item->id))); ?>" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!-- Container /- -->
            </div>
        <?php endif; ?>

        <!-- Modal -->
        <div class="modal fade" id="inquiryModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <?php echo Form::open(['route' => 'inquirySubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

                <?php echo e(csrf_field()); ?>

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="position: absolute;">
                            <span id="productName"><?php echo e($inventoryData->productName); ?></span>
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter your name *" required/>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Enter your phone number *" required/>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <input type="text" name="email" class="form-control" placeholder="Enter your email address *" required/>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <input type="text" name="title" class="form-control" placeholder="Enter title *" required>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <textarea name="description" class="form-control" placeholder="Type your message *" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer" style="border: 0px;">
                        <input type="hidden" value="<?php echo e($inventoryData->id); ?>" name="inventoryId">
                        <input type="hidden" value="<?php echo e($affiliateId); ?>" name="affiliate_id ">
                        <button type="submit" class="btn btn-secondary">Send</button>
                    </div>
                </div>
                <?php echo Form::close(); ?> 
            </div>
        </div>

    </div><!-- Container /- -->

</div><!-- Shop Single /- -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('theams/theam1/layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/backup/resources/views/theams/theam1/detail.blade.php ENDPATH**/ ?>