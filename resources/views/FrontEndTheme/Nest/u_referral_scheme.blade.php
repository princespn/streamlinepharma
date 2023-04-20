@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'About')
@section('page-content')
<main class="main">
        
        <div class="container mb-80 mt-50">
            @foreach($m_data as $key=>$row)
						<div style='position:relative'>
							<img src="{{ $row->image }}"  style="width:100%;">
							<div style='width: 100%;position: absolute;top:0px;'>
							  <div style=''>
								<h2>{!! $row->title !!}asdasd</h2>
								<h4>{!! $row->sub_title !!}</h4>
							  </div>
							</div>
						</div>
			@endforeach
        </div>
    </main>
@endsection