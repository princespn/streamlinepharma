@extends('theams/Front1/app') 
@section('title','Return Policy') 

@section('MainSection')


<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Return Policy
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="single-page pr-30 mb-lg-0 mb-sm-5">
                                    <div class="single-header style-2">
                                        <h2>Return Policy</h2>
                                       
                                    </div>
                                    <div class="single-content mb-50">
                                        <h4>{{$returnList->heading ?? ''}}</h4>
                                        {!! $returnList->description ?? '' !!}
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection