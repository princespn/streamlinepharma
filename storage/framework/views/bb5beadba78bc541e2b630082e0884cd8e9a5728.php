
<?php $__env->startSection('title', 'Contact'); ?>
<?php $__env->startSection('page-content'); ?>
<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo e(url('/')); ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                     Contact
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="mb-50">
                            
                            <div class="row">
                                
                                <div class="col-lg-12 pl-50 d-lg-block d-none" style='text-align: center;'>
                                    <h4 class="mb-15 text-brand">Office</h4>
                                    <?php echo e($account->address); ?><br />
                                    <?php echo e($account->landmark); ?><br />
                                    <abbr title="Phone">Phone:</abbr> <?php echo e($account->phone); ?><br />
                                    <abbr title="Email">Email: </abbr><?php echo e($account->email); ?><br />
                                    
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/pages/contact.blade.php ENDPATH**/ ?>