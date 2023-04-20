<?php $__env->startSection('theme1Content'); ?>



<!-- Slider Section 1 -->

<div id="home-revslider" class="slider-section container-fluid no-padding">

    <!-- START  SLIDER 5.0 -->

    <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->

        <ol class="carousel-indicators">

            <?php $__currentLoopData = $sliderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <li data-target="#myCarousel" data-slide-to="<?php echo e($key); ?>" class="<?php echo e($key == 0 ? 'active' : ''); ?>"></li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ol>



        <!-- Wrapper for slides -->

        <div class="carousel-inner">



            <?php $__currentLoopData = $sliderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



            <div class="item <?php echo e($key == 0 ? 'active' : ''); ?>">

                <img src="<?php echo e(asset($slider->imageURL)); ?>" style="width:100%;">

            </div>



            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        </div>



        <!-- Left and right controls -->

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">

            <span class="glyphicon glyphicon-chevron-left"></span>

            <span class="sr-only">Previous</span>

        </a>

        <a class="right carousel-control" href="#myCarousel" data-slide="next">

            <span class="glyphicon glyphicon-chevron-right"></span>

            <span class="sr-only">Next</span>

        </a>

    </div>

    <!-- END OF SLIDER WRAPPER -->

</div>

<!-- Slider Section 1 /- -->


<!-- Services Section -->

<div class="services-section container-fluid">

    <!-- Container -->

    <div class="container">

        <?php if($extraServiceList[0]->delivery ?? ''): ?>
            <div class="col-md-4 col-sm-4 col-xs-4">

                <div class="srv-box">

                    <i class="icon icon-Truck"></i>

                    <h5><?php echo e($extraServiceList[0]->deliveryTitle); ?></h5><i class="icon icon-Dollar"></i>                

                </div>

            </div>
        <?php endif; ?>

        <?php if($extraServiceList[0]->moneyBack ?? ''): ?>
        <div class="col-md-4 col-sm-4 col-xs-4">

            <div class="srv-box">

                <i class="icon icon-Goto"></i>

                <h5><?php echo e($extraServiceList[0]->moneyBackTitle); ?></h5><i class="icon icon-Dollars"></i>

            </div>

        </div>
        <?php endif; ?>

        <?php if($extraServiceList[0]->support ?? ''): ?>
        <div class="col-md-4 col-sm-4 col-xs-4">

            <div class="srv-box">

                <i class="icon icon-Headset"></i>

                <h5><?php echo e($extraServiceList[0]->supportTitle); ?></h5><i class="icon icon-Timer"></i>

            </div>

        </div>
        <?php endif; ?>

    </div><!-- Container /- -->

</div>

<!-- Services Section /- -->





<!------------------------------------------------------------------->
<?php if(count($advance_product)): ?>
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>New Arrival</h3>
                    <img src="<?php echo e(asset('assets/theam1/images/section-seprator.png')); ?>" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                <?php $__currentLoopData = $advance_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="<?php echo e(url('detail/'.$item->sku)); ?>">
                                                <img src="<?php echo e(asset($item->thumbnail)); ?>" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="<?php echo e($item->productName); ?>" href="<?php echo e(url('detail/'.$item->sku)); ?>">
                                                    <span><?php echo e($item->title); ?></span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        <?php echo e(number_format($item->product_price,2)); ?>

                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        <?php echo e($item->discount); ?>% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b><?php echo e(number_format($item->selling_price,2)); ?></b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="<?php echo e(url('detail/'.$item->sku)); ?>" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </div>
            <!-- Container /- -->
        </div>
