@extends('theams/theam1/layouts.app')
@section('theme1Content')

    <!-- Page Banner -->
    <div class="page-banner container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <div class="banner-content">
                <h3>Privacy Policy</h3>
            </div>
            <ol class="breadcrumb">
                <li><a href="/" title="Home">Home</a></li>
                <li class="active">Privacy Policy</li>
            </ol>
        </div><!-- Container /- -->
    </div><!-- Page Banner /- -->

    <!-- Privacy Policy Section -->
    <div class="about-section container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <!-- Section Header -->
            <div class="section-header">
            <h3>{{$privacyList->heading ?? ''}}</h3>
                <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
            </div><!-- Section Header /- -->
            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="about-content">
                    {!! $privacyList->description ?? '' !!}
                </div>
            </div>
        </div><!-- Container /- -->
    </div>
    <!-- Privacy Policy Section /- -->

    @endsection