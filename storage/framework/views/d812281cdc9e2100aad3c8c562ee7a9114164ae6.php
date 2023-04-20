

<?php $__env->startSection('pageTitle'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="csrfToken">
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">

                <?php echo Form::open(['route' => 'msg.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

                <?php echo e(csrf_field()); ?>


                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <?php if($errors->any()): ?>
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            <?php echo e($errors->first()); ?>

                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row tags">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Tags</label><br />
                            <button type="button" onclick="addTags(this)" data-type="[CUSTOMER_NAME]" class="btn">Customer Name</button>
                            <button type="button" onclick="addTags(this)" data-type="[ORDER_NO]" class="btn">Order NO</button>
                            <button type="button" onclick="addTags(this)" data-type="[GRAND_TOTAL]" class="btn">Grand Total</button>  
							<button type="button" onclick="addTags(this)" data-type="[OTP]" class="btn">OTP</button>
							<button type="button" onclick="addTags(this)" data-type="[Order_Number]" class="btn">Order Number</button>
							<button type="button" onclick="addTags(this)" data-type="[Date_of_Order]" class="btn">Date of Order</button>
							<button type="button" onclick="addTags(this)" data-type="[Order_Amount]" class="btn">Order Amount</button>
							<button type="button" onclick="addTags(this)" data-type="[Refund_Amount]" class="btn">Refund Amount</button>
							<button type="button" onclick="addTags(this)" data-type="[Product_Name]" class="btn">Product Name</button>
							<button type="button" onclick="addTags(this)" data-type="[User_Mobile_Number]" class="btn">User Mobile Number</button>
							<button type="button" onclick="addTags(this)" data-type="[Offer_Name]" class="btn">Offer Name</button>
							<button type="button" onclick="addTags(this)" data-type="[Scheem_Name]" class="btn">Scheem Name</button>
							<button type="button" onclick="addTags(this)" data-type="[Discount_%]" class="btn">Discount %</button>
							<button type="button" onclick="addTags(this)" data-type="[Discount_Code_Or_Coupan_Code]" class="btn">Discount Code Or Coupan Code</button>
							<button type="button" onclick="addTags(this)" data-type="[Offer_vaildity_Date]" class="btn">Offer vaildity Date</button>
							<button type="button" onclick="addTags(this)" data-type="[Product_Link]" class="btn">Product_Link</button>
							<button type="button" onclick="addTags(this)" data-type="[Referral Scheme Header]" class="btn">Referral Scheme Header</button>
							<button type="button" onclick="addTags(this)" data-type="[Order Type]" class="btn">Order Type</button>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" id="msgType" name="msg_type" onchange="getExistData()" required>
                                <option value="">Select type</option>
                                <option value="1">Order Creation</option>
                                <option value="8">Order Creation - Admin</option>
                                <option value="9">Order Cancel</option>
                                <option value="2">Order Accepted</option>
                                <option value="3">Order Rejected</option>
                                <option value="4">Users Sign Up OTP</option>
                                <option value="5">Users Login OTP</option>
                                <option value="6">User Forget Password OTP</option>
                                <option value="7">Referral Scheme</option>
                            </select>
                        </div>
                    </div>
                </div>
				<div class="row messages">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label>Messages</label>
                            <textarea id="messages" rows="5" name="messages" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" id="msgstatus" name="status" required>
                                <option value="">Select type</option>
                                <option value="1">Enable</option>
                                <option value="2">Disable</option>
                            </select>
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label>Template ID</label>
                            <input type='text' id="template_id"  name="template_id" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">

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
<script>
    function addTags(obj) {
        var v = $(obj).data('type');
        insertAtCursor(document.getElementById('messages'), v);
    }

    function insertAtCursor(myField, myValue) {
        if (document.selection) {
            myField.focus();
            sel = document.selection.createRange();
            sel.text = myValue;
        } else if (window.navigator.userAgent.indexOf("Edge") > -1) {
            var startPos = myField.selectionStart;
            var endPos = myField.selectionEnd;

            myField.value = myField.value.substring(0, startPos) + myValue +
                myField.value.substring(endPos, myField.value.length);

            var pos = startPos + myValue.length;
            myField.focus();
            myField.setSelectionRange(pos, pos);
        } else if (myField.selectionStart || myField.selectionStart == '0') {
            var startPos = myField.selectionStart;
            var endPos = myField.selectionEnd;
            myField.value = myField.value.substring(0, startPos) +
                myValue +
                myField.value.substring(endPos, myField.value.length);
        } else {
            myField.value += myValue;
        }
    }

    function getExistData() {
        var param = {'type':$('#msgType').val()};
        var csrfToken = document.getElementById("csrfToken").value;
        jQuery.ajax({
            url: "<?php echo e(route('msginfo')); ?>",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                data: param
            }),
            success: function(data) {console.log(data);
                if (data.status=='success') {
                    $('#messages').val(data.msg);
                    $('#msgstatus').val(data.msgStatus);
                    $('#template_id').val(data.template_id);
                }else{
                    $('#messages').val('');
                    $('#msgstatus').val('');
                    $('#template_id').val('');
                }
            } 
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/msg/index.blade.php ENDPATH**/ ?>