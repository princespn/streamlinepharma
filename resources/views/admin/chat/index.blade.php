@extends('layouts.app')

@section('pageTitle')
<style>
.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%;
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
</style>
<div class="float-right">
  
  
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Support</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-header">Added</div>
            <div class="card-body">
              <!---------------------------->
              <div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <!--div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div-->
          <div class="inbox_chat">
            <div class="chat_list active_chat">
              <div class="chat_people">
                
              </div>
            </div>
          </div>
        </div>
        <div class="mesgs">
          <div class="msg_history">
            
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a message" id='send_admin_btn' />
              <button class="msg_send_btn" type="button" onclick='setMsg()'><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
      </div>
      
      
      
      
    </div>
              <!---------------------------->
            </div>
        </div>
    </div>
</div>
<script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>
<script>
var active_id = 0;
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
				  var ref_chat = firebase.database().ref("unadc_chat/{{Session::get('user')->id}}");
				  
				  
				  function setMsg(){
					  if(active_id!=0){
						  const d = new Date();
						  let time = d.getTime();
						  var val = $('#send_admin_btn').val();
						  if($('#send_admin_btn').val()!=''){
						  var ref_chat_admin = firebase.database().ref("unadc_chat/{{Session::get('user')->id}}/"+active_id+'/chat');
						  ref_chat_admin.push({
							id: {{Session::get('user')->id}},
							name: '{{Session::get('user')->id}}->name }}',
							message: val,
							timestamp:time,
						  });
						  
						  }
						  $('#send_admin_btn').val('');
						  return false;
					  }
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
ref_chat.on("child_added", function(snapshot) {
   var value = snapshot.val();
   var html = '<div class="chat_list" onclick="initiateChat('+snapshot.key+')"><div class="chat_people"><div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div><div class="chat_ib"><h5>'+value.name+'<span class="chat_date">'+timeSince(value.message_time)+' ago</span></h5><p>'+value.last_message+'</p></div></div></div>';
   console.log(html);
   $(html).insertAfter($('.chat_list').last());

}, function (error) {
   console.log("Error: " + error.code);
});
ref_chat.on("child_changed", function(snapshot) {
   var value = snapshot.val();
   //console.log(value);

}, function (error) {
   console.log("Error: " + error.code);
});


function initiateChat(key){
	active_id = key;
	var ref_chat_user = firebase.database().ref("unadc_chat/{{Session::get('user')->id}}/"+key+'/chat');
	$('.msg_history').html('<div class="msg_box_ind"></div>');
	ref_chat_user.on("child_added", function(snapshot) {
		var ref_value = snapshot.val();
		console.log(ref_value);
		rhtml = '';
		if(Number(ref_value.id)==Number({{Session::get('user')->id}})){
			rhtml = '<div class="outgoing_msg msg_box_ind"><div class="sent_msg"><p>'+ref_value.message+'</p><span class="time_date"> '+timeSince(ref_value.timestamp)+' ago</span> </div></div>';
		}else{
			rhtml = '<div class="incoming_msg msg_box_ind"><div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div><div class="received_msg"><div class="received_withd_msg"><p>'+ref_value.message+'</p><span class="time_date"> '+timeSince(ref_value.timestamp)+' ago</span></div></div></div>';
		}
		 $(rhtml).insertAfter($('.msg_box_ind').last());
		 $(".msg_history").stop().animate({ scrollTop: $(".msg_history")[0].scrollHeight}, 1000);
	}, function (error) {
        console.log("Error: " + error.code);
    });
}

</script>
@endsection