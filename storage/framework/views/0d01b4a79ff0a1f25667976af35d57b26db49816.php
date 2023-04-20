

<?php $__env->startSection('pageTitle'); ?>

    <div class="float-right">
        <a href="<?php echo e(route('myKeyword.create')); ?>" class="btn btn-outline-light">
            Add my keyword
        </a>
    </div>

    <h4 class="page-title"> <i class="dripicons-checklist"></i> My Keyword listing</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Keyword</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $myKeywordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$myKeyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        
                                       
                                      <a href='#' class='btn btn-danger btn-sm'>Delete</a>
                                        
                                    </td>
                                    <td><?php echo e($myKeyword->name); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/affiliate/myKeyword/index.blade.php ENDPATH**/ ?>