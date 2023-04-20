@extends('theams/Front1/app') 
@section('title','Manage Product') 

@section('MainSection')

<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> About us
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="row align-items-center mb-50">
                            <div class="col-lg-6">
                                <img src="{{url('front_assets/imgs/page/about-1.png')}}" alt="" class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4" />
                            </div>
                            <div class="col-lg-6">
                                <div class="pl-25">
                                    <h2 class="mb-30">{{$aboutList->heading ?? ''}}</h2>
                                    <p class="mb-25">{!! $aboutList->description ?? '' !!}</p>
   
                                    <div class="carausel-3-columns-cover position-relative">
                                        <div id="carausel-3-columns-arrows"></div>
                                        <div class="carausel-3-columns" id="carausel-3-columns">
                                            <img src="{{url('front_assets/imgs/page/about-2.png')}}" alt="" />
                                            <img src="{{url('front_assets/imgs/page/about-3.png')}}" alt="" />
                                            <img src="{{url('front_assets/imgs/page/about-4.png')}}" alt="" />
                                            <img src="{{url('front_assets/imgs/page/about-2.png')}}" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>
                </div>
            </div>
<!--
            <section class="container mb-50 d-none d-md-block">
                <div class="row about-count">
                    <div class="col-lg-1-5 col-md-6 text-center mb-lg-0 mb-md-5">
                        <h1 class="heading-1"><span class="count">12</span>+</h1>
                        <h4>Glorious years</h4>
                    </div>
                    <div class="col-lg-1-5 col-md-6 text-center">
                        <h1 class="heading-1"><span class="count">36</span>+</h1>
                        <h4>Happy clients</h4>
                    </div>
                    <div class="col-lg-1-5 col-md-6 text-center">
                        <h1 class="heading-1"><span class="count">58</span>+</h1>
                        <h4>Projects complete</h4>
                    </div>
                    <div class="col-lg-1-5 col-md-6 text-center">
                        <h1 class="heading-1"><span class="count">24</span>+</h1>
                        <h4>Team advisor</h4>
                    </div>
                    <div class="col-lg-1-5 text-center d-none d-lg-block">
                        <h1 class="heading-1"><span class="count">26</span>+</h1>
                        <h4>Products Sale</h4>
                    </div>
                </div>
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="mb-50">
                            <h2 class="title style-3 mb-40 text-center">Our Team</h2>
                            <div class="row">
                                <div class="col-lg-4 mb-lg-0 mb-md-5 mb-sm-5">
                                    <h6 class="mb-5 text-brand">Our Team</h6>
                                    <h1 class="mb-30">Meet Our Expert Team</h1>
                                    <p class="mb-30">Proin ullamcorper pretium orci. Donec necscele risque leo. Nam massa dolor imperdiet neccon sequata congue idsem. Maecenas malesuada faucibus finibus.</p>
                                    <p class="mb-30">Proin ullamcorper pretium orci. Donec necscele risque leo. Nam massa dolor imperdiet neccon sequata congue idsem. Maecenas malesuada faucibus finibus.</p>
                                    <a href="#" class="btn">View All Members</a>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="team-card">
                                                <img src="assets/imgs/page/about-6.png" alt="" />
                                                <div class="content text-center">
                                                    <h4 class="mb-5">H. Merinda</h4>
                                                    <span>CEO & Co-Founder</span>
                                                    <div class="social-network mt-20">
                                                        <a href="#"><img src="assets/imgs/theme/icons/icon-facebook-brand.svg" alt="" /></a>
                                                        <a href="#"><img src="assets/imgs/theme/icons/icon-twitter-brand.svg" alt="" /></a>
                                                        <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-brand.svg" alt="" /></a>
                                                        <a href="#"><img src="assets/imgs/theme/icons/icon-youtube-brand.svg" alt="" /></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="team-card">
                                                <img src="assets/imgs/page/about-8.png" alt="" />
                                                <div class="content text-center">
                                                    <h4 class="mb-5">Dilan Specter</h4>
                                                    <span>Head Engineer</span>
                                                    <div class="social-network mt-20">
                                                        <a href="#"><img src="assets/imgs/theme/icons/icon-facebook-brand.svg" alt="" /></a>
                                                        <a href="#"><img src="assets/imgs/theme/icons/icon-twitter-brand.svg" alt="" /></a>
                                                        <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-brand.svg" alt="" /></a>
                                                        <a href="#"><img src="assets/imgs/theme/icons/icon-youtube-brand.svg" alt="" /></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
-->
        </div>
    </main>

@endsection