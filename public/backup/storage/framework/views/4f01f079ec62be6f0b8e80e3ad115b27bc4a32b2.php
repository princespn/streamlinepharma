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


<!-- Latest Blog -->
<?php $__currentLoopData = $categoryProductList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(count($category->productlevel1) > 0): ?>
        <div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3><?php echo e($category->name); ?></h3>
                    <p><?php echo $category->description; ?></p>
                    <img src="<?php echo e(asset('assets/theam1/images/section-seprator.png')); ?>" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                <?php $__currentLoopData = $category->productlevel1->skip(0)->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productlevel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if($productlevel->status): ?>

                        <?php $__currentLoopData = $productlevel->productvariations->skip(0)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if($item->inventory_price->sprice ?? 0 && $item->inventory_price->mrp ?? 0): ?>
                              <div class="col-md-3 col-sm-6 col-xs-6">
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
                                                <p style="height: 50px;overflow: hidden;"><?php echo $productlevel->description; ?></p>
                                                <a href="<?php echo e(route('detail', array('id' => $item->id))); ?>" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </div>
            <!-- Container /- -->
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('theams/theam1/layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/backup/resources/views/theams/theam1/index.blade.php ENDPATH**/ ?>