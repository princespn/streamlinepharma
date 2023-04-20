
<?php $__env->startSection('title', $offer_page_title); ?>
<?php $__env->startSection('page-content'); ?>
<main class="main">
        
        <section class="product-tabs section-padding position-relative">
      <div class="container">
         <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3><?php echo e($offer_page_title); ?></h3>
         </div>
         <div class="row product-grid-4">
            <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
               <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                  <div class="product-img-action-wrap">
                     <div class="product-img product-img-zoom">
                        <a href="<?php echo e(url('/product-detail/'.$item->buyProduct->sku)); ?>">
                        <img class="default-img" src="<?php echo e(asset($item->buyProduct->thumbnail)); ?>" alt="" />
                        </a>
                     </div>
                  </div>
                  <div class="product-content-wrap">
                     <div class="product-category">
                        <a href="<?php echo e(url('/product-detail/'.$item->buyProduct->sku)); ?>"><?php echo e($item->buyProduct->productName); ?></a>
                     </div>
                     <h2><a href="<?php echo e(url('/product-detail/'.$item->buyProduct->sku)); ?>"><?php echo e($item->buyProduct->title); ?></a></h2>
                     <div>
                                              <p style="text-align:center">
												<strong class="offer" style="color:green;margin-top:10px"><?php echo e($item->sceheme->title); ?></strong><br><br><span style='color:red'>Get <?php echo e($item->get_qty); ?> <?php echo e($item->offerProduct->title); ?></span> if you buy <?php echo e($item->qty); ?>

												</p>
                     </div>
                     <div class="product-card-bottom">
                        <div class="product-price">
                           <span><?php echo e(number_format($item->buyProduct->selling_price,2)); ?></span>
                           <span class="old-price"><?php echo e(number_format($item->buyProduct->product_price,2)); ?></span>
                        </div>
                        <div class="add-cart">
                           <a class="add" href="<?php echo e(url('/product-detail/'.$item->buyProduct->sku)); ?>"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--end product card-->
         </div>
         <!--End product-grid-4-->
      </div>
   </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/offer.blade.php ENDPATH**/ ?>