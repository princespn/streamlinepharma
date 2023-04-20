@extends('theams/theam1/layouts.app')

@section('theme1Content')
@php 
    $grandTotal = $totalTax = $totalAmt = 0;
@endphp
    <!-- Page Banner -->

    <div class="page-banner container-fluid no-padding">

        <!-- Container -->

        <div class="container">

            <div class="banner-content">

                <h3>Cart</h3>

            </div>

            <ol class="breadcrumb">

                <li><a href="/" title="Home">Home</a></li>

                <li class="active">Cart</li>

            </ol>

        </div><!-- Container /- -->

    </div><!-- Page Banner /- -->

    <!-- Cart -->

    <div class="woocommerce-cart container-fluid no-left-padding no-right-padding">
        <!-- Container -->
        <div class="container">
            <!-- Cart Table -->
            <div class="col-md-12 col-sm-12 col-xs-12 cart-table">
                <form>
                    <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
					@if($cartList)
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Item</th>
                                <th class="product-name">Product Name</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-unit-price">Unit Price</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">

                            @php 
                                $totalAmt = 0; 
                                $totalTax = 0;
                            @endphp

                            @foreach ($cartList as $item) 
                                <tr class="cart_item">
                                    <td class="product-thumbnail"><img src="{{ $item->product->thumbnail }}" style="height: 50px;"/></td>
                                    <td class="product-name" style="font-family: 'Montserrat', sans-serif;font-size: larger;">
                                        {{ $item->product->title }}
                                    </td>
                                    <td class="product-quantity">
                                        <div class="prd-quantity" data-title="Quantity">
                                            <input value="-" class="qtyminus btn" data-field="quantity{{ $item->product->id }}" type="button" onclick="updateCart({{ $item->product->id }},'update',0)">
                                            <input name="quantity{{ $item->product->id }}" value="{{$item->qty}}" min="1" class="qty" type="text" id="qty{{ $item->product->id }}" readonly>
                                            <input value="+" class="qtyplus btn" data-field="quantity{{ $item->product->id }}" type="button" onclick="updateCart({{ $item->product->id }},'update',1)">
                                        </div>
                                        <h3 id="cartMSG{{ $item->product->id }}"></h3>
                                    </td>
                                    <td data-title="Unit Price" class="product-unit-price">
                                        Rs {{number_format($item->product->selling_price,2)}}
										<br>
										<small>Incl : {{ $item->product->product_tax }}% Tax</small>
                                    </td>
                                    <td data-title="Total" class="product-subtotal">Rs {{number_format(($item->product->selling_price) * ($item->qty),2)}}</td>
                                    <td style='cursor: pointer;' data-title="Remove" class="product-remove" onclick="updateCart({{ $item->product->id }},'remove');"><i class="icon icon-Delete"></i></td>
                                </tr>
                                
                             @php $totalAmt += ($item->product->selling_price) * ($item->qty); @endphp
                            

                            @php 
                                $grandTotal = $totalTax + $totalAmt;
                            @endphp 
                            @if($item->product->purchase_product_offer&&$item->qty>=$item->product->purchase_product_offer->qty)
							@php
						       $offerered_qty = intdiv($item->qty,$item->product->purchase_product_offer->qty);
						    @endphp
								<tr class="cart_item">
                                    <td class="product-thumbnail"><img src="{{ $item->product->purchase_product_offer->offerProduct->thumbnail }}" style="height: 50px;"/></td>
                                    <td class="product-name" style="font-family: 'Montserrat', sans-serif;font-size: larger;">
                                        {{ $item->product->purchase_product_offer->offerProduct->title }}<br>
									<span class='offer'><strong>Offer Applied - </strong>{{ $item->product->purchase_product_offer->sceheme->title }}</span>
                                    </td>
                                    <td class="product-quantity">
									{{ $offerered_qty }}
                                    </td>
                                    <td data-title="Unit Price" class="product-unit-price">
                                        Rs {{number_format($item->product->purchase_product_offer->offerProduct->selling_price,2)}}
										<br>
										<small>Incl : {{ $item->product->purchase_product_offer->offerProduct->product_tax }}% Tax</small>
                                    </td>
                                    <td data-title="Total" class="product-subtotal" colspan='2'>
									<span style='text-decoration: line-through;'>Rs {{number_format(($item->product->purchase_product_offer->offerProduct->selling_price) * ($offerered_qty),2)}}
									</span><br> Rs 0
									</td>
                                      
                                </tr>
							@endif
                            @endforeach
                        </tbody>
                    </table>
					@endif
                </form>
            </div><!-- Cart Table /- -->
            
            <!-- Coupon -->
            <!--
                <div class="col-md-offset-4 col-md-4 col-sm-6 col-xs-6 coupon">
                <div class="coupon-box">
                    <h4>coupon code</h4>
                    <h6>If You Have A Coupon Code Enter Here</h6>
                    <form>
                        <input type="text" class="form-control" placeholder="Coupon Code" />
                        <input type="submit" value="apply code" />
                    </form>
                </div>
            </div>
            -->
            <!-- Coupon /- -->

            <div class="col-md-offset-8 col-md-4 col-sm-6 col-xs-6 cart-collaterals">
                <div class="cart_totals">
                    <h3>Cart totals</h3>
                    <table>
                        <tr>
                            <th>Sub Total</th>
                            <td>Rs {{number_format($totalAmt,2)}}</td>
                        </tr>
                        <!--tr>
                            <th>Tax</th>
                            <td>Rs {{number_format($totalTax,2)}}</td>
                        </tr-->
                        <tr>
                            <th>Total</th>
                            <td>Rs {{number_format($grandTotal,2)}}</td>
                        </tr>
                    </table>
                    <div class="wc-proceed-to-checkout">
                        
                        
                            <a href="{{route('checkOut')}}" class="checkout-button button alt wc-forward">Proceed to Checkout</a>
                        
                        
                    </div>
                </div>
            </div>
        </div><!-- Container /- -->
    </div>

    <!-- Cart /- -->

@endsection