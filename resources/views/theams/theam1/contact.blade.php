@extends('theams/theam1/layouts.app')

@section('theme1Content')
@include('chat.chat');


    <!-- Page Banner -->

    <div class="page-banner container-fluid no-padding">

        <!-- Container -->

        <div class="container">

            <div class="banner-content">

                <h3>Contact Us</h3>

            </div>

            <ol class="breadcrumb">

                <li><a href="/" title="Home">Home</a></li>

                <li class="active">Contact Us</li>

            </ol>

        </div><!-- Container /- -->

    </div><!-- Page Banner /- -->



    <!-- Contact Us -->

    <div class="contact-us container-fluid no-padding">

        <div class="col-md-6 col-sm-6 col-xs-12 no-padding">

            <div class="contact-detail">

                <!-- Section Header -->

                <div class="section-header">

                    <h3>Get In Touch</h3>

                    <p>Also Connect With Social Media To Anytime</p>

                </div><!-- Section Header /- -->

                <div class="contact-info">

                   
                 @if(Session::get('register'))
                    <p>
					<button class='btn btn-lg btn-info' onclick="$('.chat-window').toggle(); $('.msg_container_base').stop().animate({ scrollTop: $('.msg_container_base')[0].scrollHeight}, 1000);" type='button'>Chat Now</button>
					</p>
                 @else
					<p>
					<a style='width:200px;margin: auto;' class='btn btn-lg btn-info' href="{{ url('login') }}">Log in to Chat</a>
						</p> 
				 @endif
                </div>
				<div class="contact-info">

                    <i class="icon icon-Pointer"></i>

                    <p>{{$account->address}}</p>

                </div>

                <div class="contact-info">

                    <i class="icon icon-Phone2"></i>

                    <a href="tel:{{$account->phone}}" title="Phone" class="phone">{{$account->phone}}</a>

                </div>

                <div class="contact-info">

                    <i class="icon icon-Imbox"></i>

                    <a href="mailto:{{$account->email}}" title="{{$account->email}}">{{$account->email}}</a>

                </div>



                <ul class="social">

                    @if($socialList && $socialList->facebook)

                        <li><a href="{{$socialList->facebook}}" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>  

                    @endif

                    @if($socialList && $socialList->twitter)

                        <li><a href="{{$socialList->twitter}}" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>  

                    @endif



                    @if($socialList && $socialList->googleplus)

                        <li><a href="{{$socialList->googleplus}}" target="_blank" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>

                    @endif



                    @if($socialList && $socialList->instagram)

                        <li><a href="{{$socialList->instagram}}" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>

                    @endif



                    @if($socialList && $socialList->pinterest)

                        <li><a href="{{$socialList->pinterest}}" target="_blank" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>  

                    @endif



                    @if($socialList && $socialList->dribble)

                        <li><a href="{{$socialList->dribble}}" target="_blank" title="Dribbble"><i class="fa fa-dribbble"></i></a></li>

                    @endif



                    @if($socialList && $socialList->vimeo)

                        <li><a href="{{$socialList->vimeo}}" target="_blank" title="Vimeo"><i class="fa fa-vimeo"></i></a></li>

                    @endif



                    @if($socialList && $socialList->youtube)

                        <li><a href="{{$socialList->youtube}}" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li> 

                    @endif

					@if($socialList && $socialList->linkedin)

                        <li><a href="{{$socialList->linkedin}}" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li> 

                    @endif

                </ul>

            </div>

        </div>

        <div class="col-md-6 col-sm-6 col-xs-12 no-padding">

            {!! Form::open(['route' => 'contactSubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
            {{ csrf_field() }}


            <div class="form-detail">

                <div class="section-header">
                    <h3>Send a Message</h3>
                    <p>Feel Free To Say Everything And Ask Questions</p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter your name *" required/>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Enter your phone number *" required/>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                    <input type="text" name="email" class="form-control" placeholder="Enter your email address *" required/>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                    <input type="text" name="title" class="form-control" placeholder="Enter title *" required>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <textarea name="description" class="form-control" placeholder="Type your message *" rows="5"></textarea>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <button title="Submit" type="submit"  name="post">Send Message</button>
                </div>
                @if($errors->any())
                    <div id="alert-msg" class="alert-msg">{{$errors->first()}}</div>
                @endif
            </div>

            {!! Form::close() !!} 

        </div>

    </div>

    <!-- Contact Us /- -->


<div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12">
        	<div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Support</h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        
                       <span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1" onclick="$('.chat-window').toggle();" style='cursor: pointer;'></span>
                    </div>
                </div>
                <div class="panel-body msg_container_base">
                    <div class='msg_container'></div>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" form='chat_form' type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                        <span class="input-group-btn">
                        <button type='button' class="btn  btn-sm" id="btn-chat" onclick='setMsg()'>Send</button>
                        </span>
                    </div>
                </div>
    		</div>
        </div>
    </div>
	<form id='chat_form' onsubmit='return setMsg();'>
	
	</form>
<script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>
<script>
@if(Session::get('register'))
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
				  var ref_chat = firebase.database().ref("unadc_chat/{{ Session::get('register')->account_id }}/{{ Session::get('register')->id }}/chat");
				  var ref_name = firebase.database().ref("unadc_chat/{{ Session::get('register')->account_id }}/{{ Session::get('register')->id }}/");
				  
				  function setMsg(){
					  const d = new Date();
                      let time = d.getTime();
					  var val = $('#btn-input').val();
					  if($('#btn-input').val()!=''){
					  ref_chat.push({
						id: {{ Session::get('register')->id }},
						name: '{{ Session::get('register')->name }}',
						message: val,
						timestamp:time,
					  });
					  ref_name.update({
						name: '{{ Session::get('register')->name }}',
						message_time: time ,
						last_message: val 
					  });
					  }
					  $('#btn-input').val('');
					  return false;
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
   var html = '';
   if(value.id!={{ Session::get('register')->id }}){
	   html += '<div class="row msg_container base_receive"><div class="col-md-10 col-xs-10"><div class="messages msg_receive"><p>'+value.message+'</p><time datetime="2009-11-13T20:00">'+timeSince(value.timestamp)+' ago by <b>Admin</b></time> </div></div></div>';
   }else{
	   html += '<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10"><div class="messages msg_sent"><p>'+value.message+'</p><time datetime="2009-11-13T20:00">'+timeSince(value.timestamp)+' ago by <b>You</b></time> </div></div></div>';
   }
   $(html).insertAfter($('.msg_container').last());
   $(".msg_container_base").stop().animate({ scrollTop: $(".msg_container_base")[0].scrollHeight}, 1000);

}, function (error) {
   console.log("Error: " + error.code);
});
@endif
</script>
@endsection