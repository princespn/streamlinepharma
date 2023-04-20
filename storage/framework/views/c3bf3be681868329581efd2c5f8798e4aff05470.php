<?php $__env->startSection('pageTitle'); ?>



    <div class="float-right">

        <a href="<?php echo e(route('label.create')); ?>" class="btn btn-outline-light">

            Add label

        </a>

    </div>



    <h4 class="page-title"> <i class="dripicons-tags"></i> Label listing</h4>



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

                                <th>Tag</th>

                                <th>Label</th>

                                <th>Highlight</th>

                                <th>Filter</th>

                                <th>Option</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $__currentLoopData = $labelList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>

                                    <td>

                                        

                                        <!--Delete Popup-->

                                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($label->id); ?>" title="Delete this data"></i>



                                        <div class="modal fade deletePopup<?php echo e($label->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-dialog-centered">

                                                <div class="modal-content">

                                                    <div class="modal-header">

                                                        <h5 class="modal-title mt-0"><?php echo e($label->label); ?></h5>

                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                    </div>

                                                    <div class="modal-body">

                                                        <p>Are you sure want to delete this?</p>

                                                    </div>

                                                    <div class="modal-footer">

                                                        <?php echo e(Form::open(array('url' => 'admin/label/' . $label->id))); ?>


                                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                                            <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                        <?php echo e(Form::close()); ?>


                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                        <!--Edit Icon-->

                                        <a href="<?php echo e(URL::to('admin/label/'. $label->id.'/edit')); ?>">

                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>

                                        </a>

                                    </td>

                                    <td><?php echo e($label->tag->tag); ?></td>

                                    <td><?php echo e($label->label); ?></td>

                                    <td>

                                        <?php if($label->highlight == 1): ?>

                                            <i class="mdi mdi-check text-success"></i>

                                        <?php else: ?>

                                            <i class="mdi mdi-close text-warning"></i>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php if($label->filter == 1): ?>

                                            <i class="mdi mdi-check text-success"></i>

                                        <?php else: ?>

                                            <i class="mdi mdi-close text-warning"></i>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php if($label->option == 1): ?>

                                            <i class="mdi mdi-check text-success"></i>

                                        <?php else: ?>

                                            <i class="mdi mdi-close text-warning"></i>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php if($label->status == 1): ?>

                                            <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active

                                        <?php else: ?>

                                            <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive

                                        <?php endif; ?>

                                    </td>

                                </tr>

                                

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>

                    </table>



                </div>

            </div>

        </div>

    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/tagLabel/label/index.blade.php ENDPATH**/ ?>