<?php endif; ?>
<!------------------------------------------------------------------->
<?php if(count($deals)): ?>
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3><?php echo e($account->offer_page_title); ?></h3>
                    <img src="<?php echo e(asset('assets/theam1/images/section-seprator.png')); ?>" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="<?php echo e(url('detail/'.$item->buyProduct->sku)); ?>">
                                                <img src="<?php echo e(asset($item->buyProduct->thumbnail)); ?>" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="<?php echo e($item->buyProduct->productName); ?>" href="<?php echo e(url('detail/'.$item->buyProduct->sku)); ?>">
                                                    <span><?php echo e($item->buyProduct->title); ?></span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        <?php echo e(number_format($item->buyProduct->product_price,2)); ?>

                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        <?php echo e($item->buyProduct->discount); ?>% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b><?php echo e(number_format($item->buyProduct->selling_price,2)); ?></b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
											<p style="text-align:center">
												<strong class="offer" style="color:green"><?php echo e($item->sceheme->title); ?></strong><br><br>Get <?php echo e($item->get_qty); ?> <?php echo e($item->offerProduct->title); ?> if you buy <?php echo e($item->qty); ?>

												</p>


												
                                                <a href="<?php echo e(url('detail/'.$item->buyProduct->sku)); ?>" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </div>
            <!-- Container /- -->
        </div>
<?php endif; ?>
<!------------------------------------------------------------------->
<!------------------------------------------------------------------->
<?php if(count($discount)): ?>
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>High Discount</h3>
                    <img src="<?php echo e(asset('assets/theam1/images/section-seprator.png')); ?>" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                <?php $__currentLoopData = $discount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="<?php echo e(url('detail/'.$item->sku)); ?>">
                                                <img src="<?php echo e(asset($item->thumbnail)); ?>" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="<?php echo e($item->productName); ?>" href="<?php echo e(url('detail/'.$item->sku)); ?>">
                                                    <span><?php echo e($item->title); ?></span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        <?php echo e(number_format($item->product_price,2)); ?>

                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        <?php echo e($item->discount); ?>% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b><?php echo e(number_format($item->selling_price,2)); ?></b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="<?php echo e(url('detail/'.$item->sku)); ?>" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </div>
            <!-- Container /- -->
        </div>
<?php endif; ?>
<!------------------------------------------------------------------->
<!------------------------------------------------------------------->
<?php if(count($trending)): ?>
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>Trending</h3>
                    <img src="<?php echo e(asset('assets/theam1/images/section-seprator.png')); ?>" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                <?php $__currentLoopData = $trending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="<?php echo e(url('detail/'.$item->sku)); ?>">
                                                <img src="<?php echo e(asset($item->thumbnail)); ?>" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="<?php echo e($item->productName); ?>" href="<?php echo e(url('detail/'.$item->sku)); ?>">
                                                    <span><?php echo e($item->title); ?></span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        <?php echo e(number_format($item->product_price,2)); ?>

                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        <?php echo e($item->discount); ?>% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b><?php echo e(number_format($item->selling_price,2)); ?></b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="<?php echo e(url('detail/'.$item->sku)); ?>" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </div>
            <!-- Container /- -->
        </div>
<?php endif; ?>
<!------------------------------------------------------------------->
<!------------------------------------------------------------------->
<?php if(isset($viewed)&&count($viewed)): ?>
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>Recently Viewed</h3>
                    <img src="<?php echo e(asset('assets/theam1/images/section-seprator.png')); ?>" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                <?php $__currentLoopData = $viewed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="<?php echo e(url('detail/'.$item->sku)); ?>">
                                                <img src="<?php echo e(asset($item->thumbnail)); ?>" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="<?php echo e($item->productName); ?>" href="<?php echo e(url('detail/'.$item->sku)); ?>">
                                                    <span><?php echo e($item->title); ?></span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        <?php echo e(number_format($item->product_price,2)); ?>

                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        <?php echo e($item->discount); ?>% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b><?php echo e(number_format($item->selling_price,2)); ?></b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="<?php echo e(url('detail/'.$item->sku)); ?>" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </div>
            <!-- Container /- -->
        </div>
<?php endif; ?>
<!------------------------------------------------------------------->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('theams/theam1/layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/theams/theam1/index.blade.php ENDPATH**/ ?>