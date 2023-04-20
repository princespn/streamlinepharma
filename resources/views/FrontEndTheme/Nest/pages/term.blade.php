@extends('FrontEndTheme.Nest.layout.layout')
@section('title', $termList->heading)
@section('page-content')
<main class="main">
        
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">{{$termList->heading ?? ''}}</h1>
                    
                </div>
            </div> 
            <div class="row">
                <div class="col-lg-12">
                    {!! $termList->description ?? '' !!}
                </div>
                
            </div>
        </div>
    </main>
@endsection