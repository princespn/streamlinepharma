
<?php $__env->startSection('title', $advance_product->title); ?>
<?php $__env->startSection('page-content'); ?>
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo e(url('/')); ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-11 col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="product-detail accordion-detail">
                                <div class="row mb-50 mt-30">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                        <div class="detail-gallery">
                                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                            <!-- MAIN SLIDES -->
                                            <div class="product-image-slider">
                                                <?php if($advance_product->thumbnail): ?>
											    <figure class="border-radius-10">
                                                    <img src="<?php echo e(asset($advance_product->thumbnail)); ?>" alt="product image" />
                                                </figure>
                                            <?php endif; ?>
                                            <?php if($advance_product->image1): ?>
											    <figure class="border-radius-10">
                                                    <img src="<?php echo e(asset($advance_product->image1)); ?>" alt="product image" />
                                                </figure>
                                            <?php endif; ?>
											<?php if($advance_product->image2): ?>
											    <figure class="border-radius-10">
                                                    <img src="<?php echo e(asset($advance_product->image2)); ?>" alt="product image" />
                                                </figure>
                                            <?php endif; ?>
											<?php if($advance_product->image3): ?>
											    <figure class="border-radius-10">
                                                    <img src="<?php echo e(asset($advance_product->image3)); ?>" alt="product image" />
                                                </figure>
                                            <?php endif; ?>
											<?php if($advance_product->image4): ?>
											    <figure class="border-radius-10">
                                                    <img src="<?php echo e(asset($advance_product->image4)); ?>" alt="product image" />
                                                </figure>
                                            <?php endif; ?>
											<?php if($advance_product->image5): ?>
											    <figure class="border-radius-10">
                                                    <img src="<?php echo e(asset($advance_product->image5)); ?>" alt="product image" />
                                                </figure>
                                            <?php endif; ?>
											<?php if($advance_product->video): ?>
											<figure class="border-radius-10">
 <iframe style='width:100%' height='450' src="https://www.youtube.com/embed/<?php echo e(explode('=',$advance_product->video)[1]); ?>"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </figure>	
											<?php endif; ?>
                                            </div>
                                            <!-- THUMBNAILS -->
                                            <div class="slider-nav-thumbnails">
                                                <?php if($advance_product->thumbnail): ?>
                                                <div><img src="<?php echo e(asset($advance_product->thumbnail)); ?>" alt="product image" /></div>
                                            <?php endif; ?>
											<?php if($advance_product->image1): ?>
                                                <div><img src="<?php echo e(asset($advance_product->image1)); ?>" alt="product image" /></div>
                                            <?php endif; ?>
											<?php if($advance_product->image2): ?>
                                                <div><img src="<?php echo e(asset($advance_product->image2)); ?>" alt="product image" /></div>
                                            <?php endif; ?>
											<?php if($advance_product->image3): ?>
                                                <div><img src="<?php echo e(asset($advance_product->image3)); ?>" alt="product image" /></div>
                                            <?php endif; ?>
											<?php if($advance_product->image4): ?>
                                                <div><img src="<?php echo e(asset($advance_product->image4)); ?>" alt="product image" /></div>
                                            <?php endif; ?>
											<?php if($advance_product->image5): ?>
                                                <div><img src="<?php echo e(asset($advance_product->image5)); ?>" alt="product image" /></div>
                                            <?php endif; ?>
											<?php if($advance_product->video): ?>
											<div><img src="<?php echo e(asset($advance_product->thumbnail)); ?>" alt="product image" /><img style="border: 0px;
    position: absolute;
    top: 35%;
    left: 32%;
    width: 50px;    cursor: pointer;" src="<?php echo e(url('assets/images/youtube.png')); ?>"></div>
										
											<?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- End Gallery -->
                                        <?php if($advance_product->view_360_file): ?>
                                           <div class='row'>
                                                <div class="col-md-12">
                                                    <button style='background: transparent;border: 1px solid #6b6ba3;width: 100%;text-align: left;border-radius: 5px;margin-top: 5px;' data-bs-toggle="modal" data-bs-target="#modalAllAngel"><strong>View in 360</strong><br><small>Check how this look from all angles.</small></button>
                                                    <div class="modal" id="modalAllAngel">
                                                        <div class="modal-dialog modal-xl" style='height:100%'>
                                                            <div class="modal-content"  style='min-height:100%'>

                                                            

                                                            <!-- Modal body -->
                                                            <div class="modal-body" >
                                                                <model-viewer intensity='1' style='width:100%' camera-controls alt="Model" src="<?php echo e(url($advance_product->view_360_file)); ?>"></model-viewer>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="detail-info pr-30 pl-30">
                                            <span class="stock-status out-stock"> Sale Off </span>
                                            <h2 class="title-detail"><?php echo e($advance_product->title); ?></h2>
                                            <div class="product-detail-rating">
                                                <div class="product-rate-cover text-end">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (0 reviews)</span>
                                                </div>
                                            </div>
                                            <div class="clearfix product-price-cover">
                                                <div class="product-price primary-color float-left">
                                                    <span class="current-price text-brand" <?php if(isset($scheme)&&$scheme): ?> style="text-decoration: line-through" <?php endif; ?> ><?php echo e(number_format($advance_product->selling_price,2)); ?> <?php if($advance_product->tax_method=='Exclusive'): ?>
        <br>+ <?php echo e($advance_product->product_tax); ?>% Tax
       <?php endif; ?></span>
                                                    <span>
													<?php
														$offPerchantage = round(($advance_product->product_price - $advance_product->selling_price) * 100 / $advance_product->product_price)
												   ?>
                                                        <span class="save-price font-md color3 ml-15"><?php echo e($offPerchantage); ?>% Off</span>
                                                        <span class="old-price font-md ml-15"><?php echo e(number_format($advance_product->product_price,2)); ?></span>
                                                    </span>
       		   
	</div>
</div>												<?php if(isset($scheme)&&$scheme): ?>
												<div class="clearfix product-price-cover">
<div style='color: red !important;font-size: 45px;'>
<div class='blink current-price text-brand' style='color: red !important;font-size: 45px;'><?php echo e($scheme->special_charges_label); ?>  : <?php echo e($scheme->special_charges); ?></div>
<br>
				    <h5>Please add only this product in cart and at checkout time.</h5><br>
</div> 
</div> 
<?php endif; ?>  


   
											
<div class="delivery_charges_div" style='margin:10px;'>
  <?php if(!Session::get('delivery_location')): ?>
	  <button class='btn btn-danger btn-xs' data-bs-toggle="modal" data-bs-target="#deliveryAddressModal">Enter Pincode to check availablity</button>
  <?php endif; ?>
</div>

											
											<?php if(isset($group)): ?>
		<?php if($advance_product->grouping_name!=Null): ?>
		<div class="row">
		  <div class='col-md-12'>
		     <h3><?php echo e($advance_product->grouping_name); ?></h3>
			 <?php if($advance_product->setting->grouping=='color'): ?>
				 <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			       <a href="<?php echo e(url('product-detail/'.$g_row->sku)); ?>"><img src='<?php echo e($g_row->thumbnail); ?>' title='<?php echo e($g_row->color); ?>' width='70' style='width: 50px;height: 70px;border: 1px solid red' onmouseover='$(".slick-current img").attr("src","<?php echo e($g_row->thumbnail); ?>");'  onmouseout='$(".slick-current img").attr("src","<?php echo e($advance_product->thumbnail); ?>");'></a>
			     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			 <?php else: ?>
				 <?php $myg = $advance_product->setting->grouping; ?>
				 <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			       <!--a style='border: 1px solid #d3c2c2;padding: 5px;margin-right: 4px;border-radius: 4px;' href="<?php echo e(url('detail/'.$g_row->sku)); ?>"><?php echo e($g_row->$myg); ?></a-->
				   <a href="<?php echo e(url('product-detail/'.$g_row->sku)); ?>"><img src='<?php echo e($g_row->thumbnail); ?>' title='<?php echo e($g_row->color); ?>' width='70' style='width: 50px;height: 70px;border: 1px solid red' onmouseover='$(".slick-current img").attr("src","<?php echo e($g_row->thumbnail); ?>");'  onmouseout='$(".slick-current img").attr("src","<?php echo e($advance_product->thumbnail); ?>");'></a>
			     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			 <?php endif; ?>
		  </div>
		</div>
		<?php endif; ?>
		
		
		
		<?php endif; ?>
											
											
                                            <div class="short-desc mb-30">
                                                <p class="font-lg"><?php echo nl2br($advance_product->description); ?></p>
                                            </div>
											
											
											<?php if(count($advance_product->purchase_offer)): ?>
			<h5 style='color:green'>Available offers</h5>
				     <?php $__currentLoopData = $advance_product->purchase_offer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div>
					  <img src="<?php echo e(url('assets/images/offer.png')); ?>" width="18" height="18" class="_3HLfAg"> <strong> <?php echo e($offer->sceheme->title); ?></strong>  - Get <?php echo e($offer->get_qty); ?> '<?php echo e($offer->offerProduct->title); ?>' free if you buy <?php echo e($offer->qty); ?> <?php echo e($advance_product->title); ?>'
                      <!---------tc--------->
					  
					  <div class="popover__wrapper">
					  
						<strong class="popover__title">T&C</strong>
					  
					  <div class="popover__content">
						<?php echo $offer->terms_and_conditions; ?>

					  </div>
					</div>
                      <!---------tc--------->
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
											
											
                                            <form action="<?php echo e(url('add-to-cart')); ?>" method='post'>
                                            <?php echo csrf_field(); ?>
											<input type='hidden' name='product_id' value='<?php echo e($advance_product->id); ?>'>
											<div class="detail-extralink mb-50">
                                                <div class="detail-qty border radius">
                                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                    <input type="text" name="quantity" class="qty-val" value="1" min="1">
                                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                                <div class="product-extra-link2">
   <?php if(isset($scheme)&&$scheme): ?>
      <input type='hidden' value='<?php echo e($scheme->id); ?>' name='scheme_id'>
   <?php endif; ?>
   <button type="submit" name='buy_now' class="button button-add-to-cart" value='buy_now'><i class="fi-rs-shopping-cart"></i>Buy Now</button>
                                                    <button type="submit" name='att_to_cart' class="button button-add-to-cart"  value='add_to_cart'><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
											</form>
                                            <div class="font-xs">
                                                <ul class="mr-50 float-start">
                                                    <li class="mb-5">Return: <span class="text-brand"><?php echo e($advance_product->is_return == 'Yes' ? 'Yes within '.$advance_product->return_days.' days' : 'No'); ?></span></li>
                                                    <li class="mb-5">Replacement:<span class="text-brand"><?php echo e($advance_product->is_replace == 'Yes' ? 'Yes within '.$advance_product->replace_days.' days' : 'No'); ?></span></li>
                                                </ul>
                                                
                                            </div>
                                        </div>
                                        <!-- Detail Info -->
                                    </div>
                                </div>
								<?php if(count($catalouge)): ?>
								<div class='row'>
								  <div class='col-md-12'>
								    <div class="card">
                                      <div class="card-header">Product Description</div>
                                      <div class="card-body">
									    <?php $__currentLoopData = $catalouge; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										  <div class='row' style="border-bottom: 2px solid #d7d0d0;margin-bottom: 5px;">
										    <div class='col-md-4'><img src="<?php echo e(url($cat_row->image)); ?>" style="width:100%"></div>
										    <div class='col-md-8'>
											  <h2><?php echo e($cat_row->title); ?></h2>
											  <p><?php echo e($cat_row->description); ?></p>
											</div>
										  </div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									  </div>
                                    </div>
								  </div>
								</div>
								<?php endif; ?>
                                <div class="product-info">
                                    <div class="tab-style3">
                                        <ul class="nav nav-tabs text-uppercase">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ( <?php echo e(count($advance_product->review)); ?> )</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content shop_info_tab entry-main-content">
                                            <div class="tab-pane fade show active" id="Description">
                                                <div class="">
                                                   <?php echo nl2br($advance_product->description); ?> 
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="Additional-info">
                                                
                                            </div>
                                            
                                            <div class="tab-pane fade" id="Reviews">
                                                <!--Comments-->
												
												
												<?php if(session()->has('status')): ?>
													<div class="alert alert-success">
														<?php echo e(session()->get('status')); ?>

													</div>
												<?php endif; ?>
												<?php if(Session::get('register')): ?>
												<button onclick="$('.rating_container').toggle();" class='btn btn-primary btn-xs btn-sm'>Write a review</button>
<div class='row rating_container' style='display:none'>
												  <div class='col-md-12'>
												  <form name='rating_form' action="<?php echo e(url('rating_save')); ?>" method='post' enctype="multipart/form-data">
												  <?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="">Rating :</label>
    <div class="rating"> 
	     <input type="radio" name="rating" value="5" id="5" required>
		 <label for="5">☆</label> 
		 <input type="radio" name="rating" value="4" id="4" required>
		 <label for="4">☆</label> 
		 <input type="radio" name="rating" value="3" id="3" required>
		 <label for="3">☆</label> 
		 <input type="radio" name="rating" value="2" id="2" required>
		 <label for="2">☆</label> 
		 <input type="radio" name="rating" value="1" id="1" required>
		 <label for="1">☆</label>
   </div>
  </div>
  <div class="form-group">
    <label for="headline">Headline :</label>
    <input type="text" class="form-control" placeholder="What's most important to know?" id="headline" name="headline" required>
  </div>
  <div class="form-group">
    <label for="review">Review:</label>
    <textarea  class="form-control" placeholder="What did you like or dislike? What did you use this product for?" id="review" name="review" required></textarea>
  </div>
  <div class="form-group">
    <label for="photo">Photo:</label>
    <input type="file" class="form-control" placeholder="" name='photo' id="photo">
  </div>
  <input type='hidden' name='product_id' value='<?php echo e($advance_product->id); ?>'>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
												  </div>
												</div>											
												<?php else: ?>
													<a href="<?php echo e(url('login')); ?>" class='btn btn-primary btn-xs btn-sm'>Write a review</a>
												<?php endif; ?>
                                                
												<div class="comments-area">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <h4 class="mb-30">Customer reviews</h4>
                                                            <div class="comment-list">
                                                             <?php $__currentLoopData = $advance_product->review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                                                                <div class="single-comment justify-content-between d-flex">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb text-center">
                                                                            <img src="assets/imgs/blog/author-4.png" alt="" />
                                                                            <a href="#" class="font-heading text-brand"><?php echo e($review->register->name); ?></a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="font-xs text-muted"><?php echo e($review->created_at); ?></span>
                                                                                </div>
                                                                                <div class="product-rate d-inline-block">
                                                                                    <div class="product-rating" style="width: <?php echo e($review->rating*20); ?>%"></div>
                                                                                </div>
                                                                            </div>
                                                                            <h4 class="mb-10"><?php echo e($review->headline); ?></h4>
                                                                            <p class="mb-10"><?php echo e($review->review); ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
															 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
														<?php  
														  $rate1 = $rate2 = $rate3 = $rate4 = $rate5 = $avgRate = 0;
														  if(count($advance_product->review)){
															  $avgRate = $advance_product->avgRating->avg;
															  $rate1   = ( $advance_product->oneStar ? (count($advance_product->review)/$advance_product->oneStar->num)*100 : 0);
															  $rate2   = ( $advance_product->twoStar ? (count($advance_product->review)/$advance_product->twoStar->num)*100 : 0);
															  $rate3   = ( $advance_product->threeStar ? (count($advance_product->review)/$advance_product->threeStar->num)*100 : 0);
															  $rate4   = ( $advance_product->fourStar ? (count($advance_product->review)/$advance_product->fourStar->num)*100 : 0);
															  $rate5   = ( $advance_product->fiveStar ? (count($advance_product->review)/$advance_product->fiveStar->num)*100 : 0);
														  }
														?>
                                                        <div class="col-lg-4">
                                                            <h4 class="mb-30">Customer reviews</h4>
                                                            <div class="d-flex mb-30">
                                                                <div class="product-rate d-inline-block mr-15">
                                                                    <div class="product-rating" style="width: <?php echo e($avgRate*20); ?>%"></div>
                                                                </div>
                                                                <h6><?php echo e($avgRate); ?> out of 5</h6>
                                                            </div> 
                                                            <div class="progress">
                                                                <span>5 star</span>
                                                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($rate5); ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo e($rate5); ?>%</div>
                                                            </div>
                                                            <div class="progress">
                                                                <span>4 star</span>
                                                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($rate4); ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo e($rate4); ?>%%</div>
                                                            </div>
                                                            <div class="progress">
                                                                <span>3 star</span>
                                                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($rate3); ?>%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"><?php echo e($rate3); ?>%</div>
                                                            </div>
                                                            <div class="progress">
                                                                <span>2 star</span>
                                                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($rate2); ?>%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><?php echo e($rate2); ?>%</div>
                                                            </div>
                                                            <div class="progress mb-30">
                                                                <span>1 star</span>
                                                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($rate1); ?>%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><?php echo e($rate1); ?>%</div>
                                                            </div>
                                                            <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--comment form-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-60">
                                    <div class="col-12">
                                        <h2 class="section-title style-1 mb-30">Related products</h2>
                                    </div>
                                    <div class="col-12">
                                        <div class="row related-products">
										<?php $__currentLoopData = $rel_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap hover-up">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="<?php echo e(url('/product-detail/'.$row->sku)); ?>" tabindex="0">
                                                                <img class="default-img" src="<?php echo e($row->thumbnail); ?>" alt="" />
                                                            </a>
                                                        </div>
                                                        
                                                        <div class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">Hot</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <h2><a href="<?php echo e(url('/product-detail/'.$row->sku)); ?>" tabindex="0"><?php echo e($row->title); ?></a></h2>
                                                        <div class="rating-result" title="90%">
                                                            <span> </span>
                                                        </div>
                                                        <div class="product-price">
                                                            <span><?php echo e($row->selling_price); ?></span>
                                                            <span class="old-price"><?php echo e($row->product_price); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-css'); ?>
