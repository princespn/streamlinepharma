@extends('theams/Front1/app') 
@section('title','Profile') 
@section('MainSection')

  <!--End header-->
<!--End header-->
<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Contact
                </div>
            </div>
        </div>
        <div class="page-content">
            <!--
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="row align-items-end mb-50">
                            <div class="col-lg-4 mb-lg-0 mb-md-5 mb-sm-5">
                                <h4 class="mb-20 text-brand">How can help you ?</h4>
                                <h1 class="mb-30">Let us know how we can help you</h1>
                                <p class="mb-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <h5 class="mb-20">01. Visit Feedback</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <h5 class="mb-20">02. Employer Services</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                                    </div>
                                    <div class="col-lg-6 mb-lg-0 mb-4">
                                        <h5 class="mb-20 text-brand">03. Billing Inquiries</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5 class="mb-20">04.General Inquiries</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
-->
            <section class="container mb-50 d-none d-md-block">
                <div class="border-radius-15 overflow-hidden">
                    <div id="map-panes" class="leaflet-map"></div>
                </div>
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="mb-50">
                            <div class="row mb-60">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <h4 class="mb-15 text-brand">Office</h4>
                                    {{$account->address}} <br/>
                                    <abbr title="Phone">Phone:</abbr> {{$account->phone}}<br />
                                    <abbr title="Email">Email: </abbr>{{$account->email}}<br />
                                    
                                </div>
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <h4 class="mb-15 text-brand">Studio</h4>
                                    {{$account->address}} <br/>
                                    <abbr title="Phone">Phone:</abbr> {{$account->phone}}<br />
                                    <abbr title="Email">Email: </abbr>{{$account->email}}<br />
                                    
                                </div>
                                <div class="col-md-4">
                                    <h4 class="mb-15 text-brand">Shop</h4>
                                    {{$account->address}} <br/>
                                    <abbr title="Phone">Phone:</abbr> {{$account->phone}}<br />
                                    <abbr title="Email">Email: </abbr>{{$account->email}}<br />
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="contact-from-area padding-20-row-col">
                                        <h5 class="text-brand mb-10">Contact form</h5>
                                        <h2 class="mb-10">Drop Us a Line</h2>
                                        <p class="text-muted mb-30 font-sm">Your email address will not be published. Required fields are marked *</p>
                                        {!! Form::open(['url' => 'contactUsSubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="name" placeholder="First Name" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="email" placeholder="Your Email" type="email" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
      
                                                    <input name="phone" placeholder="Your Phone" type="tel" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input name="title" placeholder="Subject" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="textarea-style mb-30">
                                                        <textarea name="description" placeholder="Message"></textarea>
                                                    </div>
                                                    <button class="submit submit-auto-width" type="submit">Send message</button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!} 
                                            @if($errors->any())
                                        <p class="form-messege">{{$errors->first()}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 pl-50 d-lg-block d-none">
                                    <img class="border-radius-15 mt-50" src="assets/imgs/page/contact-2.png" alt="" />
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
 

        @endsection