
<?php $__env->startSection('title', $termList->heading); ?>
<?php $__env->startSection('page-content'); ?>
<main class="main">
        
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10"><?php echo e($termList->heading ?? ''); ?></h1>
                    
                </div>
            </div> 
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $termList->description ?? ''; ?>

                </div>
                
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/pages/term.blade.php ENDPATH**/ ?>