<style>
 @-webkit-keyframes blinker {
  from {opacity: 1.0;}
  to {opacity: 0.0;}
}
.blink{
	text-decoration: blink;
	-webkit-animation-name: blinker;
	-webkit-animation-duration: 0.6s;
	-webkit-animation-iteration-count:infinite;
	-webkit-animation-timing-function:ease-in-out;
	-webkit-animation-direction: alternate;
     color:red;
	 font-weight:bold;
}
.blink span{
	font-size:30px;
} 
.delivery_charges_div{
	color:red;
}
model-viewer{
    height: 60vh;
    width: inherit;
    min-height:100%;
}
.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
	width: 205px;
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 3vw;
    color: #FFD600;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}


</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-scripts'); ?>
<?php if($advance_product->view_360_file): ?>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
function checkServiceAvailibity(){
	
	var myKeyVals = { 
	                  id   : <?php echo e($advance_product->id); ?>,
	                  _token   : $('input[name=_token]').val(),
					}
	var saveData = $.ajax({
		  type: 'GET',
		  url: "<?php echo e(url('checkServiceAvailibity/'.$advance_product->id)); ?>",
		  dataType: "text",
		  success: function(data){ 
		     data = JSON.parse(data);
			 console.log(data);
			 $(".delivery_charges_div").html(data.message);
		  }
	});
    saveData.error(function(){ 
	    $('.mobile_error').html('Something went wrong, please try after some time.');
	});
}
<?php if(Session::get('delivery_location')): ?>
checkServiceAvailibity();
<?php endif; ?>


$(function() {
  $("form[name='rating_form']").validate({
    rules: {
      rating: "required",
      headline: "required",
      review: "required",
      photo: {
        accept: "image/jpg,image/jpeg,image/png,image/gif"
      }
    },messages: {
             photo: { accept: 'Please select valid image!'}
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
$(document).ready(function() {
    if (window.location.href.indexOf("Reviews-tab") > -1) {
      $('#Reviews-tab').tab('show');
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/product-detail.blade.php ENDPATH**/ ?>