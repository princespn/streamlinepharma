@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'Shipping Policy')
@section('page-content')
<main class="main">
        
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">{{$shippingList->heading ?? ''}}</h1>
                    
                </div>
            </div> 
            <div class="row">
                <div class="col-lg-12">
                    {!! $shippingList->description ?? '' !!}
                </div>
                
            </div>
        </div>
    </main>
@endsection