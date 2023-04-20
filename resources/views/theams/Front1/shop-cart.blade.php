@extends('theams/Front1/app') 
@section('title','Product Detail') 

@section('MainSection')
 <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop
                    <span></span> Cart
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Your Cart</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand">{{count($cartList)}}</span> products in your cart</h6>
                        <h6 class="text-body"><a href="#" class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="table-responsive shopping-summery">
                    @if($cartList)
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                  
                                    <th scope="col" colspan="2">&ensp; Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col" class="end">Remove &ensp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php 
                                $totalAmt = 0; 
                                $totalTax = 0;
                            @endphp
                            @if(count($cartList) > 0 )
                            @foreach ($cartList as $item) 
                                <tr class="pt-30">
                                   
                                    <td class="image product-thumbnail pt-40"> &ensp; <img src="{{ $item->product->thumbnail }}" style="object-fit: cover;height: 70px;" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">{{ $item->product->title }}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                    <h5 class="text-body">
                                    ₹{{number_format($item->product->selling_price,2)}}
                                    &ensp; 
									</h5>
									<small>Incl : {{ $item->product->product_tax }}% Tax</small>
                                      
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <div class="detail-extralink mr-15">
                                            <div class="detail-qty border radius">
                                                <a href="javascript:void[0]" class="qty-down" onclick="updateCart({{ $item->product->id }},'update',0)"><i class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">{{$item->qty}}</span>
                                                <a href="javascript:void[0]" class="qty-up" onclick="updateCart({{ $item->product->id }},'update',1)" ><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h5 class="text-brand">₹{{number_format(($item->product->selling_price) * ($item->qty),2)}}</h5>
                                    </td>
                                    <td class="action text-center" data-title="Remove"><a href="javascript:void[0]" onclick="updateCart({{ $item->product->id }},'remove');" class="text-body"><i class="fi-rs-trash"></i></a></td>
                                </tr>
                                @php $totalAmt += ($item->product->selling_price) * ($item->qty); @endphp
                            

                            @php 

                                $grandTotal = $totalTax + $totalAmt;
                            @endphp 
                               
                            @endforeach  
                            @endif
                            <tr>
                                <td></td>
                            </tr>  
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="cart-action d-flex justify-content-between">
                        <a class="btn "><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
                        <a class="btn  mr-10 mb-sm-15"><i class="fi-rs-refresh mr-10"></i>Update Cart</a>
                    </div>
                    <div class="row mt-50">
                        <div class="col-lg-7">
                            <div class="calculate-shiping p-40 border-radius-15 border">
                                <h4 class="mb-10">Calculate Shipping</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Flat rate:</span><strong class="text-brand">5%</strong></p>
                                <form class="field_form shipping_calculator">
                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="custom_select">
                                                <select class="form-control select-active w-100">
                                                    <option value="">India</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-lg-6">
                                            <input required="required" placeholder="State / Country" name="name" type="text">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <input required="required" placeholder="PostCode / ZIP" name="name" type="text">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="p-40">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
                                <form action="#">
                                    <div class="d-flex justify-content-between">
                                        <input class="font-medium mr-15 coupon" name="Coupon" placeholder="Enter Your Coupon">
                                        <button class="btn"><i class="fi-rs-label mr-10"></i>Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">₹ {{number_format($totalAmt,2)}}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Shipping</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end">Free</h4</td>
                                        
                                       
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            @if(isset($grandTotal))
                                            <h4 class="text-brand text-end">₹ {{number_format($grandTotal,2)}}</h4>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{url('checkOutCart')}}" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection

