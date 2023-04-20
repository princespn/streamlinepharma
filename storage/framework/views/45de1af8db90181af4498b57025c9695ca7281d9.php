

<?php $__env->startSection('pageTitle'); ?>
<style>

.chat-window .col-md-2, .col-md-10{
    padding:0;
}
.chat-window .panel{
    margin-bottom: 0px;
}
.chat-window{
    bottom:0;
    position:fixed;
    float:right;
    margin-left:10px;
}
.chat-window > div > .panel{
    border-radius: 5px 5px 0 0;
}
.chat-window .icon_minim{
    padding:2px 10px;
}
.chat-window .msg_container_base{
  background: #e5e5e5;
  margin: 0;
  padding: 0 10px 10px;
  max-height:300px;
  overflow-x:hidden;
}
.chat-window .top-bar {
  background: #666;
  color: white;
  padding: 10px;
  position: relative;
  overflow: hidden;
}
.chat-window .msg_receive{
    padding-left:0;
    margin-left:0;
}
.msg_sent{
    padding-bottom:20px !important;
    margin-right:0;
}
.chat-window .messages {
  background: white;
  padding: 10px;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  max-width:100%;
}
.chat-window .messages > p {
    font-size: 13px;
    margin: 0 0 0.2rem 0;
  }
.chat-window .messages > time {
    font-size: 11px;
    color: #ccc;
}
.chat-window .msg_container {
    padding: 10px;
    overflow: hidden;
    display: flex;
}
.chat-window img {
    display: block;
    width: 100%;
}
.chat-window .avatar {
    position: relative;
}
.chat-window .base_receive > .avatar:after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border: 5px solid #FFF;
    border-left-color: rgba(0, 0, 0, 0);
    border-bottom-color: rgba(0, 0, 0, 0);
}

.chat-window .base_sent {
  justify-content: flex-end;
  align-items: flex-end;
}
.chat-window .base_sent > .avatar:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 0;
    border: 5px solid white;
    border-right-color: transparent;
    border-top-color: transparent;
    box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
}

.chat-window .msg_sent > time{
    float: right;
}



.chat-window .msg_container_base::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.chat-window .msg_container_base::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

.chat-window .msg_container_base::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

.chat-window .btn-group.dropup{
    position:fixed;
    left:0px;
    bottom:0;
}
</style>
<div class="float-right">
  
  
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Profile</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>


<div class="row">
    <div class="col-12">
        
		<div class="card m-b-20">
		    
            <div class="card-body">
			  <?php echo Form::open(['url' => 'admin/upload_logo', 'files' => true]); ?>

			      Current : <image src='<?php echo e(url($account->logo)); ?>' width='150'>
				  <div class="form-group">
					<label for="logo">Logo:</label>
					<input type="file" name='logo' class="form-control" id="logo">
				  </div>
				  <div class="form-group">
					<label for="address">Address:</label>
					<textarea type="text" name='address' class="form-control" id="address"><?php echo e($account->address); ?></textarea>
				  </div>
				  <div class="form-group">
					<label for="title">Company Name:</label>
					<input type="text" name='title' class="form-control" id="title" value='<?php echo e($account->title); ?>'>
				  </div>
				  
				  <button type="submit" class="btn btn-primary">Upload</button>
				<?php echo Form::close(); ?>

			  
			</div>
		</div>
	</div>
</div>

<div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;margin-bottom:70px;">
        <div class="col-xs-12 col-md-12">
        	<div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat - Miguel</h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                    </div>
                </div>
                <div class="panel-body msg_container_base">
                    <div class='msg_container'></div>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" id="btn-chat" onclick='setMsg()'>Send</button>
                        </span>
                    </div>
                </div>
    		</div>
        </div>
    </div>
<script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>
<script>
var firebaseConfig = {
                 apiKey: "AIzaSyB00k_zu-py-D_Eof8khx-leODEl6TotL0",
                 authDomain: "kerp-follow-up.firebaseapp.com",
                 databaseURL: "https://kerp-follow-up-default-rtdb.firebaseio.com",
                 projectId: "kerp-follow-up",
                 storageBucket: "kerp-follow-up.appspot.com",
                 messagingSenderId: "511078098090",
                 appId: "1:511078098090:web:2c4811281c07764f5e5cd3",
                 measurementId: "G-G729WCF5ZQ"
               };
                  firebase.initializeApp(firebaseConfig);
				  var ref = firebase.database().ref("unadc_chat");
				  
				  function setMsg(){
					  const d = new Date();
                      let time = d.getTime();
					  var val = $('#btn-input').val();
					  ref.push ({
						id: 1,
						name: 'Admin',
						message: val,
						timestamp:time,
					  });
					  $('#btn-input').val('');
				  }
function timeSince(date) {

  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = seconds / 31536000;

  if (interval > 1) {
    return Math.floor(interval) + " years";
  }
  interval = seconds / 2592000;
  if (interval > 1) {
    return Math.floor(interval) + " months";
  }
  interval = seconds / 86400;
  if (interval > 1) {
    return Math.floor(interval) + " days";
  }
  interval = seconds / 3600;
  if (interval > 1) {
    return Math.floor(interval) + " hours";
  }
  interval = seconds / 60;
  if (interval > 1) {
    return Math.floor(interval) + " minutes";
  }
  return Math.floor(seconds) + " seconds";
}
ref.on("child_added", function(snapshot) {
   var value = snapshot.val();
   var html = '';
   if(value.id==2){
	   html += '<div class="row msg_container base_receive"><div class="col-md-10 col-xs-10"><div class="messages msg_receive"><p>'+value.message+'</p><time datetime="2009-11-13T20:00">'+timeSince(value.timestamp)+' ago by <b>User</b></time> </div></div></div>';
   }else{
	   html += '<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10"><div class="messages msg_sent"><p>'+value.message+'</p><time datetime="2009-11-13T20:00">'+timeSince(value.timestamp)+' ago by <b>You</b></time> </div></div></div>';
   }
   
   $(html).insertAfter($('.msg_container').last());
   $(".msg_container_base").stop().animate({ scrollTop: $(".msg_container_base")[0].scrollHeight}, 1000);

}, function (error) {
   console.log("Error: " + error.code);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/profile/index.blade.php ENDPATH**/ ?>