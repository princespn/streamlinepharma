@extends('theams/theam1/layouts.app')

@section('theme1Content')


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
	right:0px;
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
#btn-chat{
	background: #f93065; 
}
.chat-window .top-bar {
  background: #f93065;
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
  border-radius:15px;
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

.chat-window .panel-footer{
	padding:0px;
}
.chat-window .btn-group.dropup{
    position:fixed;
    left:0px;
    bottom:0;
}
.chat-window .btn-group.dropup input{
	border:0px;
}
</style>
<!-- Slider Section 1 -->

<div id="home-revslider" class="slider-section container-fluid no-padding">

    <!-- START  SLIDER 5.0 -->

    <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->

        <ol class="carousel-indicators">

            @foreach ($sliderList as $key=>$slider)

            <li data-target="#myCarousel" data-slide-to="{{  $key }}" class="{{ $key == 0 ? 'active' : ''}}"></li>

            @endforeach

        </ol>



        <!-- Wrapper for slides -->

        <div class="carousel-inner">



            @foreach ($sliderList as $key=>$slider)



            <div class="item {{ $key == 0 ? 'active' : ''}}">

                <img src="{{ asset($slider->imageURL) }}" style="width:100%;">

            </div>



            @endforeach



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

        @if($extraServiceList[0]->delivery ?? '')
            <div class="col-md-4 col-sm-4 col-xs-4">

                <div class="srv-box">

                    <i class="icon icon-Truck"></i>

                    <h5>{{$extraServiceList[0]->deliveryTitle}}</h5><i class="icon icon-Dollar"></i>                

                </div>

            </div>
        @endif

        @if($extraServiceList[0]->moneyBack ?? '')
        <div class="col-md-4 col-sm-4 col-xs-4">

            <div class="srv-box">

                <i class="icon icon-Goto"></i>

                <h5>{{$extraServiceList[0]->moneyBackTitle}}</h5><i class="icon icon-Dollars"></i>

            </div>

        </div>
        @endif

        @if($extraServiceList[0]->support ?? '')
        <div class="col-md-4 col-sm-4 col-xs-4">

            <div class="srv-box">

                <i class="icon icon-Headset"></i>

                <h5>{{$extraServiceList[0]->supportTitle}}</h5><i class="icon icon-Timer"></i>

            </div>

        </div>
        @endif

    </div><!-- Container /- -->

</div>

<!-- Services Section /- -->





<!------------------------------------------------------------------->
@if(count($advance_product))
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>New Arrival</h3>
                    <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                @foreach ($advance_product as $item)
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="{{ url('detail/'.$item->sku) }}">
                                                <img src="{{ asset($item->thumbnail) }}" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="{{ $item->productName }}" href="{{ url('detail/'.$item->sku) }}">
                                                    <span>{{ $item->title }}</span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        {{number_format($item->product_price,2)}}
                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        {{ $item->discount }}% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b>{{number_format($item->selling_price,2)}}</b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="{{ url('detail/'.$item->sku) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
            </div>
            <!-- Container /- -->
        </div>
@endif
<!------------------------------------------------------------------->
@if(count($deals))
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>{{ $account->offer_page_title }}</h3>
                    <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                @foreach ($deals as $item)
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="{{ url('detail/'.$item->buyProduct->sku) }}">
                                                <img src="{{ asset($item->buyProduct->thumbnail) }}" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="{{ $item->buyProduct->productName }}" href="{{ url('detail/'.$item->buyProduct->sku) }}">
                                                    <span>{{ $item->buyProduct->title }}</span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        {{number_format($item->buyProduct->product_price,2)}}
                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        {{ $item->buyProduct->discount }}% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b>{{number_format($item->buyProduct->selling_price,2)}}</b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
											<p style="text-align:center">
												<strong class="offer" style="color:green">{{ $item->sceheme->title }}</strong><br><br>Get {{ $item->get_qty }} {{ $item->offerProduct->title }} if you buy {{ $item->qty }}
												</p>


												
                                                <a href="{{ url('detail/'.$item->buyProduct->sku) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
            </div>
            <!-- Container /- -->
        </div>
@endif
<!------------------------------------------------------------------->
<!------------------------------------------------------------------->
@if(count($discount))
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>High Discount</h3>
                    <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                @foreach ($discount as $item)
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="{{ url('detail/'.$item->sku) }}">
                                                <img src="{{ asset($item->thumbnail) }}" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="{{ $item->productName }}" href="{{ url('detail/'.$item->sku) }}">
                                                    <span>{{ $item->title }}</span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        {{number_format($item->product_price,2)}}
                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        {{ $item->discount }}% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b>{{number_format($item->selling_price,2)}}</b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="{{ url('detail/'.$item->sku) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
            </div>
            <!-- Container /- -->
        </div>
@endif
<!------------------------------------------------------------------->
<!------------------------------------------------------------------->
@if(count($trending))
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>Trending</h3>
                    <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                @foreach ($trending as $item)
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="{{ url('detail/'.$item->sku) }}">
                                                <img src="{{ asset($item->thumbnail) }}" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="{{ $item->productName }}" href="{{ url('detail/'.$item->sku) }}">
                                                    <span>{{ $item->title }}</span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        {{number_format($item->product_price,2)}}
                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        {{ $item->discount }}% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b>{{number_format($item->selling_price,2)}}</b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="{{ url('detail/'.$item->sku) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
            </div>
            <!-- Container /- -->
        </div>
@endif
<!------------------------------------------------------------------->
<!------------------------------------------------------------------->
@if(isset($viewed)&&count($viewed))
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>Recently Viewed</h3>
                    <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                @foreach ($viewed as $item)
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="{{ url('detail/'.$item->sku) }}">
                                                <img src="{{ asset($item->thumbnail) }}" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="{{ $item->productName }}" href="{{ url('detail/'.$item->sku) }}">
                                                    <span>{{ $item->title }}</span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        {{number_format($item->product_price,2)}}
                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        {{ $item->discount }}% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b>{{number_format($item->selling_price,2)}}</b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="{{ url('detail/'.$item->sku) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
            </div>
            <!-- Container /- -->
        </div>
		
		
		
		
		
		
		
		<div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12">
        	<div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Support</h3>
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
@endif
<!------------------------------------------------------------------->
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
					  if($('#btn-input').val()!=''){
					  ref.push ({
						id: 2,
						name: 'User',
						message: val,
						timestamp:time,
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
ref.on("child_added", function(snapshot) {
   var value = snapshot.val();
   var html = '';
   if(value.id==1){
	   html += '<div class="row msg_container base_receive"><div class="col-md-10 col-xs-10"><div class="messages msg_receive"><p>'+value.message+'</p><time datetime="2009-11-13T20:00">'+timeSince(value.timestamp)+' ago by <b>Admin</b></time> </div></div></div>';
   }else{
	   html += '<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10"><div class="messages msg_sent"><p>'+value.message+'</p><time datetime="2009-11-13T20:00">'+timeSince(value.timestamp)+' ago by <b>You</b></time> </div></div></div>';
   }
   $(html).insertAfter($('.msg_container').last());
   $(".msg_container_base").stop().animate({ scrollTop: $(".msg_container_base")[0].scrollHeight}, 1000);

}, function (error) {
   console.log("Error: " + error.code);
});
</script>
@endsection
