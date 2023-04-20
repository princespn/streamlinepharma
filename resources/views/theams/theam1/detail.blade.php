@extends('theams/theam1/layouts.app')

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
</style>


<div class="shop-single container-fluid no-padding">

    <!-- Container -->

    <div class="container">

        <div class="product-views">

            <div class="col-md-4 col-sm-6 col-xs-12">

                <div class="large-5 column">
                    <div class="xzoom-container">
                        <img class="xzoom4" id="xzoom-fancy" src="{{ asset($inventoryData->imageURL0) }}" xoriginal="{{ asset($inventoryData->imageURL0) }}" />
                        
                        <div class="xzoom-thumbs">
                            @if($inventoryData->imageURL0)
                                <a href="{{ asset($inventoryData->imageURL0) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($inventoryData->imageURL0) }}" xpreview="{{ asset($inventoryData->imageURL0) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($inventoryData->imageURL1)
                                <a href="{{ asset($inventoryData->imageURL1) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($inventoryData->imageURL1) }}" xpreview="{{ asset($inventoryData->imageURL1) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($inventoryData->imageURL2)
                                <a href="{{ asset($inventoryData->imageURL2) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($inventoryData->imageURL2) }}" xpreview="{{ asset($inventoryData->imageURL2) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($inventoryData->imageURL3)
                                <a href="{{ asset($inventoryData->imageURL3) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($inventoryData->imageURL3) }}" xpreview="{{ asset($inventoryData->imageURL3) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($inventoryData->imageURL4)
                                <a href="{{ asset($inventoryData->imageURL4) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($inventoryData->imageURL4) }}" xpreview="{{ asset($inventoryData->imageURL4) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($inventoryData->imageURL5)
                                <a href="{{ asset($inventoryData->imageURL5) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($inventoryData->imageURL5) }}" xpreview="{{ asset($inventoryData->imageURL5) }}" style="height:75px;width:75px;">
                                </a>
                            @endif
                            
                        </div>
                    </div>
                </div>
                
                {{-- <div class="carousel-item">

                    @if($inventoryData->imageURL0)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($inventoryData->imageURL0) }}" id="imageURL0">
                    </div>
                    @endif

                    @if($inventoryData->imageURL1)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($inventoryData->imageURL1) }}" id="imageURL1">
                    </div>
                    @endif

                    @if($inventoryData->imageURL2)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($inventoryData->imageURL2) }}" id="imageURL2">
                    </div>
                    @endif

                    @if($inventoryData->imageURL3)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($inventoryData->imageURL3) }}" id="imageURL3">
                    </div>
                    @endif

                    @if($inventoryData->imageURL4)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($inventoryData->imageURL4) }}" id="imageURL4">
                    </div>
                    @endif

                    @if($inventoryData->imageURL5)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($inventoryData->imageURL5) }}" id="imageURL5">
                    </div>
                    @endif

                </div> --}}

            </div>

            <!-- Entry Summary -->

            <div class="col-md-8 col-sm-6 col-xs-12 entry-summary">

                @if($account->affiliationLink == 0 && $affiliateId!=0)
                <div class="col-md-12 col-sm-12 col-xs-12 description">
                    <p style="color: #ec0000;font-size: x-large;">
                        This link is expired. Try another one.
                    </p>
                </div>
                @endif

                <h3 class="product_title">
                    <span id="productName">{{$inventoryData->productName}}</span>
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

                <p class="stock in-stock"><span>Availablity:</span>@if($inventoryData ->inventory_price->qty>0) in stock @else <span style='color:red'>Out of Stock</span>  @endif</p>
                <p class="stock in-stock"><span>{{$inventoryData->sku}}</span></p>
                
                <p class="stock in-stock">
                    <span>
                        <del>
                            MRP
                            <span id="productMRP">{{number_format($inventoryData ->inventory_price->mrp,2)}} </span>
                        <del>
                    </span>

                    @php
                    $offPerchantage = round(($inventoryData ->inventory_price->mrp - $inventoryData ->inventory_price->sprice) * 100 / $inventoryData ->inventory_price->mrp)
                    @endphp
                    <br>
                    <span>
                        {{$offPerchantage}}% Off 
                    </span>
                
                    <h3 class="product_title" style="color: #ec0000; @if(Session::get('register')&&Session::get('register')->subscription_id!=Null) text-decoration: line-through  @endif ">Rs
                        <span id="productSprice">
                            {{number_format($inventoryData ->inventory_price->sprice,2)}}
                            {{$productData ->tax_detail->includeTax == 0 ? '+ Tax' : ''}}
                            {{$inventoryData ->product_packaging->includeShipping == 0 ? '+ Shipping Charge' : ''}}
                        </span>
                    </h3>
					@if(Session::get('register')&&isset($membership->name))
					<h3 class="product_title" style="color: #ec0000; ">{{ $membership->name }} Price  Rs
                        <span id="productSprice">
                            {{number_format(($inventoryData ->inventory_price->sprice - ($inventoryData ->inventory_price->sprice*$membership->benifits)/100 ),2)}}
                            {{$productData ->tax_detail->includeTax == 0 ? '+ Tax' : ''}}
                            {{$inventoryData ->product_packaging->includeShipping == 0 ? '+ Shipping Charge' : ''}}
                        </span>
                    </h3>	
					@endif
					@php
					  $mem_price = $inventoryData ->inventory_price->sprice;
					@endphp
					@if($account->isMembership==1)
					<button style='border: 1px solid grey;' onclick='$("#all_mem_price").toggle();'><span style='color:red'>{{ $account->membership_product_page_text }}</span></button>
				    <div style='display:none' id='all_mem_price'>
						@foreach($all_membership as $mem_row)
						 <h3 class="product_title" style="color: #ec0000;"> Rs - {{  number_format($mem_price-($mem_price*$mem_row->benifits)/100,2) }} For {{ $mem_row->name }}   </h3>
						@endforeach
					</div>	
				    @endif
				@if(count($schemeList))
					<h5 style='color:green'>Available offers</h5>
				     @foreach($schemeList as $offer)
					<div>
					  <img src="{{ url('assets/images/offer.png') }}" width="18" height="18" class="_3HLfAg"> <strong> {{ $offer->title }}</strong> - Get {{ $offer->get_qty }} '{{ $offer->productName }}' free if you buy {{ $offer->qty }} {{ $inventoryData->productName }}'
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
                    <span class="stock in-stock">
                        <span style="font-size:13px;">
                            @if($inventoryData->payementOption == 2)
                                (Accept cod payment only)
                            @elseif($inventoryData->payementOption == 3)
                                (Accept online payment only)
                            @endif
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
                <form>
                    <div class="product-attribute">
                        @if (isset($productData->optionList))

                        @php $position = 0; @endphp
                        @foreach ($productData->optionList as $key=>$option)

                        <div class="select">
							@if($option->tag=='Color' && isset($colorOption))
							 @php $colorId = []; @endphp
							<select  style="display:none;" id="optionId{{$position}}" name="{{ $option->tag}}" onchange="optionFilter({{$productData->id}});">
                                <option disabled>{{ $option->tag}} *</option>
                                @foreach ($option->optionsIds as $options)
                                    @php $colorId[]=$options->id; @endphp
                                    <option value="{{$options->id}}">{{$options->label}}</option>
                                @endforeach
                            </select>
                            @foreach ($colorOption as $key=>$color)
							
							 @if($key!=0 && $color->imageURL0)
							<img src="{{ asset($color->imageURL0) }}" onclick="document.getElementById('optionId{{$position}}').selectedIndex ={{$key}};optionFilter({{$productData->id}});"  style="width: 74px;height: auto;margin: 1px;" id="colorImageUrl{{$color->id}}">
							@endif
							@endforeach
							@else
                            <select id="optionId{{$position}}" name="{{ $option->tag}}" onchange="optionFilter({{$productData->id}});">

                                <option disabled>{{ $option->tag}} *</option>

                                @foreach ($option->optionsIds as $options)
                                    <option @if($position=='0') @if($inventoryData->variation0==$options->id) selected @endif @endif   @if($position=='1') @if($inventoryData->variation1==$options->id) selected @endif @endif  value="{{$options->id}}">{{$options->label}}</option>
                                @endforeach

                            </select>
							@endif
                        </div>

                        @php $position++; @endphp
                        @endforeach

                        @endif

                        <input type="hidden" value="{{$position}}" id="optionsCount">
                        <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
                        <input type="hidden" value="{{$inventoryData->id}}" id="inventoryId">
                        <input type="hidden" value="{{$affiliateId}}" id="affiliateId">
                    </div>
                    
                    @if($account->affiliationLink == 0 && $affiliateId!=0)

                        <button type="button" class="add_to_cart form-group col-md-12 col-sm-12 col-xs-12">Link Expired!</button>
                        
                    @else
                        
                        @if($account->type==1 || $account->type==2)
						@if($inventoryData ->inventory_price->qty>0)
						    <button type="button" class="add_to_cart" onclick="addToCart(true)" id="addToCartButton">Buy Now</button>
                            <button type="button" class="add_to_cart" onclick="addToCart()" id="addToCartButton">Add To Cart</button>
                        @endif
                        @endif

                        @if($account->type==3 || $account->type==2)
                            <button type="button" class="add_to_cart" data-toggle="modal" data-target="#inquiryModel">Send Inquiry</button>
                            
                            @if($errors->any())
                                <div id="alert-msg" class="alert-msg">{{$errors->first()}}</div>
                            @endif
                            
                        @endif

                        <button type="button" class="add_to_cart" id="addToCartLoadingButton" style="display:none;">Loading..</button>
                        <p id="cartMSG"></p>
                    @endif

                </form>

                <div class="product-views">
                    <div class="col-md-6 col-sm-6 col-xs-12 entry-summary" style="padding: 0px;">
                        <h3 class="product_title">Services</h3>

                        <div class="about-content">
                            @if($inventoryData->payementOption != 1)
                                <p>
                                    <i class="fa fa-circle"></i>
                                    Payment Option : 
                                        @if($inventoryData->payementOption == 2)
                                            Accept cod payment only
                                        @elseif($inventoryData->payementOption == 3)
                                            Accept online payment only
                                        @endif
                                </p>
                            @endif

                            <p>
                                <i class="fa fa-circle"></i>
                                Cancellation : {{ ($inventoryData->inventory_shipping->cancelOrder ?? 0) == 1 ? 'Yes' : 'No' }}
                            </p>

                            <p>
                                <i class="fa fa-circle"></i>
                                Return : {{ ($inventoryData->inventory_shipping->returnOrder ?? 0) == 1 ? 'Yes within '.$inventoryData->inventory_shipping->returnOrderDays.' days' : 'No' }}
                            </p>

                            <p>
                                <i class="fa fa-circle"></i>
                                Replacement : {{ ($inventoryData->inventory_shipping->replacementOrder ?? 0) == 1 ? 'Yes within '.$inventoryData->inventory_shipping->replacementOrderDays.' days' : 'No' }}
                            </p>

                        </div>
                    </div>
                    
                    @if(isset($inventoryData->inventory_warranty))
                        <div class="col-md-6 col-sm-6 col-xs-12 entry-summary">
                            <h3 class="product_title">Warranty</h3>

                            <div class="about-content">

                                @if(isset($inventoryData->inventory_warranty->domestic))
                                <p>
                                    <i class="fa fa-circle"></i>
                                    Domestic : {{ ($inventoryData->inventory_warranty->domestic ?? 0) == 1 ? 'Yes' : 'No' }}
                                </p>
                                @endif

                                @if(isset($inventoryData->inventory_warranty->international))
                                <p>
                                    <i class="fa fa-circle"></i>
                                    International : {{ ($inventoryData->inventory_warranty->international ?? 0) == 1 ? 'Yes' : 'No' }}
                                </p>
                                @endif

                                @if(isset($inventoryData->inventory_warranty->summary))
                                <p>
                                    <i class="fa fa-circle"></i>
                                    Summary : {{$inventoryData->inventory_warranty->summary ?? ''}}
                                </p>
                                @endif

                                @if(isset($inventoryData->inventory_warranty->coveredIn))
                                <p>
                                    <i class="fa fa-circle"></i>
                                    CoveredIn : {{$inventoryData->inventory_warranty->coveredIn ?? ''}}
                                </p>
                                @endif

                                @if(isset($inventoryData->inventory_warranty->notCovered))
                                <p>
                                    <i class="fa fa-circle"></i>
                                    Not Covered : {{$inventoryData->inventory_warranty->notCovered ?? ''}}
                                </p>
                                @endif

                            </div>
                        </div>
                    @endif

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
                    {!! $inventoryData->productDescription !!}
                </span>
            </p>

        </div>

        @if (count($relatedProduct) > 0)
            <div class="blog-section latest-blog container-fluid">
                <!-- Container -->
                <div class="container">

                    <!-- Section Header -->
                    <div class="section-header">
                        <h3>Related Products</h3>
                        <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                    </div>
                    <!-- Section Header /- -->

                    @foreach ($relatedProduct as $item)

                        @if($item->inventory_price->sprice ?? 0 && $item->inventory_price->mrp ?? 0)
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="type-post">
                                    <div class="entry-cover" style="text-align: center;">
                                        <a href="{{route('detail', array('id' => $item->id))}}">
                                            <img src="{{ asset($item->imageURL0) }}" style="object-fit: cover;height: 300px;">
                                        </a>
                                        <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                    </div>

                                    <div class="blog-content">
                                        <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                            <a title="{{ $item->productName }}" href="{{route('detail', array('id' => $item->id))}}">
                                                <span>{{ $item->productName }}</span>
                                            </a>
                                        </h3>
                                        @php
                                        $offPerchantage = round(($item->inventory_price->mrp - $item->inventory_price->sprice) * 100 / $item->inventory_price->mrp)
                                        @endphp
                                        <div class="entry-meta">
                                            <span class="post-like">
                                                <del>
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    {{number_format($item->inventory_price->mrp,2)}}
                                                </del>
                                                &nbsp;
                                                <b>
                                                    {{$offPerchantage}}% Off
                                                </b>
                                            </span>

                                            <span class="post-admin" style="color: #ec0000;">
                                                <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                <b>{{number_format($item->inventory_price->sprice,2)}}</b>
                                            </span>

                                        </div>
                                        <div class="entry-content">
                                            <p style="height: 50px;overflow: hidden;">{!! $item->productDescription !!}</p>
                                            <a href="{{route('detail', array('id' => $item->id))}}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                    @endforeach
                </div>
                <!-- Container /- -->
            </div>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="inquiryModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {!! Form::open(['route' => 'inquirySubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="position: absolute;">
                            <span id="productName">{{$inventoryData->productName}}</span>
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
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
                    </div>

                    <div class="modal-footer" style="border: 0px;">
                        <input type="hidden" value="{{$inventoryData->id}}" name="inventoryId">
                        <input type="hidden" value="{{$affiliateId}}" name="affiliate_id ">
                        <button type="submit" class="btn btn-secondary">Send</button>
                    </div>
                </div>
                {!! Form::close() !!} 
            </div>
        </div>

    </div><!-- Container /- -->

</div><!-- Shop Single /- -->
<script>
    function pinCodeCheck() {
        var pinCode = $('#pinCode').val().trim()
        if (!pinCode) {
            $('#pinCode').focus()
        }
        const param = {
            "pinCode": pinCode
        };
        var csrfToken = document.getElementById("csrfToken").value;

        jQuery.ajax({
            url: "{{route('deliverycode')}}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                data: param
            }),
            success: function(data) {
                 console.log(data);
                if (data.length > 0) {
                    jQuery('#pinMSG').replaceWith('<p id="pinMSG">We able to Deliver product in this area.</p>');

                } else {
                    jQuery('#pinMSG').replaceWith('<p id="pinMSG" style="color:red">Pincode is Invalid</p>');
                    document.getElementById("pinCode").value = '';
                }
                setTimeout(function() {
                    $('#pinMSG').fadeOut("slow");
                }, 5000);

            }
        });
    }
</script>
@endsection
