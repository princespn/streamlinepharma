<?php $__env->startSection('pageTitle'); ?>



    <div class="float-right">

        <a href="<?php echo e(route('account.index')); ?>" class="btn btn-outline-light">

            Back

        </a>

    </div>

    <h4 class="page-title"> <i class="dripicons-user-group"></i> Create account</h4>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('contentData'); ?>



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">



                    <?php echo Form::open(['route' => 'account.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>


                    <?php echo e(csrf_field()); ?>


                

                        <div class="row">



                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <?php if($errors->any()): ?>

                                    <div class="alert bg-danger text-white msgPopup" role="alert">

                                    <?php echo e($errors->first()); ?>


                                    </div>

                                <?php endif; ?>

                            </div>


                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Account Type</label>

                                    <select type="text" name="account_type" class="form-control" required>
									<option>Demand</option>
									<option>Supply</option>
									</select>

                                </div>

                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Choose Logo</label>

                                    

                                    <input type="file" name="logo" class="filestyle" data-buttonname="btn-secondary" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Title</label>

                                    <input type="text" name="title" class="form-control" required/>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Email</label>

                                    <input type="email" name="email" class="form-control" required/>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Phone Number</label>

                                    <input type="number" name="phone" class="form-control" required/>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>WhatsApp Number</label>

                                    <input type="number" name="whatsApp" class="form-control"/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Landmark</label>

                                    <input type="text" name="landmark" class="form-control" required/>

                                </div>

                            </div>                            

                            <div class="col-sm-6 col-md-4 col-lg-6">

                                <div class="form-group">

                                    <label>Address</label>

                                    <input type="text" name="address" class="form-control" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Pin Code</label>

                                    <input type="number" name="pinCode" id="pinCode" placeholder="Enter your pinCode"  class="form-control" required/>
                                    <p id="pinMSG"></p>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>SMS User Name</label>

                                    <input type="text" name="SMSUserName" class="form-control" />

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>SMS User Password</label>

                                    <input type="password" name="SMSUserPassword" class="form-control" />

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>SMS Sender Id</label>

                                    <input type="text" name="SMSUserSenderId" class="form-control" />

                                </div>

                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="form-group">

                                    <label>SMS Link</label>
                                    <input type="text" name="SMSApi" class="form-control" />
                                    <span class="font-13 text-muted">
                                        1. http://nimbusit.co.in/api/swsendSingle.asp?username=setUsername&password=setPassword&sender=setSenderId&sendto=setPhone&message=setMessage&TemplateID=setTEMPLATEID
                                    </span> <br>
                                    <span class="font-13 text-muted">
                                        2. http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=setUsername&Password=setPassword&SenderID=setSenderId&Phno=setPhone&Msg=setMessage&TemplateID=setTEMPLATEID
                                    </span>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Instamojo Api Key</label>

                                    <input type="text" name="instamojoApiKey" class="form-control" />

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Instamojo Auth Token</label>

                                    <input type="text" name="instamojoAuthToken" class="form-control" />

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Shipyaari User Name</label>

                                    <input type="text" name="shipyaariUserName" class="form-control" />

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Shipyaari Client Code</label>

                                    <input type="number" name="shipyaariClientCode" class="form-control" />

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Shipyaari Parent Code</label>

                                    <input type="number" name="shipyaariParentCode" class="form-control" />

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Shiprocket API Email</label>

                                    <input type="email" name="shiprocketEmail" class="form-control"  />

                                </div>

                            </div>
							<div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">

                                    <label>Shiprocket API Password</label>

                                    <input type="password" name="shiprocketPassword" class="form-control"  />

                                </div>

                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Select Default Shipping Method</label>

                                    <select name="defaultShippingMethod" class="form-control select2"  >

                                        <option value=''></option>
                                        <option>Shipyaari</option>
                                        <option>Shiprocket</option>

                                    </select>

                                </div>

                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Select Default Currency</label>

                                    <select name="defaultCurrency" class="form-control select2" >

                                        <option value="">Select Default Currency</option>

                                        <?php $__currentLoopData = $currencyList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option value="<?php echo e($currency->id); ?>"><?php echo e($currency->title); ?></option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Select Website Type</label>

                                    <select name="type" class="form-control select2" required>

                                        <option value="">Select Website Type</option>

                                        <option value="1">E-Commerce</option>

                                        <option value="2">Hybrid</option>

                                        <option value="3">Inquiry</option>

                                    </select>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Select Theme Number</label>

                                    <select name="theme" class="form-control select2" >

                                        <option value="">Select Theme Number</option>

                                        <option value="1">1</option>

                                        <option value="2">2</option>

                                        <option value="3">3</option>

                                    </select>

                                </div>

                            </div>

                            

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Theme Color</label>

                                    <input type="text" name="color" class="colorpicker-default form-control" required value="#8fff00">

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Domain Name</label>

                                    <input type="text" name="domain" class="form-control" required/>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Charge in %</label>

                                    <input type="number" name="charge" class="form-control" max="50" required/>

                                </div>

                            </div>



                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Password</label>

                                    <input type="password" name="password" class="form-control" required/>

                                </div>

                            </div>



                            <div class="col-sm-12 col-md-12 col-lg-12">


                                <input type="hidden" value="<?php echo e(csrf_token()); ?>" id="csrfToken">
                                <button type="submit" class="btn btn-outline-primary">

                                    Submit

                                </button>

                            </div>

                        </div>



                    <?php echo Form::close(); ?> 



                </div>

            </div>

        </div>

    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/account/add.blade.php ENDPATH**/ ?>