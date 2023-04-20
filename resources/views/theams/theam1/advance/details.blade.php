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
                        <img class="xzoom4" id="xzoom-fancy" src="{{ asset($data->thumbnail) }}" xoriginal="{{ asset($data->thumbnail) }}" />
                        
                        <div class="xzoom-thumbs">
                            @if($data->thumbnail)
                                <a href="{{ asset($data->thumbnail) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($data->thumbnail) }}" xpreview="{{ asset($data->thumbnail) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($data->image1)
                                <a href="{{ asset($data->image1) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($data->image1) }}" xpreview="{{ asset($data->image1) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($data->image2)
                                <a href="{{ asset($data->image2) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($data->image2) }}" xpreview="{{ asset($data->image2) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($data->image3)
                                <a href="{{ asset($data->image3) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($data->image3) }}" xpreview="{{ asset($data->image3) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($data->image4)
                                <a href="{{ asset($data->image4) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($data->image4) }}" xpreview="{{ asset($data->image4) }}" style="height:75px;width:75px;">
                                </a>
                            @endif

                            @if($data->image5)
                                <a href="{{ asset($data->image5) }}">
                                    <img class="xzoom-gallery4" src="{{ asset($data->image5) }}" xpreview="{{ asset($data->image5) }}" style="height:75px;width:75px;">
                                </a>
                            @endif
                            
                        </div>
                    </div>
                </div>
                
                {{-- <div class="carousel-item">

                    @if($data->thumbnail)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($data->thumbnail) }}" id="imageURL0">
                    </div>
                    @endif

                    @if($data->image1)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($data->image1) }}" id="imageURL1">
                    </div>
                    @endif

                    @if($data->image2)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($data->image2) }}" id="imageURL2">
                    </div>
                    @endif

                    @if($data->image3)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($data->image3) }}" id="imageURL3">
                    </div>
                    @endif
 
                    @if($data->image4)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($data->image4) }}" id="imageURL4">
                    </div> 
                    @endif

                    @if($data->image5)
                    <div class="item" style="text-align: -webkit-center;">
                        <img src="{{ asset($data->image5) }}" id="imageURL5">
                    </div>
                    @endif

                </div> --}}

            </div>

            <!-- Entry Summary -->

            <div class="col-md-8 col-sm-6 col-xs-12 entry-summary">

                

                <h3 class="product_title">
                    <span id="productName">{{$data->title}}</span>
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

                <p class="stock in-stock"><span>Availablity:</span></p>
                <p class="stock in-stock"><span>{{$data->sku}}</span></p>
                
                <p class="stock in-stock">
                    <span>
                        <del>
                            MRP
                            <span id="productMRP">{{number_format($data->product_price,2)}} </span>
                        <del>
                    </span>

                    @php
                    $offPerchantage = round(($data->selling_price - $data->selling_price) * 100 / $data->selling_price)
                    @endphp
                    <br>
                    <span>
                        {{$offPerchantage}}% Off 
                    </span>
                
                    <h3 class="product_title" style="color: #ec0000; @if(Session::get('register')&&Session::get('register')->subscription_id!=Null) text-decoration: line-through  @endif ">Rs {{ $data->selling_price }}
                        
                    </h3>
					
				
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
                <form>
                    <div class="product-attribute">
                        
                    </div>
                    
                    <a href='{{ url('ap_cart/'.$data->id) }}' class="add_to_cart"  id="addToCartButton">Buy Now</a>   

                </form>

                <div class="product-views">
                    <div class="col-md-6 col-sm-6 col-xs-12 entry-summary" style="padding: 0px;">
                        <h3 class="product_title">Services</h3>

                        <div class="about-content">
                            

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
                    {!! $data->description !!}
                </span>
            </p>

        </div>

        

        <!-- Modal -->
        

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
                // alert(data);
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
