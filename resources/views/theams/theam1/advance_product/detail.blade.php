@extends('theams/theam1/layouts.app')

@section('socialMeta')
@if(isset($scheme)&&$scheme)
<meta property="og:url"  content="{{ url('detail/'.$advance_product->sku) }}?scheme={{ urlencode(base64_encode($scheme->id)) }}" />
<meta property="og:type" content="product" />
<meta property="og:title" content="{{$advance_product->title}}" />
<meta property="og:image" content="{{ asset($advance_product->thumbnail) }}" />
<meta property="og:description" content="{{ $scheme->scheme_name }} Price : {{ $advance_product->selling_price- $advance_product->selling_price*($scheme->discount/100) }}" />

@endif
@endsection
@section('theme1Content')

<style>
    .owl-item active {
        width: auto;
    }
 .select-pincode > input{
    background-color: transparent;
    width: 70%;
    padding: 10px 20px;
    border-radius: 0;
    border: 1px solid #cecece;
    font-family: 'Montserrat', sans-serif;
    -webkit-appearance: none;
    -moz-appearance: none;
    letter-spacing: 0.56px;
    outline: none;
    position: relative;
    float: left;
    color: #777777;}
    .select-pincode > button{
    background-color: transparent;
    width: 30%;
    padding: 10px 20px;
    border-radius: 0;
    border: 1px solid #cecece;
    font-family: 'Montserrat', sans-serif;
    -webkit-appearance: none;
    -moz-appearance: none;
    letter-spacing: 0.56px;
    outline: none;
    position: relative;
    float: left;
    color: #777777;}
	
	
	.popover__title {
  color:green;cursor:pointer 
}

.popover__wrapper {
  position: relative;
  margin-top: 1.5rem;
  display: inline-block;
}
.popover__content {
  opacity: 0;
  visibility: hidden;
  position: absolute;
  left: -150px;
  transform: translate(0, 10px);
  background-color: #bfbfbf;
  padding: 1.5rem;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
  width: auto;
}
.popover__content:before {
  position: absolute;
  z-index: -1;
  content: "";
  right: calc(50% - 10px);
  top: -8px;
  border-style: solid;
  border-width: 0 10px 10px 10px;
  border-color: transparent transparent #bfbfbf transparent;
  transition-duration: 0.3s;
  transition-property: transform;
}
.popover__wrapper:hover .popover__content {
  z-index: 10;
  opacity: 1;
  visibility: visible;
  transform: translate(0, -20px);
  transition: all 0.5s cubic-bezier(0.75, -0.02, 0.2, 0.97);
}
.popover__message {
  text-align: center;
}
#xzoom-fancy{
	max-height:400px;
}
@-webkit-keyframes blinker {
  from {opacity: 1.0;}
  to {opacity: 0.0;}
}
.blink{
	text-decoration: blink;
	-webkit-animation-name: blinker;
	-webkit-animation-duration: 0.6s;
	-webkit-animation-iteration-count:infinite;
	-webkit-animation-timing-function:ease-in-out;
	-webkit-animation-direction: alternate;
     color:red;
	 font-weight:bold;
}
.blink span{
	font-size:30px;
}
</style>


<div class="shop-single container-fluid no-padding">

    <!-- Container -->

    <div class="container">

        <div class="product-views">

            <div class="col-md-4 col-sm-6 col-xs-12">

                <div class="large-5 column">
                    <div class="xzoom-container">
                        <img class="xzoom4" id="xzoom-fancy" src="{{ asset($advance_product->thumbnail) }}" xoriginal="{{ asset($advance_product->thumbnail) }}" />
                        
                        <div class="xzoom-thumbs">
                            @if($advance_product->thumbnail)
                                <a href="{{ asset($advance_product->thumbnail) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($advance_product->thumbnail) }}" xpreview="{{ asset($advance_product->thumbnail) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($advance_product->image1)
                                <a href="{{ asset($advance_product->image1) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($advance_product->image1) }}" xpreview="{{ asset($advance_product->image1) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($advance_product->image2)
                                <a href="{{ asset($advance_product->image2) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($advance_product->image2) }}" xpreview="{{ asset($advance_product->image2) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($advance_product->image3)
                                <a href="{{ asset($advance_product->image3) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($advance_product->image3) }}" xpreview="{{ asset($advance_product->image3) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($advance_product->image4)
                                <a href="{{ asset($advance_product->image4) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($advance_product->image4) }}" xpreview="{{ asset($advance_product->image4) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($advance_product->image5)
                                <a href="{{ asset($advance_product->image5) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($advance_product->image5) }}" xpreview="{{ asset($advance_product->image5) }}" style="height:75px;width:75px;">
                                </a>
                            @endif
                            
                        </div>
                    </div>
                </div>
                
                {{-- <div class="carousel-item">

                    @if($advance_product->thumbnail)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($advance_product->thumbnail) }}" id="imageURL0">
                    </div>
                    @endif

                    @if($advance_product->image1)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($advance_product->image1) }}" id="imageURL1">
                    </div>
                    @endif

                    @if($advance_product->image2)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($advance_product->image2) }}" id="imageURL2">
                    </div>
                    @endif

                    @if($advance_product->image3)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($advance_product->image3) }}" id="imageURL3">
                    </div>
                    @endif

                    @if($advance_product->image4)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($advance_product->image4) }}" id="imageURL4">
                    </div>
                    @endif

                    @if($advance_product->image5)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($advance_product->image5) }}" id="imageURL5">
                    </div>
                    @endif

                </div> --}}

            </div>

            <!-- Entry Summary -->

            <div class="col-md-8 col-sm-6 col-xs-12 entry-summary">

                

                <h3 class="product_title">
                    <span id="productName">{{$advance_product->title}}</span>
                </h3>
                
                {{-- <div class="product-rating">

                    <div class="star-rating">

                        <i class="fa fa-star"></i>

                        <i class="fa fa-star"></i>

                        <i class="fa fa-star"></i>

                        <i class="fa fa-star"></i>

                        <i class="fa fa-star-o"></i>

                    </div>

                    <a href="#review-link" class="review-link">20 reviews</a>

                </div> --}}

                <p class="stock in-stock"><span>Availablity:</span>@if($advance_product->unit_quanitity>0) in stock @else <span style='color:red'>Out of Stock</span>  @endif</p>
                <p class="stock in-stock"><span>{{$advance_product->sku}}</span></p>
                
                <p class="stock in-stock">
                    <span>
                        <del>
                            MRP
                            <span id="productMRP">{{number_format($advance_product->product_price,2)}} </span>
                        <del>
                    </span>

                    @php
                    $offPerchantage = round(($advance_product->product_price - $advance_product->selling_price) * 100 / $advance_product->product_price)
                    @endphp
                    <br>
                    <span>
                        {{$offPerchantage}}% Off 
                    </span>
                
                    <h3 class="product_title" style="color: #ec0000; @if((Session::get('register')&&Session::get('register')->subscription_id!=Null) || isset($scheme)&&$scheme) text-decoration: line-through  @endif ">Rs
                        <span id="productSprice">
                           {{ number_format($advance_product->selling_price,2) }}
                           {{ $advance_product->tax_method == 'Exclusive' ? '+ Tax' : '' }}
                           {{ $advance_product->shipping_method == 'Exclusive' ? '+ Shipping Charge' : '' }}
                        </span>
                    </h3>
					@if(isset($scheme)&&$scheme)
					<div class='blink'>{{ $scheme->scheme_name }} Price : <span>{{ $advance_product->selling_price- $advance_product->selling_price*($scheme->discount/100) }}</span></div>
				    <h3>Please add only this product in cart and at checkout time.</h3>
					@endif
				
                    <span class="stock in-stock">
                        <span style="font-size:13px;">
                            
                        </span>
                    </span>
                </p>
		<div class="row">
            <div class="select-pincode col-xs-12 col-lg-6">
                <input type="number" name="pinCode" id="pinCode" placeholder="Enter Delivery Pincode" class="formcontrol" required />
                <button class="add_to_cart" type="button" onclick="pinCodeCheck();"> Check</button>
                <p id="pinMSG"></p>
            </div>
        </div>
		@if(isset($group))
		@if($advance_product->grouping_name!=Null)
		<div class="row">
		  <div class='col-md-12'>
		     <h3>{{ $advance_product->grouping_name }}</h3>
			 @if($advance_product->setting->grouping=='color')
				 @foreach($group as $g_row)
			       <a href="{{ url('detail/'.$g_row->sku) }}"><img src='{{ $g_row->thumbnail }}' title='{{ $g_row->color }}' width='70' style='width: 50px;height: 70px;border: 1px solid red' onmouseover='$("#xzoom-fancy").attr("src","{{ $g_row->thumbnail }}");'  onmouseout='$("#xzoom-fancy").attr("src","{{ $advance_product->thumbnail }}");'></a>
			     @endforeach
			 @else
				 @php $myg = $advance_product->setting->grouping; @endphp
				 @foreach($group as $g_row)
			       <!--a style='border: 1px solid #d3c2c2;padding: 5px;margin-right: 4px;border-radius: 4px;' href="{{ url('detail/'.$g_row->sku) }}">{{ $g_row->$myg }}</a-->
				   <a href="{{ url('detail/'.$g_row->sku) }}"><img src='{{ $g_row->thumbnail }}' title='{{ $g_row->color }}' width='70' style='width: 50px;height: 70px;border: 1px solid red' onmouseover='$("#xzoom-fancy").attr("src","{{ $g_row->thumbnail }}");'  onmouseout='$("#xzoom-fancy").attr("src","{{ $advance_product->thumbnail }}");'></a>
			     @endforeach
			 @endif
		  </div>
		</div>
		@endif
		
		
		
		@endif
		
		
		@if(count($advance_product->purchase_offer))
			<h5 style='color:green'>Available offers</h5>
				     @foreach($advance_product->purchase_offer as $offer)
					<div>
					  <img src="{{ url('assets/images/offer.png') }}" width="18" height="18" class="_3HLfAg"> <strong> {{ $offer->sceheme->title }}</strong>  - Get {{ $offer->get_qty }} '{{ $offer->offerProduct->title }}' free if you buy {{ $offer->qty }} {{ $advance_product->title }}'
                      <!---------tc--------->
					  
					  <div class="popover__wrapper">
					  
						<strong class="popover__title">T&C</strong>
					  
					  <div class="popover__content">
						{!! $offer->terms_and_conditions !!}
					  </div>
					</div>
                      <!---------tc--------->
					</div>
					@endforeach
		@endif
                <form>
                    <div class="product-attribute">
                        

                        
                    </div>
                    
                    
                        
                        @if($account->type==1 || $account->type==2)
						@if($advance_product->unit_quanitity>0)
						    <button type="button" class="add_to_cart" onclick="addToCartAdvance(true @if(isset($scheme)&&$scheme) ,{{ $scheme->id }} @endif)" id="addToCartButton">Buy Now</button>
                            <button type="button" class="add_to_cart" onclick="addToCartAdvance(false @if(isset($scheme)&&$scheme) ,{{ $scheme->id }} @endif) " id="addToCartButton">Add To Cart</button>
                        @endif
                        @endif

                        


                </form>

                <div class="product-views">
                    <div class="col-md-6 col-sm-6 col-xs-12 entry-summary" style="padding: 0px;">
                        <h3 class="product_title">Services</h3>

                        <div class="about-content">
                            

                            

                            <p>
                                <i class="fa fa-circle"></i>
                                Return : {{ $advance_product->is_return == 'Yes' ? 'Yes within '.$advance_product->return_days.' days' : 'No' }}
                            </p>

                            <p>
                                <i class="fa fa-circle"></i>
                                Replacement : {{ $advance_product->is_replace == 'Yes' ? 'Yes within '.$advance_product->replace_days.' days' : 'No' }}
                            </p>

                        </div>
                    </div>
                    
                    

                </div>

                <div class="product_meta">

                    <span class="posted_in">

                        <a href="#"><i class="fa fa-heart"></i></a>

                        <a href="#"><i class="fa fa-retweet"></i></a>

                        <a href="#"><i class="fa fa-envelope-o"></i></a>

                    </span>

                    <ul class="social">

                        <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>

                        <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>

                        <li><a href="#" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>

                        <li><a href="#" title="Tumblr"><i class="fa fa-tumblr"></i></a></li>

                        <li><a href="#" title="Vimeo"><i class="fa fa-vimeo"></i></a></li>

                    </ul>

                </div>

            </div><!-- Entry Summary /- -->

        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 description">

            <h5>Description about this product</h5>

            <p>
                <span id="productDescription">
                    {!! nl2br($advance_product->description) !!}
                </span>
            </p>

        </div>

        

        <!-- Modal -->
        

    </div><!-- Container /- -->

</div><!-- Shop Single /- -->
<script>
    function addToCartAdvance(isBuyNow=false,scheme_id='') {
		//alert(isBuyNow+'/'+scheme_id);
        var sku = '{{ $advance_product->sku }}';
	    var csrfToken= '{{ csrf_token() }}';
        const param = { "sku":sku,"scheme_id":scheme_id };
		jQuery.ajax({
			url: "{{ url('addToCartAdvance') }}",
			type: "POST",
			headers: {
				'X-CSRF-TOKEN':csrfToken,
				'Accept' : 'application/json',
				'Content-Type' : 'application/json'
			},
			data: JSON.stringify({data : param}),
			success: function(data)
			{
				jQuery('#cartMSG').replaceWith('<h3 id="cartMSG">'+data+'</h3>');
				//console.log(isBuyNow);
				setTimeout(function() {
					$('#cartMSG').fadeOut("slow");
				}, 1000);
				if(isBuyNow==false){
					location.reload();
				}else{
					window.location.replace("{{ url('checkOut') }}");
				}
				//cartList();
			}
		});
    }
</script>
@endsection
