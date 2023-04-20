@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'Contact')
@section('page-content')
<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                     Contact
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="mb-50">
                            
                            <div class="row">
                                
                                <div class="col-lg-12 pl-50 d-lg-block d-none" style='text-align: center;'>
                                    <h4 class="mb-15 text-brand">Office</h4>
                                    {{ $account->address }}<br />
                                    {{ $account->landmark }}<br />
                                    <abbr title="Phone">Phone:</abbr> {{ $account->phone }}<br />
                                    <abbr title="Email">Email: </abbr>{{ $account->email }}<br />
                                    
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection