@extends('theams/Front1/app')
@section('title','Ship Wishlist ') 

@section('MainSection')
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop <span></span> Fillter
                </div>
            </div>
        </div>
        <div class="container mb-30 mt-50">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="mb-50">
                        <h1 class="heading-2 mb-10">Your Wishlist</h1>
                        <h6 class="text-body">There are <span class="text-brand">{{wishcount()}}</span> products in this list</h6>
                    </div>
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th class="custome-checkbox start pl-30">
                                        
                                    </th>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock Status</th>
                                    <th scope="col">Action</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($wish_product) >=1)
                                @foreach($wish_product as $key=>$wish_product)
                                <tr class="pt-30">
                                    <td class="custome-checkbox pl-30">
                                        
                                    </td>
                                    <td class="image product-thumbnail pt-40"><img src="{{ asset($wish_product->thumbnail) }}" alt="#" /></td>
                                    <td class="product-des product-name">
                                        <h6><a class="product-name mb-10" href="shop-product-right.html">{{$wish_product->title}}</a></h6>
                                        {!! ProductRating($wish_product->id) !!}
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h3 class="text-brand">₹{{number_format($wish_product->product_price,2)}}</h3>
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                    @if($wish_product->unit_quanitity>0) <span class="stock-status in-stock"> in stock </span> @else <span class="stock-status out-stock"> out stock </span>  @endif
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <a href="{{url('product-single-shop/'.$wish_product->sku)}}" class="btn btn-sm" >show</a>
                                    </td>
                                    <td class="action text-center" data-title="Remove">
                                        <a href="{{url('delwish/')}}/{{$wish_product->sku}}" class="text-body"><i class="fi-rs-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="pt-30">
                                    <td class="custome-checkbox pl-30">
                                        
                                    </td>
                                 
                                    <td class="action text-center" data-title="Remove" colspan="5">
                                    <a href="{{url('userlogin')}}" class="text-body">PLEASE LOG IN</a> 
                                    </td